<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\KpiScore;

class DashboardKaryawanController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $kpiScores = KpiScore::whereHas('karyawan', function ($query) use ($user) {
        $query->where('nama', $user->name);
    })->with(['indicator', 'karyawan'])->get();

    return view('dashboard.kpikaryawan', compact('kpiScores'));
}
}
