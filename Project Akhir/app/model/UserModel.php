<?php
require_once '../app/config/database.php';

class UserModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function register($username, $password) {
        if (empty($username) || empty($password)) {
            return [
                'success' => false, 
                'message' => 'Username dan password tidak boleh kosong'
            ];
        }
    
        $check_sql = "SELECT * FROM users WHERE username = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
    
        if ($check_result->num_rows > 0) {
            return [
                'success' => false, 
                'message' => 'Username sudah digunakan'
            ]; 
        }
    
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $hashed_password);
        
        if ($stmt->execute()) {
            return [
                'success' => true, 
                'message' => 'Registrasi berhasil! Silakan login.'
            ];
        } else {
            return [
                'success' => false, 
                'message' => 'Gagal melakukan registrasi'
            ];
        }
    }
}
?>