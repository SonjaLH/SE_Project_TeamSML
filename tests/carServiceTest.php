<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../db/dbconfig.php';
require_once __DIR__ . '/../services/CarService.php';

class CarServiceTest extends TestCase {
    private $carService;

    protected function setUp(): void {
        $this->carService = new CarService();
    }

    public function testAddCar() {
        $ownerId = 1;
        $make = 'Toyota';
        $model = 'Corolla';
        $year = 2020;
        $color = 'Blue';
        $mileage = 10000;
        $pricePerDay = 50.0;
        $available = true;

        $this->carService->addCar($ownerId, $make, $model, $year, $color, $mileage, $pricePerDay, $available);
        $car = $this->carService->getCarById($ownerId);

        $this->assertNotEmpty($car);

    }

//

    public function testDeleteCar() {
        $carId = 1;

        $this->carService->deleteCar($carId);
        $deletedCar = $this->carService->getCarById($carId);

        $this->assertNotEmpty($deletedCar);
    }
}

?>
