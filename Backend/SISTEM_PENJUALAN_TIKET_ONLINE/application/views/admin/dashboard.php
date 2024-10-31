<!-- dashboard.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/admin/dashboard.css'); ?>">
</head>

<body>
    <div class="sidebar">
        <div class="brand">
            <img src="<?= base_url('public/images/logo_kai.jpg'); ?>" alt="Logo" class="login-logo">
        </div>
        <ul>
            <li><a href="<?php echo site_url('admin_controller/show_trains'); ?>"></i>Dashboard</a></li>
            <li><a href="<?php echo site_url('admin_controller/show_transactions'); ?>"></i>Data Transaksi</a></li>
            <li><a href="<?php echo site_url('login_controller'); ?>"></i>Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Data Tiket Kereta Api</h2>

        <!-- Add Button -->
        <a href="<?php echo site_url('admin_controller/add_train'); ?>" class="button">Tambah Data</a>

        <!-- Display Train Table -->
        <?php if (isset($trains) && !empty($trains)) : ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Kereta</th>
                            <th>Nama Kereta</th>
                            <th>Stasiun Awal</th>
                            <th>Stasiun Akhir</th>
                            <th>Jadwal Berangkat</th>
                            <th>Jadwal Sampai</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trains as $train) : ?>
                            <tr>
                                <td><?php echo $train->kode_kereta; ?></td>
                                <td><?php echo $train->nama_kereta; ?></td>
                                <td><?php echo $train->stasiun_awal; ?></td>
                                <td><?php echo $train->stasiun_akhir; ?></td>
                                <td><?php echo $train->jadwal_berangkat; ?></td>
                                <td><?php echo $train->jadwal_sampai; ?></td>
                                <td>Rp <?php echo number_format($train->harga, 0, ',', '.'); ?></td>
                                <td><?php echo $train->stok; ?></td>
                                <td>
                                    <form action="<?php echo site_url('admin_controller/edit_train/' . $train->kode_kereta); ?>" method="get" style="display: inline;">
                                        <button type="submit" class="button-edit" onclick="return confirm('Apakah Anda yakin ingin mengedit?')">Edit</button>
                                    </form>
                                    <form action="<?php echo site_url('admin_controller/delete_train/' . $train->kode_kereta); ?>" method="post" style="display: inline;">
                                        <button type="submit" class="button-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else : ?>
            <p>Tidak ada data kereta.</p>
        <?php endif; ?>
    </div>
</body>

</html>