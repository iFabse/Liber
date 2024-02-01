<?php
        include_once '/var/www/datenbank_verbindung.php';                    // verbindung zur Datenbank 
        include_once 'eingabe.php';


            $namen = $_POST['namen'];




            $auftrag = "Lorem ipsum dolor";

            $extras = $_POST['extras'];

            $sql = "INSERT INTO menu (namen, auftrag, extras) 
                    VALUES ('$namen', '$auftrag', '$extras');";

            mysqli_query($conn, $sql);

            header("Location: ../../../verwaltung/erfolg.php?submit=sucess");
            ?>