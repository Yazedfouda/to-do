<?php 
session_start();
include("../func/func.php");
include("db.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$month = isset($_GET['month']) ? (int)$_GET['month'] : 0;

if ($month < 1 || $month > 12) {
    echo "<h4 style='text-align:center;color:#e74c3c;'>Invalid month selected.</h4>";
    exit();
}

$month_name = date("F", mktime(0, 0, 0, $month, 1));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $goal = trim($_POST['goal']);
    
    if (!empty($goal)) {
        try {
            $stmt = $con->prepare("INSERT INTO goals (id_user, id, goals) VALUES (:id_user, :month, :goals) 
                                   ON DUPLICATE KEY UPDATE goals = :goals");
            $stmt->bindParam(":id_user", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":month", $month, PDO::PARAM_INT);
            $stmt->bindParam(":goals", $goal, PDO::PARAM_STR);
            $stmt->execute();
            
            header("Location: ../layout/goals.php?success=Goal+added+successfully");
            exit();
        } catch (PDOException $e) {
            $error = "Failed to save goal: " . $e->getMessage();
        }
    } else {
        $error = "Please enter a goal.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../images/task-high.png" />
    <link rel="stylesheet" href="../css/all.css" >
    <link rel="stylesheet" href="../css/ya.css" >
    <title>Add Goal for <?php echo $month_name; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
        }
        .goal-form-card {
            background: linear-gradient(135deg, #ffffff, #e8ecef);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }
        .goal-form-card h5 {
            color: #2c3e50;
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .goal-form-card textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            resize: none;
            margin-bottom: 20px;
        }
        .goal-form-card button {
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .goal-form-card button:hover {
            background-color: #219653;
        }
        .error-message, .success-message {
            text-align: center;
            font-size: 1em;
            margin-bottom: 20px;
        }
        .error-message {
            color: #e74c3c;
        }
        .success-message {
            color: #27ae60;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="goal-form-card">
            <h5>Add Goal for <?php echo $month_name; ?></h5>
            <?php if (isset($error)) { ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="success-message"><?php echo htmlspecialchars($_GET['success']); ?></div>
            <?php } ?>
            <form method="POST" action="">
                <textarea name="goal" placeholder="Enter your goal for this month..." required></textarea>
                <button type="submit">Save Goal</button>
            </form>
            <a href="../layout/goals.php" class="back-link">Back to Goals</a>
        </div>
    </div>
</body>
</html>