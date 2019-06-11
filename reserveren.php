<?php 
// Database connectie importeren
include("scripts/database.php");
// Klantgegevens script importeren
include("scripts/klantgegevens.php");
// Gegevens uit de url halen en opslaan

// Voorstellinggegevens importeren
$gekozen_voorstelling = $_GET["voorstelling"];
include("scripts/voorstellingen.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Reserveren</title>

    <style>
    * {
        margin: 0;
        overflow-x: hidden;
    }

    h3 {
        color: red;
        margin: 2%;
    }

    .content {
        margin: 1%;
    }

    /* Start nav */

    header {
        margin-bottom: 20px;
        width: auto;
    }

    ul {
        width: 100%;
        height: 55px;
        border: 2px;
        border-color: #cfbd8b;
        top: 0;
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #990000;
        font-family: arial;
        font-weight: bold;
        padding-left: 75px;
    }

    li {
        float: left;
        font-size: 150%;
        padding-bottom: 3px;
    }

    li a {
        display: inline-block;
        color: #cfbd8b;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #cfbd8b;
        color: #990000;
        text-decoration: underline;
    }

    .current {
        text-decoration: underline;
        font-weight: bold;
    }

    /* End nav */
    table {
        border: 1px solid black;
        font-size: 1.5rem;
        width: 30%;
        margin: 2%;
    }

    tr {
        width: 50%;
    }

    td {
        padding: 2%;
    }

    form {
        margin: -1% 0 0 2%;
    }

    label {
        margin-right: 3%;
    }
    </style>

</head>

<body>
    <header>
        <ul>
            <li><a href="voorstellingen.php?<?php echo "klantnummer=$klantnummer"?>">Voorstellingen</a></li>
            <li><a href="#" class="current">Reserveren</a></li>
            <li><a href="login.html">Uitloggen</a></li>
        </ul>
    </header>

    <div class="content">
        <h1>Hallo <?php echo $aanhef . $achternaam?></h1>
        <h2>U heeft gekozen voor de volgende voorstelling:</h2>
        <!-- Gegevens van de gekozen voorstelling weergeven in tabel -->
        <div class="voorstelling">
            <table>
                <?php echo 
        "
        <tr>
            <td>Titel:</td>
            <td>$titel</td>
        </tr>
        <tr>
            <td>Datum:</td>
            <td>$datum</td>
        </tr>
        <tr>
            <td>tijd:</td>
            <td>$tijd</td>
        </tr>
        <tr>
            <td>Genre:</td>
            <td>$genre</td>
        </tr>
        <tr>
            <td>Zaal:</td>
            <td>$zaal</td>
        </tr>
        ";
        ?>

            </table>
        </div>
        <!-- Aantal personen laten kiezen voor reservering en klant doorsturen naar bevesteging pagina -->
        <form action="scripts/reservering.php" method="GET">
            <label for="aantal">Aantal personen:</label>
            <input type="number" name="aantal" required>
            <!-- Klantnummer en voorstelling toevoegen als waarde aan het formulier zodat deze mee gestuurd kunnen worden samen met het aantal personen. -->
            <input type="hidden" name="klantnummer" value="<?php echo $klantnummer?>">
            <input type="hidden" name="voorstelling" value="<?php echo $voorstellingsnr?>">
            <button>Reserveren</button>
        </form>
        <!-- Als er minder plaatsen vrij zijn dan de klant probeert te reserveren stuurt het script "reservering.php het aantal vrije plaatsen terug, dat wordt hier weergegeven." -->
        <?php 
            if(isset($_GET['plaatsen'])) {
                echo "<h3>Er zijn nog maar " . $_GET['plaatsen'] . " plaatsen beschikbaar</h3>";
            }
        ?>

    </div>
</body>

</html>