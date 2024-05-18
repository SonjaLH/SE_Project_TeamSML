<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a' and $_SESSION['usertype'] != 'd' ) {
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
    $newnic = $_POST['nic'];
    $oldemail = $_POST["oldemail"];
    $newspec = $_POST['spec'];
    $newemail = $_POST['email'];
    $newtele = $_POST['Tele'];
    $newpassword = $_POST['password'];
    $newcpassword = $_POST['cpassword'];
    $id = $_POST['id'];
    if ($newpassword == $newcpassword) {
//
        if ($newpassword != "") {
            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $userService->updateUserD($id, $newname, $newsurname, $newnic, $newspec, $newemail, $newtele, $hashedPassword);

        } else {
            $hashedPassword = "";
            $userService->updateUserD($id, $newname, $newsurname, $newnic, $newspec, $newemail, $newtele, $hashedPassword);
        }
    } else {
        echo "Password dont match";

    }
}


?>
