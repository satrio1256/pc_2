<?php

$host = "localhost";
$db_name = "dimhub";
$user = "root";
$password = "";

$connect = new mysqli($host, $user, $password, $db_name);

if ($connect->connect_errno) {
	echo "Error - Failed to connect to MySQL:" . $mysqli->connect_error ;
}
?>