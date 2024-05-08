<?php
include 'offerteDB.php';
include 'navigatiebar-admin.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Offerte</title>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="edit-offerte.css">
</head>
<body>
<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $database = new OfferteDB();
    $offerte = $database->haalOfferteOpBasisVanID($_GET['id']);
    if($offerte) {
        // Toon het bewerkingsformulier met de bestaande gegevens ingevuld
        echo '<div style="text-align: center; margin-top: 50px;">';
        echo '<h2>Bewerk Offerte</h2>';
        echo '</div>';
        ?>
        <form class="offerte-formulier" action="update-offerte.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $offerte['id']; ?>">
            <label for="naam">Naam:</label><br>
            <input type="text" id="naam" name="naam" value="<?php echo $offerte['naam']; ?>" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $offerte['email']; ?>" required><br>

            <label for="telefoonnummer">Telefoonnummer:</label><br>
            <input type="text" id="telefoonnummer" name="telefoonnummer" value="<?php echo $offerte['telefoonnummer']; ?>" required><br>

            <label for="bedrijfsnaam">Bedrijfsnaam:</label><br>
            <input type="text" id="bedrijfsnaam" name="bedrijfsnaam" value="<?php echo $offerte['bedrijfsnaam']; ?>"><br>

            <label for="offerte-optie">Offerte Optie:</label><br>
            <select id="offerte-optie" name="offerte-optie" required>
                <option value="">-- Kies een optie --</option>
                <option value="inbraakbeveiligingssystemen" <?php if($offerte['offerte_optie'] == "inbraakbeveiligingssystemen") echo "selected"; ?>>Inbraakbeveiligingssystemen</option>
                <option value="camerabewaking-systemen" <?php if($offerte['offerte_optie'] == "camerabewaking-systemen") echo "selected"; ?>>Camerabewaking-systemen</option>
                <option value="intercomsystemen" <?php if($offerte['offerte_optie'] == "intercomsystemen") echo "selected"; ?>>Intercomsystemen</option>
                <option value="overval-panieksystemen" <?php if($offerte['offerte_optie'] == "overval-panieksystemen") echo "selected"; ?>>Overval/Panieksystemen</option>
                <option value="toegangscontrolesystemen" <?php if($offerte['offerte_optie'] == "toegangscontrolesystemen") echo "selected"; ?>>Toegangscontrolesystemen</option>
                <option value="hulpoproepsystemen" <?php if($offerte['offerte_optie'] == "hulpoproepsystemen") echo "selected"; ?>>Hulpoproepsystemen</option>
            </select><br>

            <label for="bericht">Bericht:</label><br>
            <textarea id="bericht" name="bericht" required><?php echo $offerte['bericht']; ?></textarea><br>

            <label for="datum">Datum aanvraag:</label><br>
            <input type="date" id="datum" name="datum" value="<?php echo $offerte['aanvraag_datum']; ?>" required><br> <!-- Nieuw invoerveld voor de datum -->

            <label for="foto">Foto's uploaden:</label><br>
            <input type="file" id="foto" name="foto[]" multiple accept="image/*"><br>

            <input type="submit" value="Opslaan">
        </form>
        <?php
    } else {
        echo "Offerte niet gevonden";
    }
} else {
    echo "Geen offerte ID opgegeven";
}
?>
</body>
</html>
