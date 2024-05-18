<?php

session_start();
require_once __DIR__ . '/userService.php';
$userService = new UserService();
require_once __DIR__ . '/appointmentService.php';
$appointmentService = new AppointmentService();
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
    $userService->deleteUserD($id);


    $myappointments = $appointmentService->listAppointmentsByDocId($id);

    while ($myappointments) {
        header("location: delete-appointments.php?action=drop%id='.$id.'");

    }
    header("location: doctors.php");


}


?>