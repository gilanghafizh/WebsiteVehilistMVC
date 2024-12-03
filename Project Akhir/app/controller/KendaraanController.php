<?php
require_once '../app/model/KendaraanModel.php';

class KendaraanController {
    private $kendaraanModel;

    public function __construct() {
        $this->kendaraanModel = new KendaraanModel();
    }

    public function index() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }
    
        $kendaraan = $this->kendaraanModel->getAllKendaraan();
    
        require '../app/view/index.php';
    }
    public function tambahKendaraan() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $error_message = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $type = $_POST['type'];
            $year = $_POST['year'];
            $price = $_POST['price'];
            $plate_number = $_POST['plate_number'];

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $result = $this->kendaraanModel->tambahKendaraan([
                    'name' => $name,
                    'type' => $type,
                    'year' => $year,
                    'price' => $price,
                    'plate_number' => $plate_number,
                    'image' => $target_file
                ]);

                if ($result) {
                    header("Location: index.php?action=index");
                    exit();
                } else {
                    $error_message = "Gagal menyimpan data kendaraan.";
                }
            } else {
                $error_message = "Gagal mengupload gambar.";
            }
        }

        require '../app/view/tambah_kendaraan.php';
    }

    public function editKendaraan() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?action=index");
            exit();
        }

        $kendaraan = $this->kendaraanModel->getKendaraanById($id);

        if (!$kendaraan) {
            header("Location: index.php?action=index");
            exit();
        }

        require '../app/view/edit_kendaraan.php';
    }

    public function prosesEditKendaraan() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $error_message = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $type = $_POST['type'];
            $year = $_POST['year'];
            $price = $_POST['price'];
            $plate_number = $_POST['plate_number'];

            $kendaraan_lama = $this->kendaraanModel->getKendaraanById($id);

            $target_file = $kendaraan_lama['image'];

            if (!empty($_FILES["image"]["name"])) {
                $target_dir = "uploads/";
                
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $unique_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $unique_filename;

                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $error_message = "Gagal mengupload gambar baru.";
                    require '../app/view/edit_kendaraan.php';
                    exit();
                }

                if ($kendaraan_lama['image'] != $target_file) {
                    @unlink($kendaraan_lama['image']);
                }
            }

            $data_update = [
                'name' => $name,
                'type' => $type,
                'year' => $year,
                'price' => $price,
                'plate_number' => $plate_number,
                'image' => $target_file
            ];

            $result = $this->kendaraanModel->updateKendaraan($id, $data_update);

            if ($result) {
                header("Location: index.php?action=index");
                exit();
            } else {
                $error_message = "Gagal mengupdate data kendaraan.";
            }
        }

        require '../app/view/edit_kendaraan.php';
    }

    public function detailKendaraan() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }
    
        $id = $_GET['id'] ?? null;
    
        if (!$id) {
            header("Location: index.php?action=index");
            exit();
        }
    
        $kendaraan = $this->kendaraanModel->getKendaraanById($id);
    
        if (!$kendaraan) {
            header("Location: index.php?action=index");
            exit();
        }
    
        require '../app/view/detail_kendaraan.php';
    }

    public function hapusKendaraan() {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login");
            exit();
        }
    
        $id = $_GET['id'] ?? null;
    
        if (!$id) {
            header("Location: index.php?action=index");
            exit();
        }
    
        $result = $this->kendaraanModel->hapusKendaraan($id);
    
        if ($result) {
            $_SESSION['message'] = "Kendaraan berhasil dihapus.";
        } else {
            $_SESSION['error'] = "Gagal menghapus kendaraan.";
        }
    
        header("Location: index.php?action=index");
        exit();
    }
}
?>