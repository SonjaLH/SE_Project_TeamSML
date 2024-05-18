<?php

session_start();
require_once __DIR__ . '/../services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/../services/carService.php';
$carService = new CarService();
require_once __DIR__ . '/../services/bookingService.php';
$bookingService = new BookingService();

if (isset($_SESSION["user-email"])) {
    if (($_SESSION["user-email"]) == "" or $_SESSION['user-type'] != 'c') {
        header("location: ../start/login.php");
    }

} else {
    header("location: ../start/login.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $carID = $_POST['car_id'];

    $car = $carService->getCarById($carID)->fetch_assoc();


    $userC = $userService->getUserByEmail($_SESSION["user-email"])->fetch_assoc();
    $pickDate = $_POST['pickDate'];
    $dropDate = $_POST['dropDate'];

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

    echo "Total cost for rental: " . $total;


    if ($bookingService->addBooking($carID, $userC["user_id"], $pickDate, $dropDate, $total)) {
        // Insertion successful
        echo "<center><h1>Appointment booked successfully.</h1> <a href='./'><button class='btn-success'>OK</button></a></center>";
    } else {
        // Error occurred
        echo "Error:booking  ";
    }


}

?>

