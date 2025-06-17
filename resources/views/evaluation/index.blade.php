@extends('layouts.app')

@section('content')
<div class="container p-4 mx-auto">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Karyawan</th>
                    <th class="px-4 py-2">Periode</th>
                    <th class="px-4 py-2">Evaluator</th>
                    <th class="px-4 py-2">Nilai</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Tanggal Selesai</th>
                    <th class="px-4 py-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $e)
                <tr class="border-b">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <img src="{{ $e['employee']['avatar'] }}" alt="{{ $e['employee']['name'] }}" class="w-8 h-8 rounded-full">
                            <div>
                                <div class="font-medium">{{ $e['employee']['name'] }}</div>
                                <div class="text-xs text-gray-500">{{ $e['employee']['department'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">{{ $e['period'] }}</td>
                    <td class="px-4 py-3">{{ $e['evaluator'] }}</td>
                    <td class="px-4 py-3">
                        @if ($e['status'] === 'completed')
                            <span class="px-2 py-1 text-xs rounded-full {{ scoreClass($e['score']) }}">
                                {{ $e['score'] }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-block text-xs px-2 py-1 rounded-full 
                            {{ $e['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $e['status'] === 'completed' ? 'Selesai' : 'Dalam Proses' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">{{ $e['date'] }}</td>
                    <td class="px-4 py-3 text-right">
                        <button class="mr-2 text-blue-600 hover:underline">Detail</button>
                        <button class="mr-2 text-yellow-600 hover:underline">Edit</button>
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@php
function scoreClass($score) {
    if ($score >= 85) return 'bg-green-100 text-green-800';
    if ($score >= 70) return 'bg-blue-100 text-blue-800';
    if ($score >= 60) return 'bg-yellow-100 text-yellow-800';
    return 'bg-red-100 text-red-800';
}
@endphp
