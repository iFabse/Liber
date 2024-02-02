<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once '/var/www/datenbank_verbindung.php';                    // verbindung zur Datenbank 
    $kategorie = $_POST["kategorie"];
    $name = $_POST["name"];
    $bild = $_POST["bild"];
    $preis = $_POST["preis"];
    $bildGroesse = $_POST["bildGroesse"];                                     // Bildgrpöße, von der Eingabemaske

     /// DAS IST EIN TEST FÜR GITHUB

    // Pfad zum Verzeichnis, in dem die neuen Ordner erstellt werden sollen
    $verzeichnis = "../../php/";

    // überprüfe, ob der Ordner bereits existiert
    $neuerOrdner = $verzeichnis . '/' . $kategorie; // Kategorie-Ordner erstellen
    $neuerOrdnerElement = $neuerOrdner . '/' . $name;

    if (!file_exists($neuerOrdner)) {
        // Ordner erstellen
        mkdir($neuerOrdner, 0777, true);
    }

    // Überprüfe, ob das Elementen-Verzeichnis bereits existiert
    if (!file_exists($neuerOrdnerElement)) {
        // Ordner erstellen
        mkdir($neuerOrdnerElement, 0777, true);

        // PHP-Dokument für Übersicht erstellen
        $phpInhaltUebersicht = "
<!DOCTYPE html>
<html>
<head>
    <meta name=\"google\" content=\"notranslate\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../style/style.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../style/order.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../style/info.css\"/>
    <title>" . htmlspecialchars($name) . "</title>
    <link rel=\"icon\" href=\"../../../doc/$bild\">
</head>

<body>
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
            </details>
            <p>
            Preis: $preis
            </p>
            <input class=\"textdata\" type=\"text\" name=\"namen\" placeholder=\"Name\" required><br>
            <input class=\"textdata\" type=\"text\" name=\"extras\" placeholder=\"Extras\"><br>
            <input class=\"submit\" type=\"submit\" value=\"Bestellen\" required>
        </div>
    </form>
</body>
</html>";

        // Pfad zur PHP-Datei (geändert von .php)
        $phpDateipfadUebersicht = $neuerOrdnerElement . "/uebersicht.php";

        // PHP-Datei erstellen oder überschreiben
        file_put_contents($phpDateipfadUebersicht, $phpInhaltUebersicht);

        // PHP-Dokument für Datenbank erstellen
        $phpInhaltDatenbank = "<?php
        include_once '/var/www/datenbank_verbindung.php';                    // verbindung zur Datenbank 
        include_once 'eingabe.php';


            \$namen = \$_POST['namen'];




            \$auftrag = \"$name\";

            \$extras = \$_POST['extras'];

            \$sql = \"INSERT INTO menu (namen, auftrag, extras) 
                    VALUES ('\$namen', '\$auftrag', '\$extras');\";

            mysqli_query(\$conn, \$sql);

            header(\"Location: ../../../verwaltung/erfolg.php?submit=sucess\");
            ?>";

        // Pfad zur PHP-Datei (geändert von .php)
        $phpDateipfadDatenbank = $neuerOrdnerElement . "/datenbank.php";

        // PHP-Datei erstellen oder überschreiben
        file_put_contents($phpDateipfadDatenbank, $phpInhaltDatenbank);

        // Kategorie PHP ÄNDERN
    // Pfad zur anderen PHP-Datei
    $andereHtmlDateipfad = "../../php/$kategorie/$kategorie.php";

    // Lese den aktuellen Inhalt der HTML-Datei
    $aktuellesHtmlInhalt = file_get_contents($andereHtmlDateipfad);

    // Ändere die gewünschte Zeile (10 Zeilen vor Schluss)
    $zeilen = explode("\n", $aktuellesHtmlInhalt);

    $neueZeile = '<div class="center">
    <a href="' . htmlspecialchars("$name/uebersicht.php") . '"><img class="bild" src="../../doc/' . htmlspecialchars("$bild") . '" width="' . htmlspecialchars("$bildGroesse") . '" height="' . htmlspecialchars("$bildGroesse") . '"></a>
    </div>
    <div class="bezeichnung">
        <h1>' . htmlspecialchars($name) . '</h1>
    </div>';

    // Beachte: Das Array ist nullbasiert, deshalb muss Zeilennummer - 1 verwendet werden
    $zeilen[count($zeilen) - 5] = $neueZeile;

    // Setze den aktualisierten Inhalt zurück
    $neuesHtmlInhalt = implode("\n", $zeilen);

    // Überschreibe die HTML-Datei mit dem neuen Inhalt
    file_put_contents($andereHtmlDateipfad, $neuesHtmlInhalt);

    // Datenbankeintrag
    $sql = "INSERT INTO elemente (kategorie, bezeichnung, bild, kosten) 
        VALUES ('$kategorie','$name','$bild', '$preis');";               // systemNameKategorie in datenbank eintragen 

        // SQL-Injection Vorbereitung: 

        #$stmt = $mysqli->prepare($sql);
        #$stmt->bind_param("sss", $systemNameKategorie, $anzeigeName, $bild);

        mysqli_query($conn, $sql);                                                      // Verbindungsaufbau Datenbank

        #header("Location: index.html");                                                //Verweis auf neue Seite

        
        //header("Refresh:0");



    // PHP seite neu laden

    // Erfolgsmeldung oder Weiterleitung
    header("Refresh:0");

        

    
    } else {
        echo "Das Element existiert bereits!";
        echo "<img src='../../doc/error.png' width='20' height='20'>";
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
    <link rel="stylesheet" type="text/css" href="../../style/info.css"/>
    <title>Element erstellen</title>
</head>
<body>
    
<div class="bezeichnung">




    <h1>Neuen Eintrag erstellen</h1>
    <form action="" method="post">
       

        <input class="textdata" type="text" name="kategorie" placeholder="Kategorie" required><br>
        <input class="textdata" type="text" name="name" placeholder="Bezeichnung" required><br>
        <input class="textdata" type="text" name="bild" placeholder="Bildname" required><br>
        <input class="textdata" type="text" name="bildGroesse" placeholder="Bildgröße in %" required><br>
        <input class="textdata" type="text" name="preis" placeholder="Preis in €" required><br>



        <input class="submit" type="submit" placeholder="Bestellen">

    </form>
</body>
</html>
