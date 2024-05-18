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
        <img src="../assets/img/logo/logo.png" width="160px" height="80px" alt="logo">
        <h1 class="logo me-auto"><a href="index.php">

            </a></h1>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto" href="./index.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Vehicles
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../sedan">Sedan</a></li>
                        <li><a class="dropdown-item" href="../suv">Suv</a></li>
                        <li><a class="dropdown-item" href="../cupe">Cupe</a></li>
                        <li><a class="dropdown-item" href="../van">Van</a></li>
                        <li><a class="dropdown-item" href="../start">Sport</a></li>
                    </ul>
                </li>

                <li><a class="nav-link scrollto active" href="">About</a></li>
                <li><a class="nav-link scrollto" href="../contact">Contact</a></li>

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
                <h6 class="display-6"> About</h6>
                <hr>
                <div class="container-fluid ">
                    <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                        <header>
                            <h1>CRS: Your Gateway to Car Rental Convenience</h1>
                        </header>
                        <section>
                            <h2>The Problem:</h2>
                            <p>Renting a car in Tirana can often be a cumbersome process, plagued by long queues, confusing rental agreements, and hidden fees. Visitors to the city may find it particularly challenging to navigate the rental market, while locals may struggle to find reliable rental options for their transportation needs. These challenges inspired the creation of CRS.</p>
                        </section>
                        <section>
                            <h2>Our Solution:</h2>
                            <p>CRS offers a modern and user-friendly platform that simplifies the car rental process from start to finish. Here's how we're transforming the way people rent cars in Tirana:</p>
                            <ol>
                                <li><strong>Effortless Booking:</strong> Our online platform allows users to browse through a wide selection of rental vehicles, from compact cars to spacious SUVs, and easily book the one that suits their needs.</li>
                                <li><strong>Transparent Pricing:</strong> We believe in transparent pricing, which is why we provide upfront pricing with no hidden fees.</li>
                                <li><strong>Flexible Rental Options:</strong> Whether you need a car for a few hours, a day, a week, or longer, CRS has flexible rental options to accommodate your schedule.</li>
                                <li><strong>Quality Assurance:</strong> All rental vehicles offered through CRS undergo regular maintenance and safety inspections to ensure they meet the highest standards of quality and reliability.</li>
                                <li><strong>Convenient Pickup and Drop-off:</strong> We offer convenient pickup and drop-off locations throughout Tirana, including at the airport and major transportation hubs.</li>
                                <li><strong>24/7 Customer Support:</strong> Our dedicated customer support team is available 24/7 to assist customers with any inquiries or issues they may encounter during their rental.</li>
                            </ol>
                        </section>
                        <section>
                            <h2>The Benefits:</h2>
                            <p>By choosing CRS for your car rental needs, you can enjoy a range of benefits:</p>
                            <ul>
                                <li><strong>Convenience:</strong> Our online booking platform makes renting a car quick and easy, saving you time and effort.</li>
                                <li><strong>Affordability:</strong> With transparent pricing and competitive rates, CRS offers affordable rental options for every budget.</li>
                                <li><strong>Reliability:</strong> We provide well-maintained vehicles and reliable customer service, ensuring a worry-free rental experience.</li>
                                <li><strong>Flexibility:</strong> Choose the rental duration that works best for you, whether you need a car for a few hours or a few weeks.</li>
                            </ul>
                        </section>

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