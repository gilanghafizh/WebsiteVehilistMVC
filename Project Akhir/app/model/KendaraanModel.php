<?php
require_once '../app/config/database.php';

class KendaraanModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function getAllKendaraan() {
        $sql = "SELECT * FROM kendaraan";
        $result = $this->conn->query($sql);
        
        $kendaraan = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kendaraan[] = $row;
            }
        }
        
        return $kendaraan;
    }

    public function getKendaraanById($id) {
        $id = $this->conn->real_escape_string($id);
        $sql = "SELECT * FROM kendaraan WHERE id = '$id'";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }

    public function tambahKendaraan($data) {
        $name = $this->conn->real_escape_string($data['name']);
        $type = $this->conn->real_escape_string($data['type']);
        $year = $this->conn->real_escape_string($data['year']);
        $price = $this->conn->real_escape_string($data['price']);
        $plate_number = $this->conn->real_escape_string($data['plate_number']);
        $image = $this->conn->real_escape_string($data['image']);

        $sql = "INSERT INTO kendaraan (name, type, year, price, plate_number, image) 
                VALUES ('$name', '$type', '$year', '$price', '$plate_number', '$image')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateKendaraan($id, $data) {
        $name = $this->conn->real_escape_string($data['name']);
        $type = $this->conn->real_escape_string($data['type']);
        $year = $this->conn->real_escape_string($data['year']);
        $price = $this->conn->real_escape_string($data['price']);
        $plate_number = $this->conn->real_escape_string($data['plate_number']);
        $image = $this->conn->real_escape_string($data['image']);

        $sql = "UPDATE kendaraan 
                SET name='$name', 
                    type='$type', 
                    year='$year', 
                    price='$price', 
                    plate_number='$plate_number', 
                    image='$image' 
                WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusKendaraan($id) {
        $kendaraan = $this->getKendaraanById($id);
        
        if (!$kendaraan) {
            return false;
        }
    
        if (!empty($kendaraan['image']) && file_exists($kendaraan['image'])) {
            @unlink($kendaraan['image']);
        }
    
        $stmt = $this->conn->prepare("DELETE FROM kendaraan WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        $result = $stmt->execute();
        
        $stmt->close();
        
        return $result;
    }

}
?>