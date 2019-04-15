<?php
$config = require '../config.php';
echo $title;
//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//$txt = "John Doe\n";
//fwrite($myfile, $txt);
//$txt = "Jane Doe\n";
//fwrite($myfile, $txt);
//fclose($myfile);


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT name,image FROM items";
$result = $conn->query($sql);
//echo $result;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "name: " . $row["name"]. " - image: " . $row["image"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
echo "Connected successfully";


?>