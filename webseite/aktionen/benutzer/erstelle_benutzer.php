<?php
session_start();

// Prüft die Session, ob Benutzer eingeloggt ist, und leitet zur Anmeldung weiter, wenn nicht
if (!isset($_SESSION['login_user'])) 
{
    $wert = "webseite/aktionen/benutzer/erstelle_benutzer.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit();
} // Login
    

if ($_SERVER["REQUEST_METHOD"] == "POST") // Wenn erstellen Button gedrück = true 
{
    include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank

    $benutzername = mysqli_real_escape_string($conn, $_POST["benutzername"]); // Benutzername wird auf besondere zeichen überprüft

    // Überprüfe, ob Benutzer bereits existiert
    $check_user_query = "SELECT * FROM betreiber WHERE benutzername = '$benutzername'";
    $check_user_result = mysqli_query($conn, $check_user_query);


    if (mysqli_num_rows($check_user_result) > 0) // Wenn mehr als keine Zeile vorhanden ist, gibt es ihn ja schon ... 
    {
        $error = "Benutzername existiert schon"; // Fehlermeldung (wird unterhalb der eingabe angezegt)
    } 
    else 
    {
    
        $passwort = $_POST["passwort"]; //Herausfischen des Passworts als Klartext
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT); // Hier wird das Passwort in einen Hashwert umgewandelt

        $sql = "INSERT INTO betreiber (benutzername, passwort)
                VALUES ('$benutzername','$passwort_hash')"; // Benutzername und passwort werden in datenbank eingetragen
                if (mysqli_query($conn, $sql)) {
                    $erfolg = "Benutzer erfolgreich erstellt";
                    header("Location: benutzer_verwalten.php");
                } 
                else
                {
                    $error = "Fehler beim Erstellen des Benutzers: " . mysqli_error($conn); // Fehlermeldung
                }
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
    <link rel="icon" href="../../doc/benutzerErstellen.png">
    <title>Neuer Betreiber</title>
</head>

<body>
<div class="container">
    <div class="main">
        <form action="../../../BETA/login/logout.php" method="post">
            <button class="abmeldeButton" type="submit" name="delete-button">
                <img class="logoutBild" src="../../doc/abmelden.png" alt="Abmelden">
            </button>
        </form>
        <div class="bezeichnung">
            <h1>Neuen Benutzer erstellen</h1>
            <form method="post">
                <input class="textdata" type="text" name="benutzername" placeholder="Benutzername" required><br>
                <input class="textdata" type="password" name="passwort" placeholder="Passwort" required><br>
                <input class="submit" type="submit" value="Erstellen">
            </form>
            <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? htmlspecialchars($error) : ''; ?></div> <!-- Fehlermeldung mit Rotem Text -->
            <div style="font-size:11px; color:#008000; margin-top:10px"><?php echo isset($erfolg) ? htmlspecialchars($erfolg) : ''; ?></div> <!-- Fehlermeldung mit Grünem Text -->

        </div>
    </div>
</div>
</body>
<footer>
    <br><br>
    <div class="footer"><a href="../../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="../../impressum/index.html" class="footerText">Impressum</a></div>
</footer>
</html>
<!-- Zuletzt bearbeitet am 07.06.2024 und mit ChatGPT eingerückt -->