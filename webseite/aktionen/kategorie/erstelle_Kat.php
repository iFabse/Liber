<?php
session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/aktionen/kategorie/erstelle_Kat.php";
    header("Location: ../../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
}//Login

// Im Prinzip der gleiche Aufbau wie bei element Erstellung

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

    $verzeichnis = "../../php";                                                  // Verzeichni, wo die der PHP Ordner für die kategorie angelegt wird

    $bild = mysqli_real_escape_string($conn, $_POST["bild"]);                 // Bildname, von der Eingabemaske

    $bildGroesse = mysqli_real_escape_string($conn, $_POST["bildGroesse"]);   // Bildgrpöße, von der Eingabemaske

    $anzeigeName = mysqli_real_escape_string($conn, $_POST["anzeigeName"]);  // Anzeigename, von der Eingabemaske  

    $systemNameKategorie = mysqli_real_escape_string($conn, $_POST["systemNameKategorie"]); // kategorienamen für system (keine Leerzeichen, trennung von Anzeigenamen)



    // Überprüfe, ob der Ordner bereits existiert
    $neuerOrdner = $verzeichnis . '/' . $systemNameKategorie;


    if (!file_exists($neuerOrdner)) {
             
        mkdir($neuerOrdner, 0777, true);                                                // Ornder anlegen (Vorher definiert)


        // PHP-Dokument erstellen für Kategorieanzeige (z.B. Limonaden)
        $phpInhalt = "<?php



        echo '<!DOCTYPE html>
        <html lang=\"en\" translate=\"no\">
        
        <head>
            <title>$anzeigeName</title>
            <link rel=\"icon\" href=\"../../doc/$bild\">
            <meta charset=\"UTF-8\">
            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no\">
            <link rel=\"stylesheet\" type=\"text/css\" href=\"../../style/style.css\" />
        </head>
        <div class=\"container\">
        <div class=\"main\">

        




        

        </div>
        </div>
        <footer>
        <br><br>

        <div class=\"footer\"><a href=\"../../datenschutz/index.html\" class=\"footerText\">Datenschutz | </a><a href=\"../../impressum/index.html\" class=\"footerText\">Impressum</a></div>
        </footer>
        </html>';
        ?>";

        
        $phpDateipfad = $neuerOrdner . "/$systemNameKategorie.php";                  // Pfad zur PHP-Datei (geändert von .php)

        
        file_put_contents($phpDateipfad, $phpInhalt);                                // PHP-Datei erstellen oder überschreiben


        // header("Location: andere_seite.html");                                    //Verweis auf neue Seite
        
        $andereHtmlDateipfad = "../../../index.html";

        $aktuellesHtmlInhalt = file_get_contents($andereHtmlDateipfad);
        
        $zeilen = explode("\n", $aktuellesHtmlInhalt);
        
        // Speichere die Anzahl der Zeilen in einer Variable
        $anzahlZeilen = count($zeilen);
        
        // Zugriff auf die vorletzte Zeile
        $htmlZeile =$anzahlZeilen - 10;
        
        

        // Das wird in Index Html geschrieben :
        $neueZeile = '            <div class="center"> <a href="webseite/php/' . $systemNameKategorie . '/' . $systemNameKategorie . '.php"><img src="webseite/doc/' . $bild . '" class="others" width="' . $bildGroesse . '" height="' . $bildGroesse . '"></a> </div>  <div class="bezeichnung"> <h1>' . $anzeigeName . '</h1> </div>
        ';

        

        $zeilen[count($zeilen) - 11] = $neueZeile;  

        $neuesHtmlInhalt = implode("\n", $zeilen);                                   // Setze den aktualisierten Inhalt zurück

        file_put_contents($andereHtmlDateipfad, $neuesHtmlInhalt);                   // Überschreibe HTML-Datei mit dem neuen Inhalt


        $sql = "INSERT INTO kategorien (systemName, bezeichnung, bild, htmlZeile) 
        VALUES ('$systemNameKategorie','$anzeigeName','$bild', '$htmlZeile');";               // systemNameKategorie in datenbank eintragen 

        // SQL-Injection Vorbereitung: 

        #$stmt = $mysqli->prepare($sql);
        #$stmt->bind_param("sss", $systemNameKategorie, $anzeigeName, $bild);

        mysqli_query($conn, $sql);                                                      // Verbindungsaufbau Datenbank

        header("Location: kat_verwalten.php");                                               //Verweis auf neue Seite

        
        //header("Refresh:0");                                                         // PHP seite neu laden damit Eingabefelder leer sind ...
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
    <link rel="icon" href="../../doc/kategorie.png">
    <title>Kategorien verwalten</title>
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

    <h1>Neue Kategorie erstellen</h1>
    <form  method="post">

        <input class="textdata" type="text" name="systemNameKategorie" placeholder="System Kategorie" required><br>
        <input class="textdata" type="text" name="anzeigeName" placeholder="Anzeige Namen" required><br>
        <select class="textdata" name="bild" required>

<?php 
$bildOrdner = '../../doc';

// Überprüfe, ob der Ordner existiert und lesbar ist

    if($dh = opendir($bildOrdner)){

        while(($file = readdir($dh)) !== false){

                echo '<option value="' . $file . '">' . $file . '</option>';
        }
        closedir($dh);
    }

?>
</select>
<br>
        <input class="textdata" type="text" name="bildGroesse" placeholder="Bildgröße in %" required><br>


        <input class="submit" type="submit" placeholder="Bestellen">
    </form>
</div>
</div>
</body>
<footer>
    <br><br>

    <a href="../../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="../../impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>