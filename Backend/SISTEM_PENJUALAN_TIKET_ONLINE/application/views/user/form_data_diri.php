<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Data Diri</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/form_data_diri.css'); ?>">
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

            <?php if (!empty($train_info)) : ?>
                <div class="tiket-card">
                    <!-- Display only the nama_kereta and kode_kereta -->
                    <h3><?php echo $train_info->nama_kereta; ?> (<?php echo $train_info->kode_kereta; ?>)</h3>
                    <!-- Hide the rest -->
                    <p class="hidden">
                        <?php echo $train_info->jadwal_berangkat . ' - ' . $train_info->stasiun_awal; ?><br>
                        <?php echo $train_info->jadwal_sampai . ' - ' . $train_info->stasiun_akhir; ?><br>
                        <?php echo $train_info->stok > 0 ? 'Tersedia' : 'Habis'; ?><br>
                        Rp <?php echo number_format($train_info->harga, 0, ',', '.'); ?>
                    </p>
                </div>
            <?php else : ?>
                <p>Data Kereta Tidak Ditemukan</p>
            <?php endif; ?>

            <h2>Formulir Data Diri</h2>


            <form action="<?php echo site_url('user_controller/simpan_data_pengguna'); ?>" method="post">

                <!-- Input fields for personal information -->
                <div class="form-group">
                    <input type="hidden" id="kodeKereta" name="kodeKereta" value="<?php echo $train_info->kode_kereta; ?>">
                </div>

                <div class="form-group">
                    <label for="namaLengkap">Nama Lengkap:</label>
                    <input type="text" id="namaLengkap" name="namaLengkap" required>
                </div>

                <div class="form-group">
                    <label for="nik">NIK (Nomor Induk Kependudukan):</label>
                    <input type="text" id="nik" name="nik" required>
                </div>

                <div class="form-group">
                    <label for="noTelepon">No Telepon:</label>
                    <input type="tel" id="noTelepon" name="noTelepon" required>
                </div>

                <!-- Tanggal Berangkat -->
                <div class="form-group">
                    <label for="tanggalBerangkat">Tanggal Berangkat:</label>
                    <input type="date" id="tanggalBerangkat" name="tanggalBerangkat">
                </div>

                <div class="form-group">
                    <label for="jumlahTiket">Jumlah Tiket:</label>
                    <input type="number" id="jumlahTiket" name="jumlahTiket" min="1">
                </div>

                <button type="submit" class="button button">Lanjutkan</button>
            </form>
            <div class="back-button">
                <button onclick="window.location.href='<?php echo site_url('user_controller/pemesanan'); ?>'" class="button button-kembali">Kembali</button>
            </div>
            <div class="foto-pemesanan" style="margin-top: 30px;">

            </div>
        </div>
    </div>

</body>

</html>