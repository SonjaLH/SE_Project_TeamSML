<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Car rental System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/logo/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.scss" rel="stylesheet">
    <style>
        .container-fluid {
            position: relative;
        }

        .row-horizon {
            overflow-x: auto;
            white-space: nowrap;
        }

        .card {
            min-width: 200px;
            margin-right: 10px;
        }


    </style>
</head>
<?php session_start();

require_once __DIR__ . '/../../services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/../../services/authService.php';
$authService = new AuthService();
require_once __DIR__ . '/../../services/carService.php';
$carService = new CarService();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_out_btn'])) {
    $authService->destroySession();
    header("location: ../pages/login.php");
}
$userByEmail = $userService->getUserByEmail($_SESSION["user-email"])->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_out_btn'])) {
    // Call your function here
    unsetAllSessions();
    header("location: ./");
}
?>
<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top p-1">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:info@Car rental System.com">info@car-rental.com</a>
            <i class="bi bi-phone"></i> +355 224 464 15
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i
                        class="bi bi-instagram"></i></a>

        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <img src="../../assets/img/logo/logo.png" width="160px" height="80px" alt="logo">
        <h1 class="logo me-auto"><a href="index.php">

            </a></h1>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto  " href="index.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Vehicles
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item " href="">Sedan</a></li>
                        <li><a class="dropdown-item" href="../suv">Suv</a></li>
                        <li><a class="dropdown-item" href="../cupe">Cupe</a></li>
                        <li><a class="dropdown-item" href="../van">Van</a></li>
                        <li><a class="dropdown-item" href="../sport">Sport</a></li>
                    </ul>
                </li>

                <li><a class="nav-link scrollto" href="../../about">About</a></li>
                <li><a class="nav-link scrollto " href="../../contact">Contact</a></li>

                <li <?php if (!isset($_SESSION['user'])) echo 'style="display: none;"'; ?>>


                    <a href="../../start/login.php"
                       class="sign-in-btn text-center p-2"><span
                                class=" d-md-inline ">Sign in</span> </a></li>
                <li <?php if (!isset($_SESSION['user'])) echo 'style="display: none;"'; ?>>

                    <a href="../../start/register.php"
                       class="sign-up-btn   p-2"><span
                                class=" d-md-inline">Sign Up</span>
                    </a>
                </li>

                <li class="nav-item dropdown bg-opacity-100" <?php if (isset($_SESSION['user'])) echo 'style="display: none;"'; ?>>
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Hello <?php
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user']['username'];
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu">


                        <li>
                            <form method="post">
                                <input class="btn-danger" type="submit" name="sign_out_btn" value="Sign Out">
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<main style="margin-top: 100px">
    <div class="container pt-5 ">
        <br>
        <br>

        <div class="row  ">

            <div class="col-lg-12 col-md-6 col-sm-12">
                <h6 class="display-6"> Sedan Cars</h6>
                <hr>
                <div class="container-fluid ">
                    <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">


                        <?php
                        $cars = $carService->getCarsByType("sedan");

                        if ($cars->num_rows == 0) {
                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../../assets/img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="index.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';

                        } else {
                            for ($x = 0; $x < $cars->num_rows; $x++) {
                                $row = $cars->fetch_assoc();
                                $carid = $row["car_id"];
                                $make = $row["make"];
                                $model = $row["model"];
                                $year = $row["year"];
                                $price_per_day = $row["price_per_day"];


//
                                echo '

     <div class="col-12  ">
                            <div class="card border-0 text-wrap shadow-1 ">
                                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                </div>

                                <div class="card-body d-block">
                                    <h5 class="card-title text-wrap ">' . $make . ' ' . $model . '</h5>
                                    <p class="card-text text-wrap">
                                     Year:  ' . $year . '. <br> Price per day: .' . $price_per_day . 'Euro
                                    </p>

                                     <a href="../../car.php?action=view&id=' . $carid . '" class="non-style-link"><button  class="btn-outline-primary btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="../../customer/add-booking.php?action=book&id=' . $carid . ' " class="non-style-link"><button  class="btn-outline-primary btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Book</font></button></a>
                                             </div>
                                <div class="card-footer">Min Rent days : 3</div>
                            </div>
                        </div>       ';

                            }
                        }

                        ?>


                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>


    </div>

</main>
<!-- End #main -->
<br>

<!-- ======= Footer ======= -->

<?php
include("./../../footer.php");
?>
<!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../../assets/vendor/php-email-form/validate.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


<!-- Template Main JS File -->
<script src="../../assets/js/main.js"></script>


</body>

</html>