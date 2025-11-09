<?php
session_start();
include("../db.php");

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Proses tambah riwayat kunjungan
if (isset($_POST['simpan'])) {
    $nama_pasien = $_POST['nama_pasien'];
    $nama_dokter = $_POST['nama_dokter'];
    $tanggal = $_POST['tanggal_kunjungan'];
    $keluhan = $_POST['keluhan'];
    $tindakan = $_POST['tindakan'];

    $sql = "INSERT INTO riwayat_kunjungan (nama_pasien, nama_dokter, tanggal_kunjungan, keluhan, tindakan)
            VALUES ('$nama_pasien', '$nama_dokter', '$tanggal', '$keluhan', '$tindakan')";
    mysqli_query($conn, $sql);
}

// Ambil data dari tabel
$result = mysqli_query($conn, "SELECT * FROM riwayat_kunjungan ORDER BY tanggal_kunjungan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Kunjungan - Dashboard Admin</title>
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

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 md:block flex-shrink-0">
      <h2 class="text-xl font-bold text-gray-700 mb-6">Menu</h2>
      <ul class="space-y-4">
        <li><a href="dashboard_admin.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">🏠 Dashboard</a></li>
        <li><a href="dashboard_pasien.php" class="block px-3 py-2 hover:bg-green-50 text-gray-700 rounded">🧾 Data Pasien</a></li>
        <li><a href="dashboard_dokter.php" class="block px-3 py-2 hover:bg-green-50 text-gray-700 rounded">👨‍⚕️ Data Dokter</a></li>
        <li><a href="riwayat_kunjungan.php" class="flex items-center gap-2 bg-green-100 text-green-700 p-2 rounded-lg font-semibold">📜 Riwayat Kunjungan</a></li>
        <li><a href="dashboard_hubungi.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">💬 Pesan Masuk</a></li>
        <li><a href="logout.php" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded">🚪 Logout</a></li>
      </ul>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Form Tambah Riwayat -->
      <section class="bg-white p-6 rounded-2xl shadow-md mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">🧾 Tambah Riwayat Kunjungan</h2>

        <form method="POST" class="grid grid-cols-2 gap-4">
          <div>
            <label class="font-semibold">Nama Pasien</label>
            <input type="text" name="nama_pasien" required class="w-full border p-2 rounded mt-1">
          </div>

          <div>
            <label class="font-semibold">Nama Dokter</label>
            <input type="text" name="nama_dokter" required class="w-full border p-2 rounded mt-1">
          </div>

          <div>
            <label class="font-semibold">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" required class="w-full border p-2 rounded mt-1">
          </div>

          <div>
            <label class="font-semibold">Keluhan</label>
            <input type="text" name="keluhan" class="w-full border p-2 rounded mt-1">
          </div>

          <div class="col-span-2">
            <label class="font-semibold">Tindakan / Pengobatan</label>
            <textarea name="tindakan" rows="2" class="w-full border p-2 rounded mt-1"></textarea>
          </div>

          <div class="col-span-2 text-right">
            <button type="submit" name="simpan" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">
              💾 Simpan Data
            </button>
          </div>
        </form>
      </section>

      <!-- Tabel Riwayat -->
      <section class="bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">📋 Daftar Riwayat Kunjungan</h2>

        <table class="w-full text-sm border border-gray-200">
          <thead class="bg-green-500 text-white">
            <tr>
              <th class="p-2">No</th>
              <th class="p-2">Nama Pasien</th>
              <th class="p-2">Nama Dokter</th>
              <th class="p-2">Tanggal</th>
              <th class="p-2">Keluhan</th>
              <th class="p-2">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)): ?>
              <tr class="border-b hover:bg-gray-50">
                <td class="p-2 text-center"><?= $no++ ?></td>
                <td class="p-2"><?= $row['nama_pasien'] ?></td>
                <td class="p-2"><?= $row['nama_dokter'] ?></td>
                <td class="p-2 text-center"><?= $row['tanggal_kunjungan'] ?></td>
                <td class="p-2"><?= $row['keluhan'] ?></td>
                <td class="p-2"><?= $row['tindakan'] ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </section>
    </main>
  </div>

</body>
</html>
