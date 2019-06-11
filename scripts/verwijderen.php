<?php 
    // Database connectie importeren
    include("database.php");

    // Nodige gegevens importeren uit URL
    $reservering = $_GET['reservering'];
    $klantnummer = $_GET['klantnr'];

    // Query maken om de gekozen reservering te verwijderen
    $sql = "DELETE FROM reserveringen WHERE reserveringsnr = $reservering";

    if(mysql_query($sql) === TRUE) {
        // Als de voorstellingen is verwijderd klant terugsturen naar voorstellingen.php
        echo "<script>window.location.replace(\"../voorstellingen.php?klantnummer=$klantnummer\")</script>";
    } else {
        die(mysql_error());
    }
?>