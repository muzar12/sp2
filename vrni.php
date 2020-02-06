<?php
session_start();
error_reporting(E_ALL);
include ("connection.php");
$metoda = $_SERVER["REQUEST_METHOD"];
$id = (isset($_GET) && isset($_GET['id'])) ? $_GET['id'] : null;
//echo $id;
//echo $metoda;
if($metoda == "GET") {
    if (is_numeric($id)) {
        $sql = $conn->prepare("SELECT * FROM customers WHERE id = ?");
        if(!$sql){
            echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
        }
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        $out = json_encode($result->fetch_assoc());
        if ($out != "null"){
            echo "[";
            echo $out;
            echo "]";
        }
        else{
            echo "Wrong ID ! \n";
            header($_SERVER["SERVER_PROTOCOL"]." 406 Not Acceptable");
            die();
        }
    }
    if(is_numeric($id) == false) {
        $sql = $conn->prepare("SELECT * FROM customers");
        if(!$sql){
            echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
        }
        $sql->execute();
        $result = $sql->get_result();
        echo "[";
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            echo json_encode($result->fetch_assoc());
            if ($i != (mysqli_num_rows($result) - 1)) {
                echo ",";
            }
        } echo "]";
    }
}
//curl -i -X GET http://127.0.0.1/vrni/
//curl -i -d "ime=Boris&priimek=Finc&rating=4&starost=21" -X PUT http://127.0.0.1/vrni/1
elseif($metoda == "PUT") {
    parse_str(file_get_contents('php://input'), $podatki);
    if (isset($_GET) && isset($_GET['id'])) {
        $ime = (isset($podatki['ime'])) ? $podatki['ime'] : null;
        $priimek = (isset($podatki['priimek'])) ? $podatki['priimek'] : null;
        $starost = (isset($podatki['starost'])) ? $podatki['starost'] : null;
        $rating = (isset($podatki['rating'])) ? $podatki['rating'] : null;

        if ($id && $ime && $priimek && $rating && $starost) {
            // shranjevanje podatkov v DB
            $sql = $conn->prepare("UPDATE customers SET ime = ?, priimek = ?, starost = ?, rating = ? WHERE id = ?");
            if(!$sql){
                echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
            }
            $sql->bind_param("ssiii",$ime, $priimek, $starost, $rating, $id);
            $sql->execute();

            echo "DATA changed successfully ! \n";
        }
        else{
            echo "Something went wrong ! \n";
            header($_SERVER["SERVER_PROTOCOL"]." 406 Not Acceptable");
            die();
        }
    }
    else{
        echo "Something went wrong ! \n";
        header($_SERVER["SERVER_PROTOCOL"]." 406 Not Acceptable");
        die();
    }

}
else{
    echo "Wrong method used ! \n";
    header($_SERVER["SERVER_PROTOCOL"]." 406 Not Acceptable");
    die();
}
$conn->close();
?>