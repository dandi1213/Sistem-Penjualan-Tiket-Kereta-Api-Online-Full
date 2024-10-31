<!-- lihat_jadwal.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Jadwal</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/lihat_jadwal.css'); ?>">
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
            <h2>Informasi Jadwal Kereta</h2>
            <div class="table-container">
                <table class="jadwal-table">
                    <thead>
                        <tr>
                            <th>Nama Kereta</th>
                            <th>Stasiun Awal</th>
                            <th>Stasiun Akhir</th>
                            <th>Jadwal Berangkat</th>
                            <th>Jadwal Sampai</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schedules as $schedule) : ?>
                            <tr>
                                <td><?php echo $schedule->nama_kereta; ?></td>
                                <td><?php echo $schedule->stasiun_awal; ?></td>
                                <td><?php echo $schedule->stasiun_akhir; ?></td>
                                <td><?php echo $schedule->jadwal_berangkat; ?></td>
                                <td><?php echo $schedule->jadwal_sampai; ?></td>
                                <td>Rp <?php echo number_format($schedule->harga, 0, ',', '.'); ?></td>
                                <td style="background-color: <?php echo ($schedule->stok > 0) ? (($schedule->stok > 50) ? 'green' : 'red') : 'red'; ?>;">
                                    <?php
                                    if ($schedule->stok > 0) {
                                        echo ($schedule->stok > 50) ? 'Tersedia' : $schedule->stok;
                                    } else {
                                        echo 'Habis';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Form for "Pesan Sekarang" button -->
            <form action="<?php echo site_url('user_controller/pemesanan'); ?>" method="get">
                <button type="submit" class="button button-kembali">Pesan Sekarang</button>
            </form>

        </div>
    </div>
    </div>

</body>

</html>