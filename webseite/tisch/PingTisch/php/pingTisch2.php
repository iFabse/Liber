<?php
    include_once '/var/www/datenbank_verbindung.php';                    // verbindung zur Datenbank 

$pingTisch = shell_exec("python3 ../python/pingTisch2.py");


if ($pingTisch == "Tisch 2 besetzt") 
{
    $sql = "UPDATE tische SET Tisch2 = true;";
} 


if ($pingTisch == "Tisch 2 frei") 
{
    $sql = "UPDATE tische SET Tisch2 = false;";
} 


$result = mysqli_query($conn, $sql);

?>