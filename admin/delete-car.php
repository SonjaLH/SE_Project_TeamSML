<?php

session_start();
require_once __DIR__ . '/../services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/../services/bookingService.php';
$bookService = new BookingService();
require_once __DIR__ . '/../services/carService.php';
$carService = new CarService();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a' or $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}


if ($_GET) {
    //import database
    $id = $_GET["id"];
    $carService->deleteCar($id);


    $carBookings = $bookService->getBookingsbyCarID($id)->fetch_assoc();

    while ($carBookings) {
        header("location: delete-booking.php?action=drop%id='.$id.'");

    }
    header("location: index.php");


}


?>