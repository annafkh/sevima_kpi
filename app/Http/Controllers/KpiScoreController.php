<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KpiScore;
use App\Models\Karyawan;
use App\Models\KpiIndicator;

class KpiScoreController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        if ($user->role === 'hc') {
            $scores = KpiScore::with(['karyawan', 'kpiIndicator'])->get();
            $karyawans = Karyawan::all();
        }
    
        elseif ($user->role === 'leader') {
            $bawahanIds = $user->bawahan->pluck('id');
            $scores = KpiScore::with(['karyawan', 'kpiIndicator'])
                        ->whereIn('karyawan_id', $bawahanIds)
                        ->get();
            $karyawans = Karyawan::whereIn('id', $bawahanIds)->get();
        }
    
        else {
            $karyawan = $user->karyawan;
            if (!$karyawan) {
                abort(403, 'Tidak terhubung ke karyawan');
            }
            $scores = KpiScore::with(['karyawan', 'kpiIndicator'])
                        ->where('karyawan_id', $karyawan->id)
                        ->get();
            $karyawans = collect([$karyawan]);
        }
    
        $scores = $scores->groupBy('karyawan_id');
        $averageScore = $scores->flatten()->avg('nilai');
    
        return view('kpi_scores.index', compact('scores', 'averageScore', 'karyawans'));
    }    

public function visualisasi()
{
    $scores = \App\Models\KpiScore::with(['karyawan', 'kpiIndicator'])->get();

    $groupedScores = $scores->groupBy('user_id');

    return view('kpi_scores.visualisasi_grouped', compact('groupedScores'));
}
    /**
     * Show the form for creating a new resource.
     */
//     public function create()
// {
//     $karyawans = Karyawan::all();  // Mengambil semua data karyawan
//     $indicators = KpiIndicator::all();  // Mengambil semua data indikator KPI
//     return view('kpi_scores.create', compact('karyawans', 'indicators'));
// }

public function create(Request $request)
{
    $user = auth()->user();
        if ($user->role === 'hc') {
            $karyawans = Karyawan::all();
        } elseif ($user->role === 'leader') {
            $karyawans = $user->bawahan;
        } else {
            $karyawans = collect([$user->karyawan]);
        }
    $selectedKaryawanId = $request->karyawan_id;
    $indicators = collect();

    if ($selectedKaryawanId) {
        session(['previous_url' => route('kpi.summary.detail', ['karyawan_id' => $selectedKaryawanId])]);

        $now = now();
        $semesterStart = $now->month <= 6 ? $now->startOfYear() : $now->startOfYear()->addMonths(6);
        $semesterEnd = $semesterStart->copy()->addMonths(5)->endOfMonth();

        $usedIndicators = KpiScore::where('karyawan_id', $selectedKaryawanId)
            ->whereBetween('tanggal', [$semesterStart, $semesterEnd])
            ->pluck('kpi_indicator_id');

            $indicators = KpiIndicator::where('status', 'aktif')
            ->whereNotIn('id', $usedIndicators)
            ->get();
            }

    return view('kpi_scores.create', compact('karyawans', 'selectedKaryawanId', 'indicators'));
}

public function edit($id)
{
    $score = KpiScore::findOrFail($id);
    $karyawans = Karyawan::all();
    $indicators = KpiIndicator::all();
    $tanggal =  KpiIndicator::all();

    if (!session()->has('previous_page')) {
        session(['previous_page' => url()->previous()]);
    }

    return view('kpi_scores.edit', compact('score', 'karyawans', 'indicators'));
}

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'karyawan_id' => 'required|exists:karyawans,id',
    //         'kpi_indicator_id' => 'required|exists:kpi_indicators,id',
    //         'nilai' => 'required|numeric|min:0|max:100',
    //     ]);
    
    //     KpiScore::create($request->all());
    
    //     return redirect()->route('kpi_scores.index')->with('success', 'Nilai KPI berhasil ditambahkan.');
    // }
    
    public function store(Request $request)
{
    $user = auth()->user();
        if ($user->role === 'hc') {
            $karyawans = Karyawan::all();
        } elseif ($user->role === 'leader') {
            $karyawans = $user->bawahan;
        } else {
            $karyawans = collect([$user->karyawan]);
        }
    $validated = $request->validate([
        'karyawan_id' => 'required|exists:karyawans,id',
        'kpi_indicator_id' => 'required|exists:kpi_indicators,id',
        'nilai' => 'required|numeric|min:1|max:5',
        'tanggal' => 'required|date',
    ]);
        $now = now();
        $semesterAwal = $now->month <= 6 ? $now->startOfYear() : $now->startOfYear()->addMonths(6);
        $semesterAkhir = $semesterAwal->copy()->addMonths(5)->endOfMonth();

        $exists = KpiScore::where('karyawan_id', $request->karyawan_id)
            ->where('kpi_indicator_id', $request->kpi_indicator_id)
            ->whereBetween('tanggal', [$semesterAwal, $semesterAkhir])
            ->exists();

        if ($exists) {
            return back()->withErrors(['kpi_indicator_id' => 'Indikator ini sudah digunakan oleh karyawan ini di semester ini.'])->withInput();
        }

    KpiScore::create($validated);

    return redirect(session('previous_url', route('kpi_scores.index')))
        ->with('success', 'Nilai KPI berhasil disimpan!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $score = KpiScore::findOrFail($id);
    $score->update($request->only(['karyawan_id', 'kpi_indicator_id', 'nilai']));

    // Ambil dan hapus URL sebelumnya dari session
    $redirectUrl = session()->pull('previous_page', route('kpi_scores.index'));

    return redirect($redirectUrl)->with('success', 'Nilai KPI berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $score = KpiScore::findOrFail($id);
    $score->delete();

    return redirect()->back()->with('success', 'Data KPI berhasil dihapus.');
}

}
