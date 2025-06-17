<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Nilai KPI
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl p-6 mx-auto bg-white rounded shadow sm:px-6 lg:px-8">
            <form action="{{ route('kpi_scores.update', $score->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Karyawan</label>
                
                    {{-- Select hanya untuk ditampilkan, tidak bisa diubah --}}
                    <select class="w-full px-3 py-2 border rounded bg-gray-100 cursor-not-allowed" disabled>
                        @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}" @if($karyawan->id == $score->karyawan_id) selected @endif>
                                {{ $karyawan->nama }}
                            </option>
                        @endforeach
                    </select>
                
                    {{-- Hidden input agar tetap dikirim ke server --}}
                    <input type="hidden" name="karyawan_id" value="{{ $score->karyawan_id }}">
                </div>                

                <div class="mb-4">
                    <label class="block text-gray-700">KPI Indicator</label>
                    
                    {{-- Select ditampilkan tapi tidak bisa diubah --}}
                    <select class="w-full px-3 py-2 border rounded bg-gray-100 cursor-not-allowed" disabled>
                        @foreach ($indicators as $indicator)
                            <option value="{{ $indicator->id }}" @if($indicator->id == $score->kpi_indicator_id) selected @endif>
                                {{ $indicator->nama }}
                            </option>
                        @endforeach
                    </select>
                
                    {{-- Hidden input agar data tetap dikirim --}}
                    <input type="hidden" name="kpi_indicator_id" value="{{ $score->kpi_indicator_id }}">
                </div>                

                <div class="mb-4">
                    <label class="block text-gray-700">Nilai</label>
                    <input type="number" name="nilai" step="0.01" value="{{ $score->nilai }}" class="w-full px-3 py-2 border rounded" required>
                </div>

                <div class="flex justify-between">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                    <button type="submit" class="px-4 py-2 text-black bg-blue-500 rounded hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
