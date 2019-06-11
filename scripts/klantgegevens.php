<?php
// Klantnummer uit url halen
$klantnummer = $_GET["klantnummer"];
// Achternaam bepalen welke bij het klantnummer hoort
$q = mysql_query("SELECT achternaam AS achternaam 
FROM   bezoekers 
WHERE  bezoekersnr = '$klantnummer' ");
$result = mysql_fetch_assoc($q);
$achternaam = $result["achternaam"];

// Geslacht bepalen welke bij het klantnummer hoort
$q = mysql_query("SELECT geslacht AS geslacht 
FROM bezoekers 
WHERE bezoekersnr = '$klantnummer'");
$result = mysql_fetch_assoc($q);
$geslacht = $result["geslacht"];

// Aanhef bepalen aan de hand van geslacht
if ($geslacht == "man")
{
    $aanhef = "Meneer ";
}
else
{
    $aanhef = "Mevrouw ";
}
?>