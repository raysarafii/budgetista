@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Kirim Tugas</h2>
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="assignment_id" class="block font-semibold mb-1">Assignment ID</label>
            <input type="number" name="assignment_id" id="assignment_id" class="w-full border rounded px-3 py-2" required>
            <small class="text-gray-500">Masukkan ID tugas (sementara, bisa diganti select jika ada data assignments)</small>
        </div>
        <div>
            <label for="file" class="block font-semibold mb-1">File (opsional)</label>
            <input type="file" name="file" id="file" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label for="text" class="block font-semibold mb-1">Jawaban Teks (opsional)</label>
            <textarea name="text" id="text" rows="4" class="w-full border rounded px-3 py-2"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-semibold hover:bg-blue-700">Kirim</button>
    </form>
</div>
@endsection 