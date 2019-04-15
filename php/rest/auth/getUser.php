<?php

include 'user.php';
include 'DBclass.php';
error_reporting(E_ERROR);
$config = require '../../config.php';
session_start();

$userObj = new Cl_User();
$response_array = array();

if(!empty($_GET['logout'])) {
	session_unset();
	session_destroy();
	header('Location: ../../../index.html');
}

if(!empty($_GET['address'])) {
	$email = $_GET['address'];
	$address = $userObj->getUserAddress($email);
	echo json_encode(array_unique($address));
	die;
}

if(!empty($_SESSION['name'])) {
	$response_array['user']= $_SESSION["name"]; 
}
if(!empty($_SESSION['email'])) {
	$response_array['email'] = $_SESSION["email"];
}

if(!empty($_SESSION['mobile'])) {
	$response_array['mobile']  = $_SESSION["mobile"];
}

if(!empty($_SESSION['address'])) {
	$response_array['address'] = $_SESSION["address"];
}

if(!empty($_SESSION['usertype'])) {
	$response_array['usertype'] = $_SESSION["usertype"];
}
if(!empty($_SESSION['userlocation'])) {
	$response_array['userlocation'] = $_SESSION["userlocation"];
}


echo json_encode($response_array);



?>
