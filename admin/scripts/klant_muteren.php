<?php 
include("../../scripts/database.php");

// Klantgegevens uit url halen
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
$klantnummer = $_GET['klantnr'];
	
// Query maken om de klant te updaten
	$sql = "UPDATE bezoekers 
	SET geslacht = '$geslacht', 
	voornaam = '$voornaam', 
	achternaam='$achternaam', 
	straatnaam = '$straatnaam', 
	huisnummer = '$huisnummer', 
	postcode = '$postcode', 
	plaats = '$plaats', 
	telefoonnummer = '$telefoonnummer', 
	email = '$email', 
	rekeningnummer = '$rekeningnummer'
	
	WHERE bezoekersnr = '$klantnummer'";
	
	// Als de klant is aangepast een bevestering sturen, anders een foutmelding geven
	if(mysql_query($sql) === TRUE) {
    // Als de query is geslaagd doorsturen naar de voorstellingen pagina en klantnummer meesturen
    echo "<script>window.location.replace('../klant.php?klantnummer=$klantnummer&succes=\'true\'')</script>";
  } else {
    die(mysql_error());
  }
  
  
?>