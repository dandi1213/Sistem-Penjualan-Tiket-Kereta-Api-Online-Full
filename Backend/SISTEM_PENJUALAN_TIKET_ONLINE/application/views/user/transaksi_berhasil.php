<!-- transaksi_berhasil.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/transaksi_berhasil.css'); ?>">
    <!-- Add your CSS styles if needed -->
</head>

<body>

    <header>
        <div class="brand">
            <img src="<?= base_url('public/images/logo_kai.jpg'); ?>" alt="Logo" class="login-logo">
        </div>
        <nav>
            <!-- In your HTML file -->
            <a href="<?php echo site_url('user_controller/dashboard'); ?>">BERANDA</a>
            <a href="<?php echo site_url('user_controller/lihat_jadwal'); ?>">LIHAT JADWAL</a>
            <a href="<?php echo site_url('user_controller/pemesanan'); ?>">PEMESANAN</a>
            <a href="<?php echo site_url('user_controller/tiket_saya'); ?>">TIKET SAYA</a>
            <a href="<?php echo site_url('login_controller'); ?>">LOGOUT</a>

        </nav>
    </header>

    <div class="content">
        <div class="container">
            <h2>Transaksi Berhasil</h2>

            
            <!-- Button for "Lihat Tiket" -->
            <button onclick="window.location.href='<?php echo site_url('user_controller/tiket_saya'); ?>'" class="button ">Lihat Tiket</button>

            <!-- Button for "Kembali Ke Dashboard" -->
            <button onclick="window.location.href='<?php echo site_url('user_controller/dashboard'); ?>'" class="button button-kembali">Kembali Ke Dashboard</button>
        </div>
    </div>

</body>

</html>