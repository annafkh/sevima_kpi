<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Tambah Karyawan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl p-6 mx-auto bg-white rounded shadow sm:px-6 lg:px-8">
            <form action="{{ route('karyawans.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="nama" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">No KTP</label>
                    <input type="text" name="ktp" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Jabatan</label>
                    <select name="jabatan" class="w-full px-3 py-2 border rounded" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="PIC of CS">PIC of CS</option>
                        <option value="Product Trainer">Product Trainer</option>
                        <option value="QA of CS">QA of CS</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">No HP</label>
                    <input type="text" name="nohp" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Jenis Kelamin</label>
                    <select name="jk" class="w-full px-3 py-2 border rounded" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('karyawans.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                    <button type="submit" class="px-4 py-2 text-black bg-blue-500 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
