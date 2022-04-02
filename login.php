<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijavte se</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
body{
    background-color: gray;


}
form{
    border:1px solid white;
    border-radius:5%;
    background-color: purple;
 
    padding: 2%;
    margin-top: 0%;
}



.fade-in{
animation: fadeIn 2s;



}

@keyframes fadeIn{


from {
    opacity: 0;
}
to{
opacity: 1;

}
}







</style>


</head>
<body>
  <?php
  require_once('konekcija.php');
session_start();
$_SESSION['Sifra']=null;

if(isset($_POST['submit'])){
    $sifra=$_POST['sifra'];

    $sql = "SELECT * FROM `stanari` WHERE `stanari`.`Sifra` = \"$sifra\";";
    $sttm=$pdo->prepare($sql);
    $sttm->execute();
    $result=$sttm->fetchAll(PDO::FETCH_ASSOC);
  
    if(count($result)>0){
      $_SESSION['Ime i Prezime']=$result[0]['Ime i Prezime'];
      $_SESSION['PD']=$result[0]['PD'];
      $_SESSION['Ime Zgrade']=$result[0]['Ime Zgrade'];
      $_SESSION['Broj stana']=$result[0]['Broj stana'];
      $_SESSION['Kvadratura Stana']=$result[0]['Kvadratura Stana'];
      $_SESSION['Cijena po kvadratu']=number_format($result[0]['Cijena po kvadratu'],1);
      $_SESSION['Mjesecni Racun']=number_format($result[0]['Mjesecni Racun'],1);
      $_SESSION['Dug']=number_format($result[0]['Dug'],1);
      $_SESSION['Sifra']=$sifra;
      header('location:pahuljaracun.php');
    }else{
      $_SESSION['Sifra']=null;
        header('location:login.php');
    }
  }



?>
    <center>
    <p  class="fade-in" style="font-family: 'Brush Script MT', cursive; font-size:70px ;">Agencija Pahulja</p>
    <img class="fade-in" style="width:200px; margin:0%;" src="logo.png">
    </center>
    <div class="d-flex justify-content-center " >
        
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1" style="color:white"><b>Korisničko ime</b></label>
          <input style="border:2px solid black; margin: 0;" type="text" class="form-control" name="ime" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite korisničko ime">
        
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1" style="color:white"><b>Šifra</b></label>
          <input style="border:2px solid black" type="password" class="form-control" name="sifra" id="exampleInputPassword1" placeholder="Šifra">
        </div>
        <center>
        <button type="submit" class="btn btn-primary" name="submit" >Prijavi se</button>
        <center>
      </form>
   
    </div>
















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>