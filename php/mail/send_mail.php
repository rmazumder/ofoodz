<?php
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';


function sendNotification($to_recepient, $recepientname, $subject, $messagebody, $alternatemessage){

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host  =new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = MAIL_HOST; // SMTP server
  // $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Port       = MAIL_PORT;                    // set the SMTP port for the GMAIL server
  $mail->Username   = MAIL_USER; // SMTP account username
  $mail->Password   = MAIL_PWD;        // SMTP account password
  //$mail->AddReplyTo($to_recepient, $recepientname);
  //$mail->AddAddress('whoto@otherdomain.com', 'John Doe');
  $mail->SetFrom(MAIL_USER, 'OfoodZ.com');
  $mail->addAddress($to_recepient, $recepientname);
  $mail->AddBCC(MAIL_BCC1);
  $mail->AddBCC(MAIL_BCC2);
  $mail->AddBCC(MAIL_BCC3);
  $mail->SMTPSecure = 'tls';

  $mail->Subject = $subject;
  $mail->AltBody = $alternatemessage;
  $mail->MsgHTML($messagebody);;
  $mail->Send();
  return true;    
} catch (phpmailerException $e) {
	throw $e;
} catch (Exception $e) {
	throw $e;
}

}

?>