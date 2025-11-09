<?php
include '../db.php';
session_start();

// Cek login
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Ambil ID dokter yang dikirim lewat URL
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM dokter WHERE id=$id");
$data = $result->fetch_assoc();

// Proses update data dokter
if (isset($_POST['update'])) {
  $nama = $_POST['nama_dokter'];
  $spesialis = $_POST['spesialis'];
  $nohp = $_POST['no_hp'];
  $alamat = $_POST['alamat'];
  $jadwal = $_POST['jadwal_praktek'];

  $conn->query("UPDATE dokter SET 
    nama_dokter='$nama',
    spesialis='$spesialis',
    no_hp='$nohp',
    alamat='$alamat',
    jadwal_praktek='$jadwal'
    WHERE id='$id'");

  header("Location: dashboard_dokter.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Dokter</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">✏️ Edit Data Dokter</h1>
    
    <form method="POST" class="grid grid-cols-2 gap-4">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">

      <div>
        <label class="font-semibold">Nama Dokter</label>
        <input type="text" name="nama_dokter" value="<?= $data['nama_dokter'] ?>" required class="w-full border p-2 rounded mt-1">
      </div>

      <div>
        <label class="font-semibold">Spesialis</label>
        <input type="text" name="spesialis" value="<?= $data['spesialis'] ?>" required class="w-full border p-2 rounded mt-1">
      </div>

      <div>
        <label class="font-semibold">No HP</label>
        <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>" required class="w-full border p-2 rounded mt-1">
      </div>

      <div>
        <label class="font-semibold">Alamat</label>
        <input type="text" name="alamat" value="<?= $data['alamat'] ?>" class="w-full border p-2 rounded mt-1">
      </div>

      <div class="col-span-2">
        <label class="font-semibold">Jadwal Praktek</label>
        <textarea name="jadwal_praktek" rows="2" class="w-full border p-2 rounded mt-1"><?= $data['jadwal_praktek'] ?></textarea>
      </div>

      <div class="col-span-2 text-right">
        <button type="submit" name="update" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
          💾 Simpan Perubahan
        </button>
        <a href="dashboard_dokter.php" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg ml-2">
          Kembali
        </a>
      </div>
    </form>
  </div>
</body>
</html>
