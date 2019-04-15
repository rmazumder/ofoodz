<?php
# login.php
require_once __DIR__ . '/Facebook/autoload.php';
include '../../config.php';
session_start();


$redirect = "";
if(!empty($_GET['redirect']) && $_GET['redirect'] !='undefined') {
	$redirect = "?redirect=" . $_GET['redirect'];
}
$fb = new Facebook\Facebook([
  'app_id' => '1636530053289122',
  'app_secret' => '91b02f2263f792c13aed6178393f2eea',
  'default_graph_version' => 'v2.4',
  ]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl(FACEBOOK_REDIRECT_URI . $redirect, $permissions);

echo $loginUrl;

//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>