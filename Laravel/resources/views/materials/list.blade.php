@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Materi Saya</h2>

    @if($materials->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-lg shadow">
            <p class="text-gray-500 text-lg">Belum ada materi yang dibuat.</p>
        </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($materials as $material)
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow hover:shadow-lg transition duration-300">
            <div class="flex justify-between items-start">
                <h3 class="text-xl font-bold text-blue-700">{{ $material->title }}</h3>
                <a href="{{ route('materials.edit', $material->id) }}" class="text-sm text-blue-500 hover:underline">✏️ Edit</a>
            </div>
           <p class="text-gray-600 mt-1">
    <span class="font-medium">Kelas:</span>
    @if($material->classroom)
        <a href="{{ url('classes/' . $material->classroom->id . '/materials') }}" class="text-blue-600 hover:underline">
            {{ $material->classroom->name }}
                </a>
            @else
                -
            @endif
                </p>
            @if($material->file)
                <p class="mt-3">
                    <a href="{{ asset('storage/'.$material->file) }}" target="_blank" class="inline-block text-sm text-blue-600 hover:underline">
                        📎 Download File
                    </a>
                </p>
            @endif

            @if($material->content)
                <div class="mt-4 text-gray-700 text-sm whitespace-pre-line bg-gray-50 rounded-lg p-3">
                    {{ $material->content }}
                </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
