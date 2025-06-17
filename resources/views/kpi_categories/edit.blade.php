<!-- resources/views/kpi_categories/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Kategori KPI
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl p-6 mx-auto bg-white rounded shadow sm:px-6 lg:px-8">
            <form action="{{ route('kpi_categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Kategori -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="block w-full p-2 mt-1 border rounded" value="{{ old('nama', $category->nama) }}" required>
                    @error('nama')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="block w-full p-2 mt-1 border rounded" rows="4">{{ old('deskripsi', $category->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="px-4 py-2 text-black bg-blue-500 rounded">Perbarui</button>
                    <a href="{{ route('kpi_categories.index') }}" class="ml-2 text-gray-600">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
