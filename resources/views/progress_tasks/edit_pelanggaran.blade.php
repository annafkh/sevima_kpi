<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">✏️ Edit Catatan Pelanggaran</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto px-4">
            <form method="POST" action="{{ route('pelanggaran.update', $pelanggaran->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 text-sm text-gray-600">Tanggal Pelanggaran</label>
                    <input type="date" name="tanggal" value="{{ \Carbon\Carbon::parse($pelanggaran->tanggal)->format('Y-m-d') }}" class="w-full border rounded px-4 py-2" required>
                </div>                

                <div>
                    <label class="block mb-1 text-sm text-gray-600">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" rows="3" class="w-full border rounded px-4 py-2">{{ $pelanggaran->deskripsi }}</textarea>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('progress.index', ['indikator' => 'komitmen', 'karyawan_id' => $pelanggaran->karyawan_id]) }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
