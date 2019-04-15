<?php

include 'send_mail.php';
// Check for empty fields

if(empty($_POST['name'])  		||
    empty($_POST['email']) 		||
    empty($_POST['phone']) 		||
    empty($_POST['message'])	||
    empty($_POST['messagetype'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$messagetype = $_POST['messagetype'];

echo $messagetype;


if($messagetype == 'contact'){
	
	//($to_recepient, $recepientname, $subject, $messagebody, $alternatemessage)
	 $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";

	 sendNotification("ruhul.mazumder@gmail.com","ruhul","Contact Request", $email_body, "");
	




} else if($messagetype == 'order') {
	
	$meal_order = $_POST['meal_order'];

}


?>