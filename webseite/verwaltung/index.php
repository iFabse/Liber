<?php
session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/verwaltung/index.php";
    header("Location: ../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../style/style.css" />
    <title>Verwaltung</title>
    <link rel="icon" href="../doc/plus.png">
</head>

<body>  
<div class="container">
        <div class="main">

<form action="../../BETA/login/logout.php" method="post">
    <button class="abmeldeButton" type="submit" name="delete-button">
        <img class="logoutBild" src="../doc/abmelden.png" alt="Abmelden">
    </button>
</form>
    


    <div class="center">
        <a class="textdata" href="../aktionen/kategorie/kat_verwalten.php"><img class="textdata" src="../doc/kategorie.png" width="80" height="80"></a>
    </div>
    
    <div class="bezeichnung">
        <h1>Kategorien verwalten</h1>
    </div>



    <div class="center">
        <a class="textdata" href="../aktionen/element/element_verwalten.php"><img  class="textdata" src="../doc/element.png" width="80" height="80"></a>
    </div>
    
    <div class="bezeichnung">
        <h1>Elemente verwalten</h1>
    </div>
    


    <div class="center">
        <a class="textdata" href="../aktionen/benutzer/benutzer_verwalten.php"><img  class="textdata" src="../doc/benutzerErstellen.png" width="80" height="80"></a>
    </div>
    
    <div class="bezeichnung">
        <h1>Betreiber verwalten</h1>
    </div>
</div>
</div>
</body>
<footer>
    <br><br>

    <a href="../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="..//impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>