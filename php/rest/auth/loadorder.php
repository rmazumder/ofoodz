<?php

include 'user.php';
include 'DBclass.php';
error_reporting(E_ERROR);
$config = require '../../config.php';

session_start();

$userObj = new Cl_User();
//$response_array = array();
$data = $userObj->fetchOrder($_GET['id']);
echo json_encode($data);
die;	

?>