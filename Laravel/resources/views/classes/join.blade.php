@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Gabung Kelas</h2>
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('classes.join.mahasiswa') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="code" class="block font-semibold mb-1">Kode Kelas</label>
            <input type="text" name="code" id="code" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700">Gabung</button>
    </form>
</div>
@endsection 