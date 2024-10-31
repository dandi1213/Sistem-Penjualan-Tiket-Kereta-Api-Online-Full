<!-- edit_data.html -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kereta Admin</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/admin/tambah_data.css'); ?>">
</head>
<body>
    <div class="sidebar">
        <div class="brand">
        <img src="<?= base_url('public/images/logo_kai.jpg'); ?>" alt="Logo" class="login-logo">
        </div>
        <ul>
        <li><a href="<?php echo site_url('admin_controller/show_trains'); ?>"></i>Dashboard</a></li>
            <li><a href="<?php echo site_url('login_controller'); ?>"></i>Logout</a></li>
        </ul>
    </div>

    <div class="content-tambah_data">
        <h2>Edit Data Kereta</h2>
        <?php if (isset($train)): ?>
            <form action="<?php echo site_url('admin_controller/update_train'); ?>" method="post">
                <input type="hidden" name="kode_kereta" value="<?php echo $train->kode_kereta; ?>">

                <label for="nama_kereta">Nama Kereta:</label>
                <input type="text" id="nama_kereta" name="nama_kereta" value="<?php echo $train->nama_kereta; ?>" required>

                <label for="stasiun_awal">Stasiun Awal:</label>
                <input type="text" id="stasiun_awal" name="stasiun_awal" value="<?php echo $train->stasiun_awal; ?>" required>

                <label for="stasiun_akhir">Stasiun Akhir:</label>
                <input type="text" id="stasiun_akhir" name="stasiun_akhir" value="<?php echo $train->stasiun_akhir; ?>" required>

                <label for="jadwal_berangkat">Jadwal Berangkat:</label>
                <input type="time" id="jadwal_berangkat" name="jadwal_berangkat" value="<?php echo $train->jadwal_berangkat; ?>" required>

                <label for="jadwal_sampai">Jadwal Sampai:</label>
                <input type="time" id="jadwal_sampai" name="jadwal_sampai" value="<?php echo $train->jadwal_sampai; ?>" required>

                <label for="harga">Harga:</label>
                <input type="text" id="harga" name="harga" value="<?php echo $train->harga; ?>" required>

                <label for="stok">Stok:</label>
                <input type="text" id="stok" name="stok" value="<?php echo $train->stok; ?>" required>
                
                <a href="<?php echo site_url('admin_controller/show_trains'); ?>" class="button button-kembali">Kembali</a>
                <button type="submit" class="button " onclick="return confirm('Apakah Anda yakin untuk menyimpan data nya?')">Simpan</button>
            </form>
        <?php else: ?>
            <p>Data kereta tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
