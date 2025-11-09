<?php
session_start();
include '../db.php';

// Cek login
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Tambah data pasien
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama_pasien'];
  $umur = $_POST['umur'];
  $jk = $_POST['jenis_kelamin'];
  $nohp = $_POST['no_hp'];
  $keluhan = $_POST['keluhan'];
  $tanggal = $_POST['tanggal_kunjungan'];
  $dokter = $_POST['dokter_tujuan'];

  $sql = "INSERT INTO pasien (nama_pasien, umur, jenis_kelamin, no_hp, keluhan, tanggal_kunjungan, dokter_tujuan)
          VALUES ('$nama', '$umur', '$jk', '$nohp', '$keluhan', '$tanggal', '$dokter')";
  $conn->query($sql);
  header("Location: dashboard_pasien.php");
  exit();
}

// Hapus data pasien
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $conn->query("DELETE FROM pasien WHERE id='$id'");
  header("Location: dashboard_pasien.php");
  exit();
}

// Fitur pencarian
$keyword = $_GET['search'] ?? '';
if (!empty($keyword)) {
  $query = "SELECT * FROM pasien 
            WHERE nama_pasien LIKE '%$keyword%' 
            OR dokter_tujuan LIKE '%$keyword%' 
            OR tanggal_kunjungan LIKE '%$keyword%'
            ORDER BY id DESC";
} else {
  $query = "SELECT * FROM pasien ORDER BY id DESC";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Data Pasien</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navbar -->
  <nav class="bg-green-600 text-white px-8 py-4 flex justify-between items-center shadow-lg">
    <h1 class="text-2xl font-bold">🏥 Dashboard Admin</h1>
    <div>
      <span class="mr-4">👤 <?= $_SESSION['username'] ?></span>
      <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Logout</a>
    </div>
  </nav>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 md:block flex-shrink-0">
      <h2 class="text-xl font-bold text-gray-700 mb-6">Menu</h2>
      <ul class="space-y-4">
        <li><a href="dashboard_admin.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">🏠 Dashboard</a></li>
        <li><a href="dashboard_pasien.php" class="block px-3 py-2 bg-green-100 text-green-700 rounded">🧾 Data Pasien</a></li>
        <li><a href="dashboard_dokter.php" class="block px-3 py-2 hover:bg-green-50 text-gray-700 rounded">👨‍⚕️ Data Dokter</a></li>
        <li><a href="riwayat_kunjungan.php" class="block px-3 py-2 hover:bg-green-50 text-gray-700 rounded">📜 Riwayat Kunjungan</a></li>
        <li><a href="dashboard_hubungi.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">💬 Pesan Masuk</a></li>
        <li><a href="logout.php" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded">🚪 Logout</a></li>
      </ul>
    </aside>

    <!-- Konten -->
    <main class="flex-1 p-8">

      <!-- Form Tambah Pasien -->
      <section class="bg-white shadow-lg rounded-2xl p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">🧾 Tambah Data Pasien</h2>

        <?php
        $dokterQuery = $conn->query("SELECT * FROM dokter ORDER BY nama_dokter ASC");
        ?>

        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="font-semibold">Nama Pasien</label>
            <input type="text" name="nama_pasien" required class="w-full border p-2 rounded mt-1">
          </div>

          <div>
            <label class="font-semibold">Umur</label>
            <input type="number" name="umur" required class="w-full border p-2 rounded mt-1">
          </div>

          <div>
            <label class="font-semibold">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border p-2 rounded mt-1">
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>

          <div>
            <label class="font-semibold">No HP</label>
            <input type="text" name="no_hp" class="w-full border p-2 rounded mt-1">
          </div>

          <div class="col-span-2">
            <label class="font-semibold">Keluhan</label>
            <textarea name="keluhan" rows="2" class="w-full border p-2 rounded mt-1"></textarea>
          </div>

          <div>
            <label class="font-semibold">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" required class="w-full border p-2 rounded mt-1">
          </div>

          <div>
            <label class="font-semibold">Dokter Tujuan</label>
            <select name="dokter_tujuan" required class="w-full border p-2 rounded mt-1">
              <option value="">-- Pilih Dokter --</option>
              <?php while ($dokter = $dokterQuery->fetch_assoc()): ?>
                <option value="<?= $dokter['nama_dokter'] ?>">
                  <?= $dokter['nama_dokter'] ?> (<?= $dokter['spesialis'] ?>)
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="col-span-2 text-right">
            <button type="submit" name="simpan" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">
              💾 Simpan Data
            </button>
          </div>
        </form>
      </section>

      <!-- Pencarian -->
      <section class="mb-4 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-700">📋 Daftar Pasien</h2>
        <form method="GET" class="flex items-center gap-2">
          <input type="text" name="search" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari nama / dokter / tanggal" class="border border-gray-300 rounded-lg px-3 py-2 w-64">
          <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">🔍 Cari</button>
          <?php if ($keyword): ?>
            <a href="dashboard_pasien.php" class="text-gray-500 hover:text-red-500 text-sm ml-2">❌ Reset</a>
          <?php endif; ?>
        </form>
      </section>

      <!-- Tabel Data Pasien -->
      <section class="bg-white shadow-lg rounded-2xl p-6">
        <div class="overflow-x-auto">
          <table class="w-full border text-sm text-left">
            <thead class="bg-green-500 text-white">
              <tr>
                <th class="p-2">No</th>
                <th class="p-2">Nama Pasien</th>
                <th class="p-2">Umur</th>
                <th class="p-2">JK</th>
                <th class="p-2">No HP</th>
                <th class="p-2">Dokter Tujuan</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Keluhan</th>
                <th class="p-2 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result->num_rows > 0): ?>
                <?php $no=1; while($row = $result->fetch_assoc()): ?>
                  <tr class="border-b hover:bg-gray-50">
                    <td class="p-2"><?= $no++ ?></td>
                    <td class="p-2"><?= $row['nama_pasien'] ?></td>
                    <td class="p-2"><?= $row['umur'] ?></td>
                    <td class="p-2"><?= $row['jenis_kelamin'] ?></td>
                    <td class="p-2"><?= $row['no_hp'] ?></td>
                    <td class="p-2"><?= $row['dokter_tujuan'] ?></td>
                    <td class="p-2"><?= $row['tanggal_kunjungan'] ?></td>
                    <td class="p-2"><?= $row['keluhan'] ?></td>
                    <td class="p-2 text-center">
                      <a href="edit_pasien.php?id=<?= $row['id'] ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                      <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Hapus</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr><td colspan="9" class="text-center text-gray-500 p-4">Tidak ada data ditemukan.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </section>

    </main>
  </div>

</body>
</html>
