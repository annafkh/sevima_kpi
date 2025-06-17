<?php

namespace App\Http\Controllers;

use App\Models\KpiCategory;
use Illuminate\Http\Request;

class KpiCategoryController extends Controller
{
    /**
     * Tampilkan daftar kategori KPI.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = KpiCategory::all();
        return view('kpi_categories.index', compact('categories'));
        
    }

    /**
     * Tampilkan form untuk membuat kategori KPI baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kpi_categories.create');
    }

    /**
     * Simpan kategori KPI baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KpiCategory::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kpi_categories.index');
    }

    /**
     * Tampilkan form untuk mengedit kategori KPI.
     *
     * @param  \App\Models\KpiCategory  $kpiCategory
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
{
    $category = KpiCategory::findOrFail($id);
    return view('kpi_categories.edit', compact('category'));
}

    /**
     * Perbarui kategori KPI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KpiCategory  $kpiCategory
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ]);

    $category = KpiCategory::findOrFail($id);

    $category->nama = $request->input('nama');
    $category->deskripsi = $request->input('deskripsi');

    $category->save();

    return redirect()->route('kpi_categories.index')->with('success', 'Kategori berhasil diperbarui.');
}

    /**
     * Hapus kategori KPI.
     *
     * @param  \App\Models\KpiCategory  $kpiCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(KpiCategory $kpiCategory)
    {
        $kpiCategory->delete();

        return redirect()->route('kpi_categories.index');
    }
}
