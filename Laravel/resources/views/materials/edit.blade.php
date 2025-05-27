@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Materi</h2>
<form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf @method('PUT')
    <div>
        <label class="block font-semibold">Judul</label>
        <input type="text" name="title" class="w-full border rounded p-2" value="{{ $material->title }}" required>
    </div>
    <div>
        <label class="block font-semibold">File (opsional)</label>
        @if($material->file)
            <a href="{{ asset('storage/'.$material->file) }}" class="text-blue-600 underline" target="_blank">File Lama</a>
        @endif
        <input type="file" name="file" class="w-full border rounded p-2 mt-2">
    </div>
    <div>
        <label class="block font-semibold">Konten Materi (opsional)</label>
        <textarea name="content" rows="6" class="w-full border rounded p-2">{{ $material->content }}</textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection 