<?php
session_start();
include("../func/func.php");
$title="REGISTER"
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo gettitle($title);?></title>
    <link rel="shortcut icon" type="image/png" href="../images/task-high.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['faild'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
            <?php 
            echo $_SESSION['faild'];
            unset($_SESSION['faild']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="../images/task-high-resolution-logo.png" alt="" style="width: 110px;">
                                </a>

                                <form method="post" action="../data/sign_up.php">
                                    <div class="mb-3">
                                        <label for="exampleInputtext1" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="exampleInputtext1" name="name">
                                        <span class="text-danger" id="nameError"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                                        <span class="text-danger" id="emailError"></span>
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                                        <span class="text-danger" id="passwordError"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Sign Up</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="authentication-login.php">Sign In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
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

        // التحقق من النموذج قبل الإرسال
        document.querySelector('form').addEventListener('submit', function(event) {
            let name = document.getElementById('exampleInputtext1').value.trim();
            let email = document.getElementById('exampleInputEmail1').value.trim();
            let password = document.getElementById('exampleInputPassword1').value.trim();
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let isValid = true;

            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('passwordError').textContent = '';

            if (!name) {
                document.getElementById('nameError').textContent = 'الرجاء إدخال الاسم';
                isValid = false;
            }
            if (!email || !emailPattern.test(email)) {
                document.getElementById('emailError').textContent = 'الرجاء إدخال بريد إلكتروني صالح';
                isValid = false;
            }
            if (!password || password.length < 6) {
                document.getElementById('passwordError').textContent = 'كلمة المرور يجب أن تكون 6 أحرف على الأقل';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>

</html>