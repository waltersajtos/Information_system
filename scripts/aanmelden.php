<?php
// Database importeren
include("database.php");

// Klantgegevens uit formulier opslaan
$geslacht = $_GET["geslacht"];
$voornaam = $_GET["voornaam"];
if(!empty($_GET["tussenvoegsel"])) {
    $tussenvoegsel = $_GET["tussenvoegsel"];
  } else {
    $tussenvoegsel = NULL;
  }
  
$achternaam = $_GET["achternaam"];
$straatnaam = $_GET["straatnaam"];
$huisnummer = $_GET["huisnummer"];
$postcode = $_GET["postcode"];
$plaats = $_GET["plaats"];
$telefoonnummer = $_GET["telefoonnummer"];
$email = $_GET["email"];
$rekeningnummer = $_GET["rekeningnummer"];
$klantnummer = mysql_num_rows(mysql_query("SELECT * FROM bezoekers")) + 1;


// Controleren of de klant al bestaat
$check_if_exist = "SELECT COUNT(*) AS total 
FROM bezoekers 
WHERE geslacht = '$geslacht' AND voornaam = '$voornaam' 
AND tussenvoegsel = '$tussenvoegsel' AND achternaam = '$achternaam' 
AND straatnaam = '$straatnaam' AND huisnummer = '$huisnummer' 
AND postcode = '$postcode' AND plaats = '$plaats'";

// Aantal rijen uit de database halen die de gegevens bevatten
$result = mysql_query($check_if_exist) or die(mysql_error());
$row = mysql_fetch_assoc($result);

// $total is gelijk aan het aantal rijen met de klantgevens. Als $total gelijk is aan 0 bestaat de klant nog niet
$total = intval($row["total"]);

// Query om nieuwe klant toe te voegen aan database
$sql = "INSERT INTO bezoekers 
( 
  geslacht, 
  voornaam, 
  tussenvoegsel, 
  achternaam, 
  straatnaam, 
  huisnummer, 
  postcode, 
  plaats, 
  telefoonnummer, 
  email, 
  rekeningnummer 
) 
VALUES 
( 
  '$geslacht', 
  '$voornaam', 
  '$tussenvoegsel', 
  '$achternaam', 
  '$straatnaam', 
  '$huisnummer', 
  '$postcode', 
  '$plaats', 
  '$telefoonnummer', 
  '$email', 
  '$rekeningnummer'
)";


// Als de klant nog niet bestaat nieuwe klant aanmaken
if($total === 0) {
  if(mysql_query($sql) === TRUE) {
    // Als de query is geslaagd doorsturen naar de voorstellingen pagina en klantnummer meesturen
    echo "<script>window.location.replace('../voorstellingen.php?klantnummer=$klantnummer')</script>";
  } else {
    mysql_error();
  }
} else {
    // De klant bestaat al, klantnummer opzoeken
    $q = mysql_query("SELECT bezoekersnr AS id 
    FROM   bezoekers 
    WHERE  geslacht = '$geslacht' 
       AND voornaam = '$voornaam' 
       AND tussenvoegsel = '$tussenvoegsel' 
       AND achternaam = '$achternaam' 
       AND straatnaam = '$straatnaam' 
       AND huisnummer = '$huisnummer' 
       AND postcode = '$postcode' 
       AND plaats = '$plaats' ");

    $result = mysql_fetch_assoc($q);
    $klantnummer = $result["id"];
    // Klant doorsturen naar de voorstellingen pagina en klantnummer meesturen
    echo "<script>window.location.replace('../voorstellingen.php?klantnummer=$klantnummer')</script>";
}
?>