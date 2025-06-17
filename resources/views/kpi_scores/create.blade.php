<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tambah Nilai KPI
        </h2>
    </x-slot>
    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="py-6">
        <div class="max-w-5xl p-6 mx-auto bg-white rounded shadow sm:px-6 lg:px-8">
            <form action="{{ route('kpi_scores.store') }}" method="POST" id="formPenilaian">
                @csrf

                {{-- KARYAWAN --}}
                <div class="mb-4">
                    <label class="block text-gray-700">Karyawan</label>
                    <select name="karyawan_id" id="karyawanSelect" class="form-select" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}"
                                {{ old('karyawan_id', $selectedKaryawanId ?? '') == $karyawan->id ? 'selected' : '' }}>
                                {{ $karyawan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- KPI INDICATOR --}}
                    @if ($selectedKaryawanId)
                    <div class="mb-4">
                        <label class="block text-gray-700">KPI Indicator</label>
                        <select name="kpi_indicator_id" class="w-full px-3 py-2 border rounded" required>
                            @forelse ($indicators as $indicator)
                                <option value="{{ $indicator->id }}">{{ $indicator->nama }}</option>
                            @empty
                                <option disabled selected>Semua indikator sudah dinilai untuk semester ini.</option>
                            @endforelse
                        </select>
                    </div>
                @endif            
            

                {{-- NILAI --}}
                <div class="mb-4">
                    <label class="block text-gray-700">Nilai</label>
                    <input
                        type="number"
                        id="nilai"
                        name="nilai"
                        step="1"
                        min="1"
                        max="5"
                        class="w-full px-3 py-2 border rounded"
                        required
                    >
                    <p id="error-nilai" class="text-red-500 text-sm mt-1 hidden">Pesan error di sini</p>
                </div>

                {{-- TANGGAL --}}
                <div class="mb-4">
                    <label class="block text-gray-700">Tanggal Penilaian</label>
                    <input
                        type="date"
                        name="tanggal"
                        class="w-full px-3 py-2 border rounded"
                        value="{{ old('tanggal', date('Y-m-d')) }}"
                        
                        readonly
                    >
                </div>

                {{-- PERIODE --}}
                @php
                    $bulan = now()->month;
                    $semester = $bulan <= 6 ? 'Semester 1 (Jan - Jun)' : 'Semester 2 (Jul - Des)';
                @endphp
                <p class="mb-4 text-blue-600 font-semibold">Periode Penilaian Aktif: {{ $semester }}</p>

                {{-- AKSI --}}
                <div class="flex justify-between">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                    <button type="submit" class="px-4 py-2 text-black bg-blue-500 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

{{-- SCRIPT --}}
<script>
    document.getElementById('karyawanSelect').addEventListener('change', function () {
        const selectedId = this.value;
        if (selectedId) {
            window.location.href = "{{ route('kpi_scores.create') }}?karyawan_id=" + selectedId;
        }
    });
</script>

<script>
    const form = document.getElementById('formPenilaian');
    const nilai = document.getElementById('nilai');
    const errorText = document.getElementById('error-nilai');

    if (form && nilai && errorText) {
        form.addEventListener('submit', function (e) {
            let isValid = true;
            errorText.classList.add('hidden');

            const nilaiInput = parseFloat(nilai.value);

            if (!nilai.value) {
                isValid = false;
                errorText.textContent = 'Nilai tidak boleh kosong.';
                errorText.classList.remove('hidden');
            } else if (nilaiInput > 5) {
                isValid = false;
                errorText.textContent = 'Nilai tidak boleh lebih dari 5.';
                errorText.classList.remove('hidden');
            } else if (nilaiInput < 1) {
                isValid = false;
                errorText.textContent = 'Nilai tidak boleh kurang dari 1.';
                errorText.classList.remove('hidden');
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }
</script>
