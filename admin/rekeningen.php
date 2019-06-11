<?php
include('../scripts/database.php');

$voorstellingsnr = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Rekeningen</title>

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
      <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
      <li><a href="admin_dashboard.php" class="current">Rekeningen</a></li>
      <li><a href="../admin.php">Log uit</a></li>
    </ul>
  </header>
    <div class="content">

    <h1>Hallo admin, dit zijn de rekeneningen van alle klanten:</h1>
  <?php 
  // Aantal reserveringen per klant opvragen en opslaan
  $rekeningen = mysql_query("SELECT bezoekersnr, voorstellingsnr,
Sum(aantal) AS aantal
FROM reserveringen GROUP BY bezoekersnr");

// Overzichtelijke tabel maken
  echo "
  <table>
    <tr>
        <th>Bezoekersnummer</th>
        <th>voornaam</th>
        <th>Achternaam</th>
        <th>Rekeningnummer</th>
        <th>Aantal reserveringen</th>
        <th>Bedrag</th>
    </tr>";

	// Te betalen bedrag uitrekenen per bezoekersnr
  while($rekening = mysql_fetch_array($rekeningen)) {
      $totaal_prijs = 0;
      $bezoekersnr = $rekening['bezoekersnr'];
      $aantal = $rekening['aantal'];
      $voorstellingsnr = $rekening['voorstellingsnr'];

      // Prijs ophalen voor elke voorstelling
      $prijzen = mysql_query("SELECT prijs from voorstellingen WHERE voorstellingsnr = $voorstellingsnr");

      // Elke prijs optellen bij het totaal bedrag
      while($prijs = mysql_fetch_array($prijzen)) {
        $prijs = $prijs['prijs'];
      

        $totaal_prijs = $aantal * $prijs;
    }
    // Als er een reservering is gedaan door de klant de gegevens toevoegen aan de tabel, anders doorgaan naar de volgende klant
    if($aantal != 0) {
        $q = mysql_query("SELECT achternaam, 
       voornaam, 
       rekeningnummer 
        FROM   bezoekers
        WHERE  bezoekersnr = '$bezoekersnr'");

	  // Klantgegevens zoeken bij bezoekersnr
      $result = mysql_fetch_assoc($q);
      $achternaam = $result['achternaam'];
      $voornaam = $result['voornaam'];
      $rekeningnummer = $result['rekeningnummer'];
      echo "
      <tr onclick='window.location.replace(\"klant.php?klantnummer=$bezoekersnr&vorige=rekeningen\")'>
      <td>$bezoekersnr</td>
      <td>$voornaam</td>
      <td>$achternaam</td>
      <td>$rekeningnummer</td>
      <td>$aantal</td>
      <td>$totaal_prijs</td>
      </tr>
      ";
    }
      
  }
  echo "</table>";
  ?>
  </div>
</body>

</html>