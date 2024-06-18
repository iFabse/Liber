<?php
session_start();

// Prüft die Session, ob Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/aktionen/kunde/erstelle_kunde.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit();
}// Login

if ($_SERVER["REQUEST_METHOD"] == "POST") { // True, wenn Anlegen - Button gedrückt
    include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank

    $namen = mysqli_real_escape_string($conn, $_POST["name"]); // Werte aus den feldern unten als Variable speichern
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $guthaben = mysqli_real_escape_string($conn, $_POST["guthaben"]);

    $rfid = shell_exec("/usr/bin/python3 Read.py"); // python Skript zum auslesen des RFID Tags

    // Überprüfe, ob Benutzer bereits existiert
    $check_user_query = "SELECT * FROM kunden WHERE rfid = '$rfid'";
    $check_user_result = mysqli_query($conn, $check_user_query);


    if (mysqli_num_rows($check_user_result) > 0) 
    {
        $error = "Karte existiert schon";
    } 
    else 
    {
    // Datenbankeintrag
    $sql = "INSERT INTO kunden (rfid, namen, email, guthaben) VALUES ('$rfid','$namen','$email', '$guthaben');";
    mysqli_query($conn, $sql); // Verbindungsaufbau Datenbank

    // Weiterleitung zur Übersicht der kunden
    header("Location: kunde_verwalten.php");
    exit();
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../../style/style.css">
    <link rel="stylesheet" type="text/css" href="../../style/order.css">
    <title>Kunden erstellen</title>
    <link rel="icon" href="../../doc/client.png">
</head>
<body>
    <div class="container">
        <div class="main">
            <form action="../login/logout.php" method="post">
                <button class="abmeldeButton" type="submit" name="delete-button">
                    <img class="logoutBild" src="../../doc/abmelden.png" alt="Abmelden">
                </button>
            </form>
            <div class="bezeichnung">
                <h1>Neuen Kunden erstellen</h1>
                <form action="" method="post">
                    <input class="textdata" type="text" name="name" placeholder="Vor und Nachname" required><br>
                    <input class="textdata" type="text" name="email" placeholder="E-Mail" required><br>
                    <input class="textdata" type="text" name="guthaben" placeholder="Guthaben" required><br>
                    <input class="submit" type="submit" placeholder="Anlegen">
                </form>
                <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? htmlspecialchars($error) : ''; ?></div><!-- Fehlernachricht -->
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
