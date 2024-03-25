<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

    $verzeichnis = "../../php";

    $systemNameKategorie = $_POST["systemNameKategorie"];

    $neuerOrdner = $verzeichnis . '/' . $systemNameKategorie;

    if (file_exists($neuerOrdner)) {
        
        function rrmdir($dir) {
            foreach(glob($dir . '/*') as $file) {
                if(is_dir($file)) { 
                    rrmdir($file);
                } else {
                    unlink($file);
                }
            }
            rmdir($dir);
        }
        
        
        if (file_exists($neuerOrdner)) {
            // Verzeichnis löschen
            rrmdir($neuerOrdner);
            echo "Das Verzeichnis wurde erfolgreich gelöscht.";
        } else {
            echo "Das Verzeichnis existiert nicht.";
        }
        

        
        
$HTMLPfad = "../../../index.html";

$sql = "SELECT htmlZeile FROM kategorien WHERE systemName = '$systemNameKategorie'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $line_to_delete = $row['htmlZeile'];

    // Rufe das Python-Skript auf
    exec("python loeschen.py $HTMLPfad $line_to_delete");

    echo "Die Zeile wurde gelöscht.";
} else {
    echo "Keine passenden Zeilen gefunden.";
}






        $sql = "DELETE FROM kategorien WHERE systemName = '$systemNameKategorie'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Eintrag in der Datenbank wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Eintrags in der Datenbank: " . mysqli_error($conn);
        }
    } else {
        echo "Das Verzeichnis $systemNameKategorie existiert nicht.";
        echo "<img src='../doc/error.png' width='20' height='20'>";
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
    <title>Kategorie löschen</title>
</head>
<body>
    
<div class="bezeichnung">
    <h1>Kategorie löschen</h1>
    <form  method="post">
        <input class="textdata" type="text" name="systemNameKategorie" placeholder="System Kategorie" required><br>
        <input class="submit" type="submit" placeholder="Bestellen">
    </form>
</div>

</body>
</html>
