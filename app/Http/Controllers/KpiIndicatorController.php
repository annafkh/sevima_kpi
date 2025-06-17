<?php

namespace App\Http\Controllers;

use App\Models\KpiCategory;
use App\Models\KpiIndicator;
use Illuminate\Http\Request;

class KpiIndicatorController extends Controller
{
    public function index()
    {
        $indicators = KpiIndicator::all();
        $categories = KpiCategory::all();

        return view('kpi_indicators.index', compact('indicators', 'categories'));
    }

    public function create()
    {
        $categories = KpiCategory::all(); // Fix penulisan model
        return view('kpi_indicators.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kpi_category_id' => 'required|exists:kpi_categories,id',
            'bobot' => 'required|numeric|min:0|max:100',
            'target' => 'required|numeric',
            'status' => 'required|in:aktif,non-aktif',
            'deskripsi' => 'nullable|string'
        ]);

        KpiIndicator::create($validated); // Fix nama model

        return redirect()->route('kpi_indicators.index')->with('success', 'KPI Indicator berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kpi_indicator = KpiIndicator::findOrFail($id);
        $kpi_categories = KpiCategory::all();

        return view('kpi_indicators.edit', compact('kpi_indicator', 'kpi_categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kpi_categories,id',
            'bobot' => 'required|numeric|min:0|max:100',
            'target' => 'required|integer|min:0',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $kpi = KpiIndicator::findOrFail($id);

        // Mapping field kategori_id ke kpi_category_id
        $kpi->update([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'kpi_category_id' => $validated['kategori_id'],
            'bobot' => $validated['bobot'],
            'target' => $validated['target'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('kpi_indicators.index')->with('success', 'KPI berhasil diperbarui');
    }

    public function destroy(KpiIndicator $kpi_indicator)
    {
        $kpi_indicator->delete();
        return redirect()->route('kpi_indicators.index')->with('success', 'Indikator berhasil dihapus.');
    }
}
