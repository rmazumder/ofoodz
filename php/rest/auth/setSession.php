<?php

session_start();

if(!empty($_GET['userlocation'])) {
	$_SESSION['userlocation'] =$_GET['userlocation'];
}





?>
