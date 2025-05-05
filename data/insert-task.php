<?php 
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['id'])) {
    echo "Please login first.";
    exit();
}

include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $task = $_POST['task'];
    $user = $_SESSION['id'];

    try {
        // التحقق من وجود المستخدم
        $checkStmt = $con->prepare("SELECT id FROM user WHERE id = :id");
        $checkStmt->bindParam(":id", $user, PDO::PARAM_INT);
        $checkStmt->execute();
        if ($checkStmt->rowCount() == 0) {
            echo "User does not exist.";
            exit();
        }

        // إضافة المهمة
        $stmt = $con->prepare("INSERT INTO task (id_user, name_task, tasks) VALUES(:id, :title, :task)");
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":task", $task, PDO::PARAM_STR);
        $stmt->bindParam(":id", $user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['task-add']="Task added successfully";
            header("location: ../layout/task.php");
        }
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage();
    }
}
?>