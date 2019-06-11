<?php
// Import database connectie
include('../scripts/database.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Bezoekers voorstelling</title>

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
      <li><a href="admin_dashboard.php" class="current">Admin Dashboard</a></li>
      <li><a href="../admin.php">Log uit</a></li>
    </ul>
  </header>
    <div class="content">

    <h1>Hallo admin, dit zijn het aantal bezoekers per voorstelling.</h1>
    <h3>Selecteer een voorstelling om de data te zien</h3>
  
        <!-- Formulier maken met alle titels van de voorstellingen -->
        <form>
            <select name="titel">
            <?php 
                $voorstellingen = mysql_query("SELECT titel, voorstellingsnr FROM voorstellingen GROUP BY titel");

                // Voor elke voorstelling een <option> maken met value=titel
                while($voorstelling = mysql_fetch_array($voorstellingen)) {
                    $titel = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$voorstelling['titel']);
					$voorstellingsnr = $voorstelling['voorstellingsnr'];
                    echo "<option value='$titel'>$titel</option>";
                }
            ?>
            </select>
            <button value="submit">Filteren</button>
        </form>
        <!-- Filters verwijderen en pagina herladen -->
        <button onclick='window.location.replace("bezoekers_voorstelling.php")'>Filter verwijderen</button>

    <?php 
// Tabel aanmaken met de voorstelling gegevens
echo "<div style=\"overflow-x:auto;\">";
echo "<table>";
echo "<tr>";
echo "<th>Titel</th>";
echo "<th>Datum</th>";
echo "<th>Tijd</th>";
echo "<th>Genre</th>";
echo "<th>Aantal bezoekers</th>";
echo "</tr>";

// Kijken of er een voorstelling is gekozen anders alles laten zien
if(isset($_GET['titel'])) {
    $titel = $_GET['titel'];
    $voorstellingen = mysql_query("SELECT * FROM voorstellingen WHERE titel LIKE '$titel'");
} else {
    $voorstellingen = mysql_query("SELECT * FROM voorstellingen");
}

// Voor elke voorstelling een tablerow maken
while($voorstelling = mysql_fetch_array($voorstellingen)) {
	$aantal = 0;
    $titel = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$voorstelling['titel']);
    $datum = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$voorstelling['datum']);
    $tijd = $voorstelling['tijd']; 
    $genre = $voorstelling['genre'];
    $voorstellingsnr = $voorstelling['voorstellingsnr'];

    // Reserveringsgegevens ophalen
	$sql = mysql_query("SELECT aantal FROM reserveringen WHERE voorstellingsnr = $voorstellingsnr");
	while($reservering = mysql_fetch_array($sql)) {
		if(isset($reservering['aantal'])){
			$aantal += $reservering['aantal'];
		} else {
			$aantal = 0;
		}
	}
	
	
    // Gegevens in tabel zetten
    echo "<tr onclick='window.location.replace(\"voorstelling.php?voorstelling=$voorstellingsnr\")'>";
    echo "<td>$titel</td>";
    echo "<td>$datum</td>";
    echo "<td>$tijd</td>";
    echo "<td>$genre</td>";
	echo "<td>$aantal</td>";
	
    echo "</tr>";
} 
echo "</table>";
echo "</div>";  

?>




  </div>
</body>

</html>