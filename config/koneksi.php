<?php
$host = "127.0.0.1";  // Ganti localhost jadi IP langsung
$user = "root";
$pass = "";
$db = "sp_laptop";
$port = 3306;

// Set timeout lebih cepat
$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die("❌ Koneksi gagal: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($koneksi, "utf8");
?>