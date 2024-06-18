<?php

session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['login_user'])) {
    $wert = "webseite/aktionen/element/delete.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
} // Login

include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank

if (isset($_GET["kategorie"])) { // Wenn Löschen Button gedrückt und wert ist dabei = true
    $kategorie = $_GET["kategorie"];
   
    //Lade werte, um Elemente im PHP Ordner zu löschen (bezeichnungen, Zeile)
    $sql = $conn->prepare("SELECT * FROM elemente WHERE kategorie = $kategorie");
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $htmlZeile = $row['zeile'];
        $bezeichnung = $row['bezeichnung'];
        
        $verzeichnis = "../../php";
        $neuerOrdner = $verzeichnis . '/' . $kategorie . '/' . $bezeichnung;
        
        // Löschfunktion mit ChatGPT erstellt
        if (file_exists($neuerOrdner)) {
            function rrmdir($dir) {
                foreach(glob($dir . '/*') as $file) {
                    if(is_dir($file)) { 
                        rrmdir($file);
                    } else {
                        unlink($file);
                    }
                }
                rmdir($dir);
            }
            
            // Verzeichnis löschen
            rrmdir($neuerOrdner);
            echo "Das Verzeichnis wurde erfolgreich gelöscht.";
            
            // Rufe Python-Skript auf um Zeile zu löschjen
            $HTMLPfad = $verzeichnis . '/' . $kategorie . '/' . $kategorie . ".php";
            exec("python ../zeileLoeschen/loeschen.py $HTMLPfad $htmlZeile");

            echo "Die Zeile wurde gelöscht.";
            
            // Eintrag in der Datenbank löschen
            $loescheKat = $conn->prepare("DELETE FROM elemente WHERE bezeichnung = $kategorie");
            if ($loescheKat->execute()) {
                echo "Eintrag in der Datenbank wurde erfolgreich gelöscht.";
            } else {
                echo "Fehler beim Löschen des Eintrags in der Datenbank: " . $conn->error;
            }
        } else {
            echo "Das Verzeichnis existiert nicht.";
            echo "<img src='../doc/error.png' width='20' height='20'>";
        }
    } else {
        echo "Keine passenden Einträge in der Kategorie gefunden.";
    }
    
    $stmt->close();
}

$conn->close();

header("location: element_verwalten.php");
exit();

?>