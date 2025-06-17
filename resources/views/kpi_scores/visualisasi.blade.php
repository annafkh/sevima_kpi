<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Data KPI Per Karyawan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl p-6 mx-auto bg-white rounded shadow sm:px-6 lg:px-8">
            @foreach ($groupedScores as $userId => $scores)
                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-bold text-indigo-700">
                        {{ $scores->first()->karyawan->nama }} (ID: {{ $userId }})
                    </h3>
                    <table class="w-full mb-4 table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">Indikator</th>
                                <th class="px-4 py-2 border">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scores as $score)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $score->kpiIndicator->nama }}</td>
                                    <td class="px-4 py-2 border">{{ $score->nilai }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
