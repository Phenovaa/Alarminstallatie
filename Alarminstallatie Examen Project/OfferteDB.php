<?php
// offerteDB.php

class OfferteDB {
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPassword = 'root';
    private $dbName = 'alarminstallatieDB';

    private $conn;

    public function __construct() {
        // Maak een verbinding met de database
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

        // Controleer de verbinding
        if ($this->conn->connect_error) {
            die("Verbinding met de database is mislukt: " . $this->conn->connect_error);
        }
    }

    public function voegOfferteToe($naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $fotoNamen, $datum) {
        // Maak een string van de foto bestandsnamen gescheiden door komma's
        $fotoString = implode(",", $fotoNamen);

        // Voorbereiden van de SQL-query om de offerte toe te voegen, inclusief de datum
        $stmt = $this->conn->prepare("INSERT INTO offerte (naam, email, telefoonnummer, bedrijfsnaam, offerte_optie, bericht, foto, aanvraag_datum) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind de parameters aan de query
        $stmt->bind_param("ssssssss", $naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $fotoString, $datum);

        // Voer de query uit
        $result = $stmt->execute();

        // Sluit de statement
        $stmt->close();

        return $result;
    }

    public function haalAlleOffertesOp() {
        // Voorbereid de SQL-query om alle offertes op te halen inclusief de datum
        $query = "SELECT * FROM offerte";

        // Voer de query uit
        $result = $this->conn->query($query);

        // Controleer of er resultaten zijn
        if ($result->num_rows > 0) {
            // Maak een array om de offertes op te slaan
            $offertes = array();

            // Loop door de resultaten en voeg ze toe aan de array
            while ($row = $result->fetch_assoc()) {
                $offertes[] = $row;
            }

            // Geef de array met offertes terug
            return $offertes;
        } else {
            // Geen offertes gevonden
            return false;
        }
    }

    public function haalOfferteOpBasisVanID($id) {
        // Voorbereiden van de SQL-query om de offerte op te halen op basis van ID
        $stmt = $this->conn->prepare("SELECT * FROM offerte WHERE id = ?");

        // Bind de parameters aan de query
        $stmt->bind_param("i", $id);

        // Voer de query uit
        $stmt->execute();

        // Haal het resultaat op
        $result = $stmt->get_result();

        // Controleer of er een resultaat is
        if ($result->num_rows > 0) {
            // Haal de offertegegevens op
            $offerte = $result->fetch_assoc();
            return $offerte;
        } else {
            // Geen offerte gevonden met de opgegeven ID
            return false;
        }
    }

    public function updateOfferte($id, $naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $datum) {
        // Voorbereiden van de SQL-query om de offerte bij te werken
        $stmt = $this->conn->prepare("UPDATE offerte SET naam=?, email=?, telefoonnummer=?, bedrijfsnaam=?, offerte_optie=?, bericht=?, aanvraag_datum=? WHERE id=?");

        // Bind de parameters aan de query
        $stmt->bind_param("sssssssi", $naam, $email, $telefoonnummer, $bedrijfsnaam, $offerte_optie, $bericht, $datum, $id);

        // Voer de query uit
        $result = $stmt->execute();

        // Sluit de statement
        $stmt->close();

        return $result;
    }

    public function verwijderOfferte($id) {
        // Voorbereiden van de SQL-query om de offerte te verwijderen
        $stmt = $this->conn->prepare("DELETE FROM offerte WHERE id = ?");

        // Bind de parameters aan de query
        $stmt->bind_param("i", $id);

        // Voer de query uit
        $result = $stmt->execute();

        // Sluit de statement
        $stmt->close();

        return $result;
    }

    public function __destruct() {
        // Sluit de databaseverbinding wanneer het object wordt vernietigd
        $this->conn->close();
    }
}
?>
