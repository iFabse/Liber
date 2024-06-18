<?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

$pingTisch = shell_exec("python3 ../python/pingTisch3.py");

echo "$pingTisch";

if ($pingTisch == "Tisch_3_besetzt") 
{
    $sql = "UPDATE tische SET Tisch3 = true;";
} 


if ($pingTisch == "Tisch_3_frei") 
{
    $sql = "UPDATE tische SET Tisch3 = false;";
} 


$result = mysqli_query($conn, $sql);
?>