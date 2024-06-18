<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/order.css">
    <title>Fehlschlag</title>
    <link rel="icon" href="../doc/error.png">
</head>

<body>
<div class="container">
        <div class="main">


    <div class="bezeichnung">

        <img class="bild" src="../doc/error.png" width="100" height="100">
        <br>
        
        <h1>Die Übertragung an den Server schlug fehl :( 
             Wir bitten, dies zu entschuldigen.</h1>

        <br>


        <button class="submit" onclick="redirectToHomePage()">Zur Startseite</button>

        <script>
            // JavaScript-Funktion, die die Weiterleitung durchführt
            function redirectToHomePage() {
            window.location.href = "../../index.html"; // Passe den Pfad entsprechend an
            }
        </script> 

    </div>

        </div>
        </div>

</body>
<footer>
    <br><br>

    <a href="../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="..//impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>