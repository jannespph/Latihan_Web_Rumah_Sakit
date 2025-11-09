<?php
session_start();
include '../db.php';

// Hitung jumlah data
$jml_dokter = $conn->query("SELECT COUNT(*) AS total FROM dokter")->fetch_assoc()['total'];
$jml_pasien = $conn->query("SELECT COUNT(*) AS total FROM pasien")->fetch_assoc()['total'];

// Ambil data terbaru (5 terakhir)
$dokter_result = $conn->query("SELECT * FROM dokter ORDER BY id DESC LIMIT 5");
$pasien_result = $conn->query("SELECT * FROM pasien ORDER BY id DESC LIMIT 15"); // tambahin limit biar keliatan scroll-nya

// Data untuk Chart.js
$dokter_spesialis = [];
while ($dok = $dokter_result->fetch_assoc()) {
    $dokter_spesialis[] = $dok['spesialis'];
}

$pasien_nama = [];
$pasien_umur = [];
while ($pas = $pasien_result->fetch_assoc()) {
    $pasien_nama[] = $pas['nama_pasien'];
    $pasien_umur[] = $pas['umur'];
}

// Hitung jumlah dokter per spesialisasi
$spesialis_count = array_count_values($dokter_spesialis);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navbar -->
  <nav class="bg-blue-700 text-white px-8 py-4 flex justify-between items-center shadow-lg">
    <h1 class="text-2xl font-bold">🏥 Dashboard Admin</h1>
    <div>
      <span class="mr-4">👤 <?= $_SESSION['username'] ?? 'Admin' ?></span>
      <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Logout</a>
    </div>
  </nav>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 md:block flex-shrink-0">
      <h2 class="text-xl font-bold text-gray-700 mb-6">Menu</h2>
      <ul class="space-y-4">
        <li><a href="dashboard_admin.php" class="block px-3 py-2 bg-blue-100 text-blue-700 rounded">🏠 Dashboard</a></li>
        <li><a href="dashboard_pasien.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">🧾 Data Pasien</a></li>
        <li><a href="dashboard_dokter.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">👨‍⚕️ Data Dokter</a></li>
        <li><a href="riwayat_kunjungan.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">📜 Riwayat Kunjungan</a></li>
        <li><a href="dashboard_hubungi.php" class="block px-3 py-2 hover:bg-blue-50 text-gray-700 rounded">💬 Pesan Masuk</a></li>
        <li><a href="logout.php" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded">🚪 Logout</a></li>
      </ul>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-8">
      <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Ringkasan Data</h2>

      <!-- Ringkasan -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-lg">
          <h3 class="text-lg">Jumlah Dokter</h3>
          <p class="text-4xl font-bold"><?= $jml_dokter ?></p>
        </div>

        <div class="bg-green-600 text-white p-6 rounded-2xl shadow-lg">
          <h3 class="text-lg">Jumlah Pasien</h3>
          <p class="text-4xl font-bold"><?= $jml_pasien ?></p>
        </div>
      </div>

      <!-- Grafik Dokter (Pie Chart) -->
      <section class="bg-white shadow-lg rounded-2xl p-6 mb-4 flex justify-center">
        <div class="w-full md:w-1/2 lg:w-1/3">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 text-left">👨‍⚕️ Distribusi Spesialisasi Dokter</h2>
          <canvas id="chartDokter"></canvas>
        </div>
      </section>

      <!-- Grafik Pasien (Scrollable Bar Chart) -->
      <section class="bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">🧾 Grafik Umur Pasien Terbaru</h2>

        <!-- ✅ Bikin bisa discroll -->
        <div class="w-full overflow-x-auto">
          <div id="scrollWrapper" class="min-w-[900px]">
            <canvas id="chartPasien" height="200"></canvas>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- Script Chart -->
  <script>
    // ===== Grafik Dokter (Pie Chart) =====
    const dokterLabels = <?= json_encode(array_keys($spesialis_count)) ?>;
    const dokterData = <?= json_encode(array_values($spesialis_count)) ?>;

    new Chart(document.getElementById('chartDokter'), {
      type: 'pie',
      data: {
        labels: dokterLabels,
        datasets: [{
          label: 'Jumlah Dokter per Spesialisasi',
          data: dokterData,
          backgroundColor: [
            'rgba(37, 99, 235, 0.7)',
            'rgba(16, 185, 129, 0.7)',
            'rgba(234, 179, 8, 0.7)',
            'rgba(239, 68, 68, 0.7)',
            'rgba(139, 92, 246, 0.7)'
          ],
          borderColor: '#fff',
          borderWidth: 1
        }]
      },
      options: {
        plugins: { legend: { position: 'bottom' } }
      }
    });

    // ===== Grafik Pasien (Bar Chart Scrollable) =====
    const pasienLabels = <?= json_encode($pasien_nama) ?>;
    const pasienData = <?= json_encode($pasien_umur) ?>;

    // 💡 Atur lebar dinamis biar bisa discroll sesuai jumlah data
    const minWidth = pasienLabels.length * 80; // tiap pasien 80px
    document.getElementById("scrollWrapper").style.minWidth = `${minWidth}px`;

    const ctxPasien = document.getElementById("chartPasien").getContext("2d");
    new Chart(ctxPasien, {
      type: "bar",
      data: {
        labels: pasienLabels,
        datasets: [{
          label: "Umur Pasien",
          data: pasienData,
          backgroundColor: "rgba(16, 185, 129, 0.7)",
          borderColor: "rgba(16, 185, 129, 1)",
          borderWidth: 1,
          barThickness: 40
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: {
            ticks: { color: "#374151" },
            grid: { display: false }
          },
          y: {
            beginAtZero: true,
            ticks: { color: "#374151" }
          }
        }
      }
    });
  </script>

</body>
</html>
