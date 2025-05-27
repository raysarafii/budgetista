@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-3xl font-bold mb-6 text-gray-900">Tambah Tugas</h2>
    <form action="{{ route('assignments.store', $class->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
            <input id="title" type="text" name="title" required
                class="w-full border border-gray-300 rounded-md p-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea id="description" name="description" rows="5"
                class="w-full border border-gray-300 rounded-md p-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition resize-none"></textarea>
        </div>

        <div>
            <label for="file" class="block text-sm font-semibold text-gray-700 mb-1">File (opsional)</label>
            <input id="file" type="file" name="file"
                class="w-full text-gray-700 rounded-md file:border-0 file:bg-blue-600 file:text-white file:px-4 file:py-2 file:rounded-md file:cursor-pointer
                       hover:file:bg-blue-700 transition" />
        </div>

        <div>
            <label for="due_date" class="block text-sm font-semibold text-gray-700 mb-1">Deadline (opsional)</label>
            <input id="due_date" type="datetime-local" name="due_date"
                class="w-full border border-gray-300 rounded-md p-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
        </div>

        <button type="submit" 
                class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 transition">
            Simpan
        </button>
    </form>
</div>
@endsection
