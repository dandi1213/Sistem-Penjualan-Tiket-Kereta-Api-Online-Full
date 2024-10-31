<!-- tiket_saya.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/tiket_saya.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
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
            <?php if ($all_tickets) : ?>
                <?php foreach ($all_tickets as $ticket) : ?>
                    <form action="<?php echo site_url('user_controller/delete_ticket/' . $ticket->kode_tiket); ?>" method="post">

                        <input type="hidden" name="kode_tiket" value="<?php echo $ticket->kode_tiket; ?>">
                        <input class="hidden" type="text" name="kode_kereta" value="<?php echo $ticket->kode_kereta; ?>" readonly><br>
                        <input class="hidden" type="text" name="kode_tiket" value="<?php echo $ticket->kode_tiket; ?>" readonly><br>
                        <input class="hidden" type="text" name="kode_pengguna" value="<?php echo $ticket->kode_pengguna; ?>" readonly><br>
                        Nama Pengguna: <input type="text" name="nama_pengguna" value="<?php echo $this->User_model->get_user_info_by_code($ticket->kode_pengguna)->nama_pengguna; ?>" readonly><br>
                        Nama Kereta: <input type="text" name="nama_kereta" value="<?php echo $ticket->nama_kereta; ?>" readonly><br>
                        Stasiun Awal: <input type="text" name="stasiun_awal" value="<?php echo $ticket->stasiun_awal; ?>" readonly><br>
                        Stasiun Akhir: <input type="text" name="stasiun_akhir" value="<?php echo $ticket->stasiun_akhir; ?>" readonly><br>
                        No Gerbong: <input type="text" name="no_gerbong" value="<?php echo $ticket->no_gerbong; ?>" readonly><br>
                        No Kursi: <input type="text" name="no_kursi" value="<?php echo $ticket->no_kursi; ?>" readonly><br>

                        <button class="tombol-1" type="button" onclick="showQRCode('<?php echo $ticket->kode_tiket; ?>')">E-BoardingPass</button>
                    </form>
                <?php endforeach; ?>
                <!-- Popup section -->
                <div id="successPopup" class="popup">
                    <div id="qrcode" style="width: 200px; height: 200px; margin-left:1%; margin-top:1%"></div>
                    <h1>E-Boarding Pass</h1>
                    <button class="tombol-11" onclick="deleteTicketDirectly('<?php echo $ticket->kode_tiket; ?>')">Konfirmasi</button>
                    <button class="tombol-12" onclick="cancelDelete()">Batal</button>
                </div>
            <?php else : ?>
                <p id="noTicketMessage">Tidak Ada Tiket</p>
                <a href="<?php echo site_url('user_controller/pemesanan'); ?>" class="button-kembali">Pesan Sekarang</a>
            <?php endif; ?>
        </div>
    </div>
    </div>
</body>

</html>
<script>
    function showQRCode(kodeTiket) {
        // Show the popup
        document.getElementById("successPopup").style.display = "block";
    }

    function closePopup() {
        // Close the popup
        document.getElementById("successPopup").style.display = "none";
    }

    function cancelDelete() {
        // Close the popup without deleting the ticket
        closePopup();
    }

    function deleteTicketDirectly(kodeTiket) {
        // Directly delete the ticket without confirmation
        deleteTicket(kodeTiket);
    }

    function deleteTicket(kodeTiket) {
        // Use AJAX to send a request to delete the ticket
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo site_url("user_controller/delete_ticket"); ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Handle the success scenario
                // Reload the page or perform any other action
                location.reload();
            } else {
                // Handle the error scenario, display an error message, or redirect as needed
                console.error('Error deleting ticket');
            }
        };
        xhr.send('kode_tiket=' + encodeURIComponent(kodeTiket));
    }
    // Ganti teks URL dengan tautan profil TikTok Anda
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: "http://tiktok.com/@dndialidrs", // Ganti dengan tautan profil TikTok Anda
        width: 400,
        height: 400
    });
</script>