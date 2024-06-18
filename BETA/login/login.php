<?php
// Die Datei mit den Datenbankverbindungsinformationen wird eingebunden
include("/home/pi/.datenbank_verbindung.php");
session_start(); // Startet eine neue oder bestehende Session

$empfangeneDaten = $_GET['data']; // Empfangene Daten aus der URL (GET-Parameter) werden gespeichert

// Überprüft, ob die Anfrage per POST gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    // Sicheres Escapen der Benutzereingaben, um SQL-Injection zu verhindern
    $benutzername = mysqli_real_escape_string($conn, $_POST['benutzernameFormular']);
    $passwort = $_POST['passwortFormular'];

    // SQL-Abfrage, um den Benutzer anhand des Benutzernamens zu überprüfen
    $sql = "SELECT * FROM betreiber WHERE benutzername = '$benutzername'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) 
    {
        $row = mysqli_fetch_assoc($result);
        $hash = $row["passwort"]; // Gehashtes Passwort aus der Datenbank abrufen

        // Passwortüberprüfung mit password_verify
        if (password_verify($passwort, $hash)) 
        //if($passwort == $hash)
        {
            $_SESSION['login_user'] = $benutzername; // Setzt den Benutzernamen in der Session

            // Aktualisiert den letzten Login-Zeitpunkt des Benutzers
            $update_sql = "UPDATE betreiber SET letzter_login=NOW() WHERE benutzername ='$benutzername'";
            mysqli_query($conn, $update_sql);

            // Basis-URL wird auf die aktuelle Server-Adresse gesetzt
            $basisURL = $_SERVER['SERVER_NAME'] . "/";
            $weiterleitung = "http://$basisURL$empfangeneDaten"; // Leitet den Benutzer zu der angegebenen URL weiter

            header("Location: $weiterleitung"); // Führt die Weiterleitung aus
            exit(); // Beendet das Skript
        }
        else 
        {
            // Wenn die Eingaben falsch sind, wird eine Fehlermeldung angezeigt
            $error = "Falsches Passwort!";
        }
    } 
    else 
    {
        // Wenn die Eingaben falsch sind, wird eine Fehlermeldung angezeigt
        $error = "Falscher Benutzername!";
    }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../../webseite/style/style.css">
    <link rel="stylesheet" type="text/css" href="../../webseite/style/order.css">
    <title>Anmeldefenster</title>
</head>

<body>
    <div class="container">
        <div class="main">
            <div class="bezeichnung">
                <h1>Anmeldefenster</h1>
                <form method="post">
                    <br><br><br><br><br><br>
                    <!-- Benutzername wird als "Vorname" angezeigt -->
                    <input class="textdata" type="text" name="benutzernameFormular" placeholder="Benutzername" required><br>
                    <input class="textdata" type="password" name="passwortFormular" placeholder="Passwort" required><br>
                    <br><br><br>
                    <input class="submit" type="submit" name="submit" value="Anmelden">
                    <br><br><br>
                    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? htmlspecialchars($error) : ''; ?></div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>
    <br><br>
    <a href="../../webseite/datenschutz/index.html" class="footerText">Datenschutz | </a><a href="../../webseite/impressum/index.html" class="footerText">Impressum</a>
</footer>

</html>

<!-- Diese Datei wurde mithilfe von ChatGPT am 07.06.2024 Kommentiert und eingerückt, damit wir uns als Programmierer besser zurechtfinden -->
