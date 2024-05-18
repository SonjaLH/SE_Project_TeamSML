<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a' and $_SESSION['usertype'] != 'p') {
        header("location: ../views/pages/login.php");
    }

} else {
    header("location: ../views/pages/login.php");
}

require_once 'userService.php';
$userService = new UserService();
require_once 'appointmentService.php';
$appointmentService = new AppointmentService();
if ($_POST) {
    $newname = $_POST['name'];
    $newsurname = $_POST['surname'];
    $oldemail = $_POST["oldemail"];
    $newemail = $_POST['email'];
    $newpassword = $_POST['password'];
    $newcpassword = $_POST['cpassword'];
    $id = $_POST['id'];
    $tel = $_POST['telephone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    if ($newpassword == $newcpassword) {
//
        if ($newpassword != "") {
            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $userService->updateUserP($id, $newname, $newsurname, $address, $city, $newemail, $tel, $hashedPassword);

        } else {
            $hashedPassword = "";
            $userService->updateUserP($id, $newname, $newsurname, $address, $city, $newemail, $tel, $hashedPassword);
        }
    } else {
        echo "Password dont match";

    }
}


?>
