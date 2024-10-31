<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Tiket</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/pilih_tiket.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <!-- <script>
        function displayPopup() {
            alert("Jadwal Kereta Tidak Tersedia");
            // Redirect to the desired page after the user clicks "OK"
            window.location.href = "<?php echo site_url('user_controller/pemesanan'); ?>";
        }
    </script> -->
</head>

<body></body>

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
<div class="content"></div>
<div class="container">
    <?php if (empty($schedules)) : ?>
        <div id="successPopup" class="popup">
        <h1>Tiket Tidak Tersedia</h1>
        <button class="tombol-12" onclick="closePopup()">Cari Tiket Lagi?</button>
    </div>
    <?php else : ?>
        <?php foreach ($schedules as $schedule) : ?>
            <?php if ($schedule->stok > 0) : ?>
                <div class="tiket-card">
                    <h3><?php echo $schedule->nama_kereta; ?></h3>
                    <p><?php echo $schedule->jadwal_berangkat . ' - ' . $schedule->stasiun_awal; ?></p>
                    <p><?php echo $schedule->jadwal_sampai . ' - ' . $schedule->stasiun_akhir; ?></p>
                    <?php if ($schedule->stok < 50) : ?>
                        <p><?php echo 'Stok: ' . $schedule->stok; ?></p>
                    <?php else : ?>
                        <p>Tersedia</p>
                    <?php endif; ?>
                    <p>Rp <?php echo number_format($schedule->harga, 0, ',', '.'); ?></p>
                    <!-- Form for "Pilih Tiket" button -->
                    <form action="<?php echo site_url('user_controller/detail_kereta/' . $schedule->kode_kereta); ?>" method="get">
                        <button type="submit" class="button">Pilih Tiket</button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="back-button">
        <!-- Form for "Kembali" button -->
        <form action="<?php echo site_url('user_controller/pemesanan'); ?>" method="get">
            <button type="submit" class="button button-kembali">Kembali</button>
        </form>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
<script>
    function showQRCode(kodeTiket) {
        // Show the popup
        document.getElementById("successPopup").style.display = "block";
    }
    function closePopup() {

        window.location.href = "<?php echo site_url('user_controller/pemesanan'); ?>";
    }
</script>