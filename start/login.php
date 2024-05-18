<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Car rental System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/css/style.scss" rel="stylesheet">


</head>


<body>

<?php
require_once __DIR__ . '/../services/userService.php';
require_once __DIR__ . '/../services/authService.php';
$userService = new UserService();
$authService = new AuthService();


// Set the new timezone
date_default_timezone_set('Europe/Amsterdam');
$date = date('Y-m-d');

$_SESSION["date"] = $date;
$error = '';

?>

<center>
    <div class="container" style="margin: 20px;padding: 20px;">

        <h6 class="display-6"> Log In</h6>

        <div class="form-body form-outline mb-4 text-center">
            <form action="" method="POST">
                <div class=" d-flex justify-content-center form-outline mb-4">
                    <br><br>
                    <input type="email" name="email" class=" w-auto form-control form-control-lg form-control"
                           placeholder="Email Address"
                           required>
                </div>
                <div class=" d-flex justify-content-center form-outline mb-4">

                    <input type="Password" name="password"
                           class=" w-auto form-control form-control form-control-lg" placeholder="Password"
                           required></div>

                <label class="form-label" for="error">
                    <?php echo $error ?></label>
                <div class="d-flex justify-content-center">
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </div>
        </div>
        <br>
        <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
        <a href="register.php" class="hover-link1 non-style-link">Sign Up</a>
        <br><br><br>


        </form>

    </div>
</center>


<?php


if ($_POST) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = '<label for="promter" class="form-label"></label>';

    $userByEmail = $userService->getUserByEmail($email)->fetch_assoc();


    if ($userByEmail) {
        $usertype = $userByEmail["user_type"];
        if ($usertype == 'c') {

            if ($authService->validateUser($email, $password)) {

                //   Patient dashbord
                $_SESSION['user-email'] = $email;
                $_SESSION['user-type'] = 'c';

                header('location: ../customer/index.php');

            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        } elseif ($usertype == 'a') {

            if ($authService->validateUser($email, $password)) {

                //   Admin dashbord
                $_SESSION['user-email'] = $email;
                $_SESSION['user-type'] = 'a';

                header('location: ../admin');

            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }


        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
        }


    } else {
        $error = '<label for="promter" class="form-label"> User Doesn\'t exist&nbsp;</label>';
    }
}

include("../footer.php");
?>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>


</body>

</html>