<?php 
// Database connectie importeren
include("scripts/database.php");
// Klantgegevens importeren
include("scripts/klantgegevens.php");
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
        border-collapse: collapse;
        margin: 2% auto 2% auto;
        width: 100%;
        font-size: 1.3rem;
        table-layout: auto;
    }

    table,
    td,
    tr {
        border: 1px solid black;
    }

    th {
        height: 50px;
        border-right: 1px solid black;
        background-color: #990000;
        color: white;
        text-align: center;
        padding: 5px 0 0 5px;
    }

    td {
        padding: 5px 0 0 5px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #999999;
    }
    </style>

</head>

<body>
    <header>
        <ul>
            <li><a href="voorstellingen.php?<?php echo "klantnummer=$klantnummer"?>">Voorstellingen</a></li>
            <li><a href="#" class="current">Reserveringen</a></li>
            <li><a href="index.html">Uitloggen</a></li>
        </ul>
    </header>

    <div class="content">
        <h1>Hallo
            <?php echo $aanhef . $achternaam?>
        </h1>
        <h2>Dit zijn al uw reserveringen, klik op een reservering om uw reservering aan te kunnen passen
        </h2>
        <!-- Overzichtelijke tabel aanmaken met gegevens van alle reserveringen -->
        <?php
echo "<div style=\"overflow-x:auto;\">";
echo "<table>";
echo "<tr>";
echo "<th>reserveringsnr</th>";
echo "<th>datum</th>";
echo "<th>tijd</th>";
echo "<th>voorstellingsnr</th>";
echo "<th>zaal</th>";
echo "<th>aantal</th>";
echo "</tr>";

$i = 1;
$reserveringen = mysql_query("SELECT * 
FROM reserveringen 
WHERE bezoekersnr=$klantnummer");
// Alle voorstellingen in een array zetten en voor elke rij in de tabel zetten en er een link van maken.
while($reservering = mysql_fetch_array($reserveringen)) { 
    $reserveringsnr = $reservering['reserveringsnr'];
    $datum = $reservering['datum'];
    $tijd = $reservering['tijd'];
    $voorstellingsnr = $reservering['voorstellingsnr'];
    $zaalnr = $reservering['zaalnr']; 
    $aantal = $reservering['aantal'];

    // Voor elke rij uit de database een tabelrij maken en er een link van maken die naar het script reserveren.php stuurt en de geselecteerde reservering meesturen
    echo "<tr onclick='window.location.replace(\"reservering.php?klantnummer=$klantnummer&reservering=$reserveringsnr\")'>";
    $i += 1;

    echo "<td>$reserveringsnr</td>";
    echo "<td>$datum</td>";
    echo "<td>$tijd</td>";
    echo "<td>$voorstellingsnr</td>";
    echo "<td>$zaalnr</td>";
    echo "<td>$aantal</td>";
    echo "</tr>";
} 
echo "</table>";
echo "</div>";
?>

    </div>
</body>

</html>