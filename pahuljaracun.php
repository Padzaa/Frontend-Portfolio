<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaš Racun</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="icon" href="logo.png" type="image/x-icon">
  <style>
    body {
      background-color: white;

    }

    [class*="col"] {
      padding: 1rem;

      color: black;

    }

    [class*="row"] {
      margin-left: 5%;
      margin-right: 5%;

    }

    hr {
      border-top: 1px solid black;

    }

    #impd {
      text-align: center;

    }

    img {
      width: 150px;

    }

    #lf {
      text-align: left;

    }

    th {
      border: 1px solid black;

    }

    table {
      width: 100%;
      height: 100px;

    }

    td {
      border: 1px solid black;

    }

    #mali {

      padding: 0px;
      margin-bottom: 0px;
    }

    #malitekst {

      font-size: 12px;
      font-style: bold;
    }

    #uplatnica {
      border: 1px solid black;
      margin-left: 15%;
      margin-right: 15%;
    }

    #ikonica {
      width: 25px;

    }

    #red {
      color: red;

    }

    .container-fluid {
      position: relative;
    }

    button[name="logout"] {
      position: absolute;
      top: 1em;
      right: 1em;
      z-index: 999;
    }
  </style>

</head>

<body>
  <?php
  require_once('konekcija.php');
  session_start();
  if (empty($_SESSION['Sifra'])) {
    header('location:login.php');
  }
  $imeiprezime = $_SESSION['Ime i Prezime'];
  $pdbroj = $_SESSION['PD'];
  $imezgrade = $_SESSION['Ime Zgrade'];
  $brojstana = $_SESSION['Broj stana'];
  $kvadratura = $_SESSION['Kvadratura Stana'];
  $cijenapokvadratu = $_SESSION['Cijena po kvadratu'];
  $mjesecniracun = $_SESSION['Mjesecni Racun'];
  $dug = $_SESSION['Dug'];
  $sql = "SELECT * FROM `zgrade` WHERE `zgrade`.`Ime Zgrade` = \"$imezgrade\";";
  $sttm = $pdo->prepare($sql);
  $sttm->execute();
  $zgrade = $sttm->fetchAll(PDO::FETCH_ASSOC);
  $_SESSION['Ziro Racun'] = $zgrade[0]['Ziro Racun'];
  $_SESSION['PIB'] = $zgrade[0]['PIB'];
  $ziroracun = $_SESSION['Ziro Racun'];
  $pib = $_SESSION['PIB'];
  ?>

  <?php
  if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
  }

  ?>
  <div class="container-fluid">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <button type="submit" class="btn btn-primary" name="logout">Odjavi se</button>
    </form>
    <div class="row">
      <div class="col-3"> <img src="logo.png"></div>
      <div class="col-9">

        <div class="row-9">
          <div class="col"></div>
          <div id="impd" class="col"><b>Agencija pahulja</span></div>
          <div class="col"><span>Stambena zgrada:<?php echo $imezgrade; ?> </span><span style="padding-left: 20%;">PIB: <?php echo $pib; ?></span></div>
        </div>

      </div>

    </div>

    <hr>
    <!--
      <div class="row">
        <div class="col-4">
          <div class="row"> 
          <div class="col">ahgfvajhfbawifb</div> 
        </div>
        <div class="row"> 
          <div class="col">1</div> 
        </div>
        <div class="row"> 
          <div class="col">1</div> 
        </div>
        
        </div>  
        
        <div class="col-4"></div>
        <div class="col-4"></div>          

      </div>

-->

    <div class="row">
      <div class="col-sm">
        <spline> Račun za mjesec: <?php echo date("m/Y"); ?></spline>
      </div>
      <div id=impd class="col-sm">
        <spline> PD: <?php echo $pdbroj; ?></spline>
      </div>

    </div>

    <div class="row">
      <div class="col-sm"></div>
      <div id=impd class="col-sm">
        <spline> Stan br: <?php echo $brojstana; ?></spline>
      </div>

    </div>
    <div class="row">
      <div class="col-sm">
        <spline> Datum izdavanja računa: <?php
                                          echo date("d/m/Y")
                                          ?></spline>
      </div>
      <div id=impd class="col-sm">
        <spline>Stambeni prostor</spline>
      </div>

    </div>

    <div class="row">
      <div class="col-sm">
        <table>
          <tr>
            <th>Redni broj</th>
            <th>Naziv</th>
            <th>Kvadratura</th>
            <th>Cijena</th>
            <th>Račun</th>
            <th>Stari dug</th>
            <th>Ukupan dug</th>
          </tr>
          <tr>
            <td>1</td>
            <td>Akontacija za održavanje</td>
            <td><?php echo $kvadratura . "m²"; ?></td>
            <td><?php echo $cijenapokvadratu . "€"; ?></td>
            <td><?php echo $mjesecniracun . "€"; ?></td>
            <td><?php echo $dug . "€"; ?></td>
            <td><?php echo $dug . "€"; ?></td>

          </tr>

        </table>

      </div>

    </div>

    <div class="row">
      <div id="mali" class="col">
        <span style="font-size:16px; ">Po članu 16 stav 2 Zakona o održavanjestambenih zgrada("Sl, Lista CG"br.041/16 i 084/18) </span><br>

        <span style="font-size:25px; margin:0px; text-decoration: none;">Uplatu izvršiti na račun stanara etažnih vlasnika: <?php echo $ziroracun; ?><br></span>
        <span style="font-size:20px; margin:0px;"><b>Rok plaćanja je do 25-og u mjesecu.</b> Ukoliko se uplate ne izvrše u naznačenom roku, Stambena zgrada će pokrenuti postupak prinudne naplate, na osnovu čega ćete biti u obavezi da pored dospjelog duga, platite I troškove postupka.<br></span>
        <span style="font-size:22px; margin:0px;"><b>Uplata se može izvršiti za više mjeseci unaprijed!</b> </span>

      </div>

    </div>

    <div id="uplatnica">
      <div class="row">
        <div id="impd" class="col-6">Nalog platioca</div>

      </div>

      <div class="row">
        <div style="text-align: center; border:1px solid black; margin:5px; padding:8px;" class="col"> <?php echo $imeiprezime;
                                                                                                        echo " PD:" . $pdbroj; ?></div>
        <div style="text-align: center; border:1px solid black; margin:5px; padding:8px;" class="col"> </div>

      </div>
      <div class="row">
        <div style="text-align: center; font-size:12px; margin-top:-1%; " class="col-6">(Naziv platioca) </div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col-6"> (Transakcioni racun platioca)</div>

      </div>

      <div class="row">
        <div style="text-align: center; border:1px solid black; padding:0px; margin:5px" class="col-5"> Dug za održavanje</div>
        <div style="text-align: center; border:1px solid black; margin:5px" class="col"> </div>
        <div style="text-align: center; border:1px solid black; margin:5px" class="col-5"> </div>

      </div>
      <div class="row">
        <div style="text-align: center; font-size:12px; margin-top:-1%; " class="col-5">(Svrha plaćanja) </div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col"> (Model)</div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col-5"> (Poziv na broj zaduženja)</div>

      </div>

      <div class="row">
        <div style="text-align: center; border:1px solid black; padding:3px; margin:5px" class="col-5"><?php echo $imezgrade; ?></div>
        <div style="text-align: center; border:1px solid black;  padding:3px;margin:5px" class="col-5">EUR</div>
        <div style="text-align: center; border:1px solid black;  padding:3px;margin:5px" class="col"> </div>

      </div>

      <div class="row">
        <div style="text-align: center; font-size:12px; margin-top:-1%; " class="col-5">(Naziv primaoca plaćanja)</div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col-5"></div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col"> (Šifra plaćanja)</div>

      </div>

      <div class="row">
        <div style="text-align: center; border-bottom:1px solid black; margin-left:5%; padding:8px;" class="col-4"><?php echo $imeiprezime;
                                                                                                                    echo " PD:" . $pdbroj; ?></div>

        <div style="text-align: center; border:1px solid black; margin-left:20%; padding:3px;" class="col-4"><?php echo $ziroracun; ?></div>

      </div>
      <div class="row">
        <div style="text-align: center; font-size:12px; margin-top:-1%; " class="col-6">(Pečat I potpis platioca kao inicijatora) </div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col-6"> (Transakcioni racun primaoca plaćanja)</div>

      </div>

      <div class="row">
        <div class="col-5"> </div>
        <div style="text-align: center; border:1px solid black; margin:5px ;padding:3px" class="col"> </div>
        <div style="text-align: center; border:1px solid black; margin:5px; padding:3px" class="col-5"> Poziv na broj odobrenja</div>

      </div>
      <div class="row">
        <div class="col-5"> </div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col"> (Model)</div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col-5"> (Poziv na broj zaduženja)</div>

      </div>

      <div class="row">
        <div class="col-5"> </div>
        <div style="text-align: center; border-bottom:1px solid black; margin:5px" class="col"> </div>
        <div style="text-align: center; border-bottom:1px solid black; margin:5px" class="col-5"> </div>

      </div>
      <div class="row">
        <div class="col-5"> </div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col"> (Potpis primaoca plaćanja)</div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col-5">(Datum izvršenja)</div>

      </div>

      <div class="row">

        <div class="col"> </div>
        <div style="border-bottom:1px solid black; margin-left:5% ;margin-right:5%" class="col"> </div>

      </div>
      <div class="row">

        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col"> </div>
        <div style="text-align: center; font-size:12px; margin-top:-1%;" class="col">(Datum izvršenja)</div>

      </div>

    </div>

    <div style="text-align: center; font-size:16px">
      <p><b>U slučaju reklamacije računa ili primjedbe možete dati putem mail-a:agencijapahulja@gmail.com ili na tel:068/070-090i tel:067/309-939 <br>
          <center>Priloženi račun važi bez pečata</center><br>
          <center>Agencija Pahulja <img id="ikonica" src="srce.svg"> </center>
        </b></p>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>