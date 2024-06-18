<?php
session_start(); // Hier wird eine PHP Session neu erstellt

// Wenn ein angemeldeter Benutzer existiert, weden alle Cookie Variablen gelöscht und die Sitzung zerstört
// Danach wird zur Anfangs- Übersichtsseite weitergeleitet und das Skript verlassen 
if(isset($_SESSION['login_user'])) {
    session_unset();
    session_destroy();
    header("Location: ../../uebersicht/index.php");
    exit;
}
?>

<!--Zuletzt editiert am 07.06.2024 -->