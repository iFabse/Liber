<!DOCTYPE html>
<html lang="de">
<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../../webseite/style/style.css">
    <link rel="stylesheet" type="text/css" href="../../webseite/style/order.css">
    <title>RFID Scannen</title>
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
                <h1>RFID Scannen</h1>
                <div class="object">
                    <br>
                    <br><br><br><br><br><br>
                    <?php
                    session_start();
                    
                    // Prüft die Session, ob Benutzer eingeloggt ist
                    if(!isset($_SESSION['login_user'])) {
                        $wert = "BETA/rfid/erstelle_kunde_BETA.php";
                        header("Location: ../login/login.php?data=$wert");
                        exit();
                    }
                    
                    include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank 
                    
                    $rfid = shell_exec("/usr/bin/python3 Read.py");
                    $sql = "SELECT * FROM kunden WHERE rfid = $rfid";
                    $result = $conn->query($sql);
                    
                    if (!$result) {
                        die("Falsche Datenbank ausgewählt: " . $conn->error);
                    }
                    
 
                    // Zähler für Anzeige-ID
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <object>
                            Namen: <br><br>{$row['namen']}
                            <br>
                            <br><br><br>
                            <br>
                            E-Mail: <br><br><a href='mailto:{$row['email']}'>{$row['email']}</a>
                            <br>
                            <br><br><br>
                            <br>
                            Guthaben: <br><br>{$row['guthaben']} €
                            <br>
                        </object>
                        ";
                    }
                    ?>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <br><br>
        <a href="../../webseite/datenschutz/index.html" class="footerText">Datenschutz | </a>
        <a href="../../webseite/impressum/index.html" class="footerText">Impressum</a>
    </footer>
</body>
</html>
