<?php
// search.php

// Inclusie van de databaseklasse
include 'offerteDB.php';

// Maak een instantie van de databaseklasse
$database = new OfferteDB();

// Controleer of de ID in de URL is meegegeven
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Haal de ID op uit de URL
    $id = $_GET['id'];

    // Haal de offerte op basis van de ID
    $offerte = $database->haalOfferteOpBasisVanID($id);

    // Controleer of de offerte is gevonden
    if ($offerte) {
        // Toon de offertegegevens
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
    } else {
        // Geen offerte gevonden met de opgegeven ID
        echo "Geen offerte gevonden met ID: $id";
    }
} else {
    // Geen ID meegegeven in de URL
    echo "Geen ID meegegeven in de URL.";
}
?>
