<?php
# login-callback.php
require_once __DIR__ . '/Facebook/autoload.php';
	include 'user.php';
	include 'DBclass.php';
	include '../../config.php';
 session_start();
$fb = new Facebook\Facebook([
  'app_id' =>FACEBOOK_APPID,
  'app_secret' => FACEBOOK_APP_SECRET,
  'default_graph_version' => 'v2.4',
  ]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
  $fb->setDefaultAccessToken($accessToken);
  $response = $fb->get('/me?fields=name,email');
  $userNode = $response->getGraphUser();
  $username = $userNode->getName();
  $email = $userNode->getEmail();
  $id = "f_" . $userNode->getId();
  $redirect = CONTEXT_PATH;
	if(!empty($_GET['redirect'])) {
		$redirect = $_GET['redirect'];
  }
  try{
	$user = new Cl_User();
	$user->oauth_login(array("email"=>$email, "username"=>$username, "id"=>$id));
	header("Location:" . $redirect);
	die();
  } catch(Exception $ex){
	 echo $ex;
  }
  
  
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

?>