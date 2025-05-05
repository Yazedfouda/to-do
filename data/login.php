<?php 
session_start();
include("db.php");
if(isset($_SERVER['REQUEST_METHOD']) == "POST"){
    $email= trim($_POST['email']);
    $pass= $_POST['password'];
    if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
        $_SESSION['faild']="البريد غير صالح";
        header("location: ../layout/authentication-register.php");
        exit();
    }
    try{
        $stmt= $con->prepare("SELECT name, id , password FROM user WHERE email = :email");
        $stmt->bindParam(":email" , $email ,PDO::PARAM_STR);
        $stmt->execute();
        $user=$stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($pass , $user['password'])){
            $_SESSION['id']=$user['id'];
            $_SESSION['message']=' تم تسجيل الدخول بنجاح';
            $_SESSION['name'] = $user['name'];
            header("location: ../layout/index.php");
        }else{
            $_SESSION['faild']="كلمه المرور او البريد الالكتروني غير صحيح";
            header("location: ../layout/authentication-login.php");
        }
        
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}