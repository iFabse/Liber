<?php
session_start();

// Überprüfe, ob der Benutzer eingeloggt ist
if(!isset($_SESSION['login_user'])) {
    $wert ="webseite/tisch/index.php";
    header("Location: ../../BETA/login/login.php?data=$wert");
    exit(); // Beende das Skript, um sicherzustellen, dass die Weiterleitung funktioniert
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/order.css">
    <link rel="icon" href="../doc/tisch.png">
    <title>Tischreservierung</title>

</head>
<body>
<div class="container">
        <div class="main">
<form action="../../BETA/login/logout.php" method="post">
    <button class="abmeldeButton" type="submit" name="delete-button">
        <img class="logoutBild" src="../doc/abmelden.png" alt="Abmelden">
    </button>
</form>
<?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

$sql = "SELECT Tisch1, Tisch2, Tisch3, Tisch4 FROM tische;";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$tisch1 = $row['Tisch1'];
$tisch2 = $row['Tisch2'];
$tisch3 = $row['Tisch3'];
$tisch4 = $row['Tisch4'];

//-----------------------------Tisch1:---------------------------------------------------------
if ($tisch1 == "1") {
    echo '<div class="bezeichnung"><button class="button" id="tisch1">Tisch 1 zugängig machen</button></div>';
} elseif ($tisch1 == "0") {
    echo '<div class="bezeichnung"><button class="button" id="tisch1">Tisch 1 reservieren</button></div>';
}

//-----------------------------Tisch2:---------------------------------------------------------
if ($tisch2 == "1") {
    echo '<div class="bezeichnung"><button class="button" id="tisch2">Tisch 2 zugängig machen</button></div>';
} elseif ($tisch2 == "0") {
    echo '<div class="bezeichnung"><button class="button" id="tisch2">Tisch 2 reservieren</button></div>';
}

//-----------------------------Tisch3:---------------------------------------------------------
if ($tisch3 == "1") {
    echo '<div class="bezeichnung"><button class="button" id="tisch3">Tisch 3 zugängig machen</button></div>';
} elseif ($tisch3 == "0") {
    echo '<div class="bezeichnung"><button class="button" id="tisch3">Tisch 3 reservieren</button></div>';
}

//-----------------------------Tisch4:---------------------------------------------------------
if ($tisch4 == "1") {
    echo '<div class="bezeichnung"><button class="button" id="tisch4">Tisch 4 zugängig machen</button></div>';
} elseif ($tisch4 == "0") {
    echo '<div class="bezeichnung"><button class="button" id="tisch4">Tisch 4 reservieren</button></div>';
}

?>

<script>
    document.getElementById('tisch1').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'PingTisch/php/pingTisch1.php', true);
        xhr.onload = function()
        {
            if(xhr.status === 200)
            {
                window.location.reload();
            }
        };
        xhr.send();
    });

    document.getElementById('tisch2').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'PingTisch/php/pingTisch2.php', true);
        xhr.onload = function()
        {
            if(xhr.status === 200)
            {
                window.location.reload();
            }
        };
        xhr.send();
    });

    document.getElementById('tisch3').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'PingTisch/php/pingTisch3.php', true);
        xhr.onload = function()
        {
            if(xhr.status === 200)
            {
                window.location.reload();
            }
        };
        xhr.send();
    });

    document.getElementById('tisch4').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'PingTisch/php/pingTisch4.php', true);
        xhr.onload = function()
        {
            if(xhr.status === 200)
            {
                window.location.reload();
            }
        };
        xhr.send();
    });
</script>
</div>
</div>
</body>
<footer>
    <br><br>

    <a href="../datenschutz/index.html" class="footerText">Datenschutz | </a><a href="..//impressum/index.html" class="footerText">Impressum</a>
</footer>
</html>