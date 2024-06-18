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


        // RFID-Daten abrufen
        $rfid = shell_exec("/usr/bin/python3 Read.py");


        if ($rfid) {
            // Verbindung zur Datenbank herstellen
            $db_link = mysqli_connect(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

            // Verbindung prüfen
            if (!$db_link) {
                die('Verbindung fehlgeschlagen: ' . mysqli_connect_error());
            }

            // Abfrage der Daten basierend auf der RFID-Nummer
            $stmt = $db_link->prepare("SELECT id, rfid, namen, email, guthaben FROM kunden WHERE rfid = ?");
            $stmt->bind_param("s", $rfid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<table border="1">';
                echo "<tr><th>ID</th><th>RFID</th><th>Name</th><th>Email</th><th>Guthaben</th></tr>";
                // Ausgabe der Daten
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['rfid']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['namen']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['guthaben']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Keine Daten gefunden für RFID: " . htmlspecialchars($rfid);
            }

            $stmt->close();
            $db_link->close();
        } else {
            echo "Fehler beim Auslesen der RFID-Daten.";
        }
    }
    ?>
</body>
</html>
