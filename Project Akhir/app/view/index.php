<?php
// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php?action=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kendaraan</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        /* Gunakan style dari kode asli Anda */
        @font-face {
            font-family: 'MonumentExtended-Ultrabold';
            src: url('fonts/MonumentExtended-Ultrabold.ttf') format('truetype');
            font-weight: normal;
            font-size: normal;
        }

        @font-face {
            font-family: 'MonumentExtended-Regular';
            src: url('fonts/MonumentExtended-Regular.ttf') format('truetype');
            font-weight: normal;
            font-size: normal;
        }

        @font-face {
            font-family: 'AktivGrotesk-Light';
            src: url('fonts/AktivGrotesk-Light.ttf') format('truetype');
            font-weight: normal;
            font-size: normal;
        }

        @font-face {
            font-family: 'AktivGrotesk-Medium';
            src: url('fonts/AktivGrotesk-Medium.ttf') format('truetype');
            font-weight: normal;
            font-size: normal;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1 style="margin: 0;">VEHILIST</h1>
        <a href="index.php?action=logout" class="logout-btn">Logout</a>
    </div>

    <h1>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <!-- Grid container untuk daftar kendaraan -->
    <div class="grid-container <?php echo (empty($kendaraan) ? 'empty' : ''); ?>">
        <?php if (!empty($kendaraan)) { ?>
            <?php foreach ($kendaraan as $row) { ?>
                <div class="vehicle-card">
                    <img src="uploads/<?php echo basename($row['image']); ?>" alt="<?php echo $row['name']; ?>">
                    <h2><?php echo $row['name']; ?></h2>
                    <div class="actions">
                    <a href="index.php?action=edit_kendaraan&id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="index.php?action=hapus_kendaraan&id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">Hapus</a>
                    <a href="index.php?action=detail_kendaraan&id=<?php echo $row['id']; ?>">Detail</a>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="message">Tabel kosong, silahkan tambahkan kendaraan!</p>
        <?php } ?>
    </div>

    <!-- Tombol tambahkan kendaraan baru di tengah bawah -->
    <div class="add-vehicle-container">
    <a href="index.php?action=tambah_kendaraan" class="add-vehicle-btn">Tambahkan kendaraan baru</a>
    </div>
</body>
</html>