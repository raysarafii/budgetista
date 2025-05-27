@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Class: {{ $class->name }}</h2>

    <a href="{{ route('materials.create', $class->id) }}" 
       class="inline-block mb-6 rounded bg-green-600 px-5 py-3 text-white font-semibold shadow hover:bg-green-700 transition">
        + Tambah Materi
    </a>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        File
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Konten
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($materials as $material)
                    <tr>
                        <td class="px-6 py-4 whitespace-normal text-gray-900 font-semibold">
                            {{ $material->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                            @if($material->file)
                                <a href="{{ asset('storage/' . $material->file) }}" target="_blank" 
                                   class="underline hover:text-green-600 transition">
                                    Download
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-gray-700 text-sm leading-relaxed">
                            {!! nl2br(e($material->content)) !!}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="{{ route('materials.edit', $material->id) }}" 
                               class="inline-block text-yellow-500 hover:text-yellow-700 mr-4 font-semibold">
                                Edit
                            </a>
                            <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    onclick="return confirm('Hapus materi?')" 
                                    class="text-red-600 hover:text-red-800 font-semibold">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            Belum ada materi untuk kelas ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
