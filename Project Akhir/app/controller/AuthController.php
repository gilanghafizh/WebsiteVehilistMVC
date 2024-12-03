<?php
require_once '../app/model/UserModel.php';
require_once '../app/model/KendaraanModel.php';

class AuthController {
    private $userModel;
    private $kendaraanModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->kendaraanModel = new KendaraanModel();
    }

    public function login() {
        $error_message = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);

            if ($user) {
                $_SESSION['username'] = $username;
                
                header("Location: index.php?action=index");
                exit();
            } else {
                $error_message = "Username atau Password salah!";
            }
        }

        require '../app/view/login.php';
    }

    public function register() {
        $error_message = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->userModel->register($username, $password);

            if ($result['success']) {
                $_SESSION['register_success'] = $result['message'];
                header("Location: index.php?action=login");
                exit();
            } else {
                $error_message = $result['message'];
            }
        }

        require '../app/view/register.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }

    public function index() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $kendaraan = $this->kendaraanModel->getAllKendaraan();

        require '../app/view/index.php';
    }
}
?>