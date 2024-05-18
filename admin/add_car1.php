<?php
session_start();
require_once __DIR__ . '/../services/userService.php';
$userService = new UserService();
require_once __DIR__ . '/../services/authService.php';
$authService = new AuthService();
require_once __DIR__ . '/../services/carService.php';
$carService = new CarService();

if (isset($_SESSION["user-email"])) {
    if (($_SESSION["user-email"]) == "" and $_SESSION["user-type"] != 'a') {
        header("location: ../start/login.php", true);
    }

} else {
    header("location: ../start/login.php", true);
}

if (isset($_POST['submit'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $color = $_POST['color'];
    $mileage = $_POST['mileage'];
    $price_per_day = $_POST['price_per_day'];
    $available = $_POST['available'];
    $fileUrls = [];
    $target_dir = "../assets/img/cars/";
    $uploadOk = 1;


    foreach ($_FILES["files"]["name"] as $key => $name) {
        // Get the file extension
        $imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        // Generate a unique name for the file
        $newFileName = $make . '-' . $model . '-' . $mileage . uniqid('img_', true) . '.' . $imageFileType;
        $allowed_formats = ["jpg", "jpeg", "png", "gif"];

        // Target file path
        $target_file = $target_dir . $newFileName;

        // Check if the file is an actual image
        $check = getimagesize($_FILES["files"]["tmp_name"][$key]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES["files"]["size"][$key] > 5000000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, $allowed_formats)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file " . htmlspecialchars($name) . " was not uploaded.<br>";
            // If everything is okay, try to upload the file
        } else {
            if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_file)) {
                array_push($fileUrls, $target_file);
                echo "The file " . htmlspecialchars($name) . " has been uploaded as " . $newFileName . ".<br>";
            } else {
                echo "Sorry, there was an error uploading your file " . htmlspecialchars($name) . ".<br>";
            }
        }
    }
    if ($uploadOk == 1) {
        if ($carService->addCar($make, $model,$type, $year, $color, $mileage, $price_per_day, $available, $fileUrls)) {
            echo "Car added successfully";
            $fileUrls = [];
            $make = "";
            $model = "";
            $year = "";
            $color = "";
            $mileage = "";
            $price_per_day = "";
            $available = "";
            $carService->redirect("./");
        } else {
            echo "Error adding Car ";

        }
    }


}

include("../footer.php");


?>
