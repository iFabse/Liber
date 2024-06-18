<?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

$pingTisch = shell_exec("python3 ../python/pingTisch1.py");


if ($pingTisch == "Tisch_1_besetzt") 
{
    $sql = "UPDATE tische SET Tisch1 = true;";
} 


if ($pingTisch == "Tisch_1_frei") 
{
    $sql = "UPDATE tische SET Tisch1 = false;";
} 


$result = mysqli_query($conn, $sql);

?>