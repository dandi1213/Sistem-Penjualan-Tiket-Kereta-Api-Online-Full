<!-- pilihan_kursi.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tiket</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/detail_pesanan.css'); ?>">
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

    <!-- Menggunakan tag form untuk mengelompokkan elemen dalam class "content" -->
    <form action="<?php echo site_url('user_controller/bayar_tiket'); ?>" method="post">
        <div class="content">
            <div class="container">

                <h2>Informasi Tiket</h2>

                <div>
                    <!-- Display user data -->
                    <?php if (isset($nama_pengguna)) : ?>
                        <!-- Add Kode Pengguna and Kode Kereta as read-only inputs -->
                        <!-- Hidden fields for username and kode_login -->
                        <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">
                        <input type="hidden" id="kode_login" name="kode_login" value="<?php echo $kode_login; ?>">
                        <input type="hidden" name="kode_pengguna" value="<?php echo $kode_pengguna; ?>">
                        <input type="hidden" name="no_gerbong" value="<?php echo $no_gerbong; ?>">
                        <input type="hidden" name="no_kursi" value="<?php echo $no_kursi; ?>">
                        <p>Nama Pengguna: <input type="text" value="<?php echo $nama_pengguna; ?>" readonly></p>
                        <p>NIK: <input type="text" value="<?php echo $nik; ?>" readonly></p>

                        <!-- Display train data -->
                        <?php if (isset($nama_kereta)) : ?>
                            <p>Nama Kereta: <input type="text" value="<?php echo $nama_kereta; ?>" readonly></p>
                            <p>Stasiun Awal: <input type="text" value="<?php echo $stasiun_awal; ?>" readonly></p>
                            <p>Stasiun Akhir: <input type="text" value="<?php echo $stasiun_akhir; ?>" readonly></p>
                            <!-- Add other train data fields as needed -->
                        <?php else : ?>
                            <p>Data kereta tidak ditemukan.</p>
                        <?php endif; ?>

                        <!-- Display No. Gerbong and No. Kursi after train information -->
                        <p>No. Gerbong: <input type="text" value="<?php echo $no_gerbong; ?>" readonly></p>
                        <!-- Display No. Kursi as non-editable text input -->
                        <p>No. Kursi: <input type="text" value="<?php echo $no_kursi; ?>" readonly></p>
                        <p>Tanggal Berangkat: <input type="text" value="<?php echo $tanggal_berangkat; ?>" readonly></p>
                        <p>Jumlah Tiket: <input type="text" value="<?php echo $jumlah_tiket; ?>" readonly></p>
                        <?php if (isset($nama_kereta)) : ?>
                            <p>Total Harga: <input type="text" value="Rp <?php echo number_format($harga, 0, ',', '.'); ?>" readonly></p>
                            <!-- Add other train data fields as needed -->
                        <?php else : ?>
                            <p>Data kereta tidak ditemukan.</p>
                        <?php endif; ?>
                    <?php else : ?>
                        <p>Data pengguna tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <button class="button" type="button" onclick="showQRCode()">Bayar</button>
    </form>
    <div id="successPopup" class="popup">
        <div id="qrcode" style="width: 200px; height: 200px;"></div>
        <h1></h1>
        <button class="tombol-11" onclick="confirmPayment('<?php echo $kode_pengguna; ?>', '<?php echo $no_gerbong; ?>', '<?php echo $no_kursi; ?>', '<?php echo $kode_login; ?>')">Konfirmasi</button>
        <button class="tombol-12" onclick="cancel()">Batal</button>
    </div>
    <div class="back-button">
        <button onclick="window.location.href='<?php echo site_url('user_controller/pemesanan'); ?>'" class="button button-kembali">Batal</button>
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

    function cancel() {
        // Close the popup without deleting the ticket
        closePopup();
    }

   function confirmPayment(kode_pengguna, no_gerbong, no_kursi, kode_login) {
    // Close the popup
    closePopup();

    // Send AJAX request to save ticket information
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo site_url('user_controller/bayar_tiket'); ?>", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Prepare data to be sent in the request body
    var data = "kode_pengguna=" + kode_pengguna + "&no_gerbong=" + no_gerbong + "&no_kursi=" + no_kursi + "&kode_login=" + kode_login;

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server if needed
            console.log(xhr.responseText);

            // Redirect to transaksi_berhasil page
            window.location.href = "<?php echo site_url('user_controller/transaksi_berhasil'); ?>";
        }
    };

    // Send the request with the data
    xhr.send(data);
}



    // Ganti teks URL dengan tautan profil TikTok Anda
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: "http://tiktok.com/@dndialidrs", // Ganti dengan tautan profil TikTok Anda
        width: 550,
        height: 550
    });
</script>