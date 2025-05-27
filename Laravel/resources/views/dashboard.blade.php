@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="bg-white shadow-lg rounded-2xl p-6 mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Selamat datang, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-gray-500 mt-2 text-lg">Role: <span class="font-semibold text-indigo-600">{{ auth()->user()->role }}</span></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('classes.index') }}" class="group relative bg-blue-600 text-white p-6 rounded-2xl shadow-md hover:bg-blue-700 transition transform hover:-translate-y-1">
            <h3 class="text-2xl font-bold mb-2">📘 Kelas</h3>
            <p class="text-sm text-white/80">Lihat dan kelola semua kelas yang kamu ikuti atau buat.</p>
        </a>

        <a href="{{ route('materials.list') }}" class="group relative bg-green-600 text-white p-6 rounded-2xl shadow-md hover:bg-green-700 transition transform hover:-translate-y-1">
            <h3 class="text-2xl font-bold mb-2">📂 Materi</h3>
            <p class="text-sm text-white/80">Akses semua materi yang telah kamu buat dan bagikan.</p>
        </a>

        <a href="{{ route('assignments.index', 1) }}" class="group relative bg-yellow-500 text-white p-6 rounded-2xl shadow-md hover:bg-yellow-600 transition transform hover:-translate-y-1">
            <h3 class="text-2xl font-bold mb-2">📝 Tugas</h3>
            <p class="text-sm text-white/80">Kelola dan lihat tugas yang diberikan di kelas.</p>
        </a>
    </div>

    <form action="{{ url('logout') }}" method="POST" class="mt-10 text-center">
        @csrf
        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white text-base font-semibold rounded-full shadow hover:bg-red-700 transition">
            🔓 Logout
        </button>
    </form>
</div>
@endsection
