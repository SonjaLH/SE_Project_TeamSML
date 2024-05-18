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


// Set the new timezone
date_default_timezone_set('Europe/Amsterdam');
$date = date('Y-m-d');

$_SESSION["date"] = $date;
session_start();


if (isset($_SESSION["user-email"])) {
    if (($_SESSION["user-email"]) == "" or $_SESSION['user-type'] != 'c') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}

if ($_GET) {
    $id = $_GET['id'];

} ?>


<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:info@Car rental System.com">info@Car rental System.com</a>
            <i class="bi bi-phone"></i> +355 224 464 15
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <img src="../assets/img/logo/logo.png" width="180px" height="60px">
        <h1 class="logo me-auto p-3">

            Car rental System </h1>


    </div>
</header><!-- End Header -->


<main class="m-5">
    <br>
    <br>
    <br>
    <br>
    <br>
    <h2 class="text-uppercase text-center mb-5">Add Booking</h2>

    <form action="add-booking.php" method="post" class="d-flex">
        <input type="hidden" name="car_id" value="<?php echo $id ?>">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <label class="form-label" for="pickDate">Choose PickDate Date</label>

                <input type="date" name="pickDate"
                       class="date-field input-text header-searchbar form-control trigger-gtm-sb hasDatepicker w-auto "
                       value="Sun, 19 May, 2024" required>
            </div>
            <div class="col-lg-5 col-sm-12">
                <label class="form-label" for="dropDate">Choose DropDate Date</label>

                <input type="date" name="dropDate"
                       class="date-field input-text header-searchbar form-control trigger-gtm-sb hasDatepicker w-auto"
                       value="Mon, 27 May, 2024"
                       required>
            </div>
            <div class="col-lg-3 col-sm-12">

                <input type="Submit" value="Add Booking"
                       class="login-btn btn-primary btn m-2 w-25 w-auto"
                       style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
            </div>
        </div>
    </form>


</main><!-- End #main -->


<?php
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