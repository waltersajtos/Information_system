<?php 
  include('../scripts/database.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Voorstelling toevoegen</title>

  <style>
      * {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
      }
    
      /* Start form */
    
      h1 {
        margin-top: -25px;
        margin-bottom: 20px;
      }
    
      form {
        width: 50%;
        margin: 2% auto 2% auto;
        padding: 50px;
        border: 3px solid black;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
      }
    
      p {
        margin-bottom: 2.5%;
      }
    
      input[type="text"],
      input[type="email"],
      input[type="tel"],
      input[type="number"],
      input[type="password"],
      input[type="time"],
      select {
        width: 70%;
        float: right;
        border: 1px solid rgb(73, 70, 70);
        height: 30px;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        font-size: 1.5rem;
      }
    
      input[type="radio"] {
        margin-left: 2%;
        transform: scale(1.2);
      }
    
      label {
        width: 30%;
        font-size: 1.5rem;
      }
    
      p#geslacht {
        margin-left: 30%;
        font-size: 1.5rem;
        margin-bottom: 2%;
      }
    
      .button {
        display: inline-block;
        border-radius: 4px;
        background-color: #990000;
        border: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 1.5rem;
        padding: 15px;
        width: 200px;
        transition: all 0.5s;
        cursor: pointer;
      }
    
      .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
      }
    
      .button span:after {
        content: '\00bb';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
      }
    
      .button:hover span {
        padding-right: 25px;
      }
    
      .button:hover span:after {
        opacity: 1;
        right: 0;
      }
    
      /* End form */
      /* Start nav */
    
      header {
        margin-bottom: 20px;
        width: auto;
      }
    
      ul {
        width: 100%;
        height: 55px;
        border: 2px;
        border-color: #cfbd8b;
        top: 0;
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #990000;
        font-family: arial;
        font-weight: bold;
        padding-left: 75px;
      }
    
      li {
        float: left;
        font-size: 150%;
        padding-bottom: 3px;
      }
    
      li a {
        display: inline-block;
        color: #cfbd8b;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }
    
      li a:hover {
        background-color: #cfbd8b;
        color: #990000;
        text-decoration: underline;
      }
    
      .current {
        text-decoration: underline;
        font-weight: bold;
      }

      .succes {
        width: 50%;
        margin: 2% auto 2% auto;
        color: green;
        font-weight: bold;
      }
    
      /* End nav */
    </style>

</head>

<body>
  <header>
    <ul>
      <li><a href="admin_dashboard.php">Admin dashboard</a></li>
    </ul>
  </header>

  <form action="scripts/voorstelling_insert.php" method="GET">
    <p>
        <label for="datum">Datum:</label>
        <input type="text" name="datum" placeholder="vb. za 01"  required>
    </p>
    <p>
        <label for="tijd">Tijd:</label>
        <input type="text" name="tijd" placeholder="vb. 19:00:00" required>
    </p>
    <p>
        <label for="titel">Titel:</label>
        <input type="text" name="titel" required>
    </p>
    <p>
        <label for="genre">Genre:</label>   
        <select name="genre">
        <?php 
            // Voor elke zaal een <option> maken
            $sql = mysql_query("SELECT DISTINCT genre FROM voorstellingen ORDER BY genre");
            while($genre = mysql_fetch_array($sql)) {
              $genre = $genre['genre'];
              echo "<option value='$genre'>$genre</option>";
            }
          ?>
        </select>
    </p>
    <p>
        <label for="zaal">Zaal:</label>
        <select name="zaal" required>
          <?php 
            // Voor elke zaal een <option> maken
            $sql = mysql_query("SELECT naam FROM zalen");
            while($zaal = mysql_fetch_array($sql)) {
              $naam = $zaal['naam'];
              echo "<option value='$naam'>$naam</option>";
            }
          ?>
        </select>
    </p>
    <p>
        <label for="prijs">Prijs:</label>
        <input type="number" name="prijs" required>
    </p>
    <button class="button" style="vertical-align:middle"><span>toevoegen</span></button>
  </form>

  <?php
  // Als de voorstelling succesvol is toegevoegd een bevesteging geven.
if (isset($_GET['succes']))
{
    echo "<h2 class='succes'>Voorstelling succesvol toegevoegd</h2>";
}
else (die(mysql_error()));
?>
</body>

</html>
