<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">➕ Tambah KPI Indicator</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">

            <!-- Error Validation -->
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('kpi_indicators.store') }}" class="p-6 bg-white rounded-lg shadow">
                @csrf

                <!-- Nama Indicator -->
                <div class="mb-4">
                    <label for="nama" class="block mb-1 font-semibold text-gray-700">Nama Indicator</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">{{ old('deskripsi', $indicator->deskripsi ?? '') }}</textarea>
                </div>

                <!-- Kategori KPI -->
                <div class="mb-4">
                    <label for="kpi_category_id" class="block mb-1 font-semibold text-gray-700">Kategori KPI</label>
                    <select name="kpi_category_id" id="kpi_category_id" required
                            class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('kpi_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Bobot -->
                <div class="mb-4">
                    <label for="bobot" class="block mb-1 font-semibold text-gray-700">Bobot (%)</label>
                    <input type="number" name="bobot" id="bobot" value="{{ old('bobot') }}" min="0" max="100" step="0.1" required
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <!-- Target -->
                <div class="mb-4">
                    <label for="target" class="block mb-1 font-semibold text-gray-700">Target</label>
                    <input type="number" name="target" id="target" value="{{ old('target') }}" step="0.01" required
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('kpi_indicators.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 font-bold text-black bg-blue-600 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
