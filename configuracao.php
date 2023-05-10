<?php

// Define database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desafioprogramacao";
// Connecting database
try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>