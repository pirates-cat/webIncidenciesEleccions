<?php
require('connecta_admin.php');
require_once('auth.php');
header('Content-Type: text/html; charset=UTF-8');

$deleteip = (isset($_GET['deleteip']))? $_GET['deleteip'] : false;
if ($deleteip){
	$consulta = sprintf("DELETE FROM `incidenciesEleccions`.`ip_bans` where ip = '%s';", mysql_real_escape_string($deleteip));
	$result = mysql_query($consulta, $link);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
}

$deletedevice = (isset($_GET['deletedevice']))? $_GET['deletedevice'] : false;
if ($deletedevice){
	$consulta = sprintf("DELETE FROM `incidenciesEleccions`.`device_bans` where deviceid = '%s';", mysql_real_escape_string($deletedevice));
	$result = mysql_query($consulta, $link);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
}

$consulta = sprintf("SELECT * FROM `incidenciesEleccions`.`device_bans`;");
$result = mysql_query($consulta, $link);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<a href='index.php'>llista de reports</a><br/>";
echo "DEVICE BANS<br/>";
echo "<table border=1>";
$header_shown = false;
while ($row = mysql_fetch_assoc($result)) {
    if (!$header_shown){
    	echo "<tr>";
    	echo "<th>Accions</th>";
    	foreach($row as $key => $value){
    		echo "<th>",$key,"</th>";
  
    	}
    	echo "</tr>";
    	$header_shown = true;
    }
    echo "<tr>";
     echo "<td><a href='?deletedevice={$row['deviceid']}'>Raise Ban</a></td>";
    foreach($row as $key => $value){
    	 echo "<td>",$value,"</td>";
  
    }
	echo "</tr>";
}
echo "</table>";

$consulta = sprintf("SELECT * FROM `incidenciesEleccions`.`ip_bans`;");
$result = mysql_query($consulta, $link);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "IP BANS<br/>";
echo "<table border=1>";
$header_shown = false;
while ($row = mysql_fetch_assoc($result)) {
    if (!$header_shown){
    	echo "<tr>";
    	echo "<th>Accions</th>";
    	foreach($row as $key => $value){
    		echo "<th>",$key,"</th>";
  
    	}
    	echo "</tr>";
    	$header_shown = true;
    }
    echo "<tr>";
     echo "<td><a href='?deleteip={$row['ip']}'>Raise Ban</a></td>";
    foreach($row as $key => $value){
    	 echo "<td>",$value,"</td>";
  
    }
	echo "</tr>";
}
echo "</table>";