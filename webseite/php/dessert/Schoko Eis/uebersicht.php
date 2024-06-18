
<!DOCTYPE html>
<html>
<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../../../style/style.css">
    <link rel="stylesheet" type="text/css" href="../../../style/order.css">
    <title>Schoko Eis</title>
    <link rel="icon" href="../../../doc/schokoEis.jpg">
</head>
<body>
<div class="container">
<div class="main">
    <br>
    <br>
    <br>
    <img class="bild" src="../../../doc/schokoEis.jpg" width="200" height="150"><br><br><br>
    <form action="datenbank.php" method="POST">
        <div class="bezeichnung">
            <details>
                <summary>
                Schoko Eis  
                </summary>
                <div class="infos">
                <br>
                Schokoladen Eis im Waffel Becher
                </div>
                <br>
            </details>
            <br>
            <br>
            <p>
            Preis: 2,99 €
            </p>
            <input class="textdata" type="text" name="namen" placeholder="Tisch" required><br>
            <input class="textdata" type="text" name="extras" placeholder="Extras"><br>
            <input class="textdata" type="text" name="anzahl" placeholder="Anzahl"><br>
            <input class="submit" type="submit" value="Bestellen" required>
        </div>
    </form>
    </div>
    </div>
</body>
<footer>
    <br><br>
    <a href="../../../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="../../../impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>
