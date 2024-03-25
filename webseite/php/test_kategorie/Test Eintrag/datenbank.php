<?php
        include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 
        include_once 'eingabe.php';


            $namen = $_POST['namen'];




            $auftrag = "Test Eintrag";

            $extras = $_POST['extras'];

            $sql = "INSERT INTO menu (namen, auftrag, extras) 
                    VALUES ('$namen', '$auftrag', '$extras');";

            mysqli_query($conn, $sql);

            header("Location: ../../../verwaltung/erfolg.php?submit=sucess");
            ?>