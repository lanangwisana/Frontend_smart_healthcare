<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Pasien - Healya</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-green-100">

  <!-- NAVBAR -->
  <nav class="flex justify-between items-center py-6 px-10 bg-white/80 backdrop-blur-md shadow-sm fixed w-full top-0 z-50">
    <h1 class="text-3xl font-bold text-emerald-600 tracking-wide">Healya</h1>
    <div class="flex items-center gap-8">
      <a href="#services" class="hover:text-emerald-600 font-medium">Layanan</a>
      <a href="#contact" class="hover:text-emerald-600 font-medium">Kontak</a>
      <a href="/login" class="bg-gradient-to-r from-emerald-600 to-cyan-500 text-white px-5 py-2 rounded-xl hover:opacity-90 transition">Masuk</a>
    </div>
  </nav>

  <!-- CONTAINER -->
  <div class="flex items-center justify-center min-h-screen px-6 md:px-12 pt-28 md:pt-32">
    <div class="bg-white rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden w-full max-w-6xl">

      <!-- ILUSTRASI -->
      <div class="md:w-1/2 flex items-center justify-center bg-white p-10">
        <img src="{{ asset('images/register.png') }}" 
             alt="Healya Register Illustration" 
             class="w-4/5 max-w-md object-contain">
      </div>

      <!-- FORM REGISTRASI -->
      <div class="md:w-1/2 p-10 flex flex-col justify-center bg-white">
        <h2 class="text-3xl font-bold text-emerald-700 mb-6 text-center">Registrasi Pasien</h2>

        <form action="#" method="POST" class="space-y-5">
          <!-- Nama Lengkap -->
          <div>
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

          <!-- Username -->
          <div>
            <label class="block text-gray-700 font-semibold mb-2">Username</label>
            <input type="text" name="username"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400"
                   placeholder="Masukkan username unik">
          </div>

          <!-- Password -->
          <div>
            <label class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400"
                   placeholder="Masukkan password">
          </div>

          <!-- Konfirmasi Password -->
          <div>
            <label class="block text-gray-700 font-semibold mb-2">Ulangi Password</label>
            <input type="password" name="confirm_password"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400"
                   placeholder="Masukkan ulang password">
          </div>

          <!-- Tombol -->
          <button type="submit"
                  class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-lg transition">
            Daftar Sekarang
          </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-5">
          Sudah punya akun?
          <a href="/login" class="text-emerald-600 font-semibold hover:underline">Masuk</a>
        </p>
      </div>
    </div>
  </div>

</body>
</html>
