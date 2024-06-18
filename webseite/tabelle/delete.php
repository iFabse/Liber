<?php

session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/tisch/index.php";
    header("Location: ../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
}


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