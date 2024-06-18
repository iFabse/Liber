<?php
        include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank 
        include_once 'eingabe.php';
        $namen = $_POST['namen'];
        $auftrag = "Pommes Frites";
        $extras = $_POST['extras'];
        $anzahl = $_POST['anzahl'];
        $sql = "INSERT INTO menu (namen, auftrag, extras, menge) 
                VALUES ('$namen', '$auftrag', '$extras', '$anzahl');";
        if(mysqli_query($conn, $sql)) {
            header("Location: ../../../verwaltung/erfolg.php");
        } else {
            header("Location: ../../../verwaltung/fehler.php");
        }
        ?>