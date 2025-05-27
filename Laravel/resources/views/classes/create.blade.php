@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-4">Buat Kelas Baru</h2>
<form action="{{ route('classes.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block font-semibold">Nama Kelas</label>
        <input type="text" name="name" class="w-full border rounded p-2" required>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Buat</button>
</form>
@endsection 