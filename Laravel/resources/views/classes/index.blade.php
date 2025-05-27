@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
  <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Daftar Kelas</h2>

  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 space-y-4 sm:space-y-0">
    <a href="{{ route('classes.create') }}" 
       class="inline-block bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 text-white font-semibold px-6 py-3 rounded-lg transition">
       + Buat Kelas
    </a>

    <form action="{{ route('classes.join') }}" method="POST" class="flex space-x-2">
      @csrf
      <input 
        type="text" 
        name="code" 
        placeholder="Kode Kelas" 
        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
        required>
      <button 
        type="submit" 
        class="bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 text-white font-semibold px-5 py-2 rounded-lg transition">
        Join Kelas
      </button>
    </form>
  </div>

  <div class="overflow-x-auto rounded-lg shadow-md">
    <table class="min-w-full bg-white divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelas</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @foreach($classes as $class)
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-semibold">{{ $class->name }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-mono">{{ $class->code }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-4">
            <a href="{{ route('materials.index', $class->id) }}" class="text-blue-600 hover:text-blue-800 underline">Materi</a>
            <a href="{{ route('assignments.index', $class->id) }}" class="text-blue-600 hover:text-blue-800 underline">Tugas</a>
            <a href="{{ route('classes.students', $class->id) }}" class="text-blue-600 hover:text-blue-800 underline">Mahasiswa</a>
          </td>
        </tr>
        @endforeach
        @if($classes->isEmpty())
        <tr>
          <td colspan="3" class="px-6 py-8 text-center text-gray-400">Belum ada kelas yang tersedia.</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection
