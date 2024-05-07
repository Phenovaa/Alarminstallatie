<?php
// dashboard.php

// Inclusie van de databaseklasse
include 'offerteDB.php';

// Maak een instantie van de databaseklasse
$database = new OfferteDB();

?>

<?php
  include 'navigatiebar-admin.php';
  ?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap"
      rel="stylesheet"
    />
</head>

<body>
    <h1>Alarminstallatie Admin Dashboard</h1>
    <form action="dashboard.php" method="GET">
        <label for="searchInput">Zoek op ID:</label>
        <input type="text" id="searchInput" name="id" placeholder="Voer ID in...">
        <button type="submit">Zoek</button>
    </form>
    

    <?php
    // Controleer of er een zoekopdracht is uitgevoerd
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        // Haal de ID op uit de URL
        $id = $_GET['id'];

        // Haal de offerte op basis van de ID
        $offerte = $database->haalOfferteOpBasisVanID($id);

        // Controleer of de offerte is gevonden
        if ($offerte) {
            // Toon de offertegegevens in een aparte div met klasse "zoek-resultaat"
            echo "<div class='zoek-resultaat'>";
            echo "<h2>Offertegegevens</h2>";
            echo "<p>ID: {$offerte['id']}</p>";
            echo "<p>Naam: {$offerte['naam']}</p>";
            echo "<p>Email: {$offerte['email']}</p>";
            echo "<p>Telefoonnummer: {$offerte['telefoonnummer']}</p>";
            echo "<p>Bedrijfsnaam: {$offerte['bedrijfsnaam']}</p>";
            echo "<p>Offerte-optie: {$offerte['offerte_optie']}</p>";
            echo "<p>Bericht: {$offerte['bericht']}</p>";
            echo "<p>Aanvraag Datum: {$offerte['aanvraag_datum']}</p>";
            echo "<p>Foto's:</p>";
            // Loop door de foto's en toon ze
            foreach (explode(",", $offerte['foto']) as $foto) {
                echo "<img src='{$foto}' alt='Offerte foto'>";
            }
            echo "</div>"; // Sluit de div met klasse "zoek-resultaat"
        } else {
            // Geen offerte gevonden met de opgegeven ID
            echo "<p>Geen offerte gevonden met ID: $id</p>";
        }
    }

    // Haal alle offertes op als er geen zoekopdracht is
    else {
        // Haal alle offertes op
        $offertes = $database->haalAlleOffertesOp();

        // Controleer of er offertes zijn
        if ($offertes) {
            // Loop door elke offerte en vul de tabel in
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Naam</th>";
            echo "<th>Email</th>";
            echo "<th>Telefoonnummer</th>";
            echo "<th>Bedrijfsnaam</th>";
            echo "<th>Offerte-optie</th>";
            echo "<th>Bericht</th>";
            echo "<th>Foto's</th>";
            echo "<th>Aanvraag Datum</th>"; // Nieuwe kolom voor de datum
            echo "<th>Bewerk</th>"; // Nieuwe kolom voor bewerken
            echo "<th>Verwijder</th>"; // Nieuwe kolom voor verwijderen
            echo "</tr>";
            foreach ($offertes as $offerte) {
                echo "<tr>";
                echo "<td>{$offerte['id']}</td>";
                echo "<td>{$offerte['naam']}</td>";
                echo "<td>{$offerte['email']}</td>";
                echo "<td>{$offerte['telefoonnummer']}</td>";
                echo "<td>{$offerte['bedrijfsnaam']}</td>";
                echo "<td>{$offerte['offerte_optie']}</td>";
                echo "<td>{$offerte['bericht']}</td>";
                echo "<td>";
                // Loop door de foto's en toon ze
                foreach (explode(",", $offerte['foto']) as $foto) {
                    echo "<img src='{$foto}' alt='Offerte foto'>";
                }
                echo "</td>";
                echo "<td>{$offerte['aanvraag_datum']}</td>"; // Nieuwe kolom voor de datum
                echo "<td><a href='edit-offerte.php?id={$offerte['id']}'>Bewerk</a></td>"; // Nieuwe kolom voor bewerken
                echo "<td><a href='delete-offerte.php?id={$offerte['id']}'>Verwijder</a></td>"; // Nieuwe kolom voor verwijderen
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // Geen offertes gevonden
            echo "<p>Geen offertes gevonden.</p>";
        }
    }
    ?>
</body>
</html>
