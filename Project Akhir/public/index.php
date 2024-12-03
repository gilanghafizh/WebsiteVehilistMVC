<?php
session_start();
require_once '../app/controller/AuthController.php';
require_once '../app/controller/KendaraanController.php';

// Autoload classes
spl_autoload_register(function ($class) {
    $filename = str_replace('\\', '/', $class) . '.php';
    if (file_exists('app/' . $filename)) {
        require_once 'app/' . $filename;
    }
});

$kendaraanController = new KendaraanController();

// Router sederhana
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$action = $_GET['action'] ?? 'login';
$controller = new AuthController();


switch ($action) {
    case 'login':
        $controller->login();
        break;
    case 'register':
        $controller->register();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'index':
        $controller->index();
        break;
    case 'tambah_kendaraan':
        $kendaraanController->tambahKendaraan();
        break;
    case 'edit_kendaraan':
        $kendaraanController->editKendaraan();
        break;
    case 'proses_edit_kendaraan':
        $kendaraanController->prosesEditKendaraan();
        break;
    case 'detail_kendaraan':
        $kendaraanController->detailKendaraan();
        break;
    case 'hapus_kendaraan':
        $kendaraanController->hapusKendaraan();
        break;
    default:
        // Redirect atau tampilkan error
        header("Location: index.php?action=login");
        break;
}