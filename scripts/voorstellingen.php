<?php
// Voorstellingen uit de database halen, $gekozen_voorstelling en de databse connectie komen van de pagina waar het script gebruikt wordt.

    $voorstellingen = mysql_query("SELECT * 
    FROM voorstellingen 
    WHERE voorstellingsnr = '$gekozen_voorstelling'");
    
    while($voorstelling = mysql_fetch_array($voorstellingen)) { 
        $voorstellingsnr = $voorstelling['voorstellingsnr'];
        // preg_replace('/[\x00-\x1F\x80-\xFF]/', '') om ongeldige utf-8 tekens te verwijderen
        $datum = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$voorstelling['datum']); 
        $tijd = $voorstelling['tijd']; 
        // preg_replace('/[\x00-\x1F\x80-\xFF]/', '') om ongeldige utf-8 tekens te verwijderen
        $titel = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$voorstelling['titel']); 
        $genre = $voorstelling['genre']; 
        $prijs = $voorstelling['prijs'];
        $zaal = $voorstelling['zaal'];
    }
?>