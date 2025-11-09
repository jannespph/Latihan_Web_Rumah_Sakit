<?php
include '../db.php';
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM pasien WHERE id=$id");
$data = $result->fetch_assoc();

if (isset($_POST['update'])) {
  $nama = $_POST['nama_pasien'];
  $umur = $_POST['umur'];
  $jk = $_POST['jenis_kelamin'];
  $nohp = $_POST['no_hp'];
  $keluhan = $_POST['keluhan'];
  $tanggal = $_POST['tanggal_kunjungan'];
  $dokter = $_POST['dokter_tujuan'];

  $conn->query("UPDATE pasien SET 
    nama_pasien='$nama',
    umur='$umur',
    jenis_kelamin='$jk',
    no_hp='$nohp',
    keluhan='$keluhan',
    tanggal_kunjungan='$tanggal',
    dokter_tujuan='$dokter'
    WHERE id='$id'");
  header("Location: dashboard_pasien.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Pasien</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">✏️ Edit Data Pasien</h1>
    <form method="POST" class="grid grid-cols-2 gap-4">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">

      <div>
        <label class="font-semibold">Nama Pasien</label>
        <input type="text" name="nama_pasien" value="<?= $data['nama_pasien'] ?>" class="w-full border p-2 rounded mt-1">
      </div>

      <div>
        <label class="font-semibold">Umur</label>
        <input type="number" name="umur" value="<?= $data['umur'] ?>" class="w-full border p-2 rounded mt-1">
      </div>

      <div>
        <label class="font-semibold">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full border p-2 rounded mt-1">
          <option <?= $data['jenis_kelamin']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
          <option <?= $data['jenis_kelamin']=='Perempuan'?'selected':'' ?>>Perempuan</option>
        </select>
      </div>

      <div>
        <label class="font-semibold">No HP</label>
        <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>" class="w-full border p-2 rounded mt-1">
      </div>

      <div class="col-span-2">
        <label class="font-semibold">Keluhan</label>
        <textarea name="keluhan" rows="2" class="w-full border p-2 rounded mt-1"><?= $data['keluhan'] ?></textarea>
      </div>

      <div>
        <label class="font-semibold">Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" value="<?= $data['tanggal_kunjungan'] ?>" class="w-full border p-2 rounded mt-1">
      </div>

      <div>
        <label class="font-semibold">Dokter Tujuan</label>
        <input type="text" name="dokter_tujuan" value="<?= $data['dokter_tujuan'] ?>" class="w-full border p-2 rounded mt-1">
      </div>

      <div class="col-span-2 text-right">
        <button type="submit" name="update" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">💾 Simpan Perubahan</button>
        <a href="dashboard_pasien.php" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg ml-2">Kembali</a>
      </div>
    </form>
  </div>
</body>
</html>
