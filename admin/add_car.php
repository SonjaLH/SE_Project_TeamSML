<?php session_start();


require_once __DIR__ . '/../services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/../services/authService.php';
$authService = new AuthService();
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
    // Call your function here
    header("location: ../pages/login.php");
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
            <i class="bi bi-envelope"></i> <a href="mailto:info@Car rental System.com">info@Car rental System.com</a>
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
        <h1 class="logo me-auto"><a href="../customer/index.php">

            </a></h1>

        <nav id="navbar" class="navbar order-last order-lg s me-5">
            <ul>
                <li><a class="nav-link scrollto " href="../index.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Vehicles
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./../sedan">Sedan</a></li>
                        <li><a class="dropdown-item" href="./../suv">Suv</a></li>
                        <li><a class="dropdown-item" href="./../cupe">Cupe</a></li>
                        <li><a class="dropdown-item" href="./../van">Van</a></li>
                        <li><a class="dropdown-item" href="./../sport">Sport</a></li>
                    </ul>
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
                <li>
                    <a class="close text-danger" href="index.php">
                        &times; close</a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->


<main>

    <section>
        <div class="container mt-5 pt-5 w-auto h-auto d-grid justify-content-center">
            <h6 class="display-6"> Add Car</h6>
            <form action="add_car1.php" id="uploadForm" method="POST" class="add-new-form"
            ">
            <tr>
                <td class="label-td" colspan="2">
                    <label for="make" class="form-label "> Make: </label>
                </td>
                <td class="label-td" colspan="2">
                    <input type="text" id="make" name="make" placeholder="Make"
                           class="input-text form-control form-control-lg"
                           required><br>
                </td>

            </tr>
            <td class="label-td" colspan="2">
                <label for="model" class="form-label "> Car model: </label>
            </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">

                    ENUM ('sedan', 'suv', 'cupe','van','sport')

                    <select name="type" class="box form-control form-control-lg form-select ">
                        <option value="sedan">sedan</option>
                        <option value="suv">suv</option>
                        <option value="cupe">cupe</option>
                        <option value="van">van</option>
                        <option value="sport">sport</option>

                    </select>
                </td>

            </tr>


            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="type" class="input-text form-control form-control-lg"
                           placeholder="Car model" required><br>
                </td>

            </tr>


            <tr>
                <td class="label-td" colspan="2">
                    <label for="year" class="form-label "> Year: </label>
                </td>
                <td class="label-td" colspan="2">
                    <input type="number" id="year" name="year" min="1900" max="2100" step="1" placeholder="YYYY"
                           class="input-text form-control form-control-lg"
                           required><br>
                </td>

            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="color" class="form-label">color: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="color" class="input-text form-control form-control-lg"
                           placeholder="Car Color" required><br>
                </td>
            </tr>

            <tr>
                <td class="label-td" colspan="2">
                    <label for="mileage" class="form-label "> Mileage: </label>
                </td>
                <td class="label-td" colspan="2">
                    <input type="number" id="mileage" name="mileage" min="0" placeholder="mileage"
                           class="input-text form-control form-control-lg"
                           required><br>
                </td>

            </tr>

            <tr>
                <td class="label-td" colspan="2">
                    <label for="price_per_day" class="form-label "> price_per_day: </label>
                </td>
                <td class="label-td" colspan="2">
                    <input type="number" id="price_per_day" name="price_per_day" min="0" placeholder="price_per_day"
                           class="input-text form-control form-control-lg"
                           required><br>
                </td>

            </tr>

            <tr>
                <td class="label-td" colspan="2">
                    <label for="mileage" class="form-label "> Available: </label>
                </td>
                <td class="label-td" colspan="2">
                    <br>
                    <input type="radio" id="yes" name="available" value="1">
                    <label for="yes">Yes</label><br>
                    <input type="radio" id="no" name="available" value="0">
                    <label for="no">No</label><br><br>
                </td>

            </tr>
            <label for="file">Choose an image to upload:</label>
            <input type="file" id="files" name="files[]" accept="image/*" multiple><br><br>


            <tr>
                <td colspan="2">
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                    <input type="submit" name="submit" id="submit" value="Add"
                           class="login-btn btn-primary btn btn-block btn-lg gradient-custom-4 text-body">
                </td>

            </tr>

            </form>


        </div>

    </section>
</main>
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

<!-- Vendor JS Fs -->
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

</body>

</html>



