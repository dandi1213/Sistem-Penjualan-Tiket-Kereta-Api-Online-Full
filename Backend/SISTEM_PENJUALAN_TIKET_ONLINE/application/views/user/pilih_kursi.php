<!-- pilih_kursi.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Gerbong dan Kursi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/pilih_kursi.css'); ?>">
</head>
<body>

    <header>
        <div class="brand">
            <img src="<?php echo base_url('public/images/logo_kai.jpg'); ?>" alt="Logo">
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

            <h2>Pilih Gerbong dan Kursi</h2>

            <!-- Add a form to select carriage and seat -->
            <form action="<?php echo site_url('user_controller/simpan_pilihan_kursi'); ?>" method="post">

                <div class="form-group">
                    <label for="gerbong">Pilih Gerbong:</label>
                    <select id="gerbong" name="gerbong" required>
                        <!-- Dynamically populate gerbong options based on your data -->
                        <!-- Example: -->
                        <option value="1">Gerbong 1</option>
                        <option value="2">Gerbong 2</option>
                        <option value="3">Gerbong 3</option>
                        <option value="4">Gerbong 4</option>
                        <option value="5">Gerbong 5</option>
                        <option value="6">Gerbong 6</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <!-- Pilih_Kursi.php -->

                <label>Pilih Kursi</label>

                <div class="form-group">

                    <!-- Use radio buttons for seat selection -->
                    <?php
                    $seatsA = array("A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "A9", "A10");
                    foreach ($seatsA as $seat) {
                        echo '<label><input type="radio" name="kursi" value="' . $seat . '">' . $seat . '</label>';
                    }
                    ?>
                </div>

                <div class="form-group">
                    <!-- Use radio buttons for seat selection -->
                    <?php
                    $seatsB = array("B1", "B2", "B3", "B4", "B5", "B6", "B7", "B8", "B9", "B10");
                    foreach ($seatsB as $seat) {
                        echo '<label><input type="radio" name="kursi" value="' . $seat . '">' . $seat . '</label>';
                    }
                    ?>
                </div>

                <div class="form-group">
                    <!-- Use radio buttons for seat selection -->
                    <?php
                    $seatsB = array("C1", "C2", "C3", "C4", "C5", "C6", "C7", "C8", "C9", "C10");
                    foreach ($seatsB as $seat) {
                        echo '<label><input type="radio" name="kursi" value="' . $seat . '">' . $seat . '</label>';
                    }
                    ?>
                </div>

                <div class="form-group">
                    <!-- Use radio buttons for seat selection -->
                    <?php
                    $seatsB = array("D1", "D2", "D3", "D4", "D5", "D6", "D7", "D8", "D9", "D10");
                    foreach ($seatsB as $seat) {
                        echo '<label><input type="radio" name="kursi" value="' . $seat . '">' . $seat . '</label>';
                    }
                    ?>
                </div>

                <!-- Add hidden input fields for necessary data -->
                <input type="hidden" name="kode_pengguna" value="<?php echo $pengguna_id; ?>">

                <!-- Add a submit button -->
                <button type="submit" class="button button-kembali">Lanjutkan</button>
            </form>

            <div class="foto-pemesanan" style="margin-top: 30px;">
            
            </div>

        </div>
    </div>

</body>

</html>