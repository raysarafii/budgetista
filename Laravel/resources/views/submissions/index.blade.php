@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <h2 class="text-3xl font-extrabold mb-8 text-gray-900">Submission: {{ $assignment->title }}</h2>

  @if($submissions->isEmpty())
    <div class="text-center py-20 bg-gray-50 rounded-lg shadow">
      <p class="text-gray-500 text-lg">Belum ada submission untuk tugas ini.</p>
    </div>
  @else
    <div class="overflow-x-auto rounded-lg shadow border border-gray-200">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Mahasiswa</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">File</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jawaban Teks</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nilai</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Feedback</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($submissions as $submission)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">
              {{ $submission->student->name ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($submission->file)
                <a href="{{ asset('storage/'.$submission->file) }}" target="_blank" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                  </svg>
                  Download
                </a>
              @else
                <span class="text-gray-400 italic">-</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-pre-wrap text-gray-700 text-sm max-w-xs">
              {!! nl2br(e($submission->text)) !!}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center font-semibold text-gray-900">
              {{ $submission->grade ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap max-w-sm text-gray-700 text-sm">
              {{ $submission->feedback ?? '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if(auth()->user()->role === 'dosen')
              <form action="{{ route('grades.update', $submission->id) }}" method="POST" class="flex flex-col sm:flex-row sm:space-x-3 space-y-2 sm:space-y-0 items-center">
                @csrf
                @method('PATCH')
                <input
                  type="number" name="grade" min="0" max="100"
                  value="{{ $submission->grade }}"
                  class="border border-gray-300 rounded px-3 py-1 w-20 text-center focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  required
                  placeholder="Nilai"
                >
                <input
                  type="text" name="feedback"
                  value="{{ $submission->feedback }}"
                  class="border border-gray-300 rounded px-3 py-1 flex-grow focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  placeholder="Feedback"
                >
                <button
                  type="submit"
                  class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-1 rounded flex items-center justify-center transition"
                  title="Koreksi Submission"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17h2m-1-1v-6m-6 6h12a2 2 0 002-2v-3a2 2 0 00-2-2H6a2 2 0 00-2 2v3a2 2 0 002 2z" />
                  </svg>
                  Koreksi
                </button>
              </form>
              @else
                <span class="text-gray-400 italic">-</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
