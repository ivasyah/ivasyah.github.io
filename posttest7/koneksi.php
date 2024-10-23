<?php
// Setting koneksi ke database MySQL di XAMPP
$host = "localhost";  // Host default di XAMPP
$user = "root";       // Username default MySQL di XAMPP
$password = "";       // Password default biasanya kosong di XAMPP
$dbname = "toko_alat_musik"; // Nama database yang kita buat di phpMyAdmin

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
