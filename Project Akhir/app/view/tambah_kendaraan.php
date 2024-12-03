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
    <title>Tambah Kendaraan</title>
    <link rel="stylesheet" href="css/insert.css">
    <style>
        @font-face {
            font-family: 'MonumentExtended-Ultrabold';
            src: url('fonts/MonumentExtended-Ultrabold.ttf') format('truetype');
            font-weight: normal;
            font-size: normal;
        }

        @font-face {
            font-family: 'AktivGrotesk-Medium';
            src: url('fonts/AktivGrotesk-Medium.ttf') format('truetype');
            font-weight: normal;
            font-size: normal;
        }

        @font-face {
            font-family: 'AktivGrotesk-Light';
            src: url('fonts/AktivGrotesk-Light.ttf') format('truetype');
            font-weight: normal;
            font-size: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>TAMBAHKAN KENDARAAN</h1>
        <h3>Silahkan isi data mengenai kendaraan yang ingin ditambahkan</h3>

        <?php 
        // Tampilkan pesan error jika ada
        if (!empty($error_message)) {
            echo "<p class='error-message'>" . htmlspecialchars($error_message) . "</p>";
        }
        ?>

        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <th class="label">Nama Kendaraan:</th>
                    <td class="input"><input type="text" name="name" placeholder="Nama Kendaraan" required></td>
                </tr>
                <tr>
                    <th class="label">Jenis Kendaraan:</th>
                    <td class="input"><input type="text" name="type" placeholder="Jenis Kendaraan" required></td>
                </tr>
                <tr>
                    <th class="label">Nomor Plat:</th>
                    <td class="input"><input type="number" name="plate_number" placeholder="Nomor Plat" required></td>
                </tr>
                <tr>
                    <th class="label">Tahun:</th>
                    <td class="input"><input type="number" name="year" placeholder="Tahun" required></td>
                </tr>
                <tr>
                    <th class="label">Harga Kendaraan:</th>
                    <td class="input"><input type="number" step="0.01" name="price" placeholder="Harga Kendaraan" required></td>
                </tr>
                <tr>
                    <th class="label">Gambar Kendaraan:</th>
                    <td class="input"><input type="file" name="image" required></td>
                </tr>
                <tr class="submit-button">
                    <td colspan="2"><input type="submit" value="Tambahkan Kendaraan"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>