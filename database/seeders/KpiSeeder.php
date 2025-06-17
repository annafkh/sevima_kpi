<?php

namespace Database\Seeders;

use App\Models\KpiCategory;
use Illuminate\Database\Seeder;

class KpiSeeder extends Seeder
{
    public function run()
    {
        // Buat Kategori KPI baru
        $category = KpiCategory::create(['nama' => 'Responsibility']);

        // Definisikan indikator KPI dengan bobot dan target
        $indicators = [
            ['nama' => 'Tepat waktu', 'bobot' => 10, 'target' => 5],
            ['nama' => 'Akurat & sesuai supervisi', 'bobot' => 10, 'target' => 5],
            ['nama' => 'Solusi pelanggan', 'bobot' => 10, 'target' => 5],
        ];

        foreach ($indicators as $data) {
            $category->kpiIndicators()->create($data);
        }
    }
}
