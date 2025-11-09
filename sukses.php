<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Berhasil - Rumah Sakit Mabar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .fade-in-up {
      animation: fadeInUp 0.8s ease-out;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-green-100 font-sans flex flex-col min-h-screen justify-center items-center">

  <div class="bg-white p-10 rounded-3xl shadow-2xl text-center max-w-md fade-in-up border border-green-100">
    <div class="flex justify-center mb-4">
      <div class="bg-green-100 text-green-600 p-4 rounded-full">
        <i class="fa-solid fa-circle-check text-4xl"></i>
      </div>
    </div>

    <h1 class="text-3xl font-extrabold text-green-600 mb-3">Pendaftaran Berhasil!</h1>
    <p class="text-gray-700 mb-6 leading-relaxed">
      Hai <strong class="text-green-700"><?= htmlspecialchars($_GET['nama'] ?? 'Pasien Baru') ?></strong> 👋<br>
      Data kamu sudah kami terima.<br>
      Tim kami akan segera menghubungi kamu untuk konfirmasi jadwal. 💚
    </p>

    <a href="pendaftaran.php" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full text-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg inline-flex items-center gap-2">
      <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
  </div>

</body>
</html>
