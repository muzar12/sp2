<?php
session_start();
error_reporting(E_ALL);
include ("connection.php");
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
else {
    echo "You can only use DELETE method ! \n";
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Wrong Method");
    die();
}
$conn->close();
?>