<?php 
// Database connectie importeren
include("scripts/database.php");
include("scripts/klantgegevens.php");

// Reservering gegevens uit url halen en opslaan
$datum = $_GET['datum'];
$tijd = $_GET['tijd'];
$reservering_tijd = $_GET['timestamp'];
$voorstelling = $_GET['voorstelling'];
$voorstellingsnr = $_GET['voorstellingsnr'];
$aantal = $_GET['aantal'];
$zaal = $_GET['zaal'];
$prijs = $_GET['prijs'];
$reserveringsnr = $_GET['reserveringsnr'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Voorstellingen</title>

    <style>
    * {
        margin: 0;
        overflow-x: hidden;
    }

    h3.succes {
        color: green;
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
        width: 50%;
        margin: 2%;
        height: 50%;
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

    .reservering {
        margin: 2%;
    }
    </style>

</head>

<body>
    <header>
        <ul>
            <li><a href="voorstellingen.php?<?php echo "klantnummer=$klantnummer"?>">Voorstellingen</a></li>
            <li><a href="reserveringen.php?<?php echo "klantnummer=$klantnummer"?>">Reserveringen</a>
            <li>
            <li><a href="#" class="current">Bevestiging</a></li>
            <li><a href="index.html">Uitloggen</a></li>
        </ul>
    </header>

    <div class="content">
        <h1>Hallo <?php echo $aanhef . $achternaam?></h1>
        <h2>U heeft gekozen voor de volgende voorstelling:</h2>

        <div class="voorstelling">
            <table>
                <!-- Gegevens van de reservering overzichtelijk in een tabel zetten -->
                <?php echo 
        "
        <tr><th>Nieuwe reservering:</th></tr>
        <tr>
            <td>Voorstelling:</td>
            <td>$voorstelling</td>
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
            <td>Zaal:</td>
            <td>$zaal</td>
        </tr>
        <tr>
            <td>Aantal personen:</td>
            <td>$aantal</td>
        </tr>
        <tr>
            <td>Prijs:</td>
            <td>$prijs</td>
        </tr>
        ";
        ?>
            </table>


            <!-- Klant nog een reservering laten maken (doorsturen naar voorstellingen pagina en klantnummer meesturen) -->
            <form action="voorstellingen.php" method="GET" class="reservering">
                <input type="hidden" name="klantnummer" value="<?php echo $klantnummer?>">
                <button>Nog een reservering plaatsen</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>