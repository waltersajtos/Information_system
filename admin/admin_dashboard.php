<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <title>Admin dashboard</title>

  <style>
      * {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
      }
    
      /* Start form */
    
      h1 {
        margin: 2%;
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
      input[type="password"] {
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
    
      header ul {
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
    
      header li {
        float: left;
        font-size: 150%;
        padding-bottom: 3px;
      }
    
      header li a {
        display: inline-block;
        color: #cfbd8b;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }
    
      header li a:hover {
        background-color: #cfbd8b;
        color: #990000;
        text-decoration: underline;
      }
    
      .current {
        text-decoration: underline;
        font-weight: bold;
      }
    
      /* End nav */

      aside {
        border: 2px solid black;
        width: 35%;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        font-size: 1.5rem;
        padding: 5%;
        margin: 2% auto;
      }

      aside ul li a {
        text-decoration: none;
        color: red;
        font-weight: bold;
        font-size: 2rem;
      }


    </style>

</head>

<body>
  <header>
    <ul>
      <li><a href="#" class="current">Admin dashboard</a></li>
      <li><a href="admin.php">Log uit</a></li>
    </ul>
  </header>
  
      <h1>Hallo admin, kies een van de volgende menu's om het informatie systeem te onderhouden</h1>

    <aside>
      <ul>
        <li><a href="klantenbestand.php">- Klantenbestand</a></li>
        <li><a href="bezoekers_voorstelling.php">- Bezoekers per voorstelling</a></li>
        <li><a href="bezoekers_zaal.php">- Bezoekers per zaal</a></li>
        <li><a href="rekeningen.php">- Rekeningen</a></li>
        <li><a href="voorstelling_toevoegen.php">- Voorstelling toevoegen</a></li>
      </ul>
    </aside>

</body>

</html>