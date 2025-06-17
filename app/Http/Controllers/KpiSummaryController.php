<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;
use App\Models\KpiScore;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class KpiSummaryController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $semester = $request->input('semester', 'all'); // '1', '2', atau 'all'

        if ($semester == 1) {
            $start = Carbon::create($year, 01, 01)->startOfDay();
            $end = Carbon::create($year, 06, 30)->endOfDay();
        } elseif ($semester == 2) {
            $start = Carbon::create($year, 07, 01)->startOfDay();
            $end = Carbon::create($year, 12, 31)->endOfDay();
        } else {
            $start = Carbon::create($year, 01, 01)->startOfDay();
            $end = Carbon::create($year, 12, 31)->endOfDay();
        }

        $scores = DB::table('kpi_scores')
            ->select('karyawan_id', DB::raw('SUM(nilai) as total'))
            ->whereBetween('tanggal', [$start, $end])
            ->groupBy('karyawan_id')
            ->get()
            ->keyBy('karyawan_id');

            if (Auth::user()->role === 'hc') {
                $karyawans = Karyawan::with(['kpiScores.kpiIndicator', 'kpiIndicators'])->get();
            } else {
                $bawahanIds = DB::table('leader_karyawans')
                    ->where('leader_user_id', Auth::id())
                    ->pluck('karyawan_id');
            
                $karyawans = Karyawan::with(['kpiScores.kpiIndicator', 'kpiIndicators'])
                    ->whereIn('id', $bawahanIds)
                    ->get();
            }            
            
        $kpiSummaries = $karyawans->map(function ($karyawan) use ($scores, $semester, $year) {
            $totalScore = $scores[$karyawan->id]->total ?? 0;

            $totalKpi = 0;
            foreach ($karyawan->kpiScores as $score) {
                $tanggal = Carbon::parse($score->tanggal); // konversi string ke Carbon
            
                if (
                    ($semester == 'all') ||
                    ($semester == 1 && $tanggal->month <= 6 && $tanggal->year == $year) ||
                    ($semester == 2 && $tanggal->month >= 7 && $tanggal->year == $year)
                ) {
                    $target = $score->kpiIndicator->target ?? 0;
                    $bobot = $score->kpiIndicator->bobot ?? 0;
                    $nilai = $score->nilai;
                    $totalKpi += $target > 0 ? ($nilai / $target) * $bobot : 0;
                }
            }
            

            $indikatorTerisi = $karyawan->kpiScores->filter(function ($score) use ($semester, $year) {
                $tanggal = Carbon::parse($score->tanggal);
            
                if ($semester == 'all') {
                    return $tanggal->year == $year;
                } elseif ($semester == 1) {
                    return $tanggal->year == $year && $tanggal->month <= 6;
                } else {
                    return $tanggal->year == $year && $tanggal->month >= 7;
                }
            })->count();            

            $totalIndikator = 10;

            $status = match (true) {
                $indikatorTerisi === 0 => 'Belum Ada Penilaian',
                $indikatorTerisi === $totalIndikator => 'Selesai',
                default => 'Dalam Proses',
            };

            $rekomendasi = match (true) {
                $totalKpi >= 90 => 'Promosi Jabatan',
                $totalKpi >= 80 => 'Mendapatkan bonus sesuai kebijakan perusahaan',
                $totalKpi >= 40 => 'Pelatihan atau bootcamp untuk evaluasi lebih lanjut',
                default => 'Peninjauan kontrak dan/atau surat peringatan',
            };

            return [
                'karyawan_id' => $karyawan->id,
                'nama' => $karyawan->nama,
                'jabatan' => $karyawan->jabatan,
                'total' => round($totalKpi, 2),
                'status' => $status,
                'rekomendasi' => $indikatorTerisi > 0 ? $rekomendasi : 'Belum dinilai',
            ];
        });

        return view('kpi.summary', [
            'kpiSummaries' => $kpiSummaries,
            'year' => $year,
            'semester' => $semester
        ]);
    }


public function show(Request $request, $karyawanId)
{
    // Cari karyawan berdasarkan parameter route $karyawanId
    $selectedKaryawan = Karyawan::find($karyawanId);

    // Ambil KPI Scores hanya jika karyawan ditemukan
    $scores = $selectedKaryawan
        ? KpiScore::with(['karyawan', 'kpiIndicator'])
            ->where('karyawan_id', $selectedKaryawan->id)
            ->get()
            ->groupBy('karyawan_id')
        : collect();

    // Hitung rata-rata nilai
    $averageScore = $scores->flatten()->avg('nilai') ?? 0;

    // Ambil semua karyawan
    $karyawans = Karyawan::with('kpiScores.kpiIndicator')->get();

    return view('kpi.summary_detail', [
        'scores' => $scores,
        'averageScore' => $averageScore,
        'karyawans' => $karyawans,
        'selectedKaryawan' => $selectedKaryawan,
    ]);
}

public function summary(Request $request)
{
    $karyawanId = $request->karyawan_id;
    $tahun = $request->tahun ?? date('Y');
    $semester = $request->semester ?? 'all';

    $scoresQuery = KpiScore::with(['karyawan', 'kpiIndicator'])
        ->where('karyawan_id', $karyawanId);

    if ($semester == 1) {
        $start = "$tahun-01-01";
        $end   = "$tahun-06-30";
    } elseif ($semester == 2) {
        $start = "$tahun-07-01";
        $end   = "$tahun-12-31";
    } else {
        $start = "$tahun-01-01";
        $end   = "$tahun-12-31";
    }

    $scoresQuery->whereBetween('tanggal', [$start, $end]);

    $scores = $scoresQuery->get()->groupBy('karyawan_id');
    $averageScore = $scores->flatten()->avg('nilai');
    $selectedKaryawan = Karyawan::find($karyawanId);

    return view('kpi.summary_detail', compact(
        'scores', 'averageScore', 'selectedKaryawan', 'tahun', 'semester'
    ));
}

public function destroy($id)
{
    $score = KpiScore::findOrFail($id);
    $score->delete();

    return redirect()->back()->with('success', 'Data KPI berhasil dihapus.');
}

public function getSemesterSummary(Request $request)
{
    $startYear = $request->input('start', 2023);
    $endYear = $request->input('end', now()->year);

    $result = [];

    for ($year = $startYear; $year <= $endYear; $year++) {
        foreach ([1, 2] as $semester) {
            $start = $semester === 1 ? "$year-01-01" : "$year-07-01";
            $end = $semester === 1 ? "$year-06-30" : "$year-12-31";

            $avg = KpiScore::whereBetween('tanggal', [$start, $end])->avg('nilai');

            $result[] = [
                'label' => "Semester $semester ($year)",
                'tahun' => $year,
                'semester' => $semester,
                'avg_score' => round($avg, 2),
            ];
        }
    }

    return response()->json($result);
}

public function getSemesterDetail($tahun, $semester)
{
    $start = $semester == 1 ? "$tahun-01-01" : "$tahun-07-01";
    $end = $semester == 1 ? "$tahun-06-30" : "$tahun-12-31";

    $scores = KpiScore::with('karyawan')
        ->whereBetween('tanggal', [$start, $end])
        ->get()
        ->groupBy('karyawan_id')
        ->map(function ($group) {
            return [
                'nama' => $group->first()->karyawan->nama ?? 'Tidak diketahui',
                'avg' => round($group->avg('nilai'), 2),
            ];
        })->values();

    return response()->json($scores);
}

}