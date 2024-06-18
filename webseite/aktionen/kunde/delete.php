<?php

session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/aktionen/kunde/delete.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
}// Login


if (isset($_GET["namen"])) { // Warte auf übergabe des benutzernamens
    $namen = $_GET["namen"];

    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 


        $sql = "DELETE FROM kunden WHERE namen = '$namen'"; // lösche den Eintrag wo der benutzername gleich ist (as simple as that ;)
        
        if (mysqli_query($conn, $sql)) {
            echo "Eintrag in der Datenbank wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in der Datenbank: " . mysqli_error($conn);
        }
    }



header("location: kunde_verwalten.php");

exit;
?>
