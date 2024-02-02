<?php

        /*   //TODO
 
             - Strukturieren
             - Daten sollen die Website von der Datenbank genommen werden
             - Zeilenangabe in HTML soll mit in Datenbank eingefügt werden
             - Vermeidung SQL-Injection

             - benutzer und email einrichten, 
             - Benutzer überprüfen Zeile 35
        */



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once '/var/www/datenbank_verbindung.php';                    // verbindung zur Datenbank 


    $bildName = $_POST["bildName"];                                                   // Bildname, von der Eingabemaske

    $bildGroesse = $_POST["bildGroesse"];                                     // Bildgrpöße, von der Eingabemaske

    $vorname = $_POST["vorname"];

    $nachname = $_POST["nachname"];

    $e_mail = $_POST["e_mail"];

    $passwort = $_POST["passwort"];

    $rfid = $_POST["rfid"];



    // Überprüfe, ob der Benutzer bereits existiert
    $neuerOrdner = $verzeichnis . '/' . $systemNameKategorie;


    //if (!file_exists($neuerOrdner)) {  // wenn benutzer nicht existiert dann...
             


        $sql = "INSERT INTO kunde (vorname, nachname, e_mail, bildName, bildGroesse, rfid, passwort) 
        VALUES ('$vorname','$nachname','$e_mail', '$bildName', '$bildGroesse', '$rfid', '$passwort');";               // systemNameKategorie in datenbank eintragen 

        // SQL-Injection Vorbereitung: 

        #$stmt = $mysqli->prepare($sql);
        #$stmt->bind_param("sss", $systemNameKategorie, $anzeigeName, $bild);

        mysqli_query($conn, $sql);                                                      // Verbindungsaufbau Datenbank

        #header("Location: index.html");                                                //Verweis auf neue Seite

        
        //header("Refresh:0");                                                         // PHP seite neu laden damit Eingabefelder leer sind ...
   // }
    
   /* else 
    
    {
        echo "Der Benutzer $vorname $nachname existiert bereits.";
        echo "<img src='../doc/error.png' width='20' height='20'>";
    }
    */
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
    <title>Kategorie erstellen</title>
</head>

<body>
    
<div class="bezeichnung">

    <h1>Neuen Benutzer erstellen</h1>
    <form  method="post">

        <input class="textdata" type="text" name="vorname" placeholder="Vorname" required><br>
        <input class="textdata" type="text" name="nachname" placeholder="Nachname" required><br>
        <input class="textdata" type="text" name="e_mail" placeholder="E-Mail" required><br>
        <input class="textdata" type="text" name="passwort" placeholder="Passwort" required><br>
        <input class="textdata" type="text" name="rfid" placeholder="RFID-ID" required><br>
        <input class="textdata" type="text" name="bildName" placeholder="Bildname" required><br>
        <input class="textdata" type="text" name="bildGroesse" placeholder="Bildgröße in %" required><br>


        <input class="submit" type="submit" placeholder="Bestellen">
    </form>
</body>

</html>
