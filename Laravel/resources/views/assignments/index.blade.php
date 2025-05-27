@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Tugas: {{ $class->name }}</h2>

    <div class="flex justify-start mb-6">
        <a href="{{ route('assignments.create', $class->id) }}" 
           class="inline-flex items-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md shadow-md transition">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
           </svg>
           Tambah Tugas
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Judul</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Deadline</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">File</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($assignments as $assignment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">{{ $assignment->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                        {{ $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($assignment->file)
                            <a href="{{ asset('storage/'.$assignment->file) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 underline flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <span>Download</span>
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                        <a href="{{ route('assignments.edit', $assignment->id) }}" 
                           class="text-yellow-600 hover:text-yellow-800 font-semibold underline">Edit</a>

                        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                onclick="return confirm('Hapus tugas?')" 
                                class="text-red-600 hover:text-red-800 font-semibold underline ml-2">
                                Hapus
                            </button>
                        </form>

                        <a href="{{ route('submissions.index', $assignment->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold underline ml-2">Submission</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-500 italic">Belum ada tugas untuk kelas ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
