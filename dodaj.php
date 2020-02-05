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

$id = (isset($_GET) && isset($_GET['id'])) ? $_GET['id'] : null;
//curl -i -d "ime=Boris&priimek=Finc&rating=4&starost=21" -X POST http://127.0.0.1/dodaj/
$metoda = $_SERVER["REQUEST_METHOD"];
if($metoda == "POST") {
    if(is_numeric($id)){
        header($_SERVER["SERVER_PROTOCOL"]." 406 Not Acceptable");
        die();
    }

    parse_str(file_get_contents('php://input'), $podatki);
    $ime = (isset($podatki['ime'])) ? $podatki['ime'] : null;
    $priimek = (isset($podatki['priimek'])) ? $podatki['priimek'] : null;
    $starost = (isset($podatki['starost'])) ? $podatki['starost'] : null;
    $rating = (isset($podatki['rating'])) ? $podatki['rating'] : null;

    if ($ime && $priimek && $starost && $rating) {
        $sql = $conn->prepare("INSERT INTO customers (ime, priimek, starost, rating) VALUES(?, ?, ?, ?)");
        $sql->bind_param("ssii", $ime, $priimek, $starost, $rating);
        $sql->execute();
        echo "New INSERT INTO DB successful ! \n";
    }
}
else {
    echo "Something went wrong ! \n";
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Something Went Wrong");
    die();
}
$conn->close();
?>