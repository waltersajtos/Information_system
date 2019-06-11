<?php
include('../scripts/database.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Bezoekers per zaal</title>

  <style>
        * {
            margin: 0;
            overflow-x: hidden;
        }

        .content {
            margin: 1%;
        }

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

        /* End nav */

        table {
            border-collapse: collapse;
            margin: 2% auto 2% auto;
            width: 100%;
            font-size: 1.3rem;
            table-layout: auto;
        }

        table,
        td,
        tr {
            border: 1px solid black;
        }

        th {
            height: 50px;
            border-right: 1px solid black;
            background-color: #990000;
            color: white;
            text-align: center;
            padding: 5px 0 0 5px;
        }

        td {
            padding: 5px 0 0 5px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #999999;
        }

        .datum {
            background-color: #990000;
            colspan: 3;
            color: white;
            font-weight: bold;
        }

    </style>

</head>

<body>
  <header>
    <ul>
      <li><a href="admin_dashboard.php" class="current">Admin Dashboard</a></li>
      <li><a href="../admin.php">Log uit</a></li>
    </ul>
  </header>
    <div class="content">

    <h1>Hallo admin, dit zijn de aantal bezoekers per zaal.</h1>
  
    <form action="bezoekers_zaal.php" method="GET">
    <select name='datum'>
    <?php
    $datums = mysql_query("SELECT DISTINCT datum FROM voorstellingen");
    while($datum = mysql_fetch_assoc($datums)) {
        $dag = $datum['datum'];
        echo "<option value='$dag'>$dag</option>";
    }
    ?>
    </select>
    <button value="submit">Filteren</button>
</form>
<button onclick='window.location.replace("bezoekers_zaal.php")'>Filter verwijderen</button>
    <?php 

// Tabel maken met alle zalen op die dag
echo "<div style=\"overflow-x:auto;\">";
echo "<table>";
echo "<tr>";
echo "<th>Datum</th>";
echo "<th>Zaal</th>";
echo "<th>Plaatsen in zaal</th>";
echo "<th>Bezette plaatsen</th>";
echo "<th>Vrije plaatsen</th>";
echo "</tr>";
// Alle datums waarop voorstellingen zijn uit de database halen
if(isset($_GET['datum'])) {
    $datum = $_GET['datum'];
    $datums = mysql_query("SELECT DISTINCT datum FROM voorstellingen WHERE datum = '$datum'");
} else {
    $datums = mysql_query("SELECT DISTINCT datum FROM voorstellingen");
}

// Voor elke datum het aantal bezoekers in de zaal bepalen
while($datum = mysql_fetch_assoc($datums)) {
    $data = $datum['datum'];

    $zalen = mysql_query("SELECT 
    
    (SELECT naam 
    FROM   zalen 
    WHERE  zalen.zaalnr = reserveringen.zaalnr) AS zaalnaam, 
    
    (SELECT plaatsen 
    FROM   zalen 
    WHERE  zalen.zaalnr = reserveringen.zaalnr) AS aantal_plaatsen, 
    
    Sum(aantal) AS aantal, voorstellingsnr
    FROM   reserveringen

    WHERE voorstellingsnr LIKE (
        
        SELECT voorstellingsnr FROM voorstellingen  WHERE datum = '$data' AND zaal = (
            SELECT naam FROM zalen WHERE zalen.zaalnr = reserveringen.zaalnr)
            )

    GROUP  BY zaalnr");
    

    // De gegevens in een overzichtelijke tabel zetten
    while($zaal = mysql_fetch_assoc($zalen)) { 
        // Voor elke rij uit de database een tabelrij maken
        $zaalnaam = $zaal['zaalnaam'];
        $aantal_plaatsen = $zaal['aantal_plaatsen']; 
        $bezette_plaatsen = $zaal['aantal']; 
        $vrije_plaatsen = $aantal_plaatsen - $bezette_plaatsen;
    
        echo "<tr>";
        echo "<td>$data</td>";
        echo "<td>$zaalnaam</td>";
        echo "<td>$aantal_plaatsen</td>";
        echo "<td>$bezette_plaatsen</td>";
        echo "<td>$vrije_plaatsen</td>";
        echo "</tr>";

    } 
}

echo "</table>";
echo "</div>";
    

    ?>

  </div>
</body>

</html>