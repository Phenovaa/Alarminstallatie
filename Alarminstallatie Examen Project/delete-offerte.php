<?php
// delete-offerte.php

include 'offerteDB.php';

class OfferteDeleter {
    private $database;

    public function __construct() {
        // Maak een instantie van de databaseklasse
        $this->database = new OfferteDB();
    }

    public function verwijderOfferte($id) {
        // Voer de verwijder-operatie uit in de database
        $result = $this->database->verwijderOfferte($id);

        // Controleer of de verwijdering succesvol was
        if ($result) {
            echo "Offerte met ID $id is succesvol verwijderd.";
            // Redirect naar dashboard.php
            header("Location: dashboard.php");
            exit; // Zorg ervoor dat het script hier stopt om te voorkomen dat het doorgaat na de redirect
        } else {
            echo "Er is een fout opgetreden bij het verwijderen van de offerte met ID $id.";
        }
    }
}

// Controleer of de ID is ontvangen via GET en verwijder de offerte
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Haal de ID op uit de URL
    $id = $_GET['id'];

    // Maak een instantie van de OfferteDeleter klasse en verwijder de offerte
    $offerteDeleter = new OfferteDeleter();
    $offerteDeleter->verwijderOfferte($id);
} else {
    // Toon een foutmelding als de ID ontbreekt
    echo "Geen ID ontvangen voor verwijdering.";
}
?>
