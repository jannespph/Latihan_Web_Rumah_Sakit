<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Darurat - Rumah Sakit Mabar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857'
                        },
                        secondary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb'
                        },
                        accent: {
                            500: '#f97316',
                            600: '#ea580c'
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

  <main class="py-0 bg-gray-50">
  <div class="max-w-7xl mx-auto">
    <!-- Banner -->
    <section class="relative mb-6 overflow-hidden rounded-b-3xl">
      <!-- Gambar Background -->
      <img src="ambulan.jpg" alt="Konsultasi Dokter"
           class="w-full h-[500px] object-cover brightness-90 shadow-2xl transform scale-105 transition-transform duration-700 hover:scale-110">

      <!-- Overlay dan Teks -->
      <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center px-6">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-3 drop-shadow-lg tracking-wide">
          LAYANAN DARURAT 24 JAM
        </h1>
        <p class="text-base md:text-xl text-blue-100 max-w-2xl leading-relaxed">
          Respon cepat untuk setiap kondisi gawat darurat — tenaga medis kami siap siaga 24 jam untuk memberikan pertolongan pertama dengan peralatan lengkap dan profesional.
        </p>
        <div class="mt-4 w-24 h-1 bg-white/80 rounded-full"></div>
      </div>
    </section>
  </div>
</main>


  <!-- Konten -->
  <main class="max-w-6xl mx-auto px-6 py-16 leading-relaxed">
    <h2 class="text-3xl font-bold text-cyan-700 mb-6">Tentang Layanan Darurat Rumah Sakit Mabar</h2>
    <p class="text-gray-700 mb-6 text-justify">
      Layanan <span class="font-semibold text-cyan-700">Unit Gawat Darurat (UGD)</span> Rumah Sakit Mabar tersedia selama 24 jam penuh, setiap hari tanpa henti. 
      Kami didukung oleh tim dokter, perawat, dan tenaga paramedis yang berpengalaman dalam menangani berbagai kondisi kritis dengan cepat dan tepat.
    </p>

    <h3 class="text-2xl font-semibold text-gray-900 mb-3">Kondisi yang Dapat Ditangani di Layanan Darurat</h3>
    <ul class="list-disc list-inside space-y-2 text-gray-700 mb-8">
      <li>Kecelakaan lalu lintas atau cedera berat.</li>
      <li>Serangan jantung, sesak napas, atau stroke.</li>
      <li>Pendarahan hebat atau luka bakar serius.</li>
      <li>Reaksi alergi berat (anafilaksis) atau keracunan.</li>
      <li>Kejang, pingsan mendadak, atau kehilangan kesadaran.</li>
      <li>Kondisi gawat pada bayi, anak-anak, maupun lansia.</li>
    </ul>

    <h3 class="text-2xl font-semibold text-gray-900 mb-3">Fasilitas dan Layanan di Unit Gawat Darurat</h3>
    <ul class="list-disc list-inside space-y-2 text-gray-700 mb-8">
      <li>Ambulans siap siaga 24 jam dengan peralatan medis lengkap.</li>
      <li>Ruang tindakan darurat dengan perlengkapan modern.</li>
      <li>Tenaga medis profesional yang terlatih dalam penanganan trauma dan resusitasi.</li>
      <li>Sistem triase cepat untuk memprioritaskan pasien dengan kondisi paling kritis.</li>
      <li>Koordinasi langsung dengan ruang operasi, ICU, dan laboratorium.</li>
    </ul>

    <h3 class="text-2xl font-semibold text-gray-900 mb-3">Langkah Cepat Saat Darurat</h3>
    <ol class="list-decimal list-inside space-y-2 text-gray-700 mb-8">
      <li>Hubungi nomor darurat <span class="font-semibold text-cyan-700">(+62) 81371099148</span> atau datang langsung ke UGD Rumah Sakit Mabar.</li>
      <li>Tim ambulans akan segera meluncur ke lokasi untuk menjemput pasien.</li>
      <li>Pasien mendapat penanganan pertama di tempat dan dilanjutkan ke ruang tindakan UGD.</li>
      <li>Pemantauan dilakukan secara intensif oleh dokter dan perawat hingga kondisi stabil.</li>
    </ol>

    <p class="text-gray-700 mt-6 text-justify">
      Kami memahami bahwa setiap detik sangat berharga dalam situasi darurat. 
      Oleh karena itu, Rumah Sakit Mabar memastikan layanan darurat kami selalu responsif, tanggap, dan siap membantu kapan pun Anda membutuhkan.
    </p>

    <div class="mt-10 text-center">
      <a href="hubungi.php" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg transition-all duration-300">
        Hubungi Layanan Darurat Sekarang
      </a>
    </div>
  </main>

      <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-hospital text-primary-500 text-2xl mr-3"></i>
                        <span class="text-xl font-bold">Rumah Sakit Mabar</span>
                    </div>
                    <p class="text-gray-400">Melayani dengan hati, mengutamakan kesembuhan Anda.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-gray-400">
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Notes No.44b</p>
                        <p><i class="fas fa-phone mr-2"></i>(+62) 81371099148</p>
                        <p><i class="fas fa-envelope mr-2"></i>pakpahanjannes0@gmail.com</p>
                    </div>
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
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Rumah Sakit Mabar</p>
            </div>
        </div>
    </footer>

</body>
</html>
