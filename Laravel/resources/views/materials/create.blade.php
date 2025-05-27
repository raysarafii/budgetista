@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Materi</h2>
<form action="{{ route('materials.store', $class->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
        <label class="block font-semibold">Judul</label>
        <input type="text" name="title" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block font-semibold">File (opsional)</label>
        <input type="file" name="file" class="w-full border rounded p-2">
    </div>
    <div>
        <label class="block font-semibold">Konten Materi (opsional)</label>
        <textarea name="content" rows="6" class="w-full border rounded p-2"></textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection 