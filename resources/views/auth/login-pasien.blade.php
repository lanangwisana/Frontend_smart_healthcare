<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - SentraCare</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-green-100">

  <!-- NAVBAR -->
  <nav class="flex justify-between items-center py-6 px-10 bg-white/80 backdrop-blur-md shadow-sm fixed w-full top-0 z-50">
    <a href="/landingpage-pasien" class="text-3xl font-bold text-emerald-600 tracking-wide">SentraCare</a>
    <div class="flex items-center gap-8">
      <a href="#services" class="hover:text-emerald-600 font-medium">Layanan</a>
      <a href="#contact" class="hover:text-emerald-600 font-medium">Kontak</a>
      <a href="/login-pasien" class="bg-gradient-to-r from-emerald-600 to-cyan-500 text-white px-5 py-2 rounded-xl hover:opacity-90 transition">Masuk</a>
    </div>
  </nav>

  <!-- CONTAINER -->
  <div class="flex items-center justify-center min-h-screen px-6 md:px-12 pt-28 md:pt-32">
    <div class="bg-white rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden w-full max-w-5xl">

      <!-- ILUSTRASI -->
      <div class="md:w-1/2 flex items-center justify-center bg-white p-10">
        <img src="{{ asset('images/receptionist.png') }}" 
             alt="SentraCare Illustration" 
             class="w-4/5 max-w-md object-contain">
      </div>

      <!-- FORM LOGIN -->
      <div class="md:w-1/2 p-10 flex flex-col justify-center bg-white">
        <h2 class="text-3xl font-bold text-emerald-700 mb-6 text-center">Masuk ke SentraCare</h2>

        <form id="loginForm" class="space-y-5">
          <!-- Username -->
          <div>
            <label class="block text-gray-700 font-semibold mb-2">Username</label>
            <input type="text" name="username"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400"
                   placeholder="Masukkan username" required>
          </div>

          <!-- Password -->
          <div>
            <label class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-400"
                   placeholder="Masukkan password" required>
          </div>

          <!-- Tombol -->
          <button type="submit"
                  class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-lg transition">
            Masuk
          </button>
        </form>

        <!-- Teks bawah -->
        <p class="text-center text-sm text-gray-600 mt-5">
          Belum punya akun?
          <a href="/register" class="text-emerald-600 font-semibold hover:underline">Daftar</a>
        </p>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      window.location.href = '/pasien/dashboard-pasien';
    });
  </script>

</body>
</html>
