@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Nilai Saya</h2>
    @if($submissions->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">Belum ada nilai yang tersedia.</div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Tugas</th>
                    <th class="px-4 py-2 border">Kelas</th>
                    <th class="px-4 py-2 border">Nilai</th>
                    <th class="px-4 py-2 border">Feedback</th>
                    <th class="px-4 py-2 border">Tanggal Submit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                <tr>
                    <td class="px-4 py-2 border">{{ $submission->assignment->title ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $submission->assignment->classroom->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $submission->grade }}</td>
                    <td class="px-4 py-2 border">{{ $submission->feedback ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $submission->submitted_at ? \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y H:i') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection 