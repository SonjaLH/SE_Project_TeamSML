<?php session_start();

function unsetAllSessions(): void
{
    session_unset();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_out_btn'])) {
    // Call your function here
    unsetAllSessions();
    header("location: ./");
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sonja-Press</title>
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
            <i class="bi bi-envelope"></i> <a href="mailto:info@sonja-press.com">info@sonja-press.com</a>
            <i class="bi bi-phone"></i> +355 224 464 15
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://instagram.com/Sonja-Press.al" class="instagram"><i
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

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto " href="../index.php">Home</a></li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Vehicles
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../sedan">Sedan</a></li>
                        <li><a class="dropdown-item" href="../suv">Suv</a></li>
                        <li><a class="dropdown-item  scrollto nav-link " href="../cars/cupe">Cupe</a></li>
                        <li><a class="dropdown-item" href="../cars/van">Van</a></li>
                        <li><a class="dropdown-item" href="../cars/sport">sport</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="../about">About</a></li>
                <li><a class="nav-link scrollto active" href="../contact">Contact</a></li>

                <li <?php if (isset($_SESSION['user'])) echo 'style="display: none;"'; ?>>


                    <a href="../start/login.php"
                       class="sign-in-btn text-center p-2"><span
                                class=" d-md-inline ">Sign in</span> </a></li>
                <li <?php if (isset($_SESSION['user'])) echo 'style="display: none;"'; ?>>

                    <a href="../start/register.php"
                       class="sign-up-btn   p-2"><span
                                class=" d-md-inline">Sign Up</span>
                    </a>
                </li>

                <li class="nav-item dropdown bg-opacity-100" <?php if (!isset($_SESSION['user'])) echo 'style="display: none;"'; ?>>
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Hello <?php
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user'];
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
                <h6 class="display-6"> Contact</h6>
                <hr>
                <div class="container-fluid ">
                    <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                        <form style="width: 26rem;">
                            <!-- Name input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="form4Example1" class="form-control"/>
                                <label class="form-label" for="form4Example1">Name</label>
                            </div>

                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="form4Example2" class="form-control"/>
                                <label class="form-label" for="form4Example2">Email address</label>s
                            </div>

                            <!-- Message input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <textarea class="form-control" id="form4Example3" rows="4"></textarea>
                                <label class="form- form-control" for="form4Example3">Message</label>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input
                                        class="form-check-input form-control me-2"
                                        type="checkbox"
                                        value=""
                                        id="form4Example4"
                                        checked
                                />
                                <label class="form-check-label form-control" for="form4Example4">
                                    Send me a copy of this message
                                </label>
                            </div>

                            <!-- Submit button -->
                            <button data-mdb-ripple-init type="submit" class="btn btn-primary w-50 btn-block mb-4">
                                Send
                            </button>
                        </form>

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