<?php
include 'db.php';

// Proses pendaftaran pasien
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_pasien'];
    $umur = $_POST['umur'];
    $jk = $_POST['jenis_kelamin'];
    $nohp = $_POST['no_hp'];
    $keluhan = $_POST['keluhan'];
    $tanggal = $_POST['tanggal_kunjungan'];
    $dokter = $_POST['dokter_tujuan'];

    if (empty($nama) || empty($umur) || empty($jk) || empty($nohp) || empty($keluhan) || empty($tanggal) || empty($dokter)) {
        echo "<script>alert('Semua field wajib diisi!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO pasien (nama_pasien, umur, jenis_kelamin, no_hp, keluhan, tanggal_kunjungan, dokter_tujuan)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssss", $nama, $umur, $jk, $nohp, $keluhan, $tanggal, $dokter);

        if ($stmt->execute()) {
            header("Location: sukses.php?nama=" . urlencode($nama));
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
        $stmt->close();
    }
}

// Ambil daftar dokter
$dokterQuery = $conn->query("SELECT * FROM dokter ORDER BY nama_dokter ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Pasien - Rumah Sakit Mabar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'] },
          colors: { primary: { 500: '#10b981', 600: '#059669', 700: '#047857' } }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-100 font-sans pt-20 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-sm fixed top-0 left-0 w-full z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="index.html" class="flex items-center">
                        <i class="fas fa-hospital text-primary-500 text-2xl mr-3"></i>
                        <span class="text-xl font-bold text-gray-900">Rumah Sakit Mabar</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="index.php" class="text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                        <a href="jadwal-dokter.php" class="text-gray-600 hover:text-primary-700 px-3 py-2 rounded-md text-sm font-medium">Dokter Kami</a>
                        <a href="layanan.php" class="text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">Layanan Kami</a>
                        <a href="tentang.php" class="text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">Tentang Kami</a>
                        <a href="pendaftaran.php" class="text-primary-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">Pendaftaran</a>
                        <a href="hubungi.php" class="text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium">Hubungi</a>
                        <a href="login_system/login.php" class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


  <!-- Formulir -->
  <main class="flex-grow">
    <div class="max-w-3xl mx-auto mt-16 mb-24 bg-white p-10 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulir Pendaftaran Pasien</h2>
      <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="font-semibold">Nama Pasien</label>
          <input type="text" name="nama_pasien" required class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-primary-500">
        </div>

        <div>
          <label class="font-semibold">Umur</label>
          <input type="number" name="umur" required class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-primary-500">
        </div>

        <div>
          <label class="font-semibold">Jenis Kelamin</label>
          <select name="jenis_kelamin" required class="w-full border border-gray-300 p-2 rounded mt-1">
            <option value="">-- Pilih --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>

        <div>
          <label class="font-semibold">No HP</label>
          <input type="text" name="no_hp" required class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-primary-500">
        </div>

        <div class="col-span-2">
          <label class="font-semibold">Keluhan</label>
          <textarea name="keluhan" rows="2" required class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-primary-500"></textarea>
        </div>

        <div>
          <label class="font-semibold">Tanggal Kunjungan</label>
          <input type="date" name="tanggal_kunjungan" required class="w-full border border-gray-300 p-2 rounded mt-1 focus:ring-2 focus:ring-primary-500">
        </div>

        <div>
          <label class="font-semibold">Dokter Tujuan</label>
          <select name="dokter_tujuan" required class="w-full border border-gray-300 p-2 rounded mt-1">
            <option value="">-- Pilih Dokter --</option>
            <?php while ($dokter = $dokterQuery->fetch_assoc()): ?>
              <option value="<?= $dokter['nama_dokter'] ?>">
                <?= $dokter['nama_dokter'] ?> (<?= $dokter['spesialis'] ?>)
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="col-span-2 text-center mt-6">
          <button type="submit" name="simpan" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow-md transition">
            💾 Daftar Sekarang
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-14 mt-auto">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-10">
      <div>
        <div class="flex items-center mb-4">
          <i class="fas fa-hospital text-primary-500 text-2xl mr-3"></i>
          <span class="text-xl font-bold">Rumah Sakit Mabar</span>
        </div>
        <p class="text-gray-400">Melayani dengan hati, mengutamakan kesembuhan Anda.</p>
      </div>
      <div>
        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
        <p class="text-gray-400"><i class="fas fa-map-marker-alt mr-2"></i>Jl. Notes No.44b</p>
        <p class="text-gray-400"><i class="fas fa-phone mr-2"></i>(+62) 81371099148</p>
        <p class="text-gray-400"><i class="fas fa-envelope mr-2"></i>pakpahanjannes0@gmail.com</p>
      </div>
      <div>
        <h3 class="text-lg font-semibold mb-4">Layanan</h3>
        <ul class="space-y-2 text-gray-400">
          <li><a href="#" class="hover:text-white">Poli Umum</a></li>
          <li><a href="#" class="hover:text-white">Gawat Darurat</a></li>
          <li><a href="#" class="hover:text-white">Laboratorium</a></li>
          <li><a href="#" class="hover:text-white">Spesialis</a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-lg font-semibold mb-4">Media Sosial</h3>
        <div class="flex space-x-5">
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
          <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube text-xl"></i></a>
        </div>
      </div>
    </div>
    <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-400">
      <p>&copy; 2025 Rumah Sakit Mabar. Semua Hak Dilindungi.</p>
    </div>
  </footer>
</body>
</html>
