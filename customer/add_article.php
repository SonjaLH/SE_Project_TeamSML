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


//session_start();
//
//if (isset($_SESSION["user"])) {
//    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'customer') {
//        header("location: ../login.php");
//    }
//
//} else {
//    header("location: ../login.php");
//}
//import database
include("../db/dbconfig.php");


?>


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


<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->

    <section class="vh-auto ">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card border-top" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an article</h2>

                                <form action="add_article_media.php" method="POST">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="title">Tittle</label>
                                        <input type="text" name="title" class="form-control form-control-lg" required/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="subtitle">Subtitle</label>
                                        <input type="text"
                                               name="subtitle"
                                               class="form-control form-control-lg" required/>

                                    </div>


                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="category">Category</label>
                                        <select name="category" class="box form-control form-control-lg form-select">

                                            <?php

                                            $list11 = $database->query("select  * from  categories;");
                                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                                $row00 = $list11->fetch_assoc();
                                                $cat_id = $row00["category_id"];
                                                $cat_name = $row00["category_name"];
                                                $cat_info = $cat_id . ";" . $cat_name;
                                                echo "<option value='$cat_info'>  $cat_name<br/>";

                                            }
                                            echo " </select>";
                                            ?>


                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="subtitle">Content</label><br>
                                        <textarea class="form-control form-control-lg" id="content" name="content"
                                                  rows="6" cols="45" required></textarea><br>
                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Next" name="prepare_article"
                                               class="btn  btn-outline-primary    text-body w-50 ">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main><!-- End #main -->


<?php
include("../pages/footer.php");
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