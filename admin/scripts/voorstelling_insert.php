<?php 
    include('../../scripts/database.php');

    // Gegevens voor de nieuwe voorstelling uit de url halen
    $datum = $_GET['datum'];
    $tijd = $_GET['tijd'];
    $titel = $_GET['titel'];
    $genre = $_GET['genre'];
    $zaal = $_GET['zaal'];
    $prijs = $_GET['prijs'];
    // Voorstelling toevoegen aan de database
    $sql = "INSERT INTO voorstellingen (datum,tijd,titel,genre,zaal,prijs)
    VALUES('$datum','$tijd','$titel','$genre','$zaal','$prijs')
    ";

    // Als de voorstelling is toegevoegd een bevesteging geven
    if(mysql_query($sql) === TRUE) {
        echo "<script>window.location.replace('../voorstelling_toevoegen.php?succes=true')</script>";
    } else {
        // Anders een foutmelding geven
        die(mysql_error());
    }
?>