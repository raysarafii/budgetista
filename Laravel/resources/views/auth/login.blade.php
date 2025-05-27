<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6">Login</h2>
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full">Login</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ url('register') }}" class="text-blue-600 underline">Belum punya akun? Register</a>
        </div>
    </div>
</body>
</html>