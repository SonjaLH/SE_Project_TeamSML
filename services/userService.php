<?php
// Include the database configuration file
require_once __DIR__ . '/../db/dbconfig.php';

class UserService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    // Create a new user
    public function createCustomer($name, $surname, $email, $address, $username, $tel, $hashedPassword, $usertype): bool
    {
        // Insert into user table using prepared statement
        $stmt = $this->db->prepare("INSERT INTO `user` (`username`, `password`, `first_name`, `last_name`, `email`, `user_type`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $username, $hashedPassword, $name, $surname, $email, $usertype);
        $result = $stmt->execute();

        if ($result) {
            $last_id = $this->db->insert_id;

            // Insert into customer table using prepared statement
            $stmt = $this->db->prepare("INSERT INTO `customer` (`user_id`, `phone_number`, `address`) VALUES (?, ?, ?)");
            $stmt->bind_param('iss', $last_id, $tel, $address);
            $mysqli_result = $stmt->execute();

            if ($mysqli_result) {
                return true;
            } else {
                // Rollback user creation if customer creation fails
                $this->deleteUser($last_id);
                return false;
            }
        } else {
            return false;
        }
    }

    public function createUserD($name, $surname, $email, $address, $city, $clinic, $tel, $speID, $hashedPassword, $usertype)
    {
        // Insert into user table
        $result = $this->db->query(sprintf("INSERT INTO `user` (`email`, `password`, `usertype`) VALUES ('%s', '%s', '%s')", $email, $hashedPassword, $usertype));

        if ($result) {
            $last_id = $this->db->insert_id;
            // Insert into doctor table
            $mysqli_result = $this->db->query(sprintf("INSERT INTO `doctor` (`id`, `name`, `surname`, `docclinic`, `address`, `city`, `specialties`, `telephone`) VALUES ('%d', '%s', '%s', '%s', '%s', '%s', '%d', '%d')", $last_id, $name, $surname, $clinic, $address, $city, $speID, $tel));

            if ($mysqli_result) {
                return $mysqli_result;
            } else {
                // Rollback user creation if doctor creation fails
                $this->deleteUser($last_id);
            }
        } else {
            return $result;
        }
    }


    // Read a user
    public function getUser($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUserByEmail($email): bool|mysqli_result
    {
        $sqlmain = "select * from user where email=?;";
        $stmt = $this->db->prepare($sqlmain);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();

    }

    // Update a user
    public function updateUser($id, $newEmail, $type, $newpassword)
    {
        $newEmail = $this->db->real_escape_string($newEmail);
        $type = $this->db->real_escape_string($type);

        if ($newpassword !== "") {
            $newpassword = $this->db->real_escape_string($newpassword);
            $sql = "UPDATE user SET usertype = '$type', email = '$newEmail', password = '$newpassword' WHERE id = $id";
        } else {
            $sql = "UPDATE user SET usertype = '$type', email = '$newEmail' WHERE id = $id";
        }

        return $this->db->query($sql);
    }


    // Delete a user
    public function deleteUser($id)

    {
        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();

        return $result;
    }

    public function deleteUserD($id)
    {
        $sql = "DELETE FROM doctor WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        if ($result) {
            $this->deleteUser($id);
        }

    }

    public function deleteUserP($id)
    {
        $sql = "DELETE FROM patient WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        if ($result) {
            $this->deleteUser($id);
        }
    }


    // List all users
    public function listUsers(): array
    {
        $sql = "SELECT * FROM user";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPatients()
    {
        return $this->db->query("SELECT patient.*,user.* FROM patient 
                             INNER JOIN user ON patient.id = user.id;");
    }

    public function getPatientByEmail($email)
    {
        return $this->db->query("SELECT patient.*,user.* FROM patient 
                             INNER JOIN user ON patient.id = user.id 
                             WHERE user.email='$email';");
    }


    public function getDoctorByEmail($email)
    {
        return $this->db->query("SELECT doctor.* ,user.* FROM doctor 
                             INNER JOIN user ON doctor.id = user.id 
                             WHERE user.email='$email';");
    }

    public function getAdminByEmail($email)
    {
        return $this->db->query("select * from admin where email='$email';");
    }


    public function searchDoctors($keyword)
    {
        return $this->db->query("SELECT doctor.*, user.email 
                             FROM doctor 
                             INNER JOIN user 
                                 ON doctor.id = user.id 
where email='$keyword' or name='$keyword' or name like '$keyword%' or name like '%$keyword' or name like '%$keyword%';");

    }

    public function searchPatients($keyword)
    {
        return $this->db->query("SELECT patient.*, user.email 
                             FROM patient 
                             INNER JOIN user 
                                 ON patient.id = user.id 
where email='$keyword' or name='$keyword' or name like '$keyword%' or name like '%$keyword' or name like '%$keyword%';");


    }

    public function searchMyAppointments($keyword)
    {
        return $this->db->query("SELECT *,
                             FROM appointment 
                         
where app_id='$keyword' or doc_id='$keyword' or id like '$keyword%' or name like '%$keyword' or name like '%$keyword%';");

    }

    public function searchMyPatients($docId, $keyword)
    {
        return $this->db->query("SELECT patient.*, user.email 
                             FROM patient 
                             INNER JOIN user 
                                 ON patient.id = user.id 
where email='$keyword' or name='$keyword' or name like '$keyword%' or name like '%$keyword' or name like '%$keyword%';");


    }

    public function getDoctors()
    {
        return $this->db->query("SELECT doctor.*, user.email 
                             FROM doctor 
                             INNER JOIN user ON doctor.id = user.id  order by  doctor.id desc;");
    }


    public function getSpecialities()
    {
        return $this->db->query("SELECT * FROM specialties;");
    }

    public function getSpecialitieById($id)
    {
        return $this->db->query("SELECT * FROM specialties where id='$id';");
    }

    public function updateUserD($id, $name, $surname, $clinic, $spec, $email, $tele, $hashedPassword): bool
    {
        $result = false;
        if ($this->updateUser($id, $email, "d", $hashedPassword)) {
            $name = $this->db->real_escape_string($name);
            $surname = $this->db->real_escape_string($surname);
            $clinic = $this->db->real_escape_string($clinic);
            $spec = $this->db->real_escape_string($spec);
            $tele = $this->db->real_escape_string($tele);
            $sql = "UPDATE doctor SET name = '$name', surname = '$surname', docclinic = '$clinic', specialties = '$spec', telephone = '$tele' WHERE id = $id";
            $result = $this->db->query($sql);
            if ($this->getUser($id)->fetch_assoc()["usertype"] == 'a') {
                header('Location: ../views/admin/doctors.php');
            } else {
                header('Location: ../views/doctor/settings.php');

            }


        }
        return $result;
    }

    public function updateUserP($id, $newname, $newsurname, $newaddress, $newcity, $newemail, $tel, ?bool $hashedPassword)
    {
        $result = false;
        if ($this->updateUser($id, $newemail, "p", $hashedPassword)) {
            $name = $this->db->real_escape_string($newname);
            $surname = $this->db->real_escape_string($newsurname);
            $addr = $this->db->real_escape_string($newaddress);
            $city = $this->db->real_escape_string($newcity);
            $tele = $this->db->real_escape_string($tel);
            $sql = "UPDATE patient SET name = '$name', surname = '$surname', city = '$city',  ptel = '$tele' WHERE id = $id";
            $result = $this->db->query($sql);
            if ($this->getUser($id)->fetch_assoc()["usertype"] == 'a') {
                header('Location: ../views/admin/doctors.php');
            } else {
                header('Location: ../views/patient/settings.php');

            }


        }
        return $result;
    }

    public function getMyPatients($id)
    {

        return $this->db->query("select patient.* from patient JOIN appointment ON appointment.id=patient.id where doc_id='$id';");


    }

    public function getMyAppointmets($id, $usertype)
    {
        if ($usertype == "d") {
            $sqlq = "select  * from  appointment where doc_id='$id';";
        } else {
            $sqlq = "select  * from  appointment where id='$id';";
        }

        return $this->db->query($sqlq);
    }


}

?>
