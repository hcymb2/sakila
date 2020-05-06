<?php

$dbServername = "mercury";
$dbUsername = "hcymb2_user";
$dbPassword = "Database15!";
$dbName = "hcymb2_sakila";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

/* check connection */
if ($conn -> connect_error){
	die("Connection failed:". $conn -> connect_error);
}
?>