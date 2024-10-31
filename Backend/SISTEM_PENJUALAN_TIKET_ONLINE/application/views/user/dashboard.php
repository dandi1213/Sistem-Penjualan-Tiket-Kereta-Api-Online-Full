<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/user/dashboard.css'); ?>">
    <style>
       
    </style>
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


    <!-- Image slider container -->
    <div class="slider-container">
        <!-- Add your images to the slider -->
        <div class="slider">
            <img src="<?= base_url('public/images/baner1.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner2.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner3.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner4.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner5.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner6.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner7.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner8.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner9.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner10.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner1.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner2.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner3.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner4.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner5.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner6.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner7.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner8.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner9.jpg'); ?>" alt="Image 1">
            <img src="<?= base_url('public/images/baner10.jpg'); ?>" alt="Image 1">
        </div>
    </div>


    <!-- Rest of your HTML content -->
    <script>
        var slider = document.querySelector('.slider');
        var images = document.querySelectorAll('.slider img');
        var currentImageIndex = 0;

        function startSlider() {
            setInterval(function() {
                currentImageIndex = (currentImageIndex + 1) % images.length;

                // Apply the transition and move to the next image
                slider.style.transform = 'translateX(' + (-currentImageIndex * 100) + '%)';

                // Check if it's the last image, then move back to the first image after a delay
                if (currentImageIndex === images.length - 1) {
                    setTimeout(function() {
                        slider.style.transition = 'none';
                        slider.style.transform = 'translateX(0)';
                        void slider.offsetWidth; // Force reflow
                        slider.style.transition = 'transform 1s ease';
                    }, 2000); // Adjust the timeout to set the duration of the pause
                }
            }, 5000); // Adjust the interval as needed
        }

        startSlider();
    </script>

</body>

</html>