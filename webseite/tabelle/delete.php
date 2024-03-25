<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 
    
    // Lösche die Zeile mit der gegebenen ID
    $sqlDelete = "DELETE FROM menu WHERE id=$id";
    $conn->query($sqlDelete);
}

header("location: index.php");

exit;
?>