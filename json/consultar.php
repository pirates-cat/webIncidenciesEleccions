<?php
require('../inc/connecta.php');

function getPara($paramName){
	if (isset($_POST[$paramName])){
		return $_POST[$paramName];
	}
	return "";
};
$deviceid = getPara('deviceid');
$delete = getPara('delete');
$return = array();
if ($delete){
	$consulta = sprintf("DELETE FROM `".$publicDataBase."`.`incidencies` where id = '%s' and deviceid = '%s';", mysql_real_escape_string($delete),mysql_real_escape_string($deviceid));
	$result = mysql_query($consulta, $link);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
}

$consulta = sprintf("SELECT id,data,partit_afectat,provincia,poblacio,collegi_electoral,causa,reportador,contacte_reportador,comentari  FROM `".$publicDataBase."`.`incidencies` where deviceid = '%s';",mysql_real_escape_string($deviceid));
$result = mysql_query($consulta, $link);
if (!$result) {
    //die('Invalid query: ' . mysql_error());
    $return['message'] = "request_fail";
}else{
	$return['list'] =array();
	while ($row = mysql_fetch_assoc($result)) {
		$return['list'][]=$row;
	}
	$return['message'] = "OK";

}
echo json_encode ($return);
