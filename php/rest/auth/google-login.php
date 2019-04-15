<?php
require_once __DIR__ . '\googleapi\src\Google\autoload.php';
session_start();
	include '../../config.php';

$redirect = "";
if(!empty($_GET['redirect']) && $_GET['redirect'] !='undefined') {
	$redirect = $_GET['redirect'];
	$_SESSION['oauth_redirect'] = $redirect;
}
// unset($_SESSION['access_token']);
 $client_id = GOOGLE_CLIENT_ID;
 $client_secret = GOOGLE_CLIENT_SECRET;
 $redirect_uri = GOOGLE_REDIRECT_URI;
 
//Create Client Request to access Google API
$client = new Google_Client();
$client->setApplicationName("PHP Google OAuth Login Example");
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/userinfo.email");

//Send Client Request
$objOAuthService = new Google_Service_Oauth2($client);

$authUrl = $client->createAuthUrl();
echo $authUrl;

?>