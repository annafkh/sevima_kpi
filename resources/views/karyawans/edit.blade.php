<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Karyawan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl p-6 mx-auto bg-white rounded shadow sm:px-6 lg:px-8">
            <form action="{{ route('karyawans.update', $karyawan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ $karyawan->nama }}" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">No KTP</label>
                    <input type="text" name="ktp" value="{{ $karyawan->ktp }}" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Jabatan</label>
                    <select name="jabatan" class="w-full px-3 py-2 border rounded" required>
                        <option value="">Pilih Jabatan</option>
                        <option value="PIC of CS" {{ $karyawan->jabatan == 'PIC of CS' ? 'selected' : '' }}>PIC of CS</option>
                        <option value="Product Trainer" {{ $karyawan->jabatan == 'Product Trainer' ? 'selected' : '' }}>Product Trainer</option>
                        <option value="QA of CS" {{ $karyawan->jabatan == 'QA of CS' ? 'selected' : '' }}>QA of CS</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">No Hp</label>
                    <input type="text" name="nohp" value="{{ $karyawan->nohp }}" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Jenis Kelamin</label>
                    <select name="jk" class="w-full px-3 py-2 border rounded" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki - Laki" {{ $karyawan->jk == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                        <option value="Perempuan" {{ $karyawan->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('karyawans.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                    <button type="submit" class="px-4 py-2 text-black bg-green-500 rounded hover:bg-green-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
