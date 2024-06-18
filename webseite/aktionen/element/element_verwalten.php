<?php
session_start();

// prüft die Session ob Benutzer eingeloggt ist
if (!isset($_SESSION['login_user'])) {
    $wert = "webseite/aktionen/element/element_verwalten.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit();
}// Login
?>

<!DOCTYPE html>
<html>
<head>
    <title>Elemente verwalten</title>
    <link rel="icon" href="../../doc/element.png">
    <link rel="stylesheet" type="text/css" href="../../style/tabel.css">
    <link rel="stylesheet" type="text/css" href="../../style/style.css">
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
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategorie</th>
                            <th>Bezeichnung</th>
                            <th>Bild</th>
                            <th>Kosten</th>
                        </tr>
                    </thead>
                    <tbody><!-- Tabelle für Ansicht -->
                        <?php
                        include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank 

                        $sql = "SELECT * FROM elemente"; // Lade alle Einträge von Elemente
                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Falsche Datenbank ausgewählt: " . $conn->error);
                        }

                        // Zähler für Anzeige-ID (nicht die ID aus der Datenbank!)
                        $displayID = 1;
                        
                        while ($row = $result->fetch_assoc()) { // Hier werden einzelne Spalten ausgegeben
                            echo "
                            <tr>
                                <td>$displayID</td>
                                <td>$row[kategorie]</td>
                                <td>$row[bezeichnung]</td>
                                <td>$row[bild]</td>
                                <td>$row[kosten]</td>
                                <td>
                                    <a class='btn btn-danger btn-sm' href='delete.php?kategorie=$row[kategorie]'>Löschen</a>
                                </td>
                            </tr>
                            ";

                            $displayID++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <form action='erstelle_Element.php' method='post'>
                <button class="katHinzufügen" type='submit' name='delete-button'>
                    Element <img class='logoutBild' src='../../doc/plus.png' alt='Abmelden'> Hinzufügen
                </button>
            </form>
        </div>
    </div>
</body>
<footer>
    <br><br>
    <a href="../../datenschutz/index.html" class="footerText">Datenschutz</a> | 
    <a href="../../impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>
<!-- Zuletzt bearbeitet am 08.06.2024 und mit ChatGPT eingerückt -->