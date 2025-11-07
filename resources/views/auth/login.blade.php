<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form id="loginForm" class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-xl font-bold mb-4 text-center">Login</h2>
        <input type="email" name="email" placeholder="Email" class="w-full mb-3 px-3 py-2 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 px-3 py-2 border rounded" required>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Login</button>
        <p id="responseMsg" class="mt-4 text-sm text-center text-red-500"></p>
    </form>
</body>
</html>
