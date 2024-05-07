<?php
// submit-offerte.php

// Inclusie van de databaseklasse
include 'offerteDB.php';

class OfferteSubmitter {
    private $database;

    public function __construct() {
        // Maak een instantie van de databaseklasse
        $this->database = new OfferteDB();
    }

    public function verwerkOfferteFormulier() {
        // Controleer of het formulier is verzonden
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verkrijg de formuliergegevens
            $naam = $_POST['naam'];
            $email = $_POST['email'];
            $telefoonnummer = $_POST['telefoonnummer'];
            $bedrijfsnaam = $_POST['bedrijfsnaam'];
            $offerte_optie = $_POST['offerte-optie'];
            $bericht = $_POST['bericht'];
            $datum = $_POST['datum']; // Verkrijg de datum van het formulier

            // Verwerk de geüploade foto's
            $fotoNamen = array(); // Maak een array om de bestandsnamen op te slaan
            foreach ($_FILES['foto']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['foto']['name'][$key];
                $file_tmp = $_FILES['foto']['tmp_name'][$key];
                $file_path = "uploads/" . $file_name; // Stel het pad in waar de foto wordt opgeslagen
                move_uploaded_file($file_tmp, $file_path);
                $fotoNamen[] = $file_path; // Voeg de bestandsnaam toe aan de array
            }

            // Voeg de offerte toe aan de database inclusief de datum
            $result = $this->database->voegOfferteToe($naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $fotoNamen, $datum);

            if ($result) {
                session_start(); // Start de PHP-sessie
                $_SESSION['offerte_message'] = "Offerte succesvol verzonden!";
                session_write_close(); // Sluit de PHP-sessie
                header("Location: offerteformulier.php"); // Redirect terug naar het offerteformulier
                exit(); // Stop verdere uitvoering van dit script
            } else {
                echo "Er is een fout opgetreden. Probeer het later opnieuw.";
            }
        }
    }
}

// Maak een instantie van de OfferteSubmitter klasse en verwerk het formulier
$offerteSubmitter = new OfferteSubmitter();
$offerteSubmitter->verwerkOfferteFormulier();
?>
