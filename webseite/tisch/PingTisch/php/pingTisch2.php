<?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

$pingTisch = shell_exec("python3 ../python/pingTisch2.py");


if ($pingTisch == "Tisch_2_besetzt") 
{
    $sql = "UPDATE tische SET Tisch2 = true;";
} 


if ($pingTisch == "Tisch_2_frei") 
{
    $sql = "UPDATE tische SET Tisch2 = false;";
} 


$result = mysqli_query($conn, $sql);

?>