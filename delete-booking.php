<?php

session_start();
require_once __DIR__ . '/services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/services/bookingService.php';
$bookService = new BookingService();
require_once __DIR__ . '/services/carService.php';
$carService = new CarService();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a' or $_SESSION['usertype'] != 'c') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}


if ($_GET) {
    //import database
    $id = $_GET["id"];
    $bookService->deleteBooking($id);
    header("location: index.php");


}


?>