<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFID Daten auslesen</title>
</head>
<body>
    <h1>RFID Daten auslesen</h1>
    <form method="post">
        <button type="submit" name="read_rfid">RFID auslesen</button>
    </form>

    <?php
    if (isset($_POST['read_rfid'])) {
        include_once '/home/pi/.datenbank_verbindung.php'; // Verbindung zur Datenbank
          
        // Funktion zum Ausführen des Python-Skripts
        $rfid = shell_exec("/usr/bin/python3 Read.py");

        $db_link = mysqli_connect (
            MYSQL_HOST, 
            MYSQL_BENUTZER, 
            MYSQL_KENNWORT, 
            MYSQL_DATENBANK
           );

           $sql = "SELECT * FROM kunden";
        
           $db_erg = mysqli_query( $db_link, $sql );
           
        if ( ! $db_erg )
        {
          die('Ungültige Abfrage: ' . mysqli_error());
        }

        echo '<table border="1">';
        while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
        {
        echo "<tr>";
        echo "<td>". $zeile['id'] . "</td>";
        echo "<td>". $zeile[$rfid] . "</td>";
        echo "<td>". $zeile['namen'] . "</td>";
        echo "<td>". $zeile['email'] . "</td>";
        echo "<td>". $zeile['guthaben'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";

        mysqli_free_result( $db_erg );



        }


         /*
        if ($rfid) {
            // Datenbankverbindung herstellen
            $servername = "localhost";
            $username = "your_username";
            $password = "your_password";
            $dbname = "your_database";

            // Verbindung herstellen
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verbindung prüfen
            if ($conn->connect_error) {
                die("Verbindung fehlgeschlagen: " . $conn->connect_error);
            }

            // Abfrage der Daten basierend auf der RFID-Nummer
            $stmt = $conn->prepare("SELECT id, rfid, namen, email, guthaben FROM users WHERE rfid = ?");
            $stmt->bind_param("s", $rfid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Ausgabe der Daten
                while($row = $result->fetch_assoc()) {
                    echo "ID: " . $row["id"]. "<br>";
                    echo "RFID: " . $row["rfid"]. "<br>";
                    echo "Name: " . $row["namen"]. "<br>";
                    echo "Email: " . $row["email"]. "<br>";
                    echo "Guthaben: " . $row["guthaben"]. "<br>";
                }
            } else {
                echo "Keine Daten gefunden für RFID: " . htmlspecialchars($rfid);
            }
            $stmt->close();
            $conn->close();
        } else {
            echo "Fehler beim Auslesen der RFID-Daten.";
        } */
    }
    ?>
</body>
</html>