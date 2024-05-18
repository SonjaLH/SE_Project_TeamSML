<?php session_start();


require_once __DIR__ . '/../services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/../services/authService.php';
$authService = new AuthService();
require_once __DIR__ . '/../services/bookingService.php';
$bookingService = new BookingService();
require_once __DIR__ . '/../services/carService.php';
$carService = new CarService();


if (isset($_SESSION["user-email"])) {
    if (($_SESSION["user-email"]) == "" and $_SESSION["user-type"] != 'a') {
        header("location: ../start/login.php", true);
    }

} else {
    header("location: ../start/login.php", true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_out_btn'])) {
$authService->destroySession();
    // Call your function here
    header("location: ../start/login.php");
}
$userByEmail = $userService->getUserByEmail($_SESSION["user-email"])->fetch_assoc();

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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.scss" rel="stylesheet">
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

<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:info@Car rental System.com">info@CarrentalSystem.com</a>
            <i class="bi bi-phone"></i> +355 224 464 15
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://instagram.com/Car rental System.al" class="instagram"><i
                        class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/diun-olla-192685279" class="linkedin"><i
                        class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <img src="../assets/img/logo/logo.png" width="160px" height="80px" alt="logo">
        <h1 class="logo me-auto"><a href="index.php">

            </a></h1>

        <nav id="navbar" class="navbar order-last order-lg s me-5">
            <ul>
                <li><a class="nav-link scrollto " href="./../index.php">Home</a></li>
                <li class="nav-item dropdown">
                 <a class="nav-link scrollto  active" href="bookings.php">Bookings</a>
                </li>


                <li><a class="nav-link scrollto" href="./about">About</a></li>
                <li><a class="nav-link scrollto" href="./contact">Contact</a></li>

                <li <?php if (isset($_SESSION['user-email'])) echo 'style="display: none;"'; ?>>


                    <a href="../start/login.php"
                       class="sign-in-btn text-center p-2"><span
                                class=" d-md-inline ">Sign in</span> </a></li>
                <li <?php if (isset($_SESSION['user-email'])) echo 'style="display: none;"'; ?>>

                    <a href="../start/register.php"
                       class="sign-up-btn   p-2"><span
                                class=" d-md-inline">Sign Up</span>
                    </a>
                </li>

                <li class="nav-item dropdown bg-opacity-100" <?php if (!isset($_SESSION['user-email'])) echo 'style="display: none;"'; ?>>
                    <a class="nav-link dropdown-toggle btn-danger " href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Hello <?php
                        if (isset($_SESSION['user-email'])) {
                            echo $userByEmail['username'];
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu">


                        <li>
                            <form method="post">
                                <input class="btn btn-danger m-2" type="submit" name="sign_out_btn" value="Sign Out">
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
                <h6 class="display-6 m-5" > Bookings</h6>
                <hr>

                <div class="container-fluid ">
                    <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">

                        <?php

                                        $bookings = $bookingService-> getAllBookings();

           ;



                        ?>
 <table width="93%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr> <th class="table-headin">

                                                                                            Booking ID

                                                                                        </th>
                                            <th class="table-headin">

                                                Car ID

                                            </th>
                                            <th class="table-headin">

                                                Customer ID

                                            </th>

                                            <th class="table-headin">

                                                Car Name

                                            </th>
                                            <th class="table-headin">

                                                Start date

                                            </th>
                                            <th class="table-headin">

                                                End date

                                            </th>

                                            <th class="table-headin">
                                                Price per day
                                            </th>
                                            <th class="table-headin">

                                                Total

                                            </th>
                                            <th class="table-headin">

                                                Events

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php


                                        if ($bookings->num_rows == 0) {
                                            echo '<tr>
                                                                            <td colspan="4">
                                                                            <br><br><br><br>
                                                                            <center>
                                                                            <img src="../../assets/img/notfound.png" width="25%">

                                                                            <br>
                                                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                                            <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                                                            </a>
                                                                            </center>
                                                                            <br><br><br><br>
                                                                            </td>
                                                                            </tr>';

                                        } else {
                                            for ($x = 0; $x < $bookings->num_rows; $x++) {
                                                $row = $bookings->fetch_assoc();
                                                $carid = $row["car_id"];
                                                $costumer_id = $row["customer_id"];
                                                $car = $carService->getCarById($carid)->fetch_assoc();
                                                $bookID = $row["reservation_id"];
                                                $pickDate = $row["start_date"];
                                                $dropDate = $row["end_date"];
                                                $total = $row["total_cost"];
                                                $make = $car["make"];
                                                $model = $car["model"];
                                                $year = $car["year"];
                                                $price_per_day = $car["price_per_day"];



                                                echo '
                                                <tr>
<td> &nbsp;' . substr($carid, 0, 30) . '</td>
<td> &nbsp;' . substr($costumer_id, 0, 30) . '</td>
                                                                                 <td>
                                                                                ' . substr($bookID, 0, 30) . '
                                                                                </td>
                                                                                <td>
                                                                              <h5 class="card-title text-wrap ">' . $make . ' ' . $model . '</h5>
                                                                                </td>
                                                                                <td>
                                                                              <h5 class="card-title text-wrap ">' . $pickDate . '</h5>
                                                                                </td>
                                                                                <td>
                                                                              <h5 class="card-title text-wrap ">' . $dropDate . ' </h5>
                                                                                </td>
                                                                                <td>
                                                                              <h5 class="card-title text-wrap ">' . $price_per_day . '</h5>
                                                                                </td>
                                                                                <td>
                                                                              <h5 class="card-title text-wrap ">' . $total . ' Euro</h5>
                                                                                </td>

                                                                                <td>
                                                                                <div style="display:flex;justify-content: center;">
                                                                                <a href="../delete-booking.php?id=' . $bookID . '&error=0" class="non-style-link"><button  class="btn-outline-danger btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel</font></button></a>
                                                                                &nbsp;&nbsp;&nbsp;

                                                                                </td>
                                                                            </tr>';

                                            }
                                        }

                                        ?>

                                        </tbody>

                                    </table>

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
include("../footer.php");
?>
<!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>


</body>

</html>