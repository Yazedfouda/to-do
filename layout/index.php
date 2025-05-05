<?php session_start();
include("../func/func.php");
$title="TO-DO"
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo gettitle($title)?></title>
  <link rel="stylesheet" href="../css/all.css" >
  <link rel="stylesheet" href="../css/ya.css" >
  <link rel="shortcut icon" type="image/png" href="../images/task-high.png" />
  <!-- <link rel="stylesheet" href="assets/css/styles.min.css" /> -->
</head>

<body>
<?php include("head.php")?>
      <div class="container-fluid" style="height: 550px;">
<div class="head">
  <?php if(isset($_SESSION['name'])){?>
  <h4 style=""> Welcome <?php echo$_SESSION['name']?> </h4>
</div>
<?php }?>
<form action="search.php" method="GET" class="search-container">
    <input type="search" name="query" placeholder="Search tasks..." class="search-input" style="margin-top:60px;">
    <button type="submit" class="search-button" style="border:0">
        <i class="fas fa-search"></i>
    </button>
</form>

<div class="row" style="margin-top: 40px;">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">TASKS <i class="fa-solid fa-list-check" style="float: right;"></i></h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">My Agenda <i class="fa-solid fa-bullseye" style="float: right;"></i></h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>
  </div>
</body>

</html>