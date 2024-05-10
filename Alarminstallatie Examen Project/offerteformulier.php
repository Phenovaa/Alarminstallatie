<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Offerte Aanvraag</title>
  <link rel="stylesheet" href="offerteformulier.css">
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'navigatiebar.php'; ?>

<div class="center">
    <h2>Offerte Aanvraag</h2>

    <?php
    session_start(); // Start de PHP-sessie
    if (isset($_SESSION['offerte_message'])) {
        echo "<p>{$_SESSION['offerte_message']}</p>";
        unset($_SESSION['offerte_message']); // Verwijder het bericht uit de sessie
    }
    session_write_close(); 
    ?>

    <form class="offerte-form" action="submit-offerte.php" method="post" enctype="multipart/form-data">
        <label for="naam">Naam:</label><br>
        <input type="text" id="naam" name="naam" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="telefoonnummer">Telefoonnummer:</label><br>
        <input type="text" id="telefoonnummer" name="telefoonnummer" required><br>

        <label for="bedrijfsnaam">Bedrijfsnaam:</label><br>
        <input type="text" id="bedrijfsnaam" name="bedrijfsnaam"><br>

        <label for="offerte-optie">Offerte Optie:</label><br>
        <select id="offerte-optie" name="offerte-optie" required>
            <option value="">-- Kies een optie --</option>
            <option value="inbraakbeveiligingssystemen">Inbraakbeveiligingssystemen</option>
            <option value="camerabewaking-systemen">Camerabewaking-systemen</option>
            <option value="intercomsystemen">Intercomsystemen</option>
            <option value="overval-panieksystemen">Overval/Panieksystemen</option>
            <option value="toegangscontrolesystemen">Toegangscontrolesystemen</option>
            <option value="hulpoproepsystemen">Hulpoproepsystemen</option>
        </select><br>

        <label for="bericht">Bericht:</label><br>
        <textarea id="bericht" name="bericht" required></textarea><br>

        <label for="datum">Datum aanvraag:</label><br>
        <input type="date" id="datum" name="datum" required><br>

        <label for="foto">Foto's uploaden:</label><br>
        <input type="file" id="foto" name="foto[]" multiple accept="image/*"><br>

        <input type="submit" value="Versturen">
    </form>
</div>

</body>
</html>
