<?php 
    $gebruikersnaam = $_GET['gebruikersnaam'];
    $wachtwoord = $_GET['wachtwoord'];
	// Kijken of gebruikersnaam en wachtwoord klopt
    if($gebruikersnaam == "root" AND $wachtwoord == "toor") {
        echo "<script>window.location.replace('../admin_dashboard.php')</script>";
    } else {
        echo "<script>window.location.replace('../admin.php?id=wrong_password')</script>";
    }
?>