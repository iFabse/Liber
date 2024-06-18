
<!DOCTYPE html>
<html>
<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../../../style/style.css">
    <link rel="stylesheet" type="text/css" href="../../../style/order.css">
    <title>Coca Cola</title>
    <link rel="icon" href="../../../doc/cola.png">
</head>
<body>
<div class="container">
<div class="main">
    <br>
    <br>
    <br>
    <img class="bild" src="../../../doc/cola.png" width="70" height="250"><br><br><br>
    <form action="datenbank.php" method="POST">
        <div class="bezeichnung">
            <details>
                <summary>
                Coca Cola  
                </summary>
                <div class="infos">
                <br>
                Original Coca Cola
                </div>
                <br>
            </details>
            <br>
            <br>
            <p>
            Preis: 0,99 €
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
