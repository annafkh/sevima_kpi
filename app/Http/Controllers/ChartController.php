<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\KpiScore;

class ChartController extends Controller
{
    /**
     * Tampilkan halaman dashboard/chart (opsional).
     */
    public function index()
    {
        return view('charts.index');
    }

    public function getChartData(Request $request)
{
    $user = Auth::user();
    $tahun = $request->query('tahun', date('Y'));
    $semester = $request->query('semester', 1);

    $startMonth = $semester == 1 ? 1 : 7;
    $endMonth = $semester == 1 ? 6 : 12;

    $query = DB::table('kpi_scores')
        ->whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', '>=', $startMonth)
        ->whereMonth('tanggal', '<=', $endMonth);

    if ($user->role === 'karyawan') {
        $karyawan = $user->karyawan;
        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
        }

        $data = $query
            ->join('kpi_indicators', 'kpi_scores.kpi_indicator_id', '=', 'kpi_indicators.id')
            ->where('kpi_scores.karyawan_id', $karyawan->id)
            ->select('kpi_indicators.nama', DB::raw('AVG(nilai) as avg_score'))
            ->groupBy('kpi_indicators.nama')
            ->get();
    } else {
        // Leader dan HC
        $data = $query
            ->join('karyawans', 'kpi_scores.karyawan_id', '=', 'karyawans.id')
            ->select('karyawans.nama', DB::raw('AVG(nilai) as avg_score'))
            ->groupBy('karyawans.nama')
            ->orderBy('karyawans.nama')
            ->get();
    }

    return response()->json($data);
}
public function chartDetail($tahun, $semester)
{
    $start = $semester == 1 ? "$tahun-01-01" : "$tahun-07-01";
    $end = $semester == 1 ? "$tahun-06-30" : "$tahun-12-31";

    $scores = DB::table('kpi_scores')
        ->join('karyawans', 'kpi_scores.karyawan_id', '=', 'karyawans.id')
        ->select('karyawans.nama', DB::raw('AVG(kpi_scores.nilai) as avg_score'))
        ->whereBetween('tanggal', [$start, $end])
        ->groupBy('kpi_scores.karyawan_id', 'karyawans.nama')
        ->get();

    return response()->json($scores);
}

public function semesterForLeader()
{
    $user = auth()->user();
    $bawahanIds = $user->bawahan->pluck('id');

    $data = KpiScore::whereIn('karyawan_id', $bawahanIds)
        ->selectRaw('YEAR(tanggal) as tahun, IF(MONTH(tanggal) <= 6, 1, 2) as semester, AVG(nilai) as avg_score')
        ->groupBy('tahun', 'semester')
        ->orderBy('tahun')
        ->orderBy('semester')
        ->get()
        ->map(function ($item) {
            return [
                'label' => 'Semester ' . $item->semester . ' ' . $item->tahun,
                'tahun' => $item->tahun,
                'semester' => $item->semester,
                'avg_score' => round($item->avg_score, 2),
            ];
        });

    return response()->json($data);
}

public function detailForLeader($tahun, $semester)
{
    $user = auth()->user();
    $bawahanIds = $user->bawahan->pluck('id');

    $start = $semester == 1 ? "$tahun-01-01" : "$tahun-07-01";
    $end = $semester == 1 ? "$tahun-06-30" : "$tahun-12-31";

    $data = KpiScore::whereBetween('tanggal', [$start, $end])
        ->whereIn('karyawan_id', $bawahanIds)
        ->with('karyawan')
        ->selectRaw('karyawan_id, AVG(nilai) as avg_score')
        ->groupBy('karyawan_id')
        ->get()
        ->map(function ($item) {
            return [
                'nama' => $item->karyawan->nama ?? 'Unknown',
                'avg_score' => round($item->avg_score, 2),
            ];
        });
    return response()->json($data);
}

}