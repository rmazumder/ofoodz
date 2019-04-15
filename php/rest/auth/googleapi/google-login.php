<?php
require_once __DIR__ . '\src\Google\autoload.php';
session_start();


 $client_id = '642207433933-b5b31qhghh3hfjlcvtbp8ql8sjhdvd9o.apps.googleusercontent.com';
 $client_secret = '9hKwMZKVFw8ruaoJIAiTjnRf';
 $redirect_uri = 'http://localhost/tw/php/auth/';
 
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

//require_once("loginpageview.php")
?>