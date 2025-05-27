<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portal Akademik</title>

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

  <!-- Google Fonts: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>

  <!-- Font Awesome 6.4.0 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 text-white flex flex-col shadow-xl">
      <a href="/dashboard" class="p-6 font-extrabold text-2xl tracking-wide border-b border-blue-700 hover:text-blue-300 transition">
        Portal Akademik
      </a>

      <nav class="flex-1 mt-6 px-4 space-y-3">
        <a href="/classes" class="nav-link bg-blue-700 hover:bg-blue-600">
          <i class="fa-solid fa-chalkboard mr-3 text-xl"></i> Kelas
        </a>
        <a href="/materials" class="nav-link bg-green-700 hover:bg-green-600">
          <i class="fa-solid fa-book mr-3 text-xl"></i> Materi
        </a>
        <a href="/assignments" class="nav-link bg-yellow-600 hover:bg-yellow-500">
          <i class="fa-solid fa-list-check mr-3 text-xl"></i> Tugas
        </a>
      </nav>

      <!-- User Info -->
      <div class="px-6 py-4 border-t border-blue-700 flex items-center space-x-4">
        <i class="fa-solid fa-user"></i>
        <div>
          <p class="font-semibold text-white leading-tight">{{ auth()->user()->name }}</p>
        </div>
      </div>

      <!-- Logout -->
      <form method="POST" action="/logout" class="p-4 border-t border-blue-700">
        @csrf
        <button type="submit"
          class="w-full py-3 px-5 rounded-lg bg-red-600 font-semibold hover:bg-red-700 transition text-white">
          <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
        </button>
      </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 bg-gray-50 overflow-y-auto shadow-inner">
      @yield('content')
    </main>
  </div>

  <!-- Custom Component Styling -->
  <style>
    .nav-link {
      display: flex;
      align-items: center;
      padding: 0.75rem 1.25rem;
      font-weight: 600;
      border-radius: 0.75rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
  </style>
</body>
</html>
