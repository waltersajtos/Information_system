<?php
include('../scripts/database.php');


$gekozen_voorstelling = $_GET['voorstelling'];

// Import database connectie
include('../scripts/voorstellingen.php');

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

        .terug {
          font-size: 2rem;
          text-decoration: none;
          font-weight: bold;
      }
    </style>

</head>

<body>
  <header>
    <ul>
      <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
      <li><a href="#" class="current">Bezoekers voorstelling</a></li>
      <li><a href="../admin.php">Log uit</a></li>
    </ul>
  </header>
    <div class="content">

    <h1>Hallo admin, dit zijn alle bezoekers van de voorstelling <?php echo "$titel op $datum" ?>.</h1>

    <a href="bezoekers_voorstelling.php" class="terug">< TERUG</a>

<?php

// Tabel aanmaken met de bezoeker gegevens
echo "<div style=\"overflow-x:auto;\">";
echo "<table>";
echo "<tr>";
echo "<th>Klantnummer</th>";
echo "<th>Voornaam</th>";
echo "<th>Achternaam</th>";
echo "<th>Plaats</th>";
echo "<th>Aantal plaatsen</th>";
echo "</tr>";

    $reserveringen = mysql_query("SELECT bezoekersnr, aantal 
    FROM reserveringen 
    WHERE voorstellingsnr = $gekozen_voorstelling 
    ORDER BY bezoekersnr");
    while($reservering = mysql_fetch_array($reserveringen)) {
        $klantnummer = $reservering['bezoekersnr'];
        $aantal = $reservering['aantal'];

        $sql = mysql_query("SELECT * FROM bezoekers WHERE bezoekersnr = $klantnummer");

        while($klant = mysql_fetch_array($sql)) {

            $voornaam = $klant['voornaam'];
            $achternaam = $klant['achternaam'];
            $plaats = $klant['plaats'];

            // Klantgegevens in tabel zetten en een link maken naar de klantpagina voor de bezoeker
            echo "<tr onclick='window.location.replace(\"klant.php?klantnummer=$klantnummer&voorstelling=$gekozen_voorstelling&vorige=voorstelling\")'>";
            echo "<td>$klantnummer</td>";
            echo "<td>$voornaam</td>";
            echo "<td>$achternaam</td>";
            echo "<td>$plaats</td>";
            echo "<td>$aantal</td>";
            
            echo "</tr>";

        }
        
    }
echo "</table>";
echo "</div>";  
?>

  </div>
</body>

</html>