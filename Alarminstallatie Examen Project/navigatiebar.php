<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigatiebar</title>
    <link rel="stylesheet" href="navigatiebar.css">
</head>
<body>

<div class="alarminstallatie-header"></div> 

<header>
    <a href="hoofdpagina.php">
        <img class="logo" src="image/alarminstallatie.png" alt="Alarm-logo"/>
    </a>

    <nav>
        <ul class="navbar">
            <li><a href="#">Home</a></li>
            <li><a href="offerteformulier.php">Offerte aanvraag</a></li>
            <li><a href="#">Over ons</a></li>
        </ul>
    </nav>

    <ul>
       <li><button class="button-design" onclick="registreren()">Registreren</button></li>
       <li><a href="inlog.php"><button class="button-design">Inloggen</button></a></li>
    </ul>
</header>

<script>
    function registreren() {
        var code = prompt("Voer uw registratiecode in:");
        if (code === "PandaBeertje" || code === "HondKat" || code === "SlangBeer") {
            window.location.href = "registratie.php";
        } else {
            alert("Ongeldige registratiecode. Probeer opnieuw.");
        }
    }
</script>

</body>
</html>
