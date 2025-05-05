<?php 
session_start();
include("db.php");
if($_SERVER['REQUEST_METHOD']== "POST"){
    $name= htmlspecialchars($_POST['name']);
    $email= htmlspecialchars($_POST['email']);
    $password= trim($_POST['password']);
    
    if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
        $_SESSION['faild']= "البريد الالكتروني غير صالح";
        header("location: ../layout/authentication-register.php");
        exit();
        
    }
    if(strlen($password) < 6){
        $_SESSION['faild']="كلمه المرور يجب انت تكون اكثر من 6 احرف";
        header("location: ../layout/authentication-register.php");
        exit();

    }
    if(empty($name) || empty($email) || empty($password)){
        $_SESSION['faild']="يجب ملئ كل الحقول";
        header("location: ../layout/authentication-register.php");
        exit();

    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $_SESSION['faild'] = "الاسم يجب أن يحتوي على أحرف فقط";
        header("Location: ../layout/authentication-register.php");
        exit();
    }
    $pass=password_hash($_POST['password'] , PASSWORD_DEFAULT);

    try{

                // التحقق من وجود البريد الإلكتروني مسبقًا
                $stmt = $con->prepare("SELECT id FROM user WHERE email = :email");
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->fetch()) {
                    $_SESSION['error'] = "البريد الإلكتروني مسجل مسبقًا";
                    header("Location: ../layout/authentication-register.php");
                    exit();
                }
                // مستخدم جديد
    $stmt= $con->prepare("INSERT INTO user ( name, email, password) VALUES (:name , :email ,:pass)");
    
        $stmt->bindParam(':name' , $name , PDO::PARAM_STR);
        $stmt->bindParam(':email' , $email , PDO::PARAM_STR);
        $stmt->bindParam(':pass' , $pass , PDO::PARAM_STR);
        
        if($stmt->execute()){
            $_SESSION['message']="Sign up sucsses";
            header("location: ../layout/authentication-login.php");
        }else{
            $_SESSION['faild']="ERROR";
            header("location: ../layout/authentication-register.php");
        }
    }catch(PDOException $e){
        echo "faild" . $e->getMessage();
    }
}