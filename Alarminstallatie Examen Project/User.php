<?php
// User.php sssss

require_once 'UserDB.php';

class User {
    private $db;

    // Constructor om een databaseverbinding tot stand te brengen
    public function __construct() {
        $this->db = new Database();
    }

    // Functie om een gebruiker te registreren
    public function registerUser($name, $username, $password, $birthdate, $email, $phone) {
        $conn = $this->db->getConnection();

        // Voorkom SQL-injectie
        $name = $conn->real_escape_string($name);
        $username = $conn->real_escape_string($username);
        $birthdate = $conn->real_escape_string($birthdate);
        $email = $conn->real_escape_string($email);
        $phone = $conn->real_escape_string($phone);

        // Controleer of de gebruikersnaam al bestaat
        $checkQuery = "SELECT COUNT(*) as count FROM User WHERE gebruikersnaam = '$username'";
        $checkResult = $conn->query($checkQuery);
        $count = $checkResult->fetch_assoc()['count'];

        if ($count > 0) {
            return "De gebruikersnaam is al in gebruik."; // Gebruikersnaam bestaat al
        }

        // Hash het wachtwoord
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Voer de query uit om de gebruiker te registreren
        $query = "INSERT INTO User (naam, gebruikersnaam, wachtwoord, geboortedatum, email, telefoonnummer) VALUES ('$name', '$username', '$hashed_password', '$birthdate', '$email', '$phone')";
        $result = $conn->query($query);

        if ($result) {
            return true; // Gebruiker succesvol geregistreerd
        } else {
            return "Registratie mislukt."; // Registratie mislukt
        }
    }

    // Functie om een gebruiker in te loggen
    public function loginUser($username, $password) {
        $conn = $this->db->getConnection();

        // Voorkom SQL-injectie
        $username = $conn->real_escape_string($username);

        // Voer de query uit om de gebruiker te vinden
        $query = "SELECT wachtwoord FROM User WHERE gebruikersnaam='$username'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['wachtwoord'];

            // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord
            if (password_verify($password, $hashed_password)) {
                return true; // Inloggen gelukt
            } else {
                return "Het wachtwoord is onjuist!";
            }
        } else {
            return "De gebruikersnaam is onjuist!";
        }
    }
}
?>
