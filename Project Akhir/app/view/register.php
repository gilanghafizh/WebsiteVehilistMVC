<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
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
    </style>
</head>
<body>
    <div class="register-container">
        <form method="post">
            <h1>REGISTER</h1>
            <h3>Silahkan daftarkan akun anda!</h3>
            
            <?php if (!empty($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">REGISTER</button>
            
            <p>Sudah punya akun? <a href="index.php?action=login">Login di sini</a></p>
        </form>
    </div>
</body>
</html>