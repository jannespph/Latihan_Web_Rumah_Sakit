<?php
session_start();
include("../db.php");

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: riwayat_kunjungan.php");
    exit();
}

$id = $_GET['id'];

// Ambil data berdasarkan ID
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM riwayat_kunjungan WHERE id='$id'"));

// Ambil data pasien & dokter untuk dropdown
$pasienList = mysqli_query($conn, "SELECT * FROM pasien ORDER BY nama_pasien ASC");
$dokterList = mysqli_query($conn, "SELECT * FROM dokter ORDER BY nama_dokter ASC");

// Proses update data
if (isset($_POST['update'])) {
    $nama_pasien = $_POST['nama_pasien'];
    $nama_dokter = $_POST['nama_dokter'];
    $tanggal = $_POST['tanggal_kunjungan'];
    $keluhan = $_POST['keluhan'];
    $tindakan = $_POST['tindakan'];

    $sql = "UPDATE riwayat_kunjungan 
            SET nama_pasien='$nama_pasien', nama_dokter='$nama_dokter', tanggal_kunjungan='$tanggal', keluhan='$keluhan', tindakan='$tindakan'
            WHERE id='$id'";
    mysqli_query($conn, $sql);

    header("Location: riwayat_kunjungan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Riwayat Kunjungan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <header class="bg-green-600 text-white p-4 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-bold">🏥 Dashboard Admin</h1>
    <div class="flex items-center space-x-4">
      <span class="mr-4">👤 <?= $_SESSION['username'] ?></span>
      <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-white font-semibold">Logout</a>
    </div>
  </header>

  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg h-screen p-6 hidden md:block">
      <h2 class="text-xl font-bold text-gray-700 mb-6">Menu</h2>
      <ul class="space-y-4">
        <li><a href="dashboard_admin.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">🏠 Dashboard</a></li>
        <li><a href="dashboard_pasien.php" class="block px-3 py-2 hover:bg-green-50 text-gray-700 rounded">🧾 Data Pasien</a></li>
        <li><a href="dashboard_dokter.php" class="block px-3 py-2 hover:bg-green-50 text-gray-700 rounded">👨‍⚕️ Data Dokter</a></li>
        <li><a href="riwayat_kunjungan.php" class="flex items-center gap-2 bg-green-100 text-green-700 p-2 rounded-lg font-semibold">📜 Riwayat Kunjungan</a></li>
        <li><a href="logout.php" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded">🚪 Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <section class="bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">✏️ Edit Riwayat Kunjungan</h2>

        <form method="POST" class="grid grid-cols-2 gap-4">
          <!-- Nama Pasien -->
          <div>
            <label class="font-semibold">Nama Pasien</label>
            <select name="nama_pasien" required class="w-full border p-2 rounded mt-1">
              <option value="">-- Pilih Pasien --</option>
              <?php while($p = mysqli_fetch_assoc($pasienList)): ?>
                <option value="<?= $p['nama_pasien'] ?>" <?= ($p['nama_pasien'] == $data['nama_pasien']) ? 'selected' : '' ?>>
                  <?= $p['nama_pasien'] ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <!-- Nama Dokter -->
          <div>
            <label class="font-semibold">Nama Dokter</label>
            <select name="nama_dokter" required class="w-full border p-2 rounded mt-1">
              <option value="">-- Pilih Dokter --</option>
              <?php while($d = mysqli_fetch_assoc($dokterList)): ?>
                <option value="<?= $d['nama_dokter'] ?>" <?= ($d['nama_dokter'] == $data['nama_dokter']) ? 'selected' : '' ?>>
                  <?= $d['nama_dokter'] ?> (<?= $d['spesialis'] ?>)
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <!-- Tanggal -->
          <div>
            <label class="font-semibold">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan'] ?>" required class="w-full border p-2 rounded mt-1">
          </div>

          <!-- Keluhan -->
          <div>
            <label class="font-semibold">Keluhan</label>
            <input type="text" name="keluhan" value="<?= $data['keluhan'] ?>" class="w-full border p-2 rounded mt-1">
          </div>

          <!-- Tindakan -->
          <div class="col-span-2">
            <label class="font-semibold">Tindakan / Pengobatan</label>
            <textarea name="tindakan" rows="2" class="w-full border p-2 rounded mt-1"><?= $data['tindakan'] ?></textarea>
          </div>

          <!-- Tombol -->
          <div class="col-span-2 text-right">
            <button type="submit" name="update" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
              🔄 Update Data
            </button>
            <a href="riwayat_kunjungan.php" class="ml-3 text-gray-600 hover:text-black">⬅️ Kembali</a>
          </div>
        </form>
      </section>
    </main>
  </div>
</body>
</html>
