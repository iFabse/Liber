
<!DOCTYPE html>
<html>
<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="../../../style/style.css">
    <link rel="stylesheet" type="text/css" href="../../../style/order.css">
    <link rel="stylesheet" type="text/css" href="../../../style/info.css"/>
    <title>Test Eintrag</title>
    <link rel="icon" href="../../../doc/check.png">
</head>

<body>
    <br>
    <br>
    <br>
    <img class="bild" src="../../../doc/check.png" width="130" height="130"><br><br><br>

    <form action="datenbank.php" method="POST">
        <div class="bezeichnung">
            <details>
                <summary>
                Test Eintrag  
                </summary>
            </details>
            <p>
            Preis: 1,99 €
            </p>
            <input class="textdata" type="text" name="namen" placeholder="Name" required><br>
            <input class="textdata" type="text" name="extras" placeholder="Extras"><br>
            <input class="submit" type="submit" value="Bestellen" required>
        </div>
    </form>
</body>
</html>