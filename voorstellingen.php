<?php 
// Database connectie importeren
include("scripts/database.php");
// Klantgegevens importeren
include("scripts/klantgegevens.php");

$klantnummer = $_GET["klantnummer"];

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
            <li><a href="#" class="current">Voorstellingen</a></li>
            <li><a href="reserveringen.php?<?php echo "klantnummer=$klantnummer"?>">Reserveringen</a>
            <li>
            <li><a href="index.html">Uitloggen</a></li>
        </ul>
    </header>

    <div class="content">
        <h1>Hallo
            <?php echo $aanhef . $achternaam?>
        </h1>
        <h2>hieronder kan u al onze voorstellingen zien voor de komende periode, u kunt op een voorstellingen klikken
            om te reserveren
        </h2>

        <!-- Keuze veld maken met alle genres uit de database -->
        <form>
            <select name="genre">
                <?php 
    $genres = mysql_query("SELECT genre FROM voorstellingen GROUP BY genre");
    // voor elk genre een <option> veld maken en value gelijk maken aan het genre
    while($genre = mysql_fetch_array($genres)) {
        $genre = $genre['genre'];
        echo "<option value=\"$genre\">$genre</option>";
    }
?>
            </select>

            <input type="hidden" name="klantnummer" value="<?php echo $klantnummer?>">

            <!-- Als er gefilterd wordt het gekozen genre en klantnummer meesturen en de pagina herladen -->
            <button value="submit">Filter</button>
        </form>
        <!-- Genre keuze verwijderen en de pagina herladen -->
        <button onclick='window.location.replace("voorstellingen.php?klantnummer=<?php echo $klantnummer?>")'>Filter
            verwijderen</button>

        <!-- Overzichtelijke tabel aanmaken met gegevens van alle voorstellingen -->
        <?php
echo "<div style=\"overflow-x:auto;\">";
echo "<table>";
echo "<tr>";
echo "<th>voorstellingsnr</th>";
echo "<th>datum</th>";
echo "<th>tijd</th>";
echo "<th>voorstelling</th>";
echo "<th>genre</th>";
echo "<th>prijs</th>";
echo "</tr>";

// Als er een genre is gekozen alleen de voorstellingen laden die aan het genre voldoen
if(isset($_GET['genre'])) {
    $keuze = $_GET['genre'];
    $voorstellingen = mysql_query("SELECT * 
    FROM voorstellingen WHERE genre = '$keuze'
    GROUP BY voorstellingsnr");

// Als er geen genre is gekozen alle voorstellingen laten zien
} else  {
    $voorstellingen = mysql_query("SELECT * 
    FROM voorstellingen 
    GROUP BY voorstellingsnr");
}

// Alle voorstellingen in een array zetten en voor elke rij in de tabel zetten en er een link van maken.
while($voorstelling = mysql_fetch_array($voorstellingen)) { 

    $voorstellingsnr = $voorstelling['voorstellingsnr'];
    
    // Voor elke rij uit de database een tabelrij maken en er een link van maken die naar het script reserveren.php stuurt en het geselcteerde voorstellingsnummer meesturen
    echo "<tr onclick='window.location.replace(\"reserveren.php?klantnummer=$klantnummer&voorstelling=$voorstellingsnr\")'>";
    
    // preg_replace('/[\x00-\x1F\x80-\xFF]/', '') om ongeldige utf-8 tekens te verwijderen
    $datum = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$voorstelling['datum']); 
    $tijd = $voorstelling['tijd']; 
    // preg_replace('/[\x00-\x1F\x80-\xFF]/', '') om ongeldige utf-8 tekens te verwijderen
    $titel = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$voorstelling['titel']); 
    $genre = $voorstelling['genre']; 
    $prijs = $voorstelling['prijs'];

    echo "<td>$voorstellingsnr</td>";
    echo "<td>$datum</td>";
    echo "<td>$tijd</td>";
    echo "<td>$titel</td>";
    echo "<td>$genre</td>";
    echo "<td>$prijs</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";
?>

    </div>
</body>

</html>