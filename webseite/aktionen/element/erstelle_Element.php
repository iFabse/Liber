<?php

session_start();

// Prüft die Session, ob Benutzer eingeloggt ist
if (!isset($_SESSION['login_user'])) {
    $wert = "webseite/erstellen/element/erstelle_Element.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Nur wenn abschicken gedrückt wurde

    include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank 
    // Einfügen von Texteinträgen unten mit überprüfung auf sonderzeichen
    $kategorie = mysqli_real_escape_string($conn, $_POST['kategorie']); 
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $bild = mysqli_real_escape_string($conn, $_POST['bild']);
    $bildGroesse = '100';
    $preis = mysqli_real_escape_string($conn, $_POST['preis']);
    $infos = mysqli_real_escape_string($conn, $_POST['infos']);

    // Pfad zum Verzeichnis, in dem die neuen Ordner erstellt werden sollen
    $verzeichnis = "../../php/";

    // Überprüfe, ob Ordner bereits existiert
    $neuerOrdner = $verzeichnis . '/' . $kategorie; // Kategorieordner erstellen
    $neuerOrdnerElement = $neuerOrdner . '/' . $name;

    if (!file_exists($neuerOrdner)) {
        // Ordner erstellen
        mkdir($neuerOrdner, 0777, true); // Ordner mit allen Rechten -> 777
    }

    // Prüfe, ob das Verzeichnis existiert
    if (!file_exists($neuerOrdnerElement)) {
        // Ordner erstellen
        mkdir($neuerOrdnerElement, 0777, true);

        // Hier ist der Text, der als Eintrag später erscheint. hier werden dann die werte aus dem Textfeldern unten eingetragen 
        $phpInhaltUebersicht = "
<!DOCTYPE html>
<html>
<head>
    <meta name=\"google\" content=\"notranslate\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../style/style.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../style/order.css\">
    <title>" . htmlspecialchars($name) . "</title>
    <link rel=\"icon\" href=\"../../../doc/$bild\">
</head>
<body>
<div class=\"container\">
<div class=\"main\">
    <br>
    <br>
    <br>
    <img class=\"bild\" src=\"../../../doc/" . htmlspecialchars($bild) . "\" width=\"" . htmlspecialchars($bildGroesse) . "\" height=\"" . htmlspecialchars($bildGroesse) . "\"><br><br><br>
    <form action=\"" . htmlspecialchars("datenbank.php") . "\" method=\"POST\">
        <div class=\"bezeichnung\">
            <details>
                <summary>
                $name  
                </summary>
                <div class=\"infos\">
                <br>
                $infos
                </div>
                <br>
            </details>
            <br>
            <br>
            <p>
            Preis: $preis €
            </p>
            <input class=\"textdata\" type=\"text\" name=\"namen\" placeholder=\"Tisch\" required><br>
            <input class=\"textdata\" type=\"text\" name=\"extras\" placeholder=\"Extras\"><br>
            <input class=\"textdata\" type=\"text\" name=\"anzahl\" placeholder=\"Anzahl\"><br>
            <input class=\"submit\" type=\"submit\" value=\"Bestellen\" required>
        </div>
    </form>
    </div>
    </div>
</body>
<footer>
    <br><br>
    <a href=\"../../../datenschutz/index.html\" class=\"footerText\">Datenschutz | </a><a href=\"../../../impressum/index.html\" class=\"footerText\">Impressum</a>
</footer>
</html>";

        // Pfad zu PHP Datei
        $phpDateipfadUebersicht = $neuerOrdnerElement . "/uebersicht.php";

        // Datei erstellen (einfügen)
        file_put_contents($phpDateipfadUebersicht, $phpInhaltUebersicht);

        // PHP Datei für Verbindung mit Datenbank (kann man auch in einer machen)
        // TODO : Mache die Datenbank PHP in die Übersichts PHP Datei (Prio sehr niedrig)
        $phpInhaltDatenbank = "<?php
        include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank 
        include_once 'eingabe.php';
        \$namen = \$_POST['namen'];
        \$auftrag = \"$name\";
        \$extras = \$_POST['extras'];
        \$anzahl = \$_POST['anzahl'];
        \$sql = \"INSERT INTO menu (namen, auftrag, extras, menge) 
                VALUES ('\$namen', '\$auftrag', '\$extras', '\$anzahl');\";
        if(mysqli_query(\$conn, \$sql)) {
            header(\"Location: ../../../verwaltung/erfolg.php\");
        } else {
            header(\"Location: ../../../verwaltung/fehler.php\");
        }
        ?>";

        // Pfad zur pph Datei
        $phpDateipfadDatenbank = $neuerOrdnerElement . "/datenbank.php";

        // php Datei erstellen 
        file_put_contents($phpDateipfadDatenbank, $phpInhaltDatenbank);

        // Kategorie PHP ändern
        // Pfad zur anderen php Datei
        $andereHtmlDateipfad = "../../php/$kategorie/$kategorie.php";

        // Lese aktuellen Inhalt html Datei
        $aktuellesHtmlInhalt = file_get_contents($andereHtmlDateipfad);

        // Ändere Zeile (10 Zeilen vor Ende der Datei)
        $zeilen = explode("\n", $aktuellesHtmlInhalt);

        // Speichere Anzahl der Zeilen in einer Variable
        $anzahlZeilen = count($zeilen);

        // Verändernde zeile = alle zeilen minus 14
        $zeilenZahl = $anzahlZeilen - 14;
        // Wird dann in der entsprechenden kategorie angezeigt bzw. eingeschrieben werden
        $neueZeile = '<div class="center"><a href="' . htmlspecialchars("$name/uebersicht.php") . '"><img class="bild" src="../../doc/' . htmlspecialchars("$bild") . '" width="' . htmlspecialchars("$bildGroesse") . '" height="' . htmlspecialchars("$bildGroesse") . '"></a></div><div class="bezeichnung"><h1>' . htmlspecialchars($name) . '</h1></div>
        
        
        ';

        // Eingegebender Text oben wird 15 Zeilen vor Ende in PHP Datei eingefügt
        $zeilen[count($zeilen) - 15] = $neueZeile;
        
        // Geänderte Zeilen werden zusammengefügt
        $neuesHtmlInhalt = implode("\n", $zeilen); 

        // Überschreibe hjtml Datei mit neuen Inhalt
        file_put_contents($andereHtmlDateipfad, $neuesHtmlInhalt);

        // Daten werden in datenbank eingetragen...
        $sql = "INSERT INTO elemente (kategorie, bezeichnung, bild, kosten, infos, zeile) 
            VALUES ('$kategorie','$name','$bild', '$preis', '$infos', '$zeilenZahl');"; // systemNameKategorie in Datenbank eintragen 

        mysqli_query($conn, $sql); // Verbindungsaufbau Datenbank


        // oder Weiterleitung
        header("Location: element_verwalten.php");
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
    <title>Element erstellen</title>
</head>
<link rel="icon" href="../../doc/element.png">
<body>
<div class="container">
    <div class="main">
        <form action="../../../BETA/login/logout.php" method="post">
            <button class="abmeldeButton" type="submit" name="delete-button">
                <img class="logoutBild" src="../../doc/abmelden.png" alt="Abmelden">
            </button>
        </form>
        <div class="bezeichnung">
            <h1>Neues Element erstellen</h1>
            <form action="" method="post">
                <?php 
                    include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank 
                    // Der Dropdown wurde mit ChatGPT erstellt !
                    $sql_dropdown = "SELECT systemName FROM kategorien";
                    $result_dropdown = mysqli_query($conn, $sql_dropdown);
                    echo '<select class="textdata" name="kategorie" required>';
                    while ($row = mysqli_fetch_assoc($result_dropdown)) {
                        echo '<option value="' . $row['systemName'] . '">' . $row['systemName'] . '</option>';
                    }
                    echo '</select>';
                ?>
                <br>
                <input class="textdata" type="text" name="name" placeholder="Bezeichnung" required><br>
                <select class="textdata" name="bild" required>
                    <?php 
                        // Dieser Dropdown wurde auch mit ChatGPT erstellt !
                        $bildOrdner = '../../doc';
                        if ($dh = opendir($bildOrdner)) {
                            while (($file = readdir($dh)) !== false) {
                                echo '<option value="' . $file . '">' . $file . '</option>';
                            }
                            closedir($dh);
                        }
                    ?>
                </select>
                <br>
                <input class="textdata" type="text" name="preis" placeholder="Preis in €" required><br>
                <input class="textdata" type="text" name="infos" placeholder="Informationen" required><br>
                <input class="submit" type="submit" value="Erstellen">
            </form>
        </div>
    </div>
</div>
</body>
<footer>
    <br><br>
    <a href="../../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="../../impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>
