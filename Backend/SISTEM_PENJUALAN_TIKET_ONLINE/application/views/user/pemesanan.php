<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Kereta</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/pemesanan.css'); ?>">

</head>

<body>
    <header>
        <div class="brand">
            <img src="<?= base_url('public/images/logo_kai.jpg'); ?>" alt="Logo" class="login-logo">
        </div>
        <nav>
            <a href="<?php echo site_url('user_controller/dashboard'); ?>">BERANDA</a>
            <a href="<?php echo site_url('user_controller/lihat_jadwal'); ?>">LIHAT JADWAL</a>
            <a href="<?php echo site_url('user_controller/pemesanan'); ?>">PEMESANAN</a>
            <a href="<?php echo site_url('user_controller/tiket_saya'); ?>">TIKET SAYA</a>
            <a href="<?php echo site_url('login_controller'); ?>">LOGOUT</a>
        </nav>
    </header>
    <div class="content">
        <div class="container">
            <h2>Formulir Pemesanan Tiket Kereta</h2>

            <form action="<?php echo site_url('user_controller/cari_tiket'); ?>" method="post">
                <!-- Stasiun Awal -->
                <div class="form-group">
                    <label for="stasiunAwal">Stasiun Awal:</label>
                    <select id="stasiunAwal" name="stasiunAwal">
                        <option value="">Pilih Stasiun</option> <!-- Add this line for the default option -->
                        <?php foreach ($stations as $station) : ?>
                            <option value="<?php echo $station['station_name']; ?>"><?php echo $station['station_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Stasiun Akhir -->
                <div class="form-group">
                    <label for="stasiunAkhir">Stasiun Akhir:</label>
                    <select id="stasiunAkhir" name="stasiunAkhir">
                        <option value="">Pilih Stasiun</option> <!-- Add this line for the default option -->
                        <?php foreach ($stations as $station) : ?>
                            <option value="<?php echo $station['station_name']; ?>"><?php echo $station['station_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tombol Cari Tiket -->
                <button type="submit" class="button-kembali">Cari Tiket</button>
            </form>
            <div class="foto-pemesanan" style="margin-top: 30px;">
                <img src="<?= base_url('public/images/iklan1.jpg'); ?>" alt="Logo" class="login-logo">
                <img src="<?= base_url('public/images/iklan2.jpg'); ?>" alt="Logo" class="login-logo">
                <img src="<?= base_url('public/images/iklan3.jpg'); ?>" alt="Logo" class="login-logo">
            </div>
        </div>
    </div>

</body>

</html>