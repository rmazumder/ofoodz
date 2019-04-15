<?php
	
	include 'user.php';
	include 'DBclass.php';
	include '../../config.php';
	//include 'message.php';
	

	session_start();
	
	$response_array = array();
	$params = json_decode(file_get_contents('php://input'),true);

	header('content-type: application/json');
	//echo print_r($params);


	if (!array_key_exists('mode', $params)) {
		$response_array['status'] = "error";
		$response_array['message'] = "Mode not specified";
    	echo json_encode($response_array);
		return false;
	}

	$mode = $params['mode'];
	
	
	$user = new Cl_User();
	if($mode == 'login'){
		if(!array_key_exists('email', $params) || !array_key_exists('password', $params))
		{
			
			$response_array['status'] = "error";
			$response_array['message'] = "email or password not specified";
	    	echo json_encode($response_array);
			return false;
		}
		$email = $params['email'];
		$password = $params['password'];		
		try {
			$user->login( array("email"=>$email, "password"=>$password));

			$logedinuser = $_SESSION['name'];

			$response_array['status'] = "success";
			$response_array['user'] = $logedinuser;
			$response_array['action'] = "loggedin";
			$response_array['message'] = "Successfuly logged in !!!";
			if(!array_key_exists('redirect', $params)) {
				$redirect = CONTEXT_PATH;
			} else {
				$redirect = $params['redirect'];
			}
			$redirect = urldecode($redirect);
			$response_array['redirect'] = $redirect;
			
    		echo json_encode($response_array);
    		

		} catch (Exception $e) {
			//echo $e;
			$response_array['status'] = "error";
			$response_array['message'] = LOGIN_FAIL;
    		echo json_encode($response_array);
    		return false;

		}
		
		
	} else if($mode == 'registration'){
		if(!array_key_exists('password', $params) || !array_key_exists('name', $params) || !array_key_exists('confirm_password', $params)
			|| !array_key_exists('email', $params) || !array_key_exists('mobile', $params))
		{
			$response_array['status'] = "error";
			$response_array['message'] = "some parameter not specified";
    		echo json_encode($response_array);
    		return false;
			
		}
		$email = $params['email'];
		$password = $params['password'];		
		$name = $params['name'];
		$confirm_password = $params['confirm_password'];		
		$mobile = $params['mobile'];	
		try{
			$user->registration( array("email"=>$email, "password"=>$password,"name"=>$name, "confirm_password"=>$confirm_password, "mobile"=>$mobile) );
			$response_array['status'] = "success";
			$response_array['user'] = $name;
			$response_array['action'] = "accountcreated";
			$response_array['message'] = REGISTRATION_SUCCESS;
    		echo json_encode($response_array);

		} catch(Exception $e){
			$response_array['status'] = "error";
			if($e->getMessage() == "SQL_DUPLICATE"){
				$response_array['message'] = ACCOUNT_EXISTS_ERROR;
			} else {
				$response_array['message'] = "failed to create account";
			}
			$response_array['detail_message'] = $e->getMessage();
    		echo json_encode($response_array);
    		return false;
		}
	} else if($mode == 'forgotpassword'){
		if(!array_key_exists('email', $params))
		{
			$response_array['status'] = "error";
			$response_array['message'] = "some parameter not specified";
    		echo json_encode($response_array);
    		return false;
			
		}
		$email = $params['email'];
		try{
			$user->forgetPassword( array("email"=>$email));
			$response_array['status'] = "success";
			$response_array['action'] = "pwd_reset";
			$response_array['message'] = "New password has been generated and mailed to $email.";
    		echo json_encode($response_array);

		} catch(Exception $e){
			$response_array['status'] = "error";
			$response_array['message'] = "Failed to generate new password";
			$response_array['detail_message'] = $e->getMessage();
    		echo json_encode($response_array);
    		return false;
		}
	}
	

	

?>