<?php
// registratie_verwerken.php

require_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $user = new User();
    if ($user->registerUser($name, $username, $password, $birthdate, $email, $phone)) {
        // Als registratie succesvol is, stuur de gebruiker door naar de inlogpagina met een succesbericht
        header("Location: inlog.php?success=1");
        exit; // Zorg ervoor dat er geen code meer wordt uitgevoerd na het doorsturen
    } else {
        echo "Registratie mislukt!";
    }
}

?>
