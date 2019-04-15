<?php

include 'user.php';
include 'DBclass.php';
error_reporting(E_ERROR);
$config = require '../../config.php';

session_start();

$userObj = new Cl_User();
$response_array = array();
	$params = json_decode(file_get_contents('php://input'),true);
	header('content-type: application/json');

	if (!array_key_exists('scheme', $params) || !array_key_exists('selecteddate', $params)
											 || !array_key_exists('deliverytime', $params)
											 || !array_key_exists('address', $params) 
											 || !array_key_exists('mobile', $params) 
											 || !array_key_exists('email', $params)
											 || !array_key_exists('paymentmode', $params)
											 || !array_key_exists('shippingcost', $params)
											 || !array_key_exists('orderunit', $params)										
										     || !array_key_exists('totalamount', $params)
											 || !array_key_exists('price', $params))												 
	{
	
		$response_array['status'] = "error";
		$response_array['message'] = "some parameter not specified";
    	echo json_encode($response_array);
    	return false;
	}
	$scheme = $params['scheme'];
	$address =$params['address'];
	if(is_array($params['selecteddate'])){
		$selecteddate =  implode(', ', $params['selecteddate']);
	} else{
		$selecteddate =$params['selecteddate'];
	}
	
	$deliverytime = $params['deliverytime'];
	$email = $params["email"];
	$mobile = $params["mobile"];
	$price = $params["price"];
	$paymentmode = $params["paymentmode"];
	$shippingcost = $params["shippingcost"];
	$orderunit = $params["orderunit"];
	$islunch = $params["islunch"];
	$isDinner = $params["isDinner"];
	$totalamount = $params["totalamount"];

	
	try {
			$order_id = $userObj->registerOrder( array("email"=>$email, "scheme"=>$scheme, "address"=>$address,
						"selecteddate"=>$selecteddate,"email"=>$email, "mobile"=>$mobile,  "deliverytime"=>$deliverytime, 
						"price"=>$price, "orderunit"=>$orderunit,"totalamount"=>$totalamount, "islunch"=>$islunch, "isdinner"=>$isDinner, 
						"paymentmode"=>$paymentmode,"shippingcost"=>$shippingcost));				
			$response_array['status'] = "success";		
			$message = str_replace('%order_id%',$order_id, ORDER_SUCCESS); 
			$response_array['message'] = $message;
			$response_array['order_id'] = $order_id;
			if($paymentmode == 'payumoney')
				processPayUMoney($response_array, $totalamount, $email, $mobile, $order_id, $scheme);
			if($paymentmode == 'cod')
				processCOD($response_array);
			
		} catch (Exception $e) {
			$response_array['status'] = "error";
			$response_array['message'] = $e->getMessage();
    		echo json_encode($response_array);
    		return false;

		}
		
		function processCOD($response_array){
			echo json_encode($response_array); 
		}
		
		function processPayUMoney($response_array, $price, $email, $mobile ,$order_id, $productinfo){
			$MERCHANT_KEY = PAYU_MERCHANT_KEY;
			$SALT = PAYU_SALT;
			$PAYU_BASE_URL = PAYU_BASE_URL;
			$surl = PAYU_BASE_SURL;
			$furl = PAYU_BASE_FURL;
			$action = '';
			$firstname=$email;
			$formError = 0;
			$txnid = "payumoney_" . $order_id;//substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			$hash = '';
			$data  = array("key"=>$MERCHANT_KEY, "txnid"=>$txnid, "amount"=>$price, "firstname"=>$email, "email"=>$email, "phone"=>$mobile, "productinfo"=>$productinfo, "surl"=>$surl, "furl"=>$furl, "service_provider"=>'payu_paisa');
			// Hash Sequence
			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

			//$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
			$hashVarsSeq = explode('|', $hashSequence);
			$hash_string = '';	
			foreach($hashVarsSeq as $hash_var) {
			  $hash_string .= isset($data[$hash_var]) ? $data[$hash_var] : '';
			  $hash_string .= '|';
			}
			$hash_string .= $SALT;
			$hash = strtolower(hash('sha512', $hash_string));
			$action = $PAYU_BASE_URL . '/_payment';							
			$response_array['action'] = $action;
			$response_array['hash'] = $hash;
			$response_array['surl'] = $surl;
			$response_array['furl'] = $furl;
			$response_array['txnid'] = $txnid;
			$response_array['amount'] = $price;
			$response_array['firstname'] = $firstname;
			$response_array['email'] = $email;
			$response_array['productinfo'] = $productinfo;
			$response_array['phone'] = $mobile;
			$response_array['service_provider'] = "payu_paisa";
			$response_array['key'] = $MERCHANT_KEY;
			$response_array['message'] = ORDER_PROCESSING;
    		echo json_encode($response_array);    
		}
	
?>