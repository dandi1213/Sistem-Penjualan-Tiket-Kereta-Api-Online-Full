<!-- File: application/views/login/login_view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/login_style.css'); ?>">
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
        <h2>Masuk</h2>
        <?php if ($this->session->flashdata('error_message')) : ?>
            <!-- Display error message directly on the login page -->
            <div class="error-message">
                <?php echo $this->session->flashdata('error_message'); ?>
            </div>
        <?php endif; ?>
        <?php echo form_open('login_controller/login'); ?>
        <input type="text" name="username" placeholder="Nama Pengguna" required>
        <input type="password" name="password" placeholder="Kata Sandi" required>
        <button type="submit">Masuk</button>
        <?php echo form_close(); ?>
        <p class="register-link">Belum mempunyai akun? <a href="<?php echo site_url('login_controller/register'); ?>">Daftar Sekarang</a></p>

        <!-- Tambahkan kode untuk menampilkan pesan pada login_view.php -->
        <?php if ($this->session->flashdata('success_message')) : ?>
            <div style="color: green;"><?php echo $this->session->flashdata('success_message'); ?></div>
        <?php endif; ?>
    </div>
</body>

</html>