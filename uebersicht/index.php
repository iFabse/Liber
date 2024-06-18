<?php
session_start(); // Hier wird eine PHP Session neu erstellt

// Prüft die Session, ob Benutzer eingeloggt ist und leitet zur Anmeldung weiter, wenn nicht
if (!isset($_SESSION['login_user'])) {
    $wert = "uebersicht/index.php";
    header("Location: ../BETA/login/login.php?data=$wert");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> 
    <link rel="stylesheet" type="text/css" href="../webseite/style/style.css" />
    <link rel="icon" href="../webseite/doc/liSymbol.png">
    <title>Übersicht Betreiber</title>
</head>

<body>
    <div class="container">
        <div class="main">
            <!-- Logout Button -->
            <form action="../BETA/login/logout.php" method="post">
                <button class="abmeldeButton" type="submit" name="delete-button">
                    <img class="logoutBild" src="../webseite/doc/abmelden.png" alt="Abmelden">
                </button>
            </form>
            <!-- Weiterleitung an verschiedene Seiten für die Verwaltung der Gesamtwebseite -->
            <div class="center"> 
                <a href="../index.html"><img src="../webseite/doc/start.png" class="others" width="100" height="100"></a> 
            </div>  
            <div class="bezeichnung"> 
                <h1>Startseite</h1> 
            </div>
    
            <div class="center"> 
                <a href="../webseite/tabelle/index.php"><img src="../webseite/doc/tabelle.png" class="others" width="100" height="100"></a> 
            </div>  
            <div class="bezeichnung"> 
                <h1>Bestellungen</h1> 
            </div>

            <div class="center"> 
                <a href="../webseite/aktionen/kunde/kunde_verwalten.php"><img src="../webseite/doc/client.png" class="others" width="100" height="100"></a> 
            </div>  
            <div class="bezeichnung"> 
                <h1>Kunden</h1> 
            </div>
    
            <div class="center"> 
                <a href="../webseite/tisch/index.php"><img src="../webseite/doc/tisch.png" class="others" width="100" height="100"></a> 
            </div>  
            <div class="bezeichnung"> 
                <h1>Tischreservierung</h1> 
            </div>

            <div class="center"> 
                <a href="../BETA/rfid/erstelle_kunde_BETA.php"><img src="../webseite/doc/rfid.png" class="others" width="100" height="100"></a> 
            </div>  
            <div class="bezeichnung"> 
                <h1>RFID Scannen</h1> 
            </div>
    
            <div class="center"> 
                <a href="../webseite/verwaltung/"><img src="../webseite/doc/plus.png" class="others" width="100" height="100"></a> 
            </div>  
            <div class="bezeichnung"> 
                <h1>Verwaltung</h1> 
            </div>
    
            <div class="center"> 
                <a href="../phpmyadmin/index.php"><img src="../webseite/doc/phpmyadmin.png" class="others" width="100" height="100"></a> 
            </div>  
            <div class="bezeichnung"> 
                <h1>Datenbank Übersicht</h1> 
            </div>
                               
        </div>
    </div>

    <!-- Datenschutz und Impressum -->
    <footer>
        <br><br>
        <div class="footer">
            <a href="../webseite/datenschutz/index.html" class="footerText">Datenschutz | </a>
            <a href="../webseite/impressum/index.html" class="footerText">Impressum</a>
        </div>
    </footer>
</body>

</html>

<!-- Zuletzt bearbeitet am 07.06.2024 und mit ChatGPT eingerückt -->