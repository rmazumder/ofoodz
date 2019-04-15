<?php

include 'message.php';
include '../../mail/send_mail.php';
class Cl_User
{
	/**
	 * @var will going contain database connection
	 */
	protected $_con;

	/**
	 * it will initalize DBclass
	 */
	public function __construct()
	{
		$db = new Cl_DBclass();
		$this->_con = $db->con;
	}

	/**
	 * this will handles user registration process
	 * @param array $data
	 * @return boolean true or false based success 
	 */
	public function registration( array $data )
	{
		if( !empty( $data ) ){

			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);

			// escape variables for security
			$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = mysqli_real_escape_string( $this->_con, $trimmed_data['confirm_password'] );
			$mobile = mysqli_real_escape_string( $this->_con, $trimmed_data['mobile'] );
			// Check for an email address:
			if (filter_var( $trimmed_data['email'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email']);
			} else {
				throw new Exception( "Please enter a valid email address!" );
			}

			if((!$name) || (!$email) || (!$password) || (!$cpassword) || (!$mobile) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "INSERT INTO users (user_id, name, email, password, mobile, created) VALUES (NULL, '$name', '$email', '$password', $mobile, CURRENT_TIMESTAMP)";
			try{
				if(!mysqli_query($this->_con, $query)){
					if(mysqli_errno($this->_con) == 1062){
						throw new Exception('SQL_DUPLICATE');
					} 
					$error = mysqli_error($this->_con);										
					throw new Exception($error);
				} 
				$message = file_get_contents('../../mail_templates/accountcreated.html'); 
				$message = str_replace('%email%',$email, $message); 
				$message = str_replace('%user%',$name, $message); 
				$message = str_replace('%password%',$cpassword, $message); 
				sendNotification($email ,$name,"OfoodZ Account Created!", $message, "");
			} catch(mysqli_sql_exception $e){
				throw $e;
			}
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}
	/**
	 * This method will handle user login process
	 * @param array $data
	 * @return boolean true or false based on success or failure
	 */
	public function login( array $data )
	{
		$_SESSION['logged_in'] = false;
		if( !empty( $data ) ){

			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);

			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con,  $trimmed_data['email'] );
			$password = mysqli_real_escape_string( $this->_con,  $trimmed_data['password'] );

			if((!$email) || (!$password) ) {
				throw new Exception( LOGIN_FIELDS_MISSING );
			}
			$password = md5( $password );
			$query = "SELECT user_id, name, email, usertype, created FROM users where email = '$email' and password = '$password' ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		} else{
			throw new Exception( LOGIN_FIELDS_MISSING );
		}
	}

	/**
	 * This will shows account information and handles password change
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */

	public function account( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);

			// escape variables for security
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = $trimmed_data['confirm_password'];
			$user_id = mysqli_real_escape_string( $this->_con, $trimmed_data['user_id'] );

			if((!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "UPDATE users SET password = '$password' WHERE user_id = $user_id";
			if(mysqli_query($this->_con, $query))return true;
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}

	public function updateOrder( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);

			// escape variables for security
			$order_id = mysqli_real_escape_string( $this->_con, $trimmed_data['order_id'] );
			$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email'] );
			$notes = mysqli_real_escape_string( $this->_con, $trimmed_data['notes'] );
			$amountpaid = mysqli_real_escape_string( $this->_con, $trimmed_data['amountpaid'] );
			$totalamount = mysqli_real_escape_string( $this->_con, $trimmed_data['totalamount'] );
			$scheme = mysqli_real_escape_string( $this->_con, $trimmed_data['scheme'] );
			$address = mysqli_real_escape_string( $this->_con, $trimmed_data['address'] );
			$selecteddate = mysqli_real_escape_string( $this->_con, $trimmed_data['selecteddate'] );
			$deliverytime = mysqli_real_escape_string( $this->_con, $trimmed_data['deliverytime'] );
			$mobile = mysqli_real_escape_string( $this->_con, $trimmed_data['mobile'] );
			$isactive = mysqli_real_escape_string( $this->_con, $trimmed_data['isactive'] );
			$collectedby = mysqli_real_escape_string( $this->_con, $trimmed_data['collectedby'] );
			$updatedby = mysqli_real_escape_string( $this->_con, $trimmed_data['updatedby'] );



			if(!$order_id) {
				throw new Exception( FIELDS_MISSING );
			}
			echo $query;
			$query = "UPDATE order_table SET ";
			if($email){
				$query = $query . "email='$email'";
			}
			if($notes){
				$query = $query . ", notes='$notes'";
			}
			if($amountpaid){
				$query = $query . ", amountpaid='$amountpaid'";
			}
			if($totalamount){
				$query = $query . ", totalamount='$totalamount'";
			}
			if($scheme){
				$query = $query . ", scheme='$scheme'";
			}
			if($address){
				$query = $query . ", address='$address'";
			}
			if($selecteddate){
				$query = $query . ", selecteddate='$selecteddate'";
			}
			if($deliverytime){
				$query = $query . ", deliverytime='$deliverytime'";
			}
			if($mobile){
				$query = $query . ", mobile='$mobile'";
			}
			if($collectedby){
				$query = $query . ", collectedby='$collectedby'";
			}
			//if($isactive){
				$query = $query . ", isactive='$isactive'";
			//}

			$query = $query . " where order_id = $order_id";
			if($updatedby == 'payumoney'){
				
				$message = file_get_contents('../../mail_templates/payum_order.html'); 
				//$message = str_replace('%scheme%',$scheme, $message); 
				$message = str_replace('%user%',$email, $message); 
				//$message = str_replace('%selecteddate%',$selecteddate, $message); 
				//$message = str_replace('%address%',$address, $message); 
				//$message = str_replace('%mobile%',$mobile, $message); 
				//$message = str_replace('%price%',$totalamount, $message); 
				//$message = str_replace('%order_id%',$order_id, $message); 
				$message = str_replace('%ofoodz_contact%',OFOODZ_CONTACT, $message); 
				$message = str_replace('%security_deposit%',SECURITY_DEPOSITE, $message); 
				//$message = str_replace('%deliverytime%',$deliverytime, $message); 
				//$message = str_replace('%paymentmode%',$paymentmode, $message); 						
				sendNotification($email , $email ,"Order successful Processed", $message, "");
				
			}
			
			if(mysqli_query($this->_con, $query))return true;
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}

	/**
	 * This handle sign out process
	 */
	public function logout()
	{
		session_unset();
		session_destroy();
		header('Location: index.php');
	}

	/**
	 * This reset the current password and send new password to mail
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	public function forgetPassword( array $data )
	{
		if( !empty( $data ) ){

			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con, trim( $data['email'] ) );

			if((!$email) ) {
				throw new Exception( FIELDS_MISSING );
			}
			$password = $this->randomPassword();
			//echo $password;
			$password1 = md5( $password );
			$query = "UPDATE users SET password = '$password1' WHERE email = '$email'";
			//echo $query;
			if(mysqli_query($this->_con, $query)){
				$to = $email;
				$subject = "Password Reset Request";
				$txt = "Your New Password ".$password;
				$message = file_get_contents('../../mail_templates/passwordchange.html'); 
				$message = str_replace('%new_password%',$password, $message); 
				$message = str_replace('%user%',$email, $message); 
				sendNotification($to ,$email,$subject, $message, $txt);
				return true;
			} else {
				//echo "failed";
				$error = mysqli_error($this->_con);		
				//$errorno = mysqli_errno($this->_con);	
				//echo $error;	
				//echo $errorno;							
				throw new Exception($error);
				
			}
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}

	/**
	 * This will generate random password
	 * @return string
	 */

	private function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	public function registerOrder( array $data )
	{
		if( !empty( $data ) ){

			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);

			// escape variables for security
			$scheme = mysqli_real_escape_string( $this->_con, $trimmed_data['scheme'] );
			$selecteddate = mysqli_real_escape_string( $this->_con, $trimmed_data['selecteddate'] );
			$deliverytime = mysqli_real_escape_string( $this->_con, $trimmed_data['deliverytime'] );
			$address = mysqli_real_escape_string( $this->_con, $trimmed_data['address'] );
			$mobile = mysqli_real_escape_string( $this->_con, $trimmed_data['mobile'] );
			$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email'] );
			$price = mysqli_real_escape_string( $this->_con, $trimmed_data['price'] );
			$islunch = mysqli_real_escape_string( $this->_con, $trimmed_data['islunch'] );
			$isdinner = mysqli_real_escape_string( $this->_con, $trimmed_data['isdinner'] );
			$paymentmode = mysqli_real_escape_string( $this->_con, $trimmed_data['paymentmode'] );
			$totalamount = mysqli_real_escape_string( $this->_con, $trimmed_data['totalamount'] );
			$shippingcost = mysqli_real_escape_string( $this->_con, $trimmed_data['shippingcost'] );
			$orderunit = mysqli_real_escape_string( $this->_con, $trimmed_data['orderunit'] );

			if((!$scheme) || (!$selecteddate) || (!$deliverytime) || (!$address) || (!$mobile)  ) {
				throw new Exception( FIELDS_MISSING );
			}
			
			$query = "INSERT INTO order_table (order_id,  email, scheme, selecteddate, deliverytime, address, mobile, islunch, isdinner, collectedby, shippingcharge, mealamount, totalamount,unit, created) VALUES 
							(NULL,  '$email', '$scheme','$selecteddate','$deliverytime','$address', '$mobile', '$islunch','$isdinner','$paymentmode','$shippingcost','$price','$totalamount','$orderunit', CURRENT_TIMESTAMP)";
			try{
				if(!mysqli_query($this->_con, $query)){
					if(mysqli_errno($this->_con) == 1062){
						throw new Exception('SQL_DUPLICATE');
					} 
					$error = mysqli_error($this->_con);										
					throw new Exception($error);
				} 
				$order_id = "ofoodz_" . mysqli_insert_id($this->_con);
				
				if($paymentmode == "cod"){
						$message = file_get_contents('../../mail_templates/cod_order.html'); 
						$message = str_replace('%scheme%',$scheme, $message); 
						$message = str_replace('%user%',$email, $message); 
						$message = str_replace('%selecteddate%',$selecteddate, $message); 
						$message = str_replace('%address%',$address, $message); 
						$message = str_replace('%mobile%',$mobile, $message); 
						$message = str_replace('%price%',$totalamount, $message); 
						$message = str_replace('%order_id%',$order_id, $message); 
						$message = str_replace('%ofoodz_contact%',OFOODZ_CONTACT, $message); 
						$message = str_replace('%security_deposit%',SECURITY_DEPOSITE, $message); 
						$message = str_replace('%deliverytime%',$deliverytime, $message); 
						$message = str_replace('%paymentmode%',$paymentmode, $message); 						
						sendNotification($email , $name ,"Order successful Processed", $message, "");
				}
				return $order_id;
			} catch(mysqli_sql_exception $e){
				throw $e;
			}
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}
	
	public function getUserAddress($email)
	{
			// Trim all the incoming data:
			$email = mysqli_real_escape_string( $this->_con, trim($email));

			if((!$email) ) {
				throw new Exception( FIELDS_MISSING );
			}	
			$data = array();
			try {
			$query = "SELECT address FROM order_table where email = '$email'";
			$result = mysqli_query($this->_con, $query);
			
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$row = $result->fetch_array(MYSQLI_ASSOC);
					array_push($data,$row["address"]);
				}
			}
			}catch(mysqli_sql_exception $e){
				throw $e;
			}
			return $data;	
			
	}

	public function fetchOrder($orderKey)
	{
			// Trim all the incoming data:
			$orderKey = mysqli_real_escape_string( $this->_con, trim($orderKey));

			$query = "SELECT * FROM order_table where isActive=1 ORDER BY created DESC;";
			if(($orderKey) ) {
				$query = "SELECT * FROM order_table where order_id = '$orderKey'";
			}	
			
			try {
			$result = mysqli_query($this->_con, $query);
			$dataarray = array();
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {

					$dataarray[] = $row;
				}
			}
			}catch(mysqli_sql_exception $e){
				throw $e;
			}
			return $dataarray;	
			
	}
	
	public function oauth_login( array $data )
	{
		$_SESSION['logged_in'] = false;
		//echo print_r($data);
		if( !empty( $data ) ){

			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);

			// escape variables for security
			$username = mysqli_real_escape_string( $this->_con,  $trimmed_data['username'] );
			$email = mysqli_real_escape_string( $this->_con,  $trimmed_data['email'] );
			$id = mysqli_real_escape_string( $this->_con,  $trimmed_data['id'] );
			if(!$email ) {
				throw new Exception( LOGIN_FIELDS_MISSING );
			}
			if(!$username){
				$username = $email;
			}
			//$password = md5( $password );
			$query = "SELECT user_id, name, email, usertype, mobile, created FROM users where email = '$email'";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				$query = "INSERT INTO users (user_id, name, email, social_id, created) VALUES (NULL, '$username', '$email', '$id', CURRENT_TIMESTAMP)";
				if(mysqli_query($this->_con, $query));
				$query = "SELECT user_id, name, email, usertype, created FROM users where email = '$email' ";
				$result = mysqli_query($this->_con, $query);
				$data = mysqli_fetch_assoc($result);
				$count = mysqli_num_rows($result);
				if( $count == 1){
					$_SESSION = $data;
					$_SESSION['logged_in'] = true;
					return true;
				}else{
					throw new Exception( LOGIN_FAIL );
				}
			}
		} else{
			throw new Exception( LOGIN_FIELDS_MISSING );
		}
	}
}