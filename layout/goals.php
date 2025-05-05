<?php 
session_start();
include("../func/func.php");
$title="My Goals";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../images/task-high.png" />
    <link rel="stylesheet" href="../css/all.css" >
    <link rel="stylesheet" href="../css/ya.css" >
    <title><?php echo gettitle($title)?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .goals-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 65px;
        }
        .goal-card {
            background: linear-gradient(135deg, #ffffff, #e8ecef);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 280px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .goal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .goal-card h5 {
            color: #2c3e50;
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .goal-card p {
            color: #7f8c8d;
            font-size: 1em;
            min-height: 60px;
            margin-bottom: 15px;
        }
        .goal-card a {
            display: inline-block;
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .goal-card a:hover {
            background-color: #219653;
        }
        .error-message {
            text-align: center;
            color: #e74c3c;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php 
    include("head.php");
    ?>
    <?php if (!$_SESSION['id']) { ?>
        <h4 style="margin-left:40%;margin-top:10%">Please login</h4>
        <?php die(); ?>
    <?php } ?>
    <div class="container">
        <div class="goals-grid">
            <?php 
            include("../data/db.php");
            try {
                $user_id = $_SESSION['id'];
                $stmt = $con->prepare("SELECT goals, id FROM goals WHERE id_user = :id");
                $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $user_goals = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $months = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];

                foreach ($months as $index => $month) {
                    $goal_text = "No goals set yet.";
                    foreach ($user_goals as $goal) {
                        if ($index + 1 == $goal['id']) {
                            $goal_text = $goal['goals'];
                            break;
                        }
                    }
            ?>
                <div class="goal-card">
                    <h5><?php echo $month; ?></h5>
                    <p><?php echo htmlspecialchars($goal_text);?></p>
                    <a href="../data/add_goal.php ?month=<?php echo $index + 1; ?>">Add Goals</a>
                </div>
            <?php 
                }
            } catch (PDOException $e) {
                echo '<div class="error-message">Failed: ' . $e->getMessage() . '</div>';
            }
            ?>
        </div>
    </div>
    <script src="assets/js/agend.js"></script>
</body>
</html>