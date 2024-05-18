</center>
<?php
session_start();
date_default_timezone_set('Europe/Amsterdam');
$date = date('Y-m-d');

$_SESSION["date"] = $date;

require_once __DIR__ . '/../services/userService.php';
$userService = new UserService();

if ($_POST) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $reg_date = date('Y-m-d');
    $tel = $_POST['telephone'];
    $newpassword = $_POST['new_password'];
    $cpassword = $_POST['c_password'];

    if ($cpassword != " ") {
        if ($newpassword === $cpassword) {

            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

            if ($userService->getUserByEmail($email)->num_rows != 0) {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
            } else {
                $res = $userService->createCustomer($name, $surname, $email, $address, $username, $tel, $hashedPassword, 'c');

                if ($res) {
                    $_SESSION["user-email"] = $email;
                    $_SESSION["usertype"] = 'c';
                    $_SESSION["username"] = $username;
                    echo "user registered successfully ";
                    header('Location: ../customer/index.php');
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Registration failed. Please try again.</label>';
                    echo $error;
                }
            }
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconfirm Password</label>';
            echo $error;
        }
    }


} else {
    $error = '<label for="promter" class="form-label"></label>';
    echo $error;

}

?>

