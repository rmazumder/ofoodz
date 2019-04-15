<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
session_start();

require_once __DIR__ . '\googleapi\src\Google\autoload.php';
	include 'user.php';
	include 'DBclass.php';
	include '../../config.php';
/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
 $client_id = GOOGLE_CLIENT_ID;
 $client_secret = GOOGLE_CLIENT_SECRET;
 $redirect_uri = GOOGLE_REDIRECT_URI;

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/userinfo.email");

$service  = new Google_Service_Oauth2($client);
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $client->setAccessToken($_SESSION['access_token']);
  $user = $service->userinfo->get();
  $redirect = CONTEXT_PATH;
	if (isset($_SESSION['oauth_redirect'])){
		$redirect = $_SESSION['oauth_redirect'];
	}
	try {
		$email = $user['email'];
		$username = $user['name'];
		$id = 'g_' . $user['id'];
		//echo print_r($user);
		//echo $id;
		$user = new Cl_User();
		$user->oauth_login(array("email"=>$email, "username"=>$username, "id"=>$id));
		//echo print_r($redirect);
		header("Location:" . $redirect);
		die();
	  } catch(Exception $ex){
		 echo $ex;
	  }
 // $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
 // header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
?>
