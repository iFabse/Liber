<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/order.css">
    <link rel="stylesheet" type="text/css" href="../style/info.css"/>
    <title>Tische Reservieren</title>

</head>
<body>

<?php
    include_once '/var/www/datenbank_verbindung.php';                    // verbindung zur Datenbank 

$sql = "SELECT Tisch1, Tisch2, Tisch3 FROM tische;";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$tisch1 = $row['Tisch1'];
$tisch2 = $row['Tisch2'];
$tisch3 = $row['Tisch3'];

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
</script>

</body>
</html>