<?php
include 'user.php';
include 'DBclass.php';
error_reporting(E_ERROR);
$config = require '../../config.php';

date_default_timezone_set('Asia/Kolkata');
$today = date("m/d/Y");
echo $today;
session_start();
$userObj = new Cl_User();
$data = $userObj->fetchOrder($_GET['id']);
$responseArray = array();

foreach ($data as $value) {
    $selecteddates = explode(",", $value['selecteddate']);
    

    foreach ($selecteddates as $date) {
         $datetime =  date('m/d/Y', strtotime($date));
         //echo print_r($selecteddates);
         //  echo $datetime . "=" .$today . "<br>";

         if($datetime == $today){
           // echo "match " . $datetime . "<br>";
             $message = "<tr><td>" . $value['email']. 
             "</td><td>" . $value['address'] . 
             "</td><td> " . $value['mobile'].
             "</td><td> " . $value['deliverytime'].
             "</td><td> " . $value['notes'].
             "</td><td> " . $value['scheme'].
             "</td></tr>";
             array_push($responseArray, $message);
             //break;
         }
    }

}


$emailTable =  "<table border='1'><tr><th>Email</th><th>Address</th><th>Mobile</th><th>Deliverytime</th><th>notes</th><th>Scheme</th></tr>";
foreach ($responseArray as $res) {
  $emailTable =  $emailTable. $res;
}
$emailTable = $emailTable . "</table>";

$emailContent = file_get_contents('../../mail_templates/dailyschedule.html'); 
$emailContent = str_replace('%table%',$emailTable, $emailContent); 

sendNotification(MAIL_DELIVERY , "Delivery" ,"Today's Delivery Details", $emailContent, "");

?>