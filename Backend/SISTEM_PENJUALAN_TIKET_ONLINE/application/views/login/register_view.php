<!-- File: application/views/login/login_view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="<?= base_url('public/css/login_style.css'); ?>">
</head>

<body>
    <div class="colored-box">
        <img class="foto-1" src="<?= base_url('public/images/baner5.jpg'); ?>" alt="Logo" class="login-background">
        <img class="foto-1" src="<?= base_url('public/images/baner6.jpg'); ?>" alt="Logo" class="login-background">
        <img class="foto-1" src="<?= base_url('public/images/baner5.jpg'); ?>" alt="Logo" class="login-background">
        <img class="foto-1" src="<?= base_url('public/images/baner6.jpg'); ?>" alt="Logo" class="login-background">
        <img class="foto-1" src="<?= base_url('public/images/baner5.jpg'); ?>" alt="Logo" class="login-background">
        <img class="foto-1" src="<?= base_url('public/images/baner6.jpg'); ?>" alt="Logo" class="login-background">
    </div>
    <div class="login-container">
        <img src="<?= base_url('public/images/logo_kai.jpg'); ?>" alt="Logo" class="login-logo">
        <h2>Daftar</h2>
        <?php echo form_open('login_controller/save_user'); ?>
        <input type="hidden" name="role" value="pengguna">
        <input type="text" name="username" placeholder="Nama Pengguna" required>
        <input type="password" name="password" placeholder="Kata Sandi" required>
        <input type="password" name="confirm_password" placeholder="Ulangi Kata Sandi" required>
        <button type="submit">Daftar</button>
        <?php echo form_close(); ?>
        <p class="register-link">Sudah mempunyai akun? <a href="<?= site_url('login_controller/index'); ?>">Masuk</a></p>
    </div>
</body>

</html>