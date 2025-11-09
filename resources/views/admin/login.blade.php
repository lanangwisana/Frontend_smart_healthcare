<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SentraCare Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-[Segoe UI]">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-md border border-gray-200">
        <div class="text-center mb-6">
            <i class="fas fa-heartbeat text-blue-500 text-4xl mb-2"></i>
            <h3 class="text-2xl font-bold text-blue-600">Sentra Care Admin</h3>
            <p class="text-gray-500 text-sm">Masuk ke Panel Pengelolaan</p>
        </div>

        @if (session('success'))
            <div class="flex items-center bg-green-100 border border-green-300 text-green-700 text-sm p-3 rounded-lg mb-4">
                <i class="fas fa-check-circle mr-2"></i> 
                <span>{!! session('success') !!}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 transition-all duration-150 focus-within:border-blue-500 hover:border-blue-400">
                    <i class="fas fa-user text-gray-400"></i>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="admin@sentracare.com"
                        required 
                        autofocus
                        class="w-full px-2 outline-none bg-transparent text-gray-700 placeholder-gray-400"
                    >
                </div>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium mb-2">Kata Sandi</label>
                <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 transition-all duration-150 focus-within:border-blue-500 hover:border-blue-400">
                    <i class="fas fa-lock text-gray-400"></i>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        value="password123"
                        required
                        class="w-full px-2 outline-none bg-transparent text-gray-700 placeholder-gray-400"
                    >
                </div>
            </div>

            <!-- Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                Masuk
            </button>
        </form>
    </div>

</body>
</html>
