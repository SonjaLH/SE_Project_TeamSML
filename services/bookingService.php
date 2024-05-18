<?php

require_once __DIR__ . '/../db/dbconfig.php';

class BookingService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Create a new booking
    public function bookCar($carId, $customerId, $startDate, $endDate, $totalCost)
    {
        $query = "INSERT INTO Reservation (car_id, customer_id, start_date, end_date, total_cost) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param("iissd", $carId, $customerId, $startDate, $endDate, $totalCost);
        $statement->execute();
        $statement->close();
    }

    public function getBooking($reservationId)
    {
        $query = "SELECT * FROM Reservation WHERE reservation_id = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $reservationId);
        $statement->execute();
        $result = $statement->get_result();
        $booking = $result->fetch_assoc();
        $statement->close();
        return $booking;
    }

    // Read all bookings
    public function getAllBookings(): mysqli_result|bool
    {
        $query = "SELECT * FROM reservation";
        return $this->db->query($query);
    }

    // Update a booking
    public function updateBooking($reservationId, $startDate, $endDate, $totalCost)
    {
        $query = "UPDATE Reservation SET start_date=?, end_date=?, total_cost=? WHERE reservation_id=?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("ssdi", $startDate, $endDate, $totalCost, $reservationId);
        $statement->execute();
        $statement->close();
    }

    // Delete a booking
    public function deleteBooking($reservationId)
    {
        $query = "DELETE FROM reservation WHERE reservation_id=?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("i", $reservationId);
        $statement->execute();
        $statement->close();

    }

    public function addBooking($carId, $costumerId, $sDate, $eDate, $total): bool
    {
        $sql = "INSERT INTO Reservation (car_id, customer_id, start_date, end_date,total_cost) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iissd", $carId, $costumerId, $sDate, $eDate, $total);
        $result = $stmt->execute();

        $stmt->close();
        return $result;

    }


    public
    function getMyBookings($cid): mysqli_result|bool
    {
        $sql = "SELECT * FROM reservation  where customer_id='" . $cid . "';";
        return $this->db->query($sql);
    }


    public function getBookingsbyCarID(mixed $id): mysqli_result|bool
    {

        $sql = "SELECT * FROM reservation  where car_id='" . $id . "';";
        $result = $this->db->query($sql);
        return $result;
    }

}

?>
