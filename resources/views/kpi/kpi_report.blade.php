<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan KPI Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Laporan Evaluasi Nilai KPI Karyawan</h1>
    <div>
        <p>Rata-rata Nilai KPI: <strong>{{ number_format($averageScore, 2) }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Karyawan</th>
                <th>Indikator</th>
                <th>Target</th>
                <th>Bobot</th>
                <th>Capaian</th>
                <th>Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $karyawanScores)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $karyawanScores->first()->karyawan->nama }}</td>
                    <td>
                        @foreach ($karyawanScores as $item)
                            {{ $item->kpiIndicator->nama }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($karyawanScores as $item)
                            {{ $item->kpiIndicator->target }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($karyawanScores as $item)
                            {{ $item->kpiIndicator->bobot }}%<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($karyawanScores as $item)
                            {{ $item->nilai }}<br>
                        @endforeach
                    </td>
                    <td>
                        @php
                            $totalKpi = 0;
                            foreach ($karyawanScores as $item) {
                                $target = $item->kpiIndicator->target;
                                $bobot = $item->kpiIndicator->bobot;
                                $capaian = $item->nilai;
                                $totalKpi += $target > 0 ? ($capaian / $target) * $bobot : 0;
                            }
                        @endphp
                        {{ number_format($totalKpi, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
