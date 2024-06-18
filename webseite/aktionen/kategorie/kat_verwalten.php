<?php
session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/aktionen/kategorie/kat_verwalten.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
}//Login

?>

<!DOCTYPE html>
<html>
<head>
    <title>Kategorien</title>
    <link rel="stylesheet" type="text/css" href="../../style/tabel.css">
    <link rel="stylesheet" type="text/css" href="../../style/style.css">
    <link rel="icon" href="../../doc/kategorie.png">
</head>
<body>
<div class="container">
        <div class="main">
<form action="../../../BETA/login/logout.php" method="post">
    <button class="abmeldeButton" type="submit" name="delete-button">
        <img class="logoutBild" src="../../doc/abmelden.png" alt="Abmelden">
    </button>
</form>

<div class="container my-5">
    <table class="table">
        <thead><!-- Übersicht Tabelle -->
            <tr>
                <th>ID</th>
                <th>System Name</th>
                <th>Bezeichnung</th>
                <th>Bild</th>
            </tr>
        </thead>
        <tbody>
        <?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

        $sql = "SELECT * FROM kategorien"; // wähle alles von kategorien aus
        $result = $conn->query($sql);

        if (!$result) {
            die("Falsche Datenbank ausgewählt: " . $conn->error);
        }

       // Zähler für Anzeige-ID (nicht die ID aus der Datenbank!)
        $displayID = 1;

        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
            <td>$displayID</td>
            <td>$row[systemName]</td>
            <td>$row[bezeichnung]</td>
            <td>$row[bild]</td>
            <td>
                <a class='btn btn-danger btn-sm' href='delete.php?systemNameKategorie=$row[systemName]'>Löschen</a>
            </td>
            </tr>
            ";

            // Inkrementiere den Anzeige-ID-Zähler
            $displayID++;
        }
        //href='../element/delete.php?kategorie=$row[kategorie] (für elemente)
        ?>
        </tbody>
    </table>
</div>
<form  action='erstelle_Kat.php' method='post'>
<button  class="katHinzufügen"type='submit' name='delete-button'>
Kategorie <img class='logoutBild' src='../../doc/plus.png' alt='Abmelden'> Hinzufügen
    </button>
</form>
    </div>
    </div>
</body>
<footer>
    <br><br>

    <a href="../../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="../../impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>
