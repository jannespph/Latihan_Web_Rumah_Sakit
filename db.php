<?php
$host = "localhost:3308";
$user = "root"; // ganti jika username MySQL kamu berbeda
$pass = "";
$dbname = "rumah_sakit";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
