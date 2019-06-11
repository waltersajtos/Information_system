<?php 
    include('../scripts/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Klantenbestand</title>

  <style>
      * {
        margin: 0;
        padding: 0;
      }
    
      /* Start form */
    
      h1 {
        margin-bottom: 20px;
      }
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
    
      /* End form */
      /* Start nav */
    
      header header {
        margin-bottom: 20px;
        width: auto;
      }
    
      header ul {
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
    
      header li {
        float: left;
        font-size: 150%;
        padding-bottom: 3px;
      }
    
      header li a {
        display: inline-block;
        color: #cfbd8b;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }
    
      header li a:hover {
        background-color: #cfbd8b;
        color: #990000;
        text-decoration: underline;
      }
    
      .current {
        text-decoration: underline;
        font-weight: bold;
      }
    
      /* End nav */

      /* Aside */
      aside {
          font-size: 1.5rem;
          margin: 2%;
      }
      aside li {
          margin-bottom: 1%;
      }

      .content {
          margin: 3%;
      }
    </style>

</head>

<body>
  <header>
    <ul>
      <li><a href="admin_dashboard.php" >Admin Dashboard</a></li>
      <li><a href="#" class="current">Klantenbestand</a></li>
      <li><a href="admin.php">Log uit</a></li>
    </ul>
  </header>

  <div class="content">
    <h1>Hallo admin, dit zijn alle geregistreerde klanten:</h1>
    <h2>Klik op een klant voor meer informatie</h2>
	
<!-- Tabel maken met gegevens gebruiker -->

<?php
echo "<table>";
echo "<tr>";
echo "<th>Klantnr</th>";
echo "<th>Geslacht</th>";
echo "<th>Voornaam</th>";
echo "<th>Achternaam</th>";

echo "</tr>";

// Klant gegevens selecteren
$klanten = mysql_query("SELECT * 
FROM bezoekers 
ORDER BY bezoekersnr");

// Voor elke klant een table row maken
while($klant = mysql_fetch_array($klanten)) { 

    $bezoekersnr = $klant['bezoekersnr'];
    $geslacht = $klant['geslacht'];
    $voornaam = $klant['voornaam'];
    $achternaam = $klant['achternaam'];
    $straatnaam = $klant['straatnaam'];
    $huisnummer = $klant['huisnummer'];
    $postcode = $klant['postcode'];
    $plaats = $klant['plaats'];
    $telefoonnummer = $klant['telefoonnummer'];
    $email = $klant['email'];
    $rekeningnummer = $klant['rekeningnummer'];

    // Voor elke table row een link maken naar de detail pagina van de klant
    echo "<tr onclick='window.location.replace(\"klant.php?klantnummer=$bezoekersnr\")'>";
    echo "<td>$bezoekersnr</td>";
    echo "<td>$geslacht</td>";
    echo "<td>$voornaam</td>";
    echo "<td>$achternaam</td>";
    echo "</tr>";
} 
echo "</table>";
?>

  
  </div>
  
</body>

</html>