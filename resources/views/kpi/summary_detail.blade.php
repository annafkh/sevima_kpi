<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">📊 Evaluasi Nilai KPI Karyawan</h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- Tombol Cetak dan Filter (Filter di kanan, Cetak di kiri) -->
<div class="mb-4 flex flex-wrap items-center justify-between gap-4">
    
    <!-- Tombol Cetak -->
    <button onclick="window.print()" class="px-4 py-2 text-black bg-blue-600 rounded-md hover:bg-blue-700 no-print">
        Cetak Laporan
    </button>

    <form method="GET" action="{{ route('kpi.summary.detail') }}" class="mb-4 flex justify-end gap-2">
        <input type="hidden" name="karyawan_id" value="{{ request('karyawan_id') }}">    
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
            <select name="tahun" id="tahun" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
    
        <div>
            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
            <select name="semester" id="semester" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                <option value="all" {{ request('semester') == 'all' ? 'selected' : '' }}>Semua</option>
            </select>
        </div>
    
        <div class="pt-5">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Filter
            </button>
        </div>
    </form>    

            <div class="mb-4 font-semibold text-gray-700">
                Rata-rata Nilai KPI: <span class="text-blue-600">{{ number_format($averageScore, 2) }}</span>
            </div>   
        
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-full text-sm text-gray-700">
                    <thead class="text-xs font-semibold text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left border-b">#</th>
                            <th class="px-4 py-3 text-left border-b">Karyawan</th>
                            <th class="px-4 py-3 text-left border-b">Indikator</th>
                            <th class="px-4 py-3 text-left border-b">Target</th>
                            <th class="px-4 py-3 text-left border-b">Bobot</th>
                            <th class="px-4 py-3 text-left border-b">Capaian</th>
                             <th class="px-4 py-3 text-left border-b">Tanggal</th>
                            <th class="px-4 py-3 text-left border-b no-print">Aksi</th>
                        </tr>
                    </thead>
                   <tbody class="divide-y divide-gray-200">
                                @if(request('tahun') && request('semester'))
            <div class="mb-2 text-sm text-gray-600 text-center">
                Menampilkan data untuk Tahun <strong>{{ request('tahun') }}</strong> Semester <strong>{{ request('semester') }}</strong>
            </div>
            @endif     
    @forelse ($scores as $karyawanScores)
        @php $karyawan = $karyawanScores->first()->karyawan; @endphp
        
        @foreach ($karyawanScores as $index => $item)
            <tr class="align-top transition duration-150 hover:bg-gray-50">
                @if ($index === 0)
                    <td class="px-4 py-3" rowspan="{{ $karyawanScores->count() }}">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3" rowspan="{{ $karyawanScores->count() }}">
                    <div class="mb-4">
                        <a href="{{ route('kpi_scores.create', ['karyawan_id' => $karyawan->id]) }}"
                        class="inline-block px-4 py-2 mb-2 text-black bg-green-600 rounded-md hover:bg-green-700">
                            + Tambah Data KPI 
                        </a>
                    </div>
                        <div class="font-medium text-gray-900">{{ $karyawan->nama }}</div>
                        <div class="text-xs text-gray-500">{{ $karyawan->jabatan ?? 'Divisi' }}</div>
                    </td>
                @endif

                <td class="px-4 py-3">{{ $item->kpiIndicator->nama }}</td>
                <td class="px-4 py-3">{{ $item->kpiIndicator->target }}</td>
                <td class="px-4 py-3">{{ $item->kpiIndicator->bobot }}%</td>
                <td class="px-4 py-3">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ getScoreClass($item->nilai) }}">
                        {{ $item->nilai }}
                    </span>
                </td>
               <td class="px-4 py-3">
                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}                
</td>
                <td class="px-4 py-3 no-print">
    <div class="flex space-x-2">
        <a href="{{ route('kpi_scores.edit', $item->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a> |
        <form action="{{ route('kpi_scores.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
        </form>
    </div>
</td>
            </tr>
        @endforeach

        {{-- Total dan Rekomendasi --}}
        <tr class="bg-gray-50">
            <td colspan="6" class="px-4 py-2 font-semibold text-right text-gray-700">Total Nilai KPI:</td>
            <td colspan="2" class="px-4 py-2 font-bold text-blue-700">
                @php
                    $totalKpi = 0;
                    foreach ($karyawanScores as $item) {
                        $target = $item->kpiIndicator->target;
                        $bobot = $item->kpiIndicator->bobot;
                        $capaian = $item->nilai;
                        $totalKpi += $target > 0 ? ($capaian / $target) * $bobot : 0;
                    }
                @endphp
                {{ number_format($totalKpi, 2) }}
            </td>
        </tr>
        <tr class="bg-gray-50">
            <td colspan="6" class="px-4 py-2 font-semibold text-right text-gray-700">Rekomendasi:</td>
            <td colspan="2" class="px-4 py-2 italic text-gray-800">
                @php
                    if ($totalKpi >= 90) {
                        $rekomendasi = 'Promosi Jabatan';
                    } elseif ($totalKpi >= 80) {
                        $rekomendasi = 'Mendapatkan bonus sesuai kebijakan perusahaan';
                    } elseif ($totalKpi >= 40) {
                        $rekomendasi = 'Diberikan pelatihan atau bootcamp untuk peninjauan lebih lanjut dari perusahaan';
                    } else {
                        $rekomendasi = 'Mendapatkan punishment berupa peninjauan kontrak dan/atau surat peringatan dari perusahaan';
                    }
                @endphp
                {{ $rekomendasi }}
            </td>
        </tr>
    @empty
   <tr>
    <td colspan="7" class="px-4 py-6 text-center">
        <a href="{{ route('kpi_scores.create', ['karyawan_id' => $selectedKaryawan?->id]) }}"
           class="inline-block px-4 py-2 text-black bg-green-600 rounded-md hover:bg-green-700">
            + Tambah Data KPI
        </a>
    </td>
</tr>
<tr>
    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
        Belum ada data nilai KPI 
        @if($selectedKaryawan)
            untuk <span class="font-semibold text-blue-600">{{ $selectedKaryawan->nama }}</span>.
        @endif
    </td>
</tr> 
    @endforelse
</tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>

@php
    function getScoreClass($score) {
        if (in_array($score, [4, 5])) {
            return 'bg-green-100 text-green-800';
        } elseif (in_array($score, [1, 2, 3])) {
            return 'bg-red-100 text-red-800';
        } else {
            return 'bg-gray-100 text-gray-800';
        }
    }
@endphp

<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
