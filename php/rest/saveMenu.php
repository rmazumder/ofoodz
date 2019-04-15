<?php
$config = require '../config.php';

 $postdata = file_get_contents("php://input");
//echo $_POST;
//echo "menu data" + $menudata;

$myfile = fopen("../../json/menu.json", "w") or die("Unable to open file!");
//$txt = $menudata;
fwrite($myfile, $postdata);
//$txt = "Jane Doe\n";
//fwrite($myfile, $txt);
fclose($myfile);



echo "writren successfully";


?>