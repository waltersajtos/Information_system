<?php
// Database gegevens
$hostname = "localhost";
$username = "root";
$password = "usbw";
$dbname = "schouwburg";

// Database connectie aanmaken
mysql_connect($hostname, $username, $password);
mysql_select_db($dbname) or die(mysql_error());

?>