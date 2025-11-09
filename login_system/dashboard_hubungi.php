<?php
session_start();
include("../db.php");

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil semua data dari tabel hubungi_kami
$result = mysqli_query($conn, "SELECT * FROM hubungi_kami ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Pesan Masuk (Hubungi Kami)</title>
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
        <li><a href="riwayat_kunjungan.php" class="block px-3 py-2 hover:bg-yellow-50 text-gray-700 rounded">📜 Riwayat Kunjungan</a></li>
        <li><a href="dashboard_hubungi.php" class="flex items-center gap-2 bg-green-100 text-green-700 p-2 rounded-lg font-semibold">💬 Pesan Masuk</a></li>
        <li><a href="logout.php" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded">🚪 Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <section class="bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">💬 Pesan dari Hubungi Kami</h2>

        <div class="overflow-x-auto">
          <table class="w-full border border-gray-200 rounded-lg">
            <thead class="bg-green-600 text-white">
              <tr>
                <th class="p-3 text-left">No</th>
                <th class="p-3 text-left">Nama</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">WhatsApp</th>
                <th class="p-3 text-left">Kota</th>
                <th class="p-3 text-left">Tujuan</th>
                <th class="p-3 text-left">Departemen</th>
                <th class="p-3 text-left">Topik</th>
                <th class="p-3 text-left">Pesan</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="p-3"><?= $no++ ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['nama']) ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['email']) ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['whatsapp']) ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['kota']) ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['tujuan']) ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['departemen']) ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['topik']) ?></td>
                  <td class="p-3"><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <?php if (mysqli_num_rows($result) == 0): ?>
          <p class="text-center text-gray-500 mt-4">Belum ada pesan yang masuk.</p>
        <?php endif; ?>
      </section>
    </main>
  </div>
</body>
</html>
