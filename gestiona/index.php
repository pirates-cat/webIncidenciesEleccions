<?php
require('connecta_admin.php');
require_once('auth.php');
header('Content-Type: text/html; charset=UTF-8');
$block = (isset($_GET['block']))? $_GET['block'] : false;
if ($block){
	$consulta = sprintf("INSERT IGNORE INTO `incidenciesEleccions`.`ip_bans` values('%s');", mysql_real_escape_string($block));
	$result = mysql_query($consulta, $link);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
}

$blockdevice = (isset($_GET['blockdevice']))? $_GET['blockdevice'] : false;
if ($blockdevice){
	$consulta = sprintf("INSERT IGNORE INTO `incidenciesEleccions`.`device_bans` values('%s');", mysql_real_escape_string($blockdevice));
	$result = mysql_query($consulta, $link);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
}

$delete = (isset($_GET['delete']))? $_GET['delete'] : false;
if ($delete){
	$consulta = sprintf("DELETE FROM `incidenciesEleccions`.`incidencies` where id = '%s';", mysql_real_escape_string($delete));
	$result = mysql_query($consulta, $link);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
}

$order = (isset($_GET['order']))? $_GET['order'] : false;
if (!$order){
	$consulta = sprintf("SELECT * FROM `incidenciesEleccions`.`incidencies`;");
}else{
	$consulta = sprintf("SELECT * FROM `incidenciesEleccions`.`incidencies` order by %s;", mysql_real_escape_string($order));
}

$result = mysql_query($consulta, $link);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<a href='bans.php'>llista de bans</a>";
echo "<table border=1>";
$header_shown = false;
while ($row = mysql_fetch_assoc($result)) {
    if (!$header_shown){
    	echo "<tr>";
    	echo "<th>Accions</th>";
    	foreach($row as $key => $value){
    		echo "<th><a href='?order=$key'>",$key,"</a></th>";
  
    	}
    	echo "</tr>";
    	$header_shown = true;
    }
    echo "<tr>";
     echo "<td>
     <a href='?delete={$row['id']}'>Borrar</a><br/>
     <a href='?block={$row['ip']}'>Ban Ip</a><br/>
     <a href='?blockdevice={$row['deviceid']}'>Ban Dispositiu</a>
     </td>";
    foreach($row as $key => $value){
    	 echo "<td>",$value,"</td>";
  
    }
	echo "</tr>";
}
echo "</table>";