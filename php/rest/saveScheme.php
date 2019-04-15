<?php
$config = require '../config.php';

 $postdata = file_get_contents("php://input");


$myfile = fopen("../../json/scheme.json", "w") or die("Unable to open file!");
//$txt = $menudata;
fwrite($myfile, $postdata);
//$txt = "Jane Doe\n";
//fwrite($myfile, $txt);
fclose($myfile);



echo "writren successfully";


?>