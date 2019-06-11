<html>
<head>
<title>Voorstellingen naar MySQL overzetten</title>
</head>

<body>
<h2>Voorstellingen overzetten naar MySQL</h2>

<?php
// initialisatie
$bestandsnaam = "klanten_data.csv";
$aantal_velden = 10; // aantal velden per voorstelling

// MySQL initialiseren
$server = "localhost"; // naam van de MySQL-databaseserver
$user = "root";	// inlognaam
$wachtwoord = "usbw";	//wachtwoord voor dit account
$database = "schouwburg"; // naam van de database die we gebruiken
$query = "";
$db = mysql_connect($server, $user, $wachtwoord); // verbinding maken
mysql_select_db($database); // database selecteren

// stel een SQL-query op met de gegevens uit het formulier
//$query = "INSERT proefwerken (ll_id, voornaam, achternaam, email, cijfer) "; 
//$query = "INSERT INTO `test1`.`voorstelling` (`datum`, `tijd`, `titel`, `genre`, 
//`zaal`, `prijs`) VALUES $veld[0],$veld[1],$veld[2],$veld[3],$veld[4]";
// file openen voor lezen, eerst testen of file wel bestaat
if (file_exists($bestandsnaam)){
	$fp = fopen ($bestandsnaam, "r"); // ja, bestand openen
	echo "<h2>De klanten file bestaat!</h2>" ;	
}
else{
	echo "<h2>De file bestaat niet!</h2>" ;
	exit;
}
while (!feof($fp)){ // lezen tot einde van de file
$veld = fgetcsv($fp, 1000,","); //de voorstellingen komen in het array uitslag
	for ($i=0;$i<=$aantal_velden-1;$i++){
	
		echo "$veld[$i] ;" ;	
	}	
	echo "<br>";	
	$query = "INSERT INTO `schouwburg`.`bezoekers` (`geslacht`, `voornaam`, `achternaam`, `straatnaam`, 
	`huisnummer`, `postcode`, `plaats`, `telefoonnummer`, `email`, `rekeningnummer`) VALUES ('$veld[0]','$veld[1]','$veld[2]','$veld[3]',$veld[4],'$veld[5]','$veld[6]','$veld[7]','$veld[8]','$veld[9]')";
		if (!mysql_query($query)){ // probeer de query uit te voeren
		// er is een fout opgetreden
		echo $query;
		echo "Er is een fout opgetreden met foutnummer " . mysql_errno() . " : " .  mysql_error();
		// eventueel: met header("location:...") doorsturen naar gedetailleerde foutbericht-pagina.
		mysql_close($db); // database afsluiten
		exit;
	}
	else{
		// invoegen is geslaagd,
		// geef het id van de zojuist ingevoegde gegevens mee als querystring
		//$id = "?id=" . mysql_insert_id($db);
		
		echo "Klant is toegevoegd: ";
	}
}
mysql_close($db); // database afsluiten

?>
</body>
</html>

