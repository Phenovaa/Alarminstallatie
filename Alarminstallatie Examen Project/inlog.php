<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="inlog.css">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet"/>
</head>

<?php include 'navigatiebar.php'; ?>

<body>
<div class="inlog-pagina">
    <h2>Inloggen</h2>
    <?php
    // Hier wordt het bericht weergegeven als de registratie succesvol is geweest
    if (isset($_GET["success"]) && $_GET["success"] == 1) {
        echo "<p>Je account is succesvol aangemaakt! Je kunt nu inloggen.</p>";
    }

    // Hier wordt het foutbericht weergegeven als het inloggen mislukt is
    if (isset($_GET["error"])) {
        $errorMessage = $_GET["error"];
        echo "<p>$errorMessage</p>";
    }
    ?>
    <form action="inlog_verwerken.php" method="POST">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Inloggen</button>
    </form>
</div>
</body>
</html>
