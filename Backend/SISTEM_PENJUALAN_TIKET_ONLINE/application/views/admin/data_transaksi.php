<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/admin/data_transaksi.css'); ?>">
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

    <body>
        <div class="content">
            <h2>Data Transaksi Kereta Api</h2>
            <!-- Display Ticket Table -->
            <?php if (isset($transactions) && !empty($transactions)) : ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode Tiket</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Pengguna</th>
                                <th>Nama Kereta</th>
                                <th>Stasiun Awal</th>
                                <th>Stasiun Akhir</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr>
                                    <td><?php echo $transaction->kode_tiket; ?></td>
                                    <td><?php echo date('Y-m-d'); ?></td>
                                    <td>
                                        <?php
                                        $user_data = $this->Admin_model->get_user_by_code($transaction->kode_pengguna);
                                        echo ($user_data) ? $user_data->nama_pengguna : 'N/A';
                                        ?>
                                    </td>
                                    <td><?php echo ($transaction->nama_kereta) ? $transaction->nama_kereta : 'N/A'; ?></td>
                                    <td><?php echo ($transaction->stasiun_awal) ? $transaction->stasiun_awal : 'N/A'; ?></td>
                                    <td><?php echo ($transaction->stasiun_akhir) ? $transaction->stasiun_akhir : 'N/A'; ?></td>
                                    <td>Rp <?php echo number_format($transaction->harga, 0, ',', '.'); ?></td>
                                    <td>
                                        <button class="button" type="submit" onclick="showConfirmationModal('')">Delete</button>
                                    </td>
                                    <!-- Add more columns as needed -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="content">
                    <!-- Your existing content -->

                    <script>
                        function showConfirmationModal() {
                            document.getElementById('overlay').style.display = 'block';
                            document.getElementById('confirmation-modal').style.display = 'block';
                        }

                        function hideConfirmationModal() {
                            document.getElementById('overlay').style.display = 'none';
                            document.getElementById('confirmation-modal').style.display = 'none';
                        }
                    </script>

                    <!-- Delete Confirmation Modal -->
                    <div id="overlay" class="overlay"></div>
                    <div id="confirmation-modal" class="modal">
                        <p>Apakah Anda yakin untuk menghapus data?</p>
                        <button class="button-11" onclick="hideConfirmationModal()">Batal</button>
                        <form method="post" action="<?= site_url('admin_controller/delete_transaction/' . $transaction->kode_tiket); ?>">
                            <button class="button-12" type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <p>Tidak ada data transaksi.</p>
            <?php endif; ?>
    </body>

</html>