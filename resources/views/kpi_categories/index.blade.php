<!-- resources/views/kpi_categories/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">📊 Daftar Kategori KPI</h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="mb-4 font-semibold text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tombol Tambah Kategori -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('kpi_categories.create') }}" class="px-4 py-2 font-bold text-black bg-blue-600 rounded shadow hover:bg-blue-700">
                    + Tambah Kategori KPI
                </a>
            </div>

            <!-- Tabel Kategori KPI -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-full text-sm text-gray-700">
                    <thead class="text-xs font-semibold text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left border-b">#</th>
                            <th class="px-4 py-3 text-left border-b">Nama Kategori</th>
                            <th class="px-4 py-3 text-left border-b">Deskripsi</th>
                            <th class="px-4 py-3 text-left border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($categories as $category)
                            <tr class="transition duration-150 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $category->nama }}</td>
                                <td class="px-4 py-3">{{ $category->deskripsi }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('kpi_categories.edit', $category->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    |
                                    <form action="{{ route('kpi_categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus?')" class="font-medium text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
