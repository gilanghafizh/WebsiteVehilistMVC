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
    <title>Edit Kendaraan</title>
    <link rel="stylesheet" href="css/update.css">
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
        <h1>EDIT KENDARAAN</h1>
        <form method="post" enctype="multipart/form-data" action="index.php?action=proses_edit_kendaraan">
            <input type="hidden" name="id" value="<?php echo $kendaraan['id']; ?>">
            <table>
                <tr>
                    <th class="label">Nama Kendaraan:</th>
                    <td class="input"><input type="text" name="name" value="<?php echo htmlspecialchars($kendaraan['name']); ?>" required></td>
                </tr>
                <tr>
                    <th class="label">Jenis Kendaraan:</th>
                    <td class="input"><input type="text" name="type" value="<?php echo htmlspecialchars($kendaraan['type']); ?>" required></td>
                </tr>
                <tr>
                    <th class="label">Nomor Plat:</th>
                    <td class="input"><input type="text" name="plate_number" value="<?php echo htmlspecialchars($kendaraan['plate_number']); ?>" required></td>
                </tr>
                <tr>
                    <th class="label">Tahun:</th>
                    <td class="input"><input type="number" name="year" value="<?php echo htmlspecialchars($kendaraan['year']); ?>" required></td>
                </tr>
                <tr>
                    <th class="label">Harga Kendaraan:</th>
                    <td class="input"><input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($kendaraan['price']); ?>" required></td>
                </tr>
                <tr>
                    <th class="label">Gambar Kendaraan:</th>
                    <td class="input">
                        <input type="file" name="image">
                        <br>
                        <img src="<?php echo htmlspecialchars($kendaraan['image']); ?>" alt="Gambar Kendaraan" width="100">
                    </td>
                </tr>
                <tr class="submit-button">
                    <td colspan="2"><input type="submit" value="Update Kendaraan"></td>
                </tr>
            </table>
        </form>
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
    </div>
</body>
</html>