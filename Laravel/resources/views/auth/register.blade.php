<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6">Register</h2>
        <form action="{{ url('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-semibold">Nama</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold">Daftar Sebagai</label>
                <select name="role" class="w-full border rounded p-2" required>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">Register</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ url('login') }}" class="text-blue-600 underline">Sudah punya akun? Login</a>
        </div>
    </div>
</body>
</html>