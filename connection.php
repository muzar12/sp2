<?php
$hostname = "localhost";
$username = "Muzar";
$password = "geslogeslo123";
$dbName = "faks";

$conn = new mysqli($hostname, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connection successful !\n";
?>