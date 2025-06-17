<?php

namespace App\Http\Controllers;

use App\Models\KpiSummary;
use Illuminate\Http\Request;
use App\Models\KpiScore;
use App\Models\Karyawan;
use App\Models\KpiIndicator;
use App\Models\KpiCategory;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role;
    
        switch ($role) {
            case 'hc':
                // Ambil filter dari URL jika ada
                $tahun = $request->input('tahun', now()->year);
                $semester = $request->input('semester', now()->month <= 6 ? 1 : 2);
    
                // Hitung range tanggal berdasarkan semester
                $start = $semester == 1
                    ? now()->setDate($tahun, 1, 1)->startOfDay()
                    : now()->setDate($tahun, 7, 9)->startOfDay();
    
                $end = $start->copy()->addMonths(5)->endOfMonth();
    
                // Ambil data KPI Score berdasarkan filter waktu
                $chartData = KpiScore::with('karyawan')
                    ->whereBetween('tanggal', [$start, $end])
                    ->selectRaw('karyawan_id, AVG(nilai) as rata_nilai')
                    ->groupBy('karyawan_id')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nama' => $item->karyawan->nama ?? 'Unknown',
                            'rata_nilai' => round($item->rata_nilai, 2),
                        ];
                    });
    
                // Data untuk cards
                $totalKaryawan = Karyawan::count();
                $totalIndikatorAktif = KpiIndicator::where('status', 'aktif')->count();
                $totalKategoriKpi = KpiCategory::count();
                $rataRataScore = round(KpiScore::avg('nilai') * 20) . '%';
    
                return view('dashboard.hc', compact(
                    'chartData',
                    'totalKaryawan',
                    'totalIndikatorAktif',
                    'totalKategoriKpi',
                    'rataRataScore',
                    'tahun',
                    'semester'
                ));
    
                case 'leader':
                    $user = auth()->user();
                    $tahun = $request->input('tahun', now()->year);
                    $semester = $request->input('semester', now()->month <= 6 ? 1 : 2);
                
                    $start = $semester == 1
                        ? now()->setDate($tahun, 1, 1)->startOfDay()
                        : now()->setDate($tahun, 7, 9)->startOfDay();
                
                    $end = $start->copy()->addMonths(5)->endOfMonth();
                
                    // Ambil ID karyawan yang dipimpin oleh leader ini
                    $user = auth()->user();
                    $bawahanIds = $user->bawahan->pluck('id');
                
                    // KPI hanya untuk bawahannya
                    $chartData = KpiScore::with('karyawan')
                    ->whereBetween('tanggal', [$start, $end])
                    ->whereIn('karyawan_id', $bawahanIds) // FILTER berdasarkan bawahan leader
                    ->selectRaw('karyawan_id, AVG(nilai) as rata_nilai')
                    ->groupBy('karyawan_id')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nama' => $item->karyawan->nama ?? 'Unknown',
                            'rata_nilai' => round($item->rata_nilai, 2),
                        ];
                    });                
                
                    // Data cards
                    $totalKaryawan = $bawahanIds->count();
                    $totalIndikatorAktif = KpiIndicator::where('status', 'aktif')->count();
                    $totalKategoriKpi = KpiCategory::count();
                    $rataRataScore = round(
                        KpiScore::whereIn('karyawan_id', $bawahanIds)->avg('nilai') * 20
                    ) . '%';
                
                    return view('dashboard.leader', compact(
                        'chartData',
                        'totalKaryawan',
                        'totalIndikatorAktif',
                        'totalKategoriKpi',
                        'rataRataScore',
                        'tahun',
                        'semester'
                    ));                
    
            case 'karyawan':
                return view('dashboard.karyawan');
    
            default:
                abort(403);
        }
    }    
}