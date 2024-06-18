<?php
session_start();

// Prüft die Session, ob Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="BETA/rfid/testFabian.php";
    header("Location: ../login/login.php?data=$wert");
    exit();
}

    include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank

    $rfid = shell_exec("/usr/bin/python3 Read.py");
    echo $rfid;
/*
    // Datenbankeintrag
    $sql = "SELECT * FROM kunden WHERE rfid = $rfid";
                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Falsche Datenbank ausgewählt: " . $conn->error);
                        }

                        // Zähler für Anzeige-ID

                        while ($row = $result->fetch_assoc()) {
                            echo "$row[guthaben]";

                            // ID am Anfang wird um eins erhöht, sobalt neue zeile angefangen wird
                        }
*/
    // Erfolgsmeldung oder Weiterleitung
    header("Location: testFabian.php");
    exit();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../../webseite/style/style.css">
    <link rel="stylesheet" type="text/css" href="../../webseite/style/order.css">
    <title>Scanne RFID</title>
    <link rel="icon" href="../../webseite/doc/client.png">
</head>
<body>
    <div class="container">
        <div class="main">
            <form action="../login/logout.php" method="post">
                <button class="abmeldeButton" type="submit" name="delete-button">
                    <img class="logoutBild" src="../../webseite/doc/abmelden.png" alt="Abmelden">
                </button>
            </form>
            <div class="bezeichnung">
                <h1>Neuen Kunden erstellen</h1>

            </div>
        </div>
    </div>
    <footer>
        <br><br>
        <a href="../../datenschutz/index.html" class="footerText">Datenschutz | </a>
        <a href="../../impressum/index.html" class="footerText">Impressum</a>
    </footer>
</body>
</html>
