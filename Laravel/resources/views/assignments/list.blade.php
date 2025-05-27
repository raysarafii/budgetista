@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Tugas Saya</h2>

    @if($assignments->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-lg shadow">
            <p class="text-gray-500 text-lg">Belum ada tugas yang Anda buat.</p>
        </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($assignments as $assignment)
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow hover:shadow-lg transition duration-300">
            <div class="flex justify-between items-start">
                <h3 class="text-xl font-bold text-blue-700">{{ $assignment->title }}</h3>
                <a href="{{ route('assignments.edit', $assignment->id) }}" class="text-sm text-blue-500 hover:underline">✏️ Edit</a>
            </div>
            <p class="text-gray-600 mt-1">
    <span class="font-medium">Kelas:</span>
    @if($assignment->classroom)
        <a href="{{ url('classes/' . $assignment->classroom->id . '/assignments') }}" class="text-blue-600 hover:underline">
            {{ $assignment->classroom->name }}
        </a>
    @else
        -
    @endif
</p>
            @if($assignment->due_date)
            <p class="text-gray-500 text-sm mt-1">
                <span class="font-medium">Deadline:</span> {{ \Carbon\Carbon::parse($assignment->due_date)->translatedFormat('d M Y') }}
            </p>
            @endif

            @if($assignment->file)
                <p class="mt-3">
                    <a href="{{ asset('storage/'.$assignment->file) }}" target="_blank" class="inline-block text-sm text-blue-600 hover:underline">
                        📎 Download File
                    </a>
                </p>
            @endif

            @if($assignment->description)
                <div class="mt-4 text-gray-700 text-sm whitespace-pre-line bg-gray-50 rounded-lg p-3">
                    {{ $assignment->description }}
                </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
