<?php
require_once __DIR__ . '/../services/BookingService.php'; // Assuming your class is in BookingService.php
use PHPUnit\Framework\TestCase;

class BookingServiceTest extends TestCase {
    private $db;
    private $bookingService;

    public function setUp() :void{
        $this->db = Database::getConnection();
        if ($this->db->connect_error) {
            die('Cannot connect to db: ' . $this->db->connect_error);
        }
        $this->bookingService = new BookingService();
    }



    public function testBookCar() {
        $carId = 1;
        $customerId = 3;
        $startDate = '2024-05-01';
        $endDate = '2024-05-10';
        $totalCost = 100.0;

        $this->bookingService->bookCar($carId, $customerId, $startDate, $endDate, $totalCost);
        $bookings = $this->bookingService->getAllBookings();

        $this->assertNotEmpty($bookings);

    }

    public function testGetBooking() {
        $booking = $this->bookingService->getBooking(11);
        $this->assertEquals(11, $booking['reservation_id']);
    }




    public function testGetAllBookings() {
        // Call the method
        $bookings = $this->bookingService->getAllBookings();

        // Assert that bookings array is not empty
        $this->assertNotEmpty($bookings);
    }

    public function testUpdateBooking() {
        // Create a new booking for testing update
        $carId = 2;
        $customerId = 2;
        $startDate = '2024-06-01';
        $endDate = '2024-06-05';
        $totalCost = 700.00;
        $this->bookingService->bookCar($carId, $customerId, $startDate, $endDate, $totalCost);

        // Update the booking
        $newStartDate = '2024-06-02';
        $newEndDate = '2024-06-06';
        $newTotalCost = 750.00;
        $bookings = $this->bookingService->getAllBookings();
        $bookingToUpdate = end($bookings);
        $this->bookingService->updateBooking($bookingToUpdate['reservation_id'], $newStartDate, $newEndDate, $newTotalCost);

        // Fetch the updated booking and assert its new values
        $updatedBooking = $this->bookingService->getAllBookings();
        $this->assertEquals($newStartDate, $updatedBooking[count($updatedBooking) - 1]['start_date']);
        $this->assertEquals($newEndDate, $updatedBooking[count($updatedBooking) - 1]['end_date']);
        $this->assertEquals($newTotalCost, $updatedBooking[count($updatedBooking) - 1]['total_cost']);
    }

    public function testDeleteBooking() {
        // Create a new booking for testing deletion
        $carId = 3;
        $customerId = 3;
        $startDate = '2024-07-01';
        $endDate = '2024-07-05';
        $totalCost = 800.00;
        $this->bookingService->bookCar($carId, $customerId, $startDate, $endDate, $totalCost);

        // Delete the booking
        $bookingsBeforeDelete = $this->bookingService->getAllBookings();
        $bookingToDelete = end($bookingsBeforeDelete); // Get the last booking
        $this->bookingService->deleteBooking($bookingToDelete['reservation_id']);

        // Fetch all bookings after deletion and assert that the deleted booking is not present
        $bookingsAfterDelete = $this->bookingService->getAllBookings();
        $this->assertNotContains($bookingToDelete, $bookingsAfterDelete);
    }


}
?>
