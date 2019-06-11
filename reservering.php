<?php 
// Database connectie importeren
include("scripts/database.php");
// Klantgegevens script importeren
include("scripts/klantgegevens.php");
// Gegevens uit de url halen en opslaan

$reserveringsnr = $_GET["reservering"];

$reserveringen = mysql_query("SELECT * 
FROM reserveringen 
WHERE reserveringsnr=$reserveringsnr");
// Alle voorstellingen in een array zetten en voor elke rij in de tabel zetten en er een link van maken.
while($reservering = mysql_fetch_array($reserveringen)) { 
    // Voor elke rij uit de database een tabelrij maken en er een link van maken die naar het script reserveren.php stuurt en het geselcteerde voorstellingsnummer meesturen
    $reserveringsnr = $reservering['reserveringsnr'];
    $datum = $reservering['datum'];
    $tijd = $reservering['tijd'];
    $voorstellingsnr = $reservering['voorstellingsnr'];
    $zaalnr = $reservering['zaalnr']; 
    $aantal = $reservering['aantal'];
}

$gekozen_voorstelling = $voorstellingsnr;

// Voorstellinggegevens importeren
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

    div.aanpassen {
        margin: auto;
        padding: 1%;
    }
    </style>

</head>

<body>
    <header>
        <ul>
            <li><a href="voorstellingen.php?<?php echo "klantnummer=$klantnummer"?>">Voorstellingen</a></li>
            <li><a href="reserveringen.php?<?php echo "klantnummer=$klantnummer"?>">Reserveringen</a>
            <li>
            <li><a href="#" class="current">Reservering</a></li>
            <li><a href="index.html">Uitloggen</a></li>
        </ul>
    </header>

    <div class="content">
        <h1>Hallo <?php echo $aanhef . $achternaam?></h1>
        <h2>Dit is uw reservering:</h2>

        <div class="reservering">
            <table>
                <?php echo 
        "
        <tr>
            <td>Titel:</td>
            <td>$reserveringsnr</td>
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
            <td>Voorstelling:</td>
            <td>$titel</td>
        </tr>
        <tr>
            <td>Aantal personen:</td>
            <td>$aantal</td>
        </tr>
        <tr>
            <td>Zaal:</td>
            <td>$zaalnr</td>
        </tr>
        ";
        ?>



            </table>


            <!-- Mogelijkheid om aantal personen aan te passen, gegevens van huidige reservering worden meegestuurd -->
            <div class="aanpassen">
                <form action="scripts/reservering.php?" method="GET">
                    <input type='number' name="aantal">
                    <input type="hidden" name="voorstelling" value="<?php echo $voorstellingsnr?>">
                    <input type="hidden" name="klantnummer" value="<?php echo $klantnummer?>">
                    <input type="hidden" name="reserveringsnr" value="<?php echo $reserveringsnr?>">
                    <input type="hidden" name="change" value="true">
                    <button>Aantal personen aanpassen</button>
                </form>
                <!-- Mogelijkheid om reservering te verwijderen -->
                <form action="scripts/verwijderen.php" method="GET">
                    <input type="hidden" name="reservering" value=<?php echo $reserveringsnr?>><br><br>
                    <input type="hidden" name="klantnr" value=<?php echo $klantnummer?>>
                    <button>Verwijderen</button>
                </form>


                <h1><?php 
    // Als de reservering is aangepast een bevesteging geven
        if(isset($_GET['change'])) {
            echo "<h3 class='succes'>Reservering is succesvol aangepast</h2>";
        }
    ?>
                </h1>

            </div>
</body>

</html>