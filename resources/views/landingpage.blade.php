<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Healya - Digital Medical Check-Up</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-emerald-50 to-cyan-100 text-gray-700">

  <!-- Navbar -->
  <nav class="flex justify-between items-center py-6 px-10 bg-white/80 backdrop-blur-md shadow-sm fixed w-full top-0 z-50">
    <h1 class="text-3xl font-bold text-emerald-600 tracking-wide">Healya</h1>
    <div class="flex items-center gap-8">
      <a href="#services" class="hover:text-emerald-600 font-medium">Layanan</a>
      <a href="#contact" class="hover:text-emerald-600 font-medium">Kontak</a>
      <a href="/login" class="bg-gradient-to-r from-emerald-600 to-cyan-500 text-white px-5 py-2 rounded-xl hover:opacity-90 transition">Masuk</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto px-10 pt-32 pb-20">
    <div class="md:w-1/2 space-y-6">
      <h2 class="text-5xl md:text-6xl font-bold text-emerald-700 leading-tight">
        Pemeriksaan Kesehatan<br>
        <span class="text-blue-600">mudah & terpercaya</span>
      </h2>
      <p class="text-gray-600 text-lg leading-relaxed">
        Healya membantu Anda melakukan pemesanan medical check-up dan layanan kesehatan digital tanpa antre dengan hasil yang cepat dan akurat.
      </p>
      <div class="flex gap-4 pt-4">
        <a href="/booking" class="bg-gradient-to-r from-emerald-600 to-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:opacity-90 transition">Mulai Sekarang</a>
        <a href="#features" class="px-6 py-3 rounded-xl border border-emerald-600 text-emerald-700 font-semibold hover:bg-emerald-50 transition">Pelajari Lebih Lanjut</a>
      </div>
    </div>
    <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
      <img src="{{ asset('images/healya hero.png') }}" 
           alt="Healya Hero"  class="w-[90%] md:w-[95%] lg:w-[90%] object-contain">
    </div>
  </section>

 <!-- Pilih Layanan Anda (warna card: putih / tosca muda) -->
<section id="services" class="py-20 bg-white">
  <div class="max-w-6xl mx-auto text-center px-6">
    <h3 class="text-4xl font-bold text-emerald-700 mb-10">Pilih Layanan Anda</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

      <!-- Booking Tes Darah (CARD PUTIH) -->
      <div class="bg-gradient-to-br from-emerald-50 to-cyan-100 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all flex flex-col items-center">
        <img src="{{ asset('images/ceklabb1.gif') }}" alt="Tes Darah" class="w-28 h-28 mb-4 object-contain">
        <h4 class="text-2xl font-semibold text-emerald-800 mb-3">Booking Tes Darah</h4>
        <p class="text-gray-600 text-center mb-6">Lakukan pemeriksaan darah untuk mengetahui kondisi tubuh Anda secara menyeluruh.</p>
        <a href="/booking" class="mt-auto bg-emerald-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">Pesan Sekarang</a>
      </div>

      <!-- Booking Medical Check-Up (CARD TOSCA MUDA) -->
      <div class="bg-gradient-to-br from-emerald-50 to-cyan-100 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all flex flex-col items-center">
        <img src="{{ asset('images/checkup1.gif') }}" alt="Checkup" class="w-28 h-28 mb-4 object-contain">
        <h4 class="text-2xl font-semibold text-emerald-700 mb-3">Booking Medical Check-Up</h4>
        <p class="text-gray-700 text-center mb-6">Pesan layanan pemeriksaan menyeluruh untuk memastikan kesehatan tubuh Anda.</p>
        <a href="/booking" class="mt-auto bg-emerald-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">Pesan Sekarang</a>
      </div>

      <!-- Booking Vaksinasi (CARD PUTIH) -->
      <div class="bg-gradient-to-br from-emerald-50 to-cyan-100 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all flex flex-col items-center">
        <img src="{{ asset('images/vaksinasi1.gif') }}" alt="Vaksinasi" class="w-28 h-28 mb-4 object-contain">
        <h4 class="text-2xl font-semibold text-emerald-800 mb-3">Booking Vaksinasi</h4>
        <p class="text-gray-600 text-center mb-6">Pilih layanan vaksinasi dengan jadwal yang fleksibel dan tenaga medis terpercaya.</p>
        <a href="/booking" class="mt-auto bg-emerald-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">Pesan Sekarang</a>
      </div>

    </div>
  </div>
</section>

  <!-- Footer -->
  <footer class="text-center text-gray-500 py-8 text-sm bg-white">
    © 2025 Healya. Semua hak cipta dilindungi.
  </footer>

</body>
</html>
