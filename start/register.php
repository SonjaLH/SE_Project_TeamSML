<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Car Rental System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo/logo.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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


session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Europe/Amsterdam');
$date = date('Y-m-d');

$_SESSION["date"] = $date;

require_once __DIR__ . '/../services/userService.php';
$userService = new UserService();


?>


<!-- ======= Header ======= -->


<div class="mask d-flex align-items-center h-100 gradient-custom-3 mt-5">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card border-success" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Create a customer account</h2>

                        <form action="reg.php" method="POST" onsubmit="return validateForm()">

                            <div class="form-outline mb-4">
                                <input type="text" name="name" class="form-control form-control-lg" required/>
                                <label class="form-label" for="name">Your Name</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" name="username" class="form-control form-control-lg" required/>
                                <label class="form-label" for="username">Your Username</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="surname" class="form-control form-control-lg" required/>
                                <label class="form-label" for="surname">Your Surname</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" name="email" class="form-control form-control-lg" required/>
                                <label class="form-label" for="email">Your Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="address" class="form-control form-control-lg" required/>
                                <label class="form-label" for="address">Your Address</label>
                            </div>


                            <div class="form-outline mb-4">
                                <input type="tel" name="telephone" class="form-control form-control-lg" required
                                       placeholder="ex: 0694455666"/>
                                <label class="form-label" for="telephone">Telephone</label>
                            </div>


                            <div class="form-outline mb-4">
                                <input type="password" name="new_password"
                                       class="form-control form-control-lg" required/>
                                <label class="form-label" for="new_password">Password</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="c_password"
                                       class="form-control form-control-lg" required/>
                                <label class="form-label" for="c_password">Repeat your password</label>
                            </div>

                            <div class="form-check d-flex justify-content-center mb-5">
                                <input class="form-check-input me-2" type="checkbox" value="" id="terms"
                                       required/>
                                <label class="form-check-label" for="terms">
                                    I agree all statements in <a href="#" class="text-body"><u>Terms of
                                            service</u></a>
                                </label>
                            </div>
                            <label class="form-label" for="error">
                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Register"
                                           class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                </div>


                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a
                                            href="login.php"
                                            class="fw-bold text-body"><u>Login here</u></a></p>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        var name = document.forms["registrationForm"]["name"].value;
        var surname = document.forms["registrationForm"]["surname"].value;
        var email = document.forms["registrationForm"]["email"].value;
        var address = document.forms["registrationForm"]["address"].value;
        var city = document.forms["registrationForm"]["city"].value;
        var telephone = document.forms["registrationForm"]["telephone"].value;
        var newPassword = document.forms["registrationForm"]["new_password"].value;
        var confirmPassword = document.forms["registrationForm"]["c_password"].value;
        var termsChecked = document.getElementById("terms").checked;

        // Perform validation
        if (name === "" || surname === "" || email === "" || address === "" || city === "-" || telephone === "" || newPassword === "" || confirmPassword === "") {
            alert("All fields must be filled out");
            return false;
        }

        if (newPassword !== confirmPassword) {
            alert("Passwords do not match");
            return false;
        }

        if (!termsChecked) {
            alert("You must agree to the terms of service");
            return false;
        }

        return true;
    }
</script>

<br>
<br>
<center>

</center>

<br>
<br>
<br>
<br>

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