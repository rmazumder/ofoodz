<?php

include 'user.php';
include 'DBclass.php';
error_reporting(E_ERROR);
$config = require '../../config.php';

session_start();

$params = json_decode(file_get_contents('php://input'),true);

header('content-type: application/json');
$userObj = new Cl_User();


$order_id = $params['order_id'];
$amountpaid = $params['amountpaid'];
$isactive = $params['isactive'];
$notes = $params['notes'];
$totalamount = $params['totalamount'];
$scheme = $params['scheme'];
$address =$params['address'];
$selecteddate =  $params['selecteddate'];
$deliverytime = $params['deliverytime'];
$email = $params["email"];
$mobile = $params["mobile"];
$collectedby = $params["collectedby"];


$userObj->updateOrder(array("email"=>$email, "scheme"=>$scheme, "address"=>$address,
						"selecteddate"=>$selecteddate,"amountpaid"=>$amountpaid, "mobile"=>$mobile,  "deliverytime"=>$deliverytime,
						 "totalamount"=>$totalamount,  "notes"=>$notes,  "isactive"=>$isactive,  "order_id"=>$order_id, "collectedby"=>$collectedby));
//echo json_encode($data);
die;	

?>