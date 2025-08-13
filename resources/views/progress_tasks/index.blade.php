<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">📋 Progress Tugas Karyawan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
            @endif
            {{-- Form Pilih Indikator --}}
            <form method="GET" action="" id="indikatorForm" class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Indikator</label>
                <select name="indikator" id="indikator" class="w-full border rounded px-4 py-2" required>
                    <option value="">-- Pilih Indikator --</option>
                    <option value="tepat">Mampu menyelesaikan tugas dengan tepat waktu</option>
                    <option value="komitmen">Memiliki komitmen kerja yang tinggi untuk perusahaan</option>
                </select>
            </form>

            {{-- Form Pilih Karyawan --}}
            <div id="form-karyawan" class="hidden">
                <form method="GET" action="{{ route('progress.index') }}" class="mb-6">
                    <input type="hidden" name="indikator" id="indikator_hidden">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Karyawan</label>
                    <select name="karyawan_id" class="w-full border rounded px-4 py-2" onchange="this.form.submit()">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $k)
                            <option value="{{ $k->id }}" {{ $selected == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            {{-- FORM INPUT --}}
            @if ($selected && request('indikator') === 'tepat')
                {{-- FORM TEPAT WAKTU --}}
                <form method="POST" action="{{ route('progress.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="indikator" value="tepat">
                    <input type="hidden" name="karyawan_id" value="{{ $selected }}">

                    <div>
                        <label class="block mb-1 text-sm text-gray-600">Judul Tugas</label>
                        <input type="text" name="judul_tugas" class="w-full border rounded px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm text-gray-600">Deadline</label>
                        <input type="date" name="deadline" class="w-full border rounded px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-sm text-gray-600">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="w-full border rounded px-4 py-2">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan Tugas
                    </button>
                </form>

            @elseif ($selected && request('indikator') === 'komitmen')
                {{-- FORM KOMITMEN --}}
                <form method="POST" action="{{ route('progress.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="indikator" value="komitmen">
                    <input type="hidden" name="karyawan_id" value="{{ $selected }}">

                    <div class="bg-red-50 p-4 border border-red-300 rounded">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catat Pelanggaran Komitmen</label>

                        <div class="mb-2">
                            <label class="text-sm">Tanggal Pelanggaran</label>
                            <input type="date" name="tanggal_pelanggaran" class="w-full border rounded px-4 py-2">
                        </div>

                        <div>
                            <label class="text-sm">Deskripsi (opsional)</label>
                            <textarea name="deskripsi" rows="2" class="w-full border rounded px-4 py-2" placeholder="Contoh: Tidak menyelesaikan tugas dengan baik..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan Catatan Komitmen
                    </button>
                </form>
            @endif

                @if ($selected && request('indikator') === 'tepat')
                <div class="mt-8 mb-3 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Daftar Tugas</h3>
                    <div class="flex items-center gap-3">
                        <label for="toggleLock" class="text-sm font-medium text-gray-700">Kunci Periode Penilaian</label>
                        <button id="toggleLock" type="button"
                            class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-300 transition-colors focus:outline-none"
                            role="switch" aria-checked="false">
                            <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-300 translate-x-1"></span>
                        </button>
                    </div>
                </div>
            
                <table class="w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2">Judul</th>
                            <th class="border px-3 py-2">Deadline</th>
                            <th class="border px-3 py-2">Selesai</th>
                            <th class="border px-3 py-2">Tepat Waktu</th>
                            <th class="border px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="border px-3 py-2">{{ $task->judul_tugas }}</td>
                                <td class="border px-3 py-2">{{ $task->deadline }}</td>
                                <td class="border px-3 py-2">{{ $task->tanggal_selesai ?? '-' }}</td>
                                <td class="border px-3 py-2">
                                    @if ($task->tepat_waktu)
                                        ✅
                                    @elseif ($task->tanggal_selesai)
                                        ❌
                                    @else
                                        ⏳
                                    @endif
                                </td>
                                <td class="border px-3 py-2 space-x-1">
                                    <a href="{{ route('progress.edit', $task->id) }}"
                                       class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">
                                       Edit
                                    </a>

                                    <form action="{{ route('progress.destroy', $task->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus tugas ini?')"
                                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        
            @if ($selected && request('indikator') === 'komitmen')
            <div class="mt-8 mb-3 flex items-center justify-between">
                <h3 class="text-lg font-semibold">Catatan Pelanggaran Komitmen</h3>
                <div class="flex items-center gap-3">
                    <label for="toggleLock" class="text-sm font-medium text-gray-700">Kunci Periode Penilaian</label>
                    <button id="toggleLock" type="button"
                        class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-300 transition-colors focus:outline-none"
                        role="switch" aria-checked="false">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-300 translate-x-1"></span>
                    </button>
                </div>
            </div>
                <table class="w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2">Tanggal</th>
                            <th class="border px-3 py-2">Deskripsi</th>
                            <th class="border px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggarans as $p)
                            <tr>
                                <td class="border px-3 py-2">{{ $p->tanggal }}</td>
                                <td class="border px-3 py-2">{{ $p->deskripsi ?? '-' }}</td>
                                <td class="border px-3 py-2 space-x-1">
                                    <a href="{{ route('pelanggaran.edit', $p->id) }}"
                                    class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">Edit</a>

                                    <form action="{{ route('pelanggaran.destroy', $p->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus catatan ini?')"
                                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border px-3 py-2 text-center text-gray-500">Tidak ada pelanggaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif

            @if ($selected)
            <div class="mt-6 space-y-3">

            
                <form method="POST" action="{{ route('progress.nilaiOtomatis', $selected) }}">
                    @csrf
                    <input type="hidden" name="indikator" value="{{ request('indikator') }}">
                    <button type="submit"
                            id="btnHitung"
                            class="bg-green-400 text-white px-4 py-2 rounded cursor-not-allowed opacity-50"
                            disabled>
                        Hitung Nilai Otomatis KPI
                    </button>
                </form>
            </div>
            @endif            

        </div>
    </div>

    <script>
        const indikatorSelect = document.getElementById('indikator');
        const formKaryawan = document.getElementById('form-karyawan');
        const indikatorHidden = document.getElementById('indikator_hidden');

        indikatorSelect.addEventListener('change', function () {
            if (this.value) {
                window.location.href = `{{ url()->current() }}?indikator=${this.value}`;
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            const indikatorVal = "{{ request('indikator') }}";
            if (indikatorVal) {
                indikatorSelect.value = indikatorVal;
                indikatorHidden.value = indikatorVal;
                formKaryawan.classList.remove('hidden');
            }
        });
    </script>
    <script>
        const toggleLock = document.getElementById('toggleLock');
        const btnHitung = document.getElementById('btnHitung');
    
        let isLocked = false;
    
        toggleLock.addEventListener('click', function () {
            isLocked = !isLocked;
            toggleLock.setAttribute('aria-checked', isLocked);
    
            // Toggle warna & posisi bulatan
            toggleLock.classList.toggle('bg-green-500', isLocked);
            toggleLock.classList.toggle('bg-gray-300', !isLocked);
    
            const circle = toggleLock.querySelector('span');
            if (isLocked) {
                circle.classList.add('translate-x-6');
                circle.classList.remove('translate-x-1');
    
                btnHitung.disabled = false;
                btnHitung.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-green-400');
                btnHitung.classList.add('bg-green-600', 'hover:bg-green-700');
            } else {
                circle.classList.remove('translate-x-6');
                circle.classList.add('translate-x-1');
    
                btnHitung.disabled = true;
                btnHitung.classList.add('opacity-50', 'cursor-not-allowed', 'bg-green-400');
                btnHitung.classList.remove('bg-green-600', 'hover:bg-green-700');
            }
        });
    </script>    
</x-app-layout>
