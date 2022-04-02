<?php
$host="localhost";
$dbname="webappbaza";
$user="root";
$password="";
try{
$pdo=new PDO("mysql:host=".$host.";dbname=".$dbname,$user,$password);
//  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,;
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Postoji greska ".$e->getMessage();

}

?>