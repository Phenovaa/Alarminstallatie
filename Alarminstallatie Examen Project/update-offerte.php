<?php
// update-offerte.php

include 'offerteDB.php';

class OfferteUpdater {
    private $database;

    public function __construct() {
        // Maak een instantie van de databaseklasse
        $this->database = new OfferteDB();
    }

    public function updateOfferte($id, $naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $datum) {
        // Voer de update-operatie uit in de database
        $result = $this->database->updateOfferte($id, $naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $datum);

        // Controleer of de update succesvol was
        if ($result) {
            // Redirect naar dashboard.php na een succesvolle update
            header("Location: dashboard.php");
            exit(); // Zorg ervoor dat het script stopt na het doorsturen
        } else {
            echo "Er is een fout opgetreden bij het bijwerken van de offerte met ID $id.";
        }
    }
}

// Controleer of het formulier is ingediend en verwerk de update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de formuliergegevens op
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $bedrijfsnaam = $_POST['bedrijfsnaam'];
    $offerte_optie = $_POST['offerte-optie'];
    $bericht = $_POST['bericht'];
    $datum = $_POST['datum'];

    // Maak een instantie van de OfferteUpdater klasse en voer de update uit
    $offerteUpdater = new OfferteUpdater();
    $offerteUpdater->updateOfferte($id, $naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $datum);
}
?>
