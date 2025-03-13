<!-- SESSION -->
<!-- menyimpan session -->
<?php echo "Nama: " . $_POST['nama']; ?>

<!-- mengakses session -->
<?php session_start(); echo $_SESSION['user']; ?>

<!-- COOKIES -->
<!-- menyimpan cookies -->
<?php setcookie("username", "Taufiq", time() + 3600); // Berlaku 1 jam ?>

<!-- mengakses cookies -->
<?php echo $_COOKIE['username']; ?>