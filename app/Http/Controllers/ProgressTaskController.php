<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressTask;
use App\Models\Karyawan;
use App\Models\KpiIndicator;
use App\Models\KpiScore;
use Carbon\Carbon;
use App\Models\CatatanPelanggaran;

class ProgressTaskController extends Controller
{
    public function index(Request $request)
    {
        $selected = $request->get('karyawan_id');
        $karyawans = auth()->user()->role === 'leader'
            ? auth()->user()->bawahan
            : Karyawan::all();

        $tasks = collect();
        if ($selected) {
            $tasks = ProgressTask::where('karyawan_id', $selected)->get();
        }
        $pelanggarans = collect(); // default kosong

        if ($selected && $request->get('indikator') === 'komitmen') {
            $pelanggarans = \App\Models\CatatanPelanggaran::where('karyawan_id', $selected)->get();
        }
        return view('progress_tasks.index', compact('karyawans', 'selected', 'tasks', 'pelanggarans'));
    }

    public function store(Request $request)
    {
        $indikator = $request->input('indikator');

        if ($indikator === 'tepat') {
            $data = $request->validate([
                'karyawan_id' => 'required|exists:karyawans,id',
                'judul_tugas' => 'required|string|max:255',
                'deadline' => 'required|date',
                'tanggal_selesai' => 'nullable|date',
            ]);

            $data['tepat_waktu'] = $data['tanggal_selesai'] && $data['tanggal_selesai'] <= $data['deadline'] ? 1 : 0;

            ProgressTask::create($data);

            return back()->with('success', 'Tugas berhasil ditambahkan.');
        }

        if ($indikator === 'komitmen') {
            $data = $request->validate([
                'karyawan_id' => 'required|exists:karyawans,id',
                'tanggal_pelanggaran' => 'required|date',
                'deskripsi' => 'nullable|string',
            ]);

            \App\Models\CatatanPelanggaran::create([
                'karyawan_id' => $data['karyawan_id'],
                'tanggal' => $data['tanggal_pelanggaran'],
                'deskripsi' => $data['deskripsi'] ?? null,
            ]);

            return back()->with('success', 'Catatan pelanggaran berhasil disimpan.');
        }

        return back()->with('error', 'Indikator tidak valid.');
    }

    public function nilaiOtomatis(Request $request, $karyawan_id)
    {
        $indikator = request('indikator');

        if ($indikator === 'komitmen') {
            return $this->hitungNilaiKomitmen($karyawan_id);
        }

        $indicator = KpiIndicator::where('nama', 'like', '%tepat waktu%')->first();
        if (!$indicator) {
            return back()->with('error', 'Indikator "tepat waktu" tidak ditemukan.');
        }

        $tasks = ProgressTask::where('karyawan_id', $karyawan_id)->get();
        if ($tasks->count() == 0) {
            return back()->with('error', 'Tidak ada tugas.');
        }

        $total = $tasks->count();
        $tepat = $tasks->where('tepat_waktu', 1)->count();
        $persen = ($tepat / $total) * 100;

        $nilai = match (true) {
            $persen < 30 => 1,
            $persen <= 60 => 2,
            $persen <= 80 => 3,
            $persen <= 90 => 4,
            $persen == 100 => 5,
            default => 1,
        };

        $now = now();
        $semesterStart = $now->month <= 6 ? $now->startOfYear() : $now->startOfYear()->addMonths(6);
        $semesterEnd = $semesterStart->copy()->addMonths(5)->endOfMonth();
        
        $exists = KpiScore::where('karyawan_id', $karyawan_id)
            ->where('kpi_indicator_id', $indicator->id)
            ->whereBetween('tanggal', [$semesterStart, $semesterEnd])
            ->exists();
            
        if ($exists) {
            return back()->with('error', 'Nilai KPI sudah ada di semester ini.');
        }

        KpiScore::create([
            'karyawan_id' => $karyawan_id,
            'kpi_indicator_id' => $indicator->id,
            'nilai' => $nilai,
            'tanggal' => now(),
        ]);        

        return back()->with('success', 'Nilai KPI berhasil dihitung & disimpan.');
    }
    public function edit($id){
        $task = ProgressTask::findOrFail($id);
        return view('progress_tasks.edit', compact('task'));
    }

    public function destroy($id)
    {
        $task = ProgressTask::findOrFail($id);
        $task->delete();

        return back()->with('success', 'Tugas berhasil dihapus.');
    }
    public function update(Request $request, $id){
        $task = ProgressTask::findOrFail($id);

        $task->judul_tugas = $request->judul_tugas;
        $task->deadline = $request->deadline;
        $task->tanggal_selesai = $request->tanggal_selesai;

        if ($task->tanggal_selesai && $task->tanggal_selesai <= $task->deadline) {
            $task->tepat_waktu = true;
        } elseif ($task->tanggal_selesai) {
            $task->tepat_waktu = false;
        } else {
            $task->tepat_waktu = null;
        }

        $task->save();

        return redirect()->route('progress.index', ['karyawan_id' => $task->karyawan_id])
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function hitungNilaiKomitmen($karyawan_id)
    {
        $now = now();
        $semesterStart = $now->month <= 6 ? $now->startOfYear() : $now->startOfYear()->addMonths(6);
        $semesterEnd = $semesterStart->copy()->addMonths(5)->endOfMonth();

        $jumlahPelanggaran = CatatanPelanggaran::where('karyawan_id', $karyawan_id)
            ->whereBetween('tanggal', [$semesterStart, $semesterEnd])
            ->count();

        $totalHari = $semesterStart->diffInDays($semesterEnd) + 1;

        $persenKepatuhan = (($totalHari - $jumlahPelanggaran) / $totalHari) * 100;

        $skor = match (true) {
            $persenKepatuhan == 100 => 5,
            $persenKepatuhan >= 80 => 4,
            $persenKepatuhan >= 60 => 3,
            $persenKepatuhan >= 50 => 2,
            $persenKepatuhan < 50 => 1,
            default => 1,
        }; //persentase masih sangat tinggi - dibuat per bulan

        $indikator = KpiIndicator::where('nama', 'like', '%komitmen%')->first();

        if (!$indikator) {
            return back()->with('error', 'Indikator Komitmen tidak ditemukan.');
        }

        $exists = KpiScore::where('karyawan_id', $karyawan_id)
            ->where('kpi_indicator_id', $indikator->id)
            ->whereBetween('tanggal', [$semesterStart, $semesterEnd])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Nilai KPI Komitmen sudah ada di semester ini.');
        }

        KpiScore::create([
            'karyawan_id' => $karyawan_id,
            'kpi_indicator_id' => $indikator->id,
            'nilai' => $skor,
            'tanggal' => now(),
        ]);

        return redirect()->route('progress.index', [
            'indikator' => 'komitmen',
            'karyawan_id' => $karyawan_id
        ])->with('success', "Nilai KPI Komitmen berhasil disimpan. Kepatuhan: " . number_format($persenKepatuhan, 2) . "%");
    }
    public function editPelanggaran($id)
    {
        $pelanggaran = CatatanPelanggaran::findOrFail($id);
        return view('progress_tasks.edit_pelanggaran', compact('pelanggaran'));
    }
    public function updatePelanggaran(Request $request, $id)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        $pelanggaran = CatatanPelanggaran::findOrFail($id);
        $pelanggaran->update($data);

        return redirect()->route('progress.index', [
            'indikator' => 'komitmen',
            'karyawan_id' => $pelanggaran->karyawan_id,
        ])->with('success', 'Catatan pelanggaran berhasil diperbarui.');
    }
    public function destroyPelanggaran($id)
    {
        $pelanggaran = CatatanPelanggaran::findOrFail($id);
        $pelanggaran->delete();

        return redirect()->route('progress.index', [
            'indikator' => 'komitmen',
            'karyawan_id' => $pelanggaran->karyawan_id,
        ])->with('success', 'Catatan pelanggaran berhasil dihapus.');
    }
}
