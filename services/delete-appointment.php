<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a' and $_SESSION['usertype'] != 'd' and $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}
require_once __DIR__ . '/userService.php';
$userService = new UserService();
require_once __DIR__ . '/appointmentService.php';
$appointmentService = new AppointmentService();

if ($_GET) {
    //import database
    $id = $_GET["id"];

    $appointmentService->deleteAppointment($id, $_SESSION['usertype']);
}


?>