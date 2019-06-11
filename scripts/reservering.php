<?php 
// Database importeren
include('database.php');

// Gegevens uit de url halen
$klantnummer = $_GET['klantnummer'];
$aantal = $_GET['aantal'];
$gekozen_voorstelling = $_GET['voorstelling'];

// Als reserversnr is meegestuurd vanuit bevesteging.php om de reservering aan te passen dit nummer gebruiken anders nieuw reserververingsnummer bepalen d.m.v database.
if(isset($_GET['reserveringsnr'])) {
    $reserveringsnr = $_GET['reserveringsnr'];
} else {
    $reserveringsnr = mysql_num_rows(mysql_query("SELECT * FROM reserveringen")) + 1;
}

if(isset($_GET['change'])) {
    $change = $_GET['change'];
} else {
    $change = false;
}


// Voorstellingen importeren
include("voorstellingen.php");

// Datum en tijd van de reservering opslaan
$vandaag = getdate();
$r_datum = $vandaag['year'] . "-" . $vandaag['mon'] . "-" . $vandaag['mday'];
$r_tijd = $vandaag['hours'] . ":" . $vandaag['minutes'] . ":" . $vandaag['seconds'];
$r_timestamp = $vandaag['year'] . "-" . $vandaag['mon'] . "-" . $vandaag['mday'] . " om " .$vandaag['hours'] . ":" . $vandaag['minutes'] . ":" . $vandaag['seconds'];

$totaal_prijs = intval($prijs * $aantal);

// Zaalnamen uit de databse halen
$q = mysql_query("SELECT * 
FROM zalen 
WHERE naam = '$zaal'");

// Voor elke zaal het nummer, naam en aantal plaatsen bepalen
while($zaal = mysql_fetch_array($q)) {
    $zaalnr = $zaal['zaalnr'];
    $naam = $zaal['naam'];
    $plaatsen = $zaal['plaatsen'];
}
 
// Aantal gereserveerde plaatsen bepalen
$q = mysql_query("SELECT SUM(aantal) as aantal 
FROM reserveringen 
WHERE voorstellingsnr = '$voorstellingsnr'");

// Kijken of de query een resultaat geeft, als er geen reserveringen zijn voor de voorstelling zal het resultaat "false" zijn. Als dit zo is is het aantal bezette plaatsen dus gelijk aan 0.
if($q !== false) {
    while($reserveringen = mysql_fetch_array($q)) {
        $bezette_plaatsen = $reserveringen['aantal'];
    }
} else {
    $bezette_plaatsen = 0;
}

// Aantal vrije plaatsen bepalen
$vrijeplaatsen = $plaatsen - $bezette_plaatsen;

// Kijken of het aantal personen is aangepast vanuit bevesteging.php
if($change != true) {
    // Kijken of er genoeg plaatsen vrij zijn voor de klant, anders terugsturen naar reserveren.php
    if($vrijeplaatsen - $aantal >= 0) {
        $sql = "INSERT INTO reserveringen 
        
        (bezoekersnr, 
         datum, 
         tijd, 
         voorstellingsnr, 
         zaalnr, 
         aantal) 
VALUES     
        ('$klantnummer', 
        '$r_datum', 
        '$r_tijd', 
        '$voorstellingsnr', 
        '$zaalnr', 
        '$aantal'
)";

        if(mysql_query($sql) === TRUE) {
            // Bevestiging aanmaken en doorsturen naar klant
            echo "<script>window.location.replace('../bevestiging.php?klantnummer=$klantnummer&voorstellingsnr=$gekozen_voorstelling&datum=$datum&tijd=$tijd&timestamp=$r_timestamp&voorstelling=$titel&aantal=$aantal&zaal=$naam&prijs=$totaal_prijs&reserveringsnr=$reserveringsnr')</script>";
        } else {
            die(mysql_error());
        }
    } else {
        // Als er te weinig plaatsen over zijn gebruiker terugsturen en aantal vrije plaatsen meesturen
        echo "<script>window.location.replace('../reserveren.php?klantnummer=$klantnummer&voorstelling=$voorstellingsnr&plaatsen=$vrijeplaatsen')</script>";
    }
    // Als het aantal personen aan is gepast vanuit bevesteging.php:
} else {
    // Als er genoeg plaatsen vrij zijn de reservering toevoegen aan de database
    if($vrijeplaatsen - $aantal >= 0) {
    $sql = "UPDATE reserveringen
            SET aantal = '$aantal'
            WHERE reserveringsnr='$reserveringsnr'";
        if(mysql_query($sql) === TRUE) {
            // Bevestiging aanmaken en doorsturen naar klant
            echo "<script>window.location.replace('../reservering.php?klantnummer=$klantnummer&voorstellingsnr=$gekozen_voorstelling&datum=$datum&tijd=$tijd&timestamp=$r_timestamp&voorstelling=$titel&aantal=$aantal&zaal=$naam&prijs=$totaal_prijs&reservering=$reserveringsnr&change=true')</script>";
        } else {
            die(mysql_error());
        }
} else {
    // Als er te weinig plaatsen over zijn gebruiker terugsturen en aantal vrije plaatsen meesturen
    echo "<script>window.location.replace('../reserveren.php?klantnummer=$klantnummer&voorstelling=$voorstellingsnr&plaatsen=$vrijeplaatsen')</script>";
}
}
?>