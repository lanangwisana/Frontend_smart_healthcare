<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" action="{{ route('register') }}" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h2 class="text-xl font-bold mb-4 text-center">Registrasi</h2>

        <select name="role" class="w-full mb-3 px-3 py-2 border rounded" required>
            <option value="">Pilih Role</option>
            <option value="pasien">Pasien</option>
            <option value="admin">Admin Klinik</option>
        </select>

        <input type="email" name="email" placeholder="Email" class="w-full mb-3 px-3 py-2 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 px-3 py-2 border rounded" required>

        <!-- Field untuk Pasien -->
        <input type="text" name="nik" placeholder="NIK" class="w-full mb-3 px-3 py-2 border rounded">
        <input type="text" name="nama_pasien" placeholder="Nama Pasien" class="w-full mb-3 px-3 py-2 border rounded">
        <input type="date" name="tanggal_lahir" class="w-full mb-3 px-3 py-2 border rounded">
        <input type="text" name="no_telpon" placeholder="No Telpon" class="w-full mb-3 px-3 py-2 border rounded">
        <input type="text" name="alamat" placeholder="Alamat" class="w-full mb-3 px-3 py-2 border rounded">

        <!-- Field untuk Admin -->
        <input type="text" name="nama_admin" placeholder="Nama Admin Klinik" class="w-full mb-3 px-3 py-2 border rounded">

        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Register</button>

        @if(session('message'))
            <p class="mt-4 text-sm text-center text-red-500">{{ session('message') }}</p>
        @endif
    </form>
</body>
</html>

