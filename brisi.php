<?php
session_start();
error_reporting(E_ALL);

$hostname = "localhost";
$username = "Muzar";
$password = "geslogeslo123";
$dbName = "faks";

$conn = new mysqli($hostname, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connection successful ! \n";
//curl -i -X DELETE http://127.0.0.1/brisi/1
$metoda = $_SERVER["REQUEST_METHOD"];
$id = (isset($_GET) && isset($_GET['id'])) ? $_GET['id'] : null;
if($metoda == "DELETE") {
    if (is_numeric($id)) {
        $sql = $conn->prepare("DELETE FROM customers WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        echo "Successfully DELETED ! \n";
    } else {
        echo "Something went wrong ! \n";
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Something Went Wrong");
        die();
    }
}
$conn->close();
?>