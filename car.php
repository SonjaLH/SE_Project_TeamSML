<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> Car Rental System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logo/logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/adm.css" rel="stylesheet">


</head>

<body>
<?php

//learn from w3schools.com

session_start();

require_once __DIR__ . '/services/carService.php';
$carService = new CarService();


if ($_GET) {
    $id = $_GET["id"];
    $action = $_GET["action"];
    $carById = $carService->getCarById($id);
    $car = $carById->fetch_assoc();
    $carid = $car['car_id'];
    $make = $car['make'];
    $model = $car['model'];
    $year = $car['year'];
    $price_per_day = $car['price_per_day'];

} else header('Location: ./doctors.php');

?>


<center>
    <h2></h2>
    <a class="close text-danger" href="index.php">&times; close</a>
    <div class="content">

        <br>
    </div>
    <div style="display: flex;justify-content: center;" class="border-0">
        <table width="auto" class="sub-table scrolldown add-doc-form-container border-0 "


        <tr>
            <td>
                <h6 class="display-5" style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">
                    View Car
                    Details.</h6><br><br>
            </td>
        </tr>

        <tr>

            <td class="label-td" colspan="2">
                <h6 class="display-6"><label for="name" class="form-label">Make: <?php echo $make ?></label></h6>
            </td>
        </tr>

        <tr>

            <td class="label-td" colspan="2">
                <h6 class="display-6"><label for="spec" class="form-label">Model: <?php echo $model ?></label></h6>

            </td>
        </tr>

        <tr>
            <td class="label-td" colspan="2">
                <h6 class="display-6"><label for="Email" class="form-label">Year: <?php echo $year ?></label>
            </td>
        </tr>

        <tr>
            <td class="label-td" colspan="2">
                <h6 class="display-6"><label for="nic" class="form-label">price per
                        day: <?php echo $price_per_day ?> Euro</label></h6>
            </td>
        </tr>


        </table>
    </div>
</center>


<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


<?php

include("./footer.php");


?>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<!-- Vendor Jiles -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

</body>

</html>



