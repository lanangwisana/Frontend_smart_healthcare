<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Booking Pemeriksaan - Healya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="min-h-screen flex flex-col md:flex-row bg-gradient-to-br from-green-50 via-teal-50 to-emerald-100">

  <!-- Navbar -->
 <nav class="flex justify-between items-center py-6 px-10 bg-white/80 backdrop-blur-md shadow-sm fixed w-full top-0 z-50">
    <a href="/landingpage-pasien" h1 class="text-3xl font-bold text-emerald-600 tracking-wide">SentraCare</h1>
    <div class="flex items-center gap-8">
      <a href="#services" class="hover:text-emerald-600 font-medium">Layanan</a>
      <a href="#contact" class="hover:text-emerald-600 font-medium">Kontak</a>
      <a href="/login-pasien" class="bg-gradient-to-r from-emerald-600 to-cyan-500 text-white px-5 py-2 rounded-xl hover:opacity-90 transition">Masuk</a>
    </div>
  </nav>

  <!-- BAGIAN KIRI: FORM -->
  <div class="flex-[1.1] flex items-center justify-center px-12 md:px-24 py-16 mt-24"> <!-- tambahkan mt-24 biar ga ketabrak navbar -->
    <div class="w-full max-w-3xl">
      <h2 class="text-4xl font-bold text-emerald-700 mb-8">Form Booking Pemeriksaan</h2>

      < <form onsubmit="event.preventDefault(); window.location.href='/pasien/dashboard-pasien';" 
            method="POST" 
            class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
        <!-- Nama Lengkap -->
        <div class="md:col-span-2">
          <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
          <input type="text" name="nama" 
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400" 
                 placeholder="Masukkan nama lengkap">
        </div>

        <!-- Tanggal Lahir -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" 
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400">
        </div>

        <!-- Jenis Kelamin -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
          <select name="jenis_kelamin" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="laki-laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
          </select>
        </div>

        <!-- Nomor Telepon -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
          <input type="text" name="telepon" 
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400" 
                 placeholder="08xxxxxxxxxx">
        </div>

        <!-- Email -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Email</label>
          <input type="email" name="email" 
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400" 
                 placeholder="Masukkan email aktif">
        </div>

        <!-- Alamat -->
        <div class="md:col-span-2">
          <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
          <textarea name="alamat" rows="2" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400" 
                    placeholder="Masukkan alamat lengkap"></textarea>
        </div>

        <!-- Jenis Layanan -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Jenis Layanan</label>
          <select id="jenis_layanan" name="jenis_layanan" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400">
            <option value="">-- Pilih Layanan --</option>
            <option value="lab test">Lab Test</option>
            <option value="MCU">Medical Check-Up</option>
            <option value="vaksin">Vaksinasi</option>
          </select>
        </div>

        <!-- Tipe Layanan -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Tipe Layanan</label>
          <select id="tipe_layanan" name="tipe_layanan" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400">
            <option value="">-- Pilih Tipe Layanan --</option>
          </select>
        </div>

        <!-- Tanggal Pemeriksaan -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Tanggal Pemeriksaan</label>
          <input type="date" name="tanggal" 
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400">
        </div>

        <!-- Jam Pemeriksaan -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Jam Pemeriksaan</label>
          <input type="time" name="jam" 
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400">
        </div>

        <!-- Catatan -->
        <div class="md:col-span-2">
          <label class="block text-gray-700 font-semibold mb-2">Catatan Tambahan</label>
          <textarea name="catatan" rows="3" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400" 
                    placeholder="Tuliskan catatan tambahan jika ada..."></textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="md:col-span-2 mt-2">
          <button type="submit" 
                  class="w-full bg-emerald-600 text-white font-semibold py-3 rounded-lg hover:bg-emerald-700 transition">
            Booking Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- BAGIAN KANAN: GAMBAR -->
  <div class="flex-[0.9] hidden md:flex items-center justify-center">
    <img src="{{ asset('images/booking1.png') }}" 
         alt="Healya Illustration" 
         class="w-4/5 max-w-2xl object-contain">
  </div>

  <script>
    const layananSelect = document.getElementById('jenis_layanan');
    const tipeSelect = document.getElementById('tipe_layanan');

    const options = {
      "lab test": ["Tes Darah", "Tes Urine", "Tes Hormon"],
      "MCU": ["Medical Check-Up"],
      "vaksin": ["Vaksin Anak", "Vaksin HPV"]
    };

    layananSelect.addEventListener('change', function () {
      const jenis = this.value;
      tipeSelect.innerHTML = '<option value="">-- Pilih Tipe Layanan --</option>';
      if (options[jenis]) {
        options[jenis].forEach(opt => {
          const el = document.createElement('option');
          el.value = opt.toLowerCase().replace(/\s+/g, '-');
          el.textContent = opt;
          tipeSelect.appendChild(el);
        });
      }
    });
  </script>

</body>
</html>
