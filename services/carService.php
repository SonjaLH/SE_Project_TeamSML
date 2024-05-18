<?php

use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . '/../db/dbconfig.php';
require_once __DIR__ . '/bookingService.php';

class CarService
{
    private $db;
    private BookingService $bookingService;

    public function __construct()
    {
        $this->db = Database::getConnection();
        $this->bookingService = new BookingService();
    }

    // Create a new car

    public function addCar($make, $model, $type, $year, $color, $mileage, $price_per_day, $available, $fileUrls): bool
    {
        $query = "INSERT INTO car ( make, model, year, color, mileage, price_per_day, available,type) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param("ssisidis", $make, $model, $year, $color, $mileage, $price_per_day, $available, $type);
        $res = $statement->execute();
        $close = $statement->close();
        if ($res) {
            $last_id = $this->db->insert_id;
            foreach ($fileUrls as $fileUrl) {
                $res = $this->addimg($last_id, $fileUrl);
            }
        }
        if ($res) {
            $this->redirect("./");

        }
        return $res;

    }

    // Read a car by ID
    public function getCarById($carId)
    {

        $query = "SELECT * FROM car WHERE car_id=?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $carId);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }

    // Update a car
    public
    function updateCar($carId, $make, $model, $year, $color, $mileage, $pricePerDay, $available)
    {
        $query = "UPDATE car SET make=?, model=?, year=?, color=?, mileage=?, price_per_day=?, available=? WHERE car_id=?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("ssiisidi", $make, $model, $year, $color, $mileage, $pricePerDay, $available, $carId);
        $statement->execute();
        $statement->close();
    }

    // Delete a car
    public function deleteCar($carId)

    {
        if ($this->deleteCarImages($carId)) {
            $query = "DELETE FROM car WHERE car_id=?";
            $statement = $this->db->prepare($query);
            $statement->bind_param("i", $carId);
            $statement->execute();

            return $statement;
            $statement->close();
        } else return false;


    }

    public function deleteCarImages($carId): bool|mysqli_stmt
    {
        $query = "DELETE FROM carimg WHERE car_id=?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $carId);
        $statement->execute();
        return $statement;
        $statement->close();

    }


    private function addimg(int|string $last_car_id, mixed $fileUrl): bool
    {
        $query = "INSERT INTO carimg ( car_id, image_url) VALUES (?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param("is", $last_car_id, $fileUrl);
        $res = $statement->execute();
        $statement->close();
        return $res;
    }


    #[NoReturn] function redirect($url, $permanent = false): void
    {
        if (headers_sent() === false) {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }
        exit();
    }

    public function getCars(): mysqli_result|bool
    {
        $sql = "SELECT * FROM car";
        return $this->db->query($sql);
    }

    public function getCarImages($car_id): mysqli_result|bool
    {
        $sql = "SELECT * FROM carimg where car_id=$car_id";
        return $this->db->query($sql);
    }

    public function getAvCars($pickDate, $dropDate): mysqli_result|bool
    {


        return $this->db->query("SELECT car.*, r.*
                             FROM car 
                             INNER JOIN reservation r on car.car_id = r.car_id 
where (r.start_date >= '$pickDate' && r.start_date <= '$dropDate') or
                (r.end_date >= '$pickDate' && r.end_date <= '$dropDate') or
                (r.start_date <= '$pickDate' && r.end_date >= '$dropDate');");

    }

    public function getCarsByType($type): mysqli_result|bool
    {
        $sql = "SELECT * FROM car where type='$type'";
        return $this->db->query($sql);

    }

}

?>
