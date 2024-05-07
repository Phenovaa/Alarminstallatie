<?php
// UserDB.php

class Database {
    private $host = "localhost"; // Hostnaam
    private $username = "root"; // Gebruikersnaam
    private $password = "root"; // Wachtwoord
    private $database = "alarminstallatieDB"; // Database naam
    protected $conn;

    // Maak een databaseverbinding
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Databaseverbinding mislukt: " . $this->conn->connect_error);
        }
    }

    // Sluit de databaseverbinding
    public function __destruct() {
        $this->conn->close();
    }

    // Geeft de databaseverbinding terug
    public function getConnection() {
        return $this->conn;
    }
}

?>
