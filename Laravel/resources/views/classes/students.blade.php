@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-6 border-b-2 border-indigo-600 pb-2">
        Daftar Mahasiswa: {{ $class->name }}
    </h2>

    <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
        <table class="min-w-full bg-white">
            <thead class="bg-indigo-600">
                <tr>
                    <th class="text-left text-white font-semibold py-3 px-6">Nama</th>
                    <th class="text-left text-white font-semibold py-3 px-6">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr class="border-b border-gray-100 hover:bg-indigo-50 transition">
                    <td class="py-4 px-6 text-gray-800 font-medium">{{ $student->name }}</td>
                    <td class="py-4 px-6 text-gray-600">{{ $student->email }}</td>
                </tr>
                @endforeach
                @if($students->isEmpty())
                <tr>
                    <td colspan="2" class="text-center py-6 text-gray-500 italic">Belum ada mahasiswa terdaftar.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
