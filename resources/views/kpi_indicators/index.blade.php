<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">📊 Daftar KPI Indicator</h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 font-semibold text-green-600">
                    {{ session('success') }}
                </div>
            @endif

        <div class="flex justify-between mb-4">
            <a href="{{ url()->previous() }}" class="px-4 py-2 font-bold text-white bg-gray-600 rounded shadow hover:bg-gray-700">
                ← Kembali
            </a>
            <a href="{{ auth()->user()->role !== 'leader' ? route('kpi_indicators.create') : '#' }}" 
                class="px-4 py-2 font-bold text-black rounded shadow 
                    {{ auth()->user()->role === 'leader' ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"
                @if(auth()->user()->role === 'leader') onclick="return false;" 
                @endif
            >
                + Tambah KPI Indicator
            </a>
        </div>


            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-full text-sm text-gray-700">
                    <thead class="text-xs font-semibold text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left border-b">#</th>
                            <th class="px-4 py-3 text-left border-b">Nama</th>
                            <th class="px-4 py-3 text-left border-b">Kategori KPI</th>
                            <th class="px-4 py-3 text-left border-b">Bobot</th>
                            <th class="px-4 py-3 text-left border-b">Deskripsi Poin</th>
                            <th class="px-4 py-3 text-left border-b">Target</th>
                            <th class="px-4 py-3 text-left border-b">Status</th>
                            <th class="px-4 py-3 text-left border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($indicators as $indicator)
                            @php
                                $category = $categories->firstWhere('id', $indicator->kpi_category_id);
                            @endphp
                            <tr class="transition duration-150 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $indicator->nama }}</td>
                                <td class="px-4 py-3">{{ $category->nama ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $indicator->bobot }}%</td>
                                <td class="px-4 py-3">{!! nl2br(e($indicator->deskripsi)) !!}</td>
                                <td class="px-4 py-3">{{ $indicator->target }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold rounded 
                                        {{ $indicator->status === 'aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ ucfirst($indicator->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if (auth()->user()->role !== 'leader')
                                        <a href="{{ route('kpi_indicators.edit', $indicator->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                        |
                                        <form action="{{ route('kpi_indicators.destroy', $indicator->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin hapus?')" class="font-medium text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    @else
                                        <span class="italic text-gray-400">Tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
