<?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

$pingTisch = shell_exec("python3 ../python/pingTisch4.py");

if ($pingTisch == "Tisch_4_besetzt") 
{
    $sql = "UPDATE tische SET Tisch4 = true;";
} 


if ($pingTisch == "Tisch_4_frei") 
{
    $sql = "UPDATE tische SET Tisch4 = false;";
} 


$result = mysqli_query($conn, $sql);
?>