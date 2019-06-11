<?php
// Database connectie importeren
include ("../scripts/database.php");

// Gekozen klant importeren
$klantnr = $_GET['klantnummer'];

// Klantgegevens van de gekozen klant ophalen
$klanten = mysql_query("SELECT * 
FROM   bezoekers 
WHERE  bezoekersnr = '$klantnr' 
ORDER  BY bezoekersnr");

while ($klant = mysql_fetch_array($klanten))
{
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

  <title>Klant</title>

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
      <li><a href="#" class="current">Klant</a></li>
      <li><a href="admin.php">Log uit</a></li>
    </ul>
  </header>

  <div class="content">
      <!-- Controleren vanaf welke pagina de klantgegevens zijn opgevraagd, de voorstelling pagina of de klantenbestand pagina -->
      <a href=<?php 
      if(isset($_GET['vorige'])) {
        $vorige = $_GET['vorige'];
        if($vorige == 'voorstelling') {
          $voorstelling = $_GET['voorstelling'];
          echo 'voorstelling.php?voorstelling=' . $voorstelling;
        } elseif($vorige == 'rekeningen') {
          echo 'rekeningen.php';
      } 
    } else {
          echo 'klantenbestand.php';
        }
      ?> class="terug">< TERUG</a>

      <div class="voorstelling">
      <table>
        <?php echo "
        <tr><th>Klant:</th></tr>
        <tr>
            <td>Klantnummer:</td>
            <td>$bezoekersnr</td>
        </tr>
        <tr>
            <td>Geslacht:</td>
            <td>$geslacht</td>
        </tr>
        <tr>
            <td>Voornaam:</td>
            <td>$voornaam</td>
        </tr>
        <tr>
            <td>Achternaam:</td>
            <td>$achternaam</td>
        </tr>
        <tr>
            <td>Straatnaam:</td>
            <td>$straatnaam</td>
        </tr>
        <tr>
            <td>Huisnummer:</td>
            <td>$huisnummer</td>
        </tr>
        <tr>
            <td>Postcode:</td>
            <td>$postcode</td>
        </tr>
        <tr>
            <td>Woonplaats:</td>
            <td>$plaats</td>
        </tr>
        <tr>
            <td>Telefoonnummer:</td>
            <td>$telefoonnummer</td>
        </tr>
        <tr>
            <td>email:</td>
            <td>$email</td>
        </tr>
        <tr>
            <td>rekeningnummer:</td>
            <td>$rekeningnummer</td>
        </tr>
        ";
?>
    </table>
    </div>
    <!-- Mogelijkheid om de klant te muteren toevoegen -->
	<form action="scripts/klant_muteren.php" method="GET">
    <h1>Klant muteren:</h1>
    <p id="geslacht">
      <input type="radio" name="geslacht" value="man" required>Dhr.
      <input type="radio" name="geslacht" value="vrouw">Mevr.
    </p>

    <p>
      <label for="voornaam">Voornaam</label>
      <input type="text" name="voornaam" required>
    </p>

    <p>
      <label for="tussenvoegsel">Tussenvoegsel</label>
      <input type="text" name="tussenvoegsel">
    </p>

    <p>
      <label for="achternaam">Achternaam</label>
      <input type="text" name="achternaam" required>
    </p>

    <p>
      <label for="straatnaam">Straatnaam</label>
      <input type="text" name="straatnaam" required>
    </p>

    <p>
      <label for="huisnummer">Huisnummer</label>
      <input type="number" name="huisnummer" required>
    </p>

    <p>
      <label for="postcode">Postcode</label>
      <input type="text" name="postcode" required>
    </p>

    <p>
      <label for="plaats">Plaats</label>
      <input type="text" name="plaats" required>
    </p>

    <p>
      <label for="telefoonnummer">Telefoonnummer</label>
      <input type="tel" name="telefoonnummer" required>
    </p>

    <p>
      <label for="email">Email</label>
      <input type="email" name="email" required>
    </p>

    <p>
      <label for="Rekeningnummer">Rekeningnummer</label>
      <input type="text" name="rekeningnummer" required>
    </p>
	<!-- Bezoekersnummer meesturen en aangeven dat er een bewerking is gewest aangeven -->
	<input type="hidden" name="klantnr" value=<?php echo $bezoekersnr ?>>
	<input type="hidden" name="change" value="true">
	
    <button class="button" style="vertical-align:middle"><span>Muteren </span></button>
  </form>
    </div>
</body>

</html>
