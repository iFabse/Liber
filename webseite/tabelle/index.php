<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <title>Bestell Tabelle</title>
    <link rel="stylesheet" href="../style/tabel.css">
    <style type="text/css">
    body {
    }
    </style>
</head>
<body>
<div class="container my-5">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bestellung</th>
                <th>Name</th>
                <th>Extras</th>
                <th>Aktion</th>
            </tr>
        </thead>
        <tbody>
        <?php
    include_once '/home/pi/.datenbank_verbindung.php';                    // verbindung zur Datenbank 

        $sql = "SELECT * FROM menu";
        $result = $conn->query($sql);

        if (!$result) {
            die("Falsche Datenbank ausgewählt: " . $conn->error);
        }

        // Zähler für Anzeige-ID
        $displayID = 1;

        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
            <td>$displayID</td>
            <td>$row[auftrag]</td>
            <td>$row[namen]</td>
            <td>$row[extras]</td>
            <td>
                <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Löschen</a>
            </td>
            </tr>
            ";

            // Inkrementiere den Anzeige-ID-Zähler
            $displayID++;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
