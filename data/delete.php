<?php 
session_start();
include("db.php");

if(isset($_SERVER['REQUEST_METHOD']) == "POST"){

    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo "error: missing id";
        exit;
    }

$id=$_POST['id'];
    try{

        $stmt=$con->prepare("DELETE FROM task WHERE id= :id");
        $stmt->bindParam(":id" , $id , PDO::PARAM_INT);

        if($stmt->execute()){
            header("location: ../layout/task.php");
        }
    }
    catch(PDOException $e){
     echo "Faild" . $e->getMessage();
    }
}