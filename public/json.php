<?php
require('../inc/connecta.php');
function getPara($paramName){
	if (isset($_GET[$paramName])){
		return strip_tags($_GET[$paramName]);
	}
	return "";
};
$since = getPara('since') + 0;
//$since = 1353800683;
$query = sprintf("SELECT DATE_FORMAT(data,%s) hora,partit_afectat,provincia,poblacio,collegi_electoral,solucionada,causa,comentari FROM `incidenciesEleccions`.`incidencies` where borrada = '0' and data > FROM_UNIXTIME(%d) order by data ASC;","'%d/%m</br>%H:%ih'",mysql_real_escape_string($since));
$result = mysql_query($query, $link);

$arrayReturn = array();
$arrayReturn['results'] = array();
if ($result){
	while ($row = mysql_fetch_assoc($result)) {
		 $row['provincia']= ucfirst(strtolower($row['provincia']));
		 $row['poblacio']= ucfirst(strtolower($row['poblacio']));
		 $row['collegi_electoral']= ucfirst(strtolower($row['collegi_electoral']));
         $arrayReturn['results'][]= $row;
    }
}
// in the future, this 'curdate' is the param that requests will send back
$arrayReturn['curdate'] = round(microtime(true));

header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json; charset=UTF-8');
echo json_encode ($arrayReturn,JSON_FORCE_OBJECT);