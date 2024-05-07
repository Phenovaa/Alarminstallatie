<?php
// registratie.php

require_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $user = new User();
    $registrationResult = $user->registerUser($name, $username, $password, $birthdate, $email, $phone);
    if ($registrationResult === true) {
        // Als registratie succesvol is, stuur de gebruiker door naar de inlogpagina met een succesbericht
        header("Location: inlog.php?success=1");
        exit; // Zorg ervoor dat er geen code meer wordt uitgevoerd na het doorsturen
    } else {
        // Als registratie mislukt is, toon het foutbericht op de registratiepagina
        $errorMessage = $registrationResult;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
    <link rel="stylesheet" href="registratie.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap"
      rel="stylesheet"
    />
</head>

<?php include 'navigatiebar.php'; ?>

<body>
    <div class="registratie-pagina">
        <h2>Registratie</h2>
        <?php if(isset($errorMessage)) { ?>
            <p><?php echo $errorMessage; ?></p>
        <?php } ?>
        <form action="registratie.php" method="POST"> <!-- Let op: het formulier moet naar registratie.php verwijzen -->
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="birthdate">Geboortedatum:</label>
            <input type="date" id="birthdate" name="birthdate" required><br><br>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="phone">Telefoonnummer:</label>
            <input type="text" id="phone" name="phone"><br><br>
            <button type="submit">Registreren</button>
        </form>
    </div>
</body>
</html>
