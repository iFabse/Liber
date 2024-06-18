<?php

session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/erstellen/kategorie/delete.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
} // Login


if (isset($_GET["systemNameKategorie"])) { // Wenn Wert übergeben wurde dann = true
    $systemNameKategorie = $_GET["systemNameKategorie"];

    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

    $verzeichnis = "../../php";


    $neuerOrdner = $verzeichnis . '/' . $systemNameKategorie;

    if (file_exists($neuerOrdner)) { // wenn Ordner der systemKategorie da ist, dann löschen
        
        // Ordner Löschfunktion mit ChatGPT erstellt
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
        
        
        if (file_exists($neuerOrdner)) {
            // Verzeichnis löschen
            rrmdir($neuerOrdner);
            echo "Das Verzeichnis wurde erfolgreich gelöscht.";
        } else {
            echo "Das Verzeichnis existiert nicht.";
        }
        

        
        
$HTMLPfad = "../../../index.html"; // Pfad zur index.html Datei geladen

$sql = "SELECT htmlZeile FROM kategorien WHERE systemName = '$systemNameKategorie'";// Gespeicherte Zeile beim erstellen laden
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $line_to_delete = $row['htmlZeile'];

    // Rufe das Python-Skript auf
    exec("python ../zeileLoeschen/loeschen.py $HTMLPfad $line_to_delete"); // Lösche mit python skript die zeile aus der Datei 

    echo "Die Zeile wurde gelöscht.";
} else {
    echo "Keine passenden Zeilen gefunden.";
}
        $sql = "DELETE FROM kategorien WHERE systemName = '$systemNameKategorie'"; // Datenbankeintrag löschen
        
        if (mysqli_query($conn, $sql)) {
            echo "Eintrag in der Datenbank wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in der Datenbank: " . mysqli_error($conn);
        }
    } else {
        echo "Das Verzeichnis $systemNameKategorie existiert nicht.";
        echo "<img src='../doc/error.png' width='20' height='20'>";
    }
}


header("location: kat_verwalten.php");

exit;
?>
