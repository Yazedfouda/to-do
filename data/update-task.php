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
    $id = $_POST['id'];
    $id_user = $_SESSION['id'];

    try {
        $stmt = $con->prepare("UPDATE task SET name_task = :title, tasks = :task WHERE id = :id AND id_user = :user_id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT); 
        $stmt->bindParam(":title", $title, PDO::PARAM_STR); 
        $stmt->bindParam(":task", $task, PDO::PARAM_STR); 
        $stmt->bindParam(":user_id", $id_user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $_SESSION['task-add'] = "Task updated successfully";
                header("Location: ../layout/task.php");
                exit();
            } else {
                echo "Task not found or you don't have permission to update it.";
            }
        } else {
            echo "Failed to update task.";
        }
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage();
    }
}
?>