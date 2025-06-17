@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Evaluasi KPI - {{ $employee->name }}</h2>

    <h4 class="mt-4">Rata-Rata Nilai per Indikator</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Indikator</th>
                <th>Rata-Rata Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($averageScores as $indicatorId => $avg)
                <tr>
                    <td>{{ \App\Models\Indicator::find($indicatorId)->name }}</td>
                    <td>{{ number_format($avg, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="mt-5">Riwayat Penilaian Bulanan</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $h)
                <tr>
                    <td>{{ DateTime::createFromFormat('!m', $h->month)->format('F') }} {{ $h->year }}</td>
                    <td>{{ $h->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
