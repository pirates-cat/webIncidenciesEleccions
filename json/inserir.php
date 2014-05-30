<?php 
error_reporting(0);
require("../inc/connecta.php");


function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){   //check ip from share internet
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   //to check ip is pass from proxy
    	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
};

function getPara($paramName){
	/*
	if (isset($_GET[$paramName])){
		return $_GET[$paramName];
	}
	*/
	if (isset($_POST[$paramName])){
		return strip_tags($_POST[$paramName]);
	}
	return "";
};

//'partit_afectat=test&provincia=test&poblacio=test&coords=test&collegi_electoral=test&causa=test&reportador=test&contacte_reportador=test&comentari=test

$ip = getRealIpAddr();

$partit_afectat = getPara('partit_afectat');
$collegi_electoral = getPara('collegi_electoral');
$causa = getPara('causa');
$reportador = getPara('reportador');
$contacte_reportador = getPara('contacte_reportador');
$comentari = getPara('comentari');
$provincia = getPara('provincia');
$poblacio = getPara('poblacio');
$coords = getPara('coords');
$deviceid = getPara('deviceid');
$return = array();

if($ip){
	$consulta = sprintf("SELECT * FROM `".$publicDataBase."`.`device_bans` WHERE deviceid = '%s' UNION SELECT * FROM `".$publicDataBase."`.`ip_bans` WHERE ip = '%s'",mysql_real_escape_string($deviceid),mysql_real_escape_string($ip));
	$resultado = mysql_query($consulta, $link);
	if (!$resultado) {
		$return['message'] = "request_fail";
	}else{
		if(mysql_num_rows($resultado) > 0){
			$return['message'] = "request_denied";
		}else{
			if ($partit_afectat != "" && $provincia != "" && $poblacio != "" && $collegi_electoral !="" && $causa != "" && $reportador != "" && $contacte_reportador != ""){
				$consulta = sprintf("INSERT INTO  `".$publicDataBase."`.`incidencies` ( `ip` , `partit_afectat` , `provincia`, `poblacio`, `coords` , `deviceid`,`collegi_electoral` , `causa` , `reportador` , `contacte_reportador` , `comentari`)
				VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
					mysql_real_escape_string($ip),
					mysql_real_escape_string($partit_afectat),
					mysql_real_escape_string($provincia),
					mysql_real_escape_string($poblacio),
					mysql_real_escape_string($coords),
					mysql_real_escape_string($deviceid),
					mysql_real_escape_string($collegi_electoral),
					mysql_real_escape_string($causa),
					mysql_real_escape_string($reportador),
					mysql_real_escape_string($contacte_reportador),
					mysql_real_escape_string($comentari)
					);
				$resultado = mysql_query($consulta, $link);
				if (!$resultado) {
				 	//$return['message'] =mysql_error(); 
					$return['message'] ="request_fail";
				}else{
					$return['message'] = "OK";
				}
			}else{
				$return['message'] = "request_incomplete";
			}
		}
	}
	
}else{
	$return['message'] = "request_fail";
}
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json; charset=UTF-8');
echo json_encode ($return);
