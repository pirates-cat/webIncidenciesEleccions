<?php
require('connecta_admin.php');
require_once('auth.php');
header('Content-Type: text/html; charset=UTF-8');

function execQuery($link, $consulta){
	$result = mysql_query($consulta, $link);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
}

$block = (isset($_GET['block']))? $_GET['block'] : false;
if ($block){
	execQuery($link, sprintf("INSERT IGNORE INTO `incidenciesEleccions`.`ip_bans` values('%s');", mysql_real_escape_string($block)));
}

$blockdevice = (isset($_GET['blockdevice']))? $_GET['blockdevice'] : false;
if ($blockdevice){
	execQuery($link, sprintf("INSERT IGNORE INTO `incidenciesEleccions`.`device_bans` values('%s');", mysql_real_escape_string($blockdevice)));
}

$delete = (isset($_GET['delete']))? $_GET['delete'] : false;
if ($delete){
	execQuery($link, sprintf("DELETE FROM `incidenciesEleccions`.`incidencies` where id = '%s';", mysql_real_escape_string($delete)));
}

$resolve = (isset($_GET['resolve']))? $_GET['resolve'] : false;
if ($resolve){
	execQuery($link, sprintf("UPDATE `incidenciesEleccions`.`incidencies` set solucionada = '1' where id = '%s';", mysql_real_escape_string($resolve)));
}

$unresolve = (isset($_GET['unresolve']))? $_GET['unresolve'] : false;
if ($unresolve){
	execQuery($link, sprintf("UPDATE `incidenciesEleccions`.`incidencies` set solucionada = '0' where id = '%s';", mysql_real_escape_string($unresolve)));
}

$hide = (isset($_GET['hide']))? $_GET['hide'] : false;
if ($hide){
	execQuery($link, sprintf("UPDATE `incidenciesEleccions`.`incidencies` set borrada = '1' where id = '%s';", mysql_real_escape_string($hide)));
}

$show = (isset($_GET['show']))? $_GET['show'] : false;
if ($show){
	execQuery($link, sprintf("UPDATE `incidenciesEleccions`.`incidencies` set borrada = '0' where id = '%s';", mysql_real_escape_string($show)));
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
echo "<a href='bans.php'>Veure llista de bans</a><br/><hr/>";
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
     <a href='?resolve={$row['id']}' title='es mostrara com a resolta a la web'>Resoldre</a><br/>
     <a href='?unresolve={$row['id']}' title='es mostrara com a no resolta a la web'>Unresoldre</a><br/>
     <a href='?hide={$row['id']}' title='NO es mostrara a la web publica pero sera visible aqui'>Amagar</a><br/>
     <a href='?show={$row['id']}' title='SI es mostrara a la web publica pero sera visible aqui'>Mostrar</a><br/>
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