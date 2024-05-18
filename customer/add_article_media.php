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


if (isset($_POST["prepare_article"])) {
// Retrieve form data
    $title = $_POST['title'];
    $sub_title = $_POST['subtitle'];
    $category_id = explode(";", $_POST['category'])[0];
    $category_name = explode(";", $_POST['category'])[1];
    $content = $_POST['content'];
    $user_email = $_SESSION['user'];
    $stmt = $database->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row01 = $result->fetch_assoc();
        // Use $row01 as needed
    } else {
        // Handle the case where the query failed
        echo "Query failed: " . $database->error;
    }

    $stmt->close();
    $author_id = $row01["user_id"];
    $max_article_id = $database->query("select MAX(article_id) as max_id  from  articles ")->fetch_assoc()["max_id"];
    $article_id = $max_article_id + 1;
}
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

<?php
$uploadDirectory = "../" . strtolower($category_name) . "/media/" . strtolower($article_id);
// Specify the directory where you want to save the uploaded files

if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true); // Create the directory if it doesn't exist
}
if (isset($_POST["upload_media"])) {
    if (isset($_FILES['mediaFiles'])) {
        $uploadedFiles = $_FILES['mediaFiles'];

        for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
            $fileName = $uploadedFiles['name'][$i];
            $tempFilePath = $uploadedFiles['tmp_name'][$i];
            $targetFilePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                echo "File $fileName has been uploaded successfully.<br>";
            } else {
                echo "Error uploading $fileName.<br>";
            }
        }
    } else {
        echo "No files selected for upload.";


    }
}
?>

<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->

    <section class="vh-auto ">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card border-top" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Add Media</h2>

                                <form action="" method="POST">

                                    <div class="form-outline mb-4">

                                        <label for="mediaFiles">Select Multiple Media Files:</label>
                                        <input class="form-control form-control-lg" type="file" name="mediaFiles[]"
                                               id="mediaFiles" multiple accept="image/*, video/*">
                                        <br>
                                    </div>


                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Upload" name="upload_media"
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
include("footer.php");
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