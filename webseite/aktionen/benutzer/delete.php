<?php

session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/aktionen/benutzer/delete.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
} // Login


if (isset($_GET["benutzername"])) { //Von Löschen Button wird benutzername-Wert übergeben. Erst wenn der Wert da ist, ist die if-Abfrage true
    $benutzername = $_GET["benutzername"];

    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 


        $sql = "DELETE FROM betreiber WHERE benutzername = '$benutzername'"; // Datenbankeintrag zugehörig zu Benutzername wird gelöscht
        
        if (mysqli_query($conn, $sql)) {
            echo "Eintrag in der Datenbank wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in der Datenbank: " . mysqli_error($conn);
        }
    }



header("location: benutzer_verwalten.php"); // Weiterleitung zur Verwaltung der benutzer

exit;
?>
