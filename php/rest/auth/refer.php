<?php
include '../../mail/send_mail.php';
error_reporting(E_ERROR);
$config = require '../../config.php';
session_start();

$response_array = array();
	$params = json_decode(file_get_contents('php://input'),true);
	header('content-type: application/json');

	if (array_key_exists('data', $params))
	{
		$message = $params['data'];
		sendNotification(MAIL_REFER , "Ofoodz" ,"OfoodZ refer mail", json_encode($message), "");
		$response_array['status'] = "success";		
		$response_array['message'] = REFER_THANKS;
		echo json_encode($response_array);    	
	}
	
	
	
	
	

?>