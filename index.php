
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title> Car Rental System</title>
    <!-- Favicons -->
    <link href="assets/img/logo/logo.png" rel="icon">

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

    <!-- Template Main CSS File -->
    <link href="assets/css/style.scss" rel="stylesheet">

</head>
<?php
echo "test";

session_start();

require_once __DIR__ . '/services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/services/authService.php';
$authService = new AuthService();
require_once __DIR__ . '/services/bookingService.php';
$bookingS = new BookingService();
require_once __DIR__ . '/services/carService.php';
$carService = new CarService();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_out_btn'])) {
    $authService->destroySession();
    header("location: ./");
}

if(isset($_SESSION['user-email']))
{
    $userByEmail = $userService->getUserByEmail($_SESSION["user-email"])->fetch_assoc();

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
<header id="header" class="fixed-top  p-1">
    <div class="container d-flex align-items-center">
        <img src="assets/img/logo/logo.png" width="160px" height="80px" alt="logo">
        <h1 class="logo me-auto"><a href="index.php">

            </a></h1>

        <nav id="navbar" class="navbar order-last order-lg-0 me-3">
            <ul>
                <li><a class="nav-link scrollto active" href="./index.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Vehicles
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./cars/sedan">Sedan</a></li>
                        <li><a class="dropdown-item" href="./cars/suv">Suv</a></li>
                        <li><a class="dropdown-item" href="./cars/cupe">Cupe</a></li>
                        <li><a class="dropdown-item" href="./cars/van">Van</a></li>
                        <li><a class="dropdown-item" href="./cars/sport">Sport</a></li>
                    </ul>
                </li>


                <li><a class="nav-link scrollto" href="./about">About</a></li>
                <li><a class="nav-link scrollto" href="./contact">Contact</a></li>

                <li <?php if (isset($_SESSION['user-email'])) echo 'style="display: none;"'; ?>>


                    <a href="start/login.php"
                       class="sign-in-btn text-center p-2"><span
                                class=" d-md-inline ">Sign in</span> </a></li>
                <li <?php if (isset($_SESSION['user-email'])) echo 'style="display: none;"'; ?>>

                    <a href="start/register.php"
                       class="sign-up-btn   p-2"><span
                                class=" d-md-inline">Sign Up</span>
                    </a>
                </li>

                <li class="nav-item dropdown bg-opacity-100" <?php if (!isset($_SESSION['user-email']) ) echo 'style="display: none;"'; ?>>
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
                            <a href="<?php
                            if ($_SESSION['user-type'] == 'a') {
                                echo "./admin";
                            } else {
                                echo "customer";
                            }
                            ?>">My Space</a>
                        </li>


                        <li>
                            <form method="post">
                                <input class="btn btn-danger m-2" type="submit" name="sign_out_btn"
                                       value="Sign Out">
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
    <div class="container">
        <div class="row p-0 m-0 w-100">

            <div class="hero-wrap" style="background-image: url('assets/img/bg_1.jpg');"
                 data-stellar-background-ratio="0.6">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                        <div class="col-12 ">
                            <style>
                                .tall-button {
                                    height: 60px;
                                    font-weight: bold;
                                    justify-content: center;

                                }
                            </style>

                            <div class="text w-100 text-center  align-text-top text-white ">

                                <br>
                                <br>
                                <br> <br>
                                <br>
                                <br>
                                <h1 class="mb-4">Fast &amp; Easy Way To Rent A Car</h1>
                                <br>
                                <br>
                                <br> <br>
                                <br>
                                <br> <br>
                                <br>
                                <br> <br>
                                <br>
                                <br>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container ">
            <div class="row ">
                <h6 class="display-6 pt-5">Vehicle Models and Types </h6>

            </div>

            <hr>

            <div class="row  ">
                <div class="col-lg-12  ">
                    <h6 class="display-6"> Sport Cars</h6>
                    <!--                    //https://rentluxecar.com/-->
                    <div class="container-fluid ">
                        <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/kl5ne5zn9lae7wqk1wbn.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">BENTLEY GTC</h5>
                                    <p class="card-text">Engine : 6.0 | HP:560 | 0-100 km/h in 4,8 seconds | Top
                                        Speed:318 Klm/h | Min days : 3 </p>
                                </div>
                            </div>
                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/elph0pmksrdsbaapmpbw.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">ABARTH 595</h5>
                                    <p class="card-text">Engine : 1.4 | HP:190 | 0-100 km/h in 5,8 seconds | Top
                                        Speed:230 Klm/h | Min days : 3 </p>
                                </div>
                            </div>
                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/qsm7esjogrtsz5dmgsk1.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">BMW I8</h5>
                                    <p class="card-text">Engine : 1.5 | HP:360 | 0-100 km/h in 4,4 seconds | Top
                                        Speed:250 Klm/h | Min days : 3</p>
                                </div>
                            </div>
                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/h8vyw3tcqgwrmxx9qk1c.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">LAMBORGHINI AVENTADOR</h5>
                                    <p class="card-text">Engine : 6.5 | HP:700 | 0-100 km/h in 2.9 seconds | Top
                                        Speed:350 Klm/h | Min days : 3</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <a href="./cars/sport">
                        <button type="button" class="btn btn-light">See more</button>
                    </a>
                </div>


            </div>
            <div class="row  ">
                <div class="col-lg-6 col-md-6 col-sm-12 border-end border-secondary ">
                    <h6 class="display-6"> Sedan</h6>
                    <div class="container-fluid ">
                        <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">

                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/o5sf4ohltlovpkkv9iat.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">MERCEDES CLASS S 350 LONG</h5>
                                    <p class="card-text">Engine : 3.0 | HP:258 | 0-100 km/h in 6,8 seconds | Top
                                        Speed:250 Klm/h | Min days : 3 </p>
                                </div>
                            </div>

                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/jnlz3gofdbb575qnbxet.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">BMW 740 XD</h5>
                                    <p class="card-text">Engine : 3.0 | HP:309 | 0-100 km/h in 8.5 seconds | Top
                                        Speed:250 Klm/h | Min days : 3 </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <a href="./cars/sedan">
                        <button type="button" class="btn btn-light">See more</button>
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 border-end border-secondary">
                    <h6 class="display-6"> Suv</h6>
                    <div class="container-fluid ">
                        <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/cenbbzxjmbayhy103g2i.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">AUDI Q7</h5>
                                    <p class="card-text">Engine : 3.0 | HP:333 | 0-100 km/h in 6,9 seconds | Top
                                        Speed:243 Klm/h | Min days : 3 </p>
                                </div>
                            </div>
                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/lrfsesf8sdsdjzqrtge7.jpg"
                                     class="card-img-top bx-border-radius"
                                     alt="Card image">
                                <div class="card-body">
                                    <h5 class="card-title">BMW X5</h5>
                                    <p class="card-text">TEngine : 3.0 | HP:258 | 0-100 km/h in 6,9 seconds | Top
                                        Speed:230 Klm/h | Min days : 3 </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <a href="./cars/suv">
                        <button type="button" class="btn btn-light">See more</button>
                    </a>
                </div>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 border-end border-secondary ">
                        <h6 class="display-6"> Cupe</h6>
                        <hr>
                        <div class="container-fluid ">
                            <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                                <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                                    <div class="card border-0" style="width: 18rem;">
                                        <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/brtcwezhc8tgsto5spzu.jpg"
                                             class="card-img-top bx-border-radius"
                                             alt="Card image">
                                        <div class="card-body">
                                            <h5 class="card-title">MERCEDES AMG GT 4 DOORS COUPE</h5>
                                            <p class="card-text">Engine : 4.0 | HP:639 | 0-100 km/h in 3.2 seconds | Top
                                                Speed:318 Klm/h | Min days : 3 </p>
                                        </div>
                                    </div>
                                    <div class="card border-0" style="width: 18rem;">
                                        <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/ohrky4xbx7vv2ulxdoap.jpg"
                                             class="card-img-top bx-border-radius"
                                             alt="Card image">
                                        <div class="card-body">
                                            <h5 class="card-title">MERCEDES S63 AMG COUPE</h5>
                                            <p class="card-text">Engine : 5.4 | HP:585 | 0-100 km/h in 3,8 seconds | Top
                                                Speed:250 Klm/h | Min days : 3 </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <a href="./cars/cupe">
                                <button type="button" class="btn btn-light">See more</button>
                            </a>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 ">
                        <h6 class="display-6"> Van</h6>
                        <hr>

                        <div class="container-fluid ">
                            <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                                <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">
                                    <div class="card border-0" style="width: 18rem;">
                                        <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/azt274qw9rfmkgac6gb1.jpg"
                                             class="card-img-top bx-border-radius"
                                             alt="Card image">
                                        <div class="card-body">
                                            <h5 class="card-title">MERCEDES V CLASS</h5>
                                            <p class="card-text">Engine : 2.5 | HP:190 | 0-100 km/h in 9,8 seconds | Top
                                                Speed:200 Klm/h | Min days : 3 </p>
                                        </div>
                                    </div>
                                    <div class="card border-0" style="width: 18rem;">
                                        <img src="https://res.cloudinary.com/unix-center/image/upload/c_limit,dpr_3.0,f_auto,fl_progressive,g_center,h_580,q_75,w_906/brm7lvbt39nayrssxury.jpg"
                                             class="card-img-top bx-border-radius"
                                             alt="Card image">
                                        <div class="card-body">
                                            <h5 class="card-title">MERCEDES V300 AMG 4MATIC</h5>
                                            <p class="card-text">Engine : 2.0| HP:240 | 0-100 km/h in 9,8 seconds | Top
                                                Speed:220 Klm/h | Min days : 3 </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <a href="./cars/van">
                                <button type="button" class="btn btn-light">See more</button>
                            </a>
                        </div>
                    </div>


                </div>


    </section>
    <hr>

    <section id="check-availability">
        <div class="row  ">
            <div class="col-lg-12 col-md-12 col-sm-12 border-end border-secondary ">
                <form action="index.php#check-availability" method="post" class="d-flex">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label class="form-label" for="pickDate">Choose PickDate Date</label>

                            <input type="date" name="pickDate"
                                   class="date-field input-text header-searchbar form-control trigger-gtm-sb hasDatepicker w-auto "
                                   value="Sun, 19 May, 2024">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label class="form-label" for="dropDate">Choose DropDate Date</label>

                            <input type="date" name="dropDate"
                                   class="date-field input-text header-searchbar form-control trigger-gtm-sb hasDatepicker w-auto"
                                   value="Mon, 27 May, 2024">
                        </div>
                        <div class="col-lg-4 col-sm-12">

                            <input type="Submit" value="Search Availability"
                                   class="login-btn btn-primary btn m-2 w-25 w-auto"
                                   style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </div>
                    </div>
                </form>
                <h6 class="display-6"> Result</h6>
                <div class="container-fluid ">
                    <div class="row flex-row flex-md-grow-1   flex-wrap overflow-scroll overflow-visible row-horizon  p-3">

                        <?php


                        if ($_POST && isset($_POST["pickDate"]) && isset($_POST["dropDate"])) {
                            $pickDate = $_POST["pickDate"];
                            $dropDate = $_POST["dropDate"];


                            $acars = $carService->getAvCars($pickDate, $dropDate);
                        } else {
                            $acars = $carService->getCars();
//
                        }
                        //

                        ?>
                        <div class="row ">

                            <div class="col ">


                                <div class="abc scroll">
                                    <table width="93%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr>
                                            <th class="table-headin">


                                                Car Name

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


                                        if ($acars->num_rows == 0) {
                                            echo '<tr>
                                                                            <td colspan="4">
                                                                            <br><br><br><br>
                                                                            <center>
                                                                            <img src="../../assets/img/notfound.png" width="25%">
                                        
                                                                            <br>
                                                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                                      
                                                                            </center>
                                                                            <br><br><br><br>
                                                                            </td>
                                                                            </tr>';

                                        } else {

                                            for ($x = 0; $x < $acars->num_rows; $x++) {
                                                $car = $acars->fetch_assoc();

                                                $carid = $car['car_id'];
                                                $make = $car['make'];
                                                $model = $car['model'];
                                                $year = $car['year'];
                                                $price_per_day = $car['price_per_day'];


                                                if ($_POST) {
                                                    try {
                                                        $start = new DateTime($pickDate);
                                                    } catch (Exception $e) {
                                                        echo 'Invalid start date: ' . $e->getMessage();
                                                        exit;
                                                    }

                                                    try {
                                                        $end = new DateTime($dropDate);
                                                    } catch (Exception $e) {
                                                        echo 'Invalid end date: ' . $e->getMessage();
                                                        exit;
                                                    }

// Get the difference between the two dates
                                                    $interval = $start->diff($end);

// Calculate the total cost
                                                    $totalDays = $interval->days; // Total number of days as a difference
                                                    $total = $totalDays * $car["price_per_day"];
                                                } else {
                                                    $total = 0;
                                                }


                                                echo '<tr> <td> &nbsp;' . substr($make, 0, 30) . ' ' . substr($model, 0, 30) . '</td >
        <td > ' . substr($price_per_day, 0, 30) . '  </td >
         <td >' . substr($total, 0, 20) . '  </td >
                                        
        <td >
            <div style = "display:flex;justify-content: center;">
    <a href = "customer/booking.php?id=' . $carid . '&error=0" class="non-style-link" ><button  class="btn-primary-soft btn button-icon btn-edit"  style = "padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;';

// Check user type and conditionally set display style
                                                if (!isset($_SESSION['user-email'])) {

                                                    echo "display:none;";
                                                }

                                                echo '" ><font class="tn-in-text" > Book</font ></button ></a >
    &nbsp;&nbsp;&nbsp;
    <a href = "car.php?action=view&id=' . $carid . '" class="non-style-link" ><button  class="btn-primary-soft btn button-icon btn-view"  style = "padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;" ><font class="tn-in-text" > View</font ></button ></a >
    &nbsp;&nbsp;&nbsp;
</div >
</td >
</tr > ';


                                            }
                                        }

                                        ?>

                                        </tbody>

                                    </table>
                                </div>


                            </div>
                        </div>
                        <br>
                        <br>

                    </div>

                </div>


    </section>

</main>
<!-- End #main -->
<br>

<!-- ======= Footer ======= -->

<?php
include("footer.php");
?>
<!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/jquery.stellar.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>


</body>

</html>