<?php
// inlog_verwerken.php

require_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new User();
    $loginResult = $user->loginUser($username, $password);
    if ($loginResult === true) {
        // Als inloggen gelukt is, stuur de gebruiker door naar het dashboard
        header("Location: dashboard.php");
        exit; // Zorg ervoor dat er geen code meer wordt uitgevoerd na het doorsturen
    } else {
        // Als inloggen mislukt is, stuur de gebruiker terug naar de inlogpagina met een foutmelding
        header("Location: inlog.php?error=" . urlencode($loginResult));
        exit; // Zorg ervoor dat er geen code meer wordt uitgevoerd na het doorsturen
    }
}
?>
