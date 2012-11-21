<?php
error_reporting(0);
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json; charset=UTF-8');
$return = array();
$return['message'] = "OK";
echo json_encode ($return);
