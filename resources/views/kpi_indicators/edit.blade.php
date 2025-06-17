<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit KPI Indicator</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl p-6 mx-auto bg-white rounded shadow sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 font-semibold text-red-600">
                    <strong>Oops!</strong> Ada kesalahan pada input:
                    <ul class="mt-2 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kpi_indicators.update', $kpi_indicator->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ $kpi_indicator->nama }}" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full px-3 py-2 border rounded">{{ $kpi_indicator->deskripsi }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Kategori</label>
                    <select name="kategori_id" class="w-full px-3 py-2 border rounded" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kpi_categories as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kpi_indicator->kpi_category_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700">Bobot (%)</label>
                    <input type="number" step="0.01" name="bobot" value="{{ $kpi_indicator->bobot }}" class="w-full px-3 py-2 border rounded" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700">Target</label>
                    <input type="number" name="target" value="{{ $kpi_indicator->target }}" class="w-full px-3 py-2 border rounded" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700">Status</label>
                    <select name="status" class="w-full px-3 py-2 border rounded" required>
                        <option value="aktif" {{ $kpi_indicator->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ $kpi_indicator->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
                
                <div class="flex justify-between">
                    <a href="{{ route('kpi_indicators.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                    <button type="submit" class="px-4 py-2 text-black bg-green-500 rounded hover:bg-green-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
