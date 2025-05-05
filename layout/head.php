<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css" >
  <link rel="shortcut icon" type="image/png" href="../images/task-high.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if (isset($_SESSION['message'])){?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center; font-size:16px;" >
                    <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']); // حذف الرسالة بعد العرض
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }; ?>
            
            <?php 
      if(isset($_SESSION['faild'])){
      ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                    <?php 
                    echo $_SESSION['faild'];
                    unset($_SESSION['faild']); // حذف الرسالة بعد العرض
                    
                    ?>
                </div>
      <?php }?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
  data-sidebar-position="fixed" data-header-position="fixed" style="height: auto;">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="index.php" class="text-nowrap logo-img">
            <img src="../images/task-high-resolution-logo.png" alt=""  style="width: 100px;"/>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php" aria-expanded="false">
                <span>
                <i class="fa-solid fa-house"></i>
                </span>
                <span class="hide-menu">Me</span>
              </a>
            </li>
            <li class="nav-small-cap" style="margin-top: -8px;">
              <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
              <span class="hide-menu" >__________</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="task.php" aria-expanded="false">
                <span>
                <i class="fa-solid fa-clipboard" style="font-size: 20px;"></i>
                </span>
                <span class="hide-menu">Tasks</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="goals.php" aria-expanded="false">
                <span>
                <i class="fa-solid fa-calendar" style="font-size: 20px;"></i>
                </span>
                <span class="hide-menu">My Goals</span>
              </a>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6"></iconify-icon>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="authentication-login.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="authentication-register.php" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li>

          <div class="unlimited-access hide-menu bg-primary-subtle position-relative mb-7 mt-7 rounded-3" style="display: none;"> 
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
              </div>
            </div>
          </div>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
        <?php if(!isset($_SESSION['name'])){?>
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light" >
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing" style="float: left;"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="#" target="_blank"
                class="btn btn-primary me-2"><span class="d-none d-md-block">Check Pro Version</span> <span class="d-block d-md-none">Pro</span></a>
              <a href="#" target="_blank"
                class="btn btn-success"><span class="d-none d-md-block">Download Free </span> <span class="d-block d-md-none">Free</span></a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="authentication-login.php" class="d-flex align-items-center gap-2 dropdown-item" >
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                      <p class="mb-0 fs-3">login</p>
                    </a>
                    <a href="authentication-register.php" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="fa-solid fa-user-plus"></i>
                      <p class="mb-0 fs-3">Sign up</p>
                    </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
        <?php } else{?>
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <a href="#" target="_blank"
                class="btn btn-primary me-2"><span class="d-none d-md-block">Check Pro Version</span> <span class="d-block d-md-none">Pro</span></a>
              <a href="#" target="_blank"
                class="btn btn-success"><span class="d-none d-md-block">Download Free </span> <span class="d-block d-md-none">Free</span></a>

                <h5 style="margin-left: 5px;margin-top:10px"><?php echo $_SESSION['name']?></h5>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="task.php" class="d-flex align-items-center gap-2 dropdown-item" >
                    <i class="fa-solid fa-list-check"></i>
                      <p class="mb-0 fs-3">Task</p>
                    </a>
                    <a href="../data/logout.php" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                      <p class="mb-0 fs-3">Logout</p>
                    </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
        <?php }?>
      <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
      <script>
        // إخفاء التنبيهات بعد 3 ثوانٍ
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.classList.add('fade');
                alert.classList.remove('show');
                alert.remove();
            });
        }, 3000);
</script>
</body>
</html>