<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Healya - Dashboard Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50 to-green-100 min-h-screen">

  <!-- NAVBAR -->
  <nav class="flex justify-between items-center py-6 px-10 bg-white/80 backdrop-blur-md shadow-sm fixed w-full top-0 z-50">
    <a href="/landingpage-pasien" class="text-3xl font-bold text-emerald-600 tracking-wide">SentraCare</a>
    
    <div class="flex items-center gap-8">
      <a href="#services" class="hover:text-emerald-600 font-medium">Layanan</a>
      <a href="#contact" class="hover:text-emerald-600 font-medium">Kontak</a>
      
      <!-- PROFIL (HANYA LOGOUT) -->
        <div class="relative group">
        <button
          class="flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-cyan-500 text-white px-5 py-2 rounded-xl hover:opacity-90 transition">
          <span id="username">Halo, Bitari</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z"
              clip-rule="evenodd" />
          </svg>
        </button>

        <!-- Dropdown -->
        <div
          class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 delay-100 group-hover:delay-0">
          <a href="/landingpage-pasien" class="block px-4 py-2 text-red-600 hover:bg-red-50">Keluar</a>
        </div>
      </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main class="pt-32 pb-20 px-6 md:px-20">

    <!-- CARD SELAMAT DATANG -->
    <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl p-10 text-center mb-16">
      <h1 class="text-4xl font-bold text-emerald-700 mb-4">Selamat Datang, <span class="text-cyan-600">Bitari</span>!</h1>
      <p class="text-gray-600 mb-8">Kelola jadwal dan riwayat pemeriksaan Anda dengan mudah melalui dashboard SentraCare.</p>
      <a href="/booking-pasien" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-semibold transition">Booking Pemeriksaan</a>
    </div>

    <!-- RIWAYAT PEMERIKSAAN -->
    <section id="riwayat" class="bg-white/70 rounded-3xl shadow-md p-10 backdrop-blur-sm">
      <h2 class="text-3xl font-bold text-emerald-700 mb-8 text-center">Riwayat Pemeriksaan Anda</h2>

      <!-- CONTOH DATA -->
      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 bg-white rounded-lg overflow-hidden">
          <thead class="bg-emerald-600 text-white">
            <tr>
              <th class="py-3 px-6 text-left">Tanggal</th>
              <th class="py-3 px-6 text-left">Jenis Layanan</th>
              <th class="py-3 px-6 text-left">Tipe Layanan</th>
              <th class="py-3 px-6 text-left">Status</th>
              <th class="py-3 px-6 text-center">Report</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            <tr class="border-b hover:bg-emerald-50">
              <td class="py-3 px-6">12 Oktober 2025</td>
              <td class="py-3 px-6">Lab Test</td>
              <td class="py-3 px-6">Tes Darah</td>
              <td class="py-3 px-6"><span class="text-emerald-600 font-medium">Selesai</span></td>
              <td class="py-3 px-6 text-center">
                <a href="#" class="text-cyan-600 hover:underline">Lihat Report</a>
              </td>
            </tr>
            <tr class="border-b hover:bg-emerald-50">
              <td class="py-3 px-6">28 September 2025</td>
              <td class="py-3 px-6">Vaksinasi</td>
              <td class="py-3 px-6">Vaksin HPV</td>
              <td class="py-3 px-6"><span class="text-yellow-600 font-medium">Menunggu Hasil</span></td>
              <td class="py-3 px-6 text-center">
                <a href="#" class="text-gray-400 cursor-not-allowed">Belum Tersedia</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="text-center text-gray-500 py-10 text-sm border-t mt-20">
    © 2025 SentraCare. Semua Hak Dilindungi.
  </footer>

</body>
</html>
