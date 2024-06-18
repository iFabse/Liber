<?php
session_start();

// prüft die Session ob Benutzer eingeloggt ist
if (!isset($_SESSION['login_user'])) {
    $wert = "webseite/aktionen/benutzer/benutzer_verwalten.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit();
}
?> <!-- Login Überprüfung -->

<!DOCTYPE html>
<html>
<head>
    <title>Betreiber verwalten</title>
    <link rel="icon" href="../../doc/client.png">
    <link rel="stylesheet" type="text/css" href="../../style/style.css">
    <link rel="stylesheet" type="text/css" href="../../style/tabel.css">
</head>
<body>
    <div class="container">
        <div class="main">
            <form action="../../../BETA/login/logout.php" method="post">
                <button class="abmeldeButton" type="submit" name="delete-button">
                    <img class="logoutBild" src="../../doc/abmelden.png" alt="Abmelden">
                </button>
            </form><!-- Logout -->

            <div class="container my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Benutzername</th>
                            <th>Letzter Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank 

                        $sql = "SELECT * FROM betreiber";
                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Falsche Datenbank ausgewählt: " . $conn->error);
                        }

                        // Zähler für Anzeige-ID

                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>$row[id]</td>
                                <td>$row[benutzername]</td>
                                <td>$row[letzter_login]</td>
                                <td>
                                    <a class='btn btn-danger btn-sm' href='delete.php?benutzername=$row[benutzername]'>Löschen</a>
                                </td>
                            </tr>
                            ";

                            // ID am Anfang wird um eins erhöht, sobalt neue zeile angefangen wird
                        }
                        ?>
                    </tbody>
                </table>
            </div> <!-- Anzeige Tabelle -->

            <form action='erstelle_benutzer.php'>
                <button class="katHinzufügen" type='submit' name='delete-button'>
                    Betreiber <img class='logoutBild' src='../../doc/plus.png' alt='Abmelden'> Hinzufügen
                </button>
            </form> <!-- Button für weiterleitung zur erstellung Benutzer -->
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