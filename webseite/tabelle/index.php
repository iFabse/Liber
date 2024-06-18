<?php
session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/tisch/index.php";
    header("Location: ../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bestellungen</title>
    <link rel="icon" href="../doc/tabelle.png">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/tabel.css">
    <style type="text/css">
    body {
    }
    </style>
</head>
<body>
<div class="container">
        <div class="main">
<form action="../../BETA/login/logout.php" method="post">
    <button class="abmeldeButton" type="submit" name="delete-button">
        <img class="logoutBild" src="../doc/abmelden.png" alt="Abmelden">
    </button>
</form>

<div class="container my-5">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bestellung</th>
                <th>Tisch</th>
                <th>Extras</th>
                <th>Menge</th>
                <th>Aktion</th>
            </tr>
        </thead>
        <tbody>
        <?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

        $sql = "SELECT * FROM menu";
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
            <td>$row[auftrag]</td>
            <td>$row[namen]</td>
            <td>$row[extras]</td>
            <td>$row[menge]</td>
            <td>
                <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Löschen</a>
            </td>
            </tr>
            ";

            // Inkrementiere den Anzeige-ID-Zähler
            $displayID++;
        }
        ?>
        </tbody>
    </table>
</div>
    </div>
    </div>
</body>
<footer>
    <br><br>

    <a href="../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="../impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>
