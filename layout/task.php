<?php session_start();
include("../func/func.php");
$title = "TASK";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/ya.css">
    <link rel="shortcut icon" type="image/png" href="../images/task-high.png"/>
    <title><?php echo gettitle($title); ?></title>
</head>
<body style="background-color: #f6f8fa;">
    <!-- add task -->
    <?php if (isset($_SESSION['task-add'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center; font-size:16px;">
            <?php 
            echo $_SESSION['task-add'];
            unset($_SESSION['task-add']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    
    <!-- header -->
    <?php include("head.php"); ?>
    <?php if (!$_SESSION['id']) { ?>
        <h4 style="margin-left:40%;margin-top:10%">Please login</h4>
        <?php die(); ?>
    <?php } ?>
    
    <div class="container">
        <button type="button" class="btn btn-success" style="margin-top: 110px; position: relative; margin-left:40%; width:200px"
            data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Create Task</button>

        <!-- card of task -->
        <div class="row">
            <?php 
            include("../data/db.php");
            try {
                $user_id = $_SESSION['id'];
                $stmt = $con->prepare("SELECT * FROM task WHERE id_user = :id");
                $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $user = $stmt->fetchAll();
                
                if ($stmt->rowCount() > 0) {
                    foreach ($user as $users) {
                        ?>
                        <div class="col-sm-4 mb-3 mb-sm-0" style="margin-top:20px">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown" style="float: right; font-size:20px">
                                        <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            ...
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button type="button" class="dropdown-item" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editModal" 
                                                        data-id="<?php echo $users['id']; ?>" 
                                                        data-title="<?php echo htmlspecialchars($users['name_task']); ?>" 
                                                        data-task="<?php echo htmlspecialchars($users['tasks']); ?>">
                                                    Edit <i class="fa-solid fa-pen"></i>
                                                </button>
                                            </li>
                                            <form method="post" action="../data/delete.php" onsubmit="return confirm('Are you sure you want to delete?')">
                                                <li><input type='hidden' name='id' value="<?php echo $users['id']; ?>"></li>
                                                <li><button class="dropdown-item" type="submit">Delete <i class="fa-solid fa-trash"></i></button></li>
                                            </form>
                                        </ul>
                                    </div>
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($users['name_task']); ?>
                                        <input type="checkbox" value="" style="width: 18px; float:right;">
                                    </h5>
                                    <p class="card-text"><?php echo htmlspecialchars($users['tasks']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php 
                    }
                } else {
                    echo "<div class='col-12'><p>لا توجد بيانات لعرضها</p></div>";
                }
            } catch (PDOException $e) {
                echo "Failed: " . $e->getMessage();
            }
            ?>
        </div>

        <!-- model create task -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../data/insert-task.php">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="recipient-name" style="margin-top:8px !important;" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">The Mission:</label>
                                <textarea class="form-control" id="message-text" style="height: 130px;" name="task"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" style="width: 150px;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- model edit task -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../data/update-task.php">
                            <input type="hidden" name="id" value="">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="recipient-name" style="margin-top:8px !important;" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">The Mission:</label>
                                <textarea class="form-control" id="message-text" style="height: 130px;" name="task"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" style="width: 150px;">Save Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var title = button.getAttribute('data-title');
            var task = button.getAttribute('data-task');

            var modalTitleInput = editModal.querySelector('input[name="title"]');
            var modalTaskInput = editModal.querySelector('textarea[name="task"]');
            var modalIdInput = editModal.querySelector('input[name="id"]');

            modalTitleInput.value = title;
            modalTaskInput.value = task;
            modalIdInput.value = id;
        });
    });
    </script>
</body>
</html>