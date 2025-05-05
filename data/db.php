<?php 
$db="mysql:host=localhost;dbname=tasks";
$user="root";
$pas="";
try{
    $con= new PDO($db, $user ,$pas);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){

    echo "faild ". $e->getMessage();
}
