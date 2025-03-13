<?php
// proses_login.php - Proses Login
session_start(); 

// Credentials yang benar
$user = "fachri"; 
$pass = "f123"; 

// Validasi input
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Memeriksa apakah username dan password sesuai
    if ($username === $user && $password === $pass) { 
        // Login berhasil
        $_SESSION['username'] = $user; 
        header("Location: dashboard.php"); 
        exit();
    } else { 
        // Login gagal
        header("Location: login.php?error=1");
        exit();
    } 
} else {
    // Jika form tidak lengkap
    header("Location: login.php?error=1");
    exit();
}
?>