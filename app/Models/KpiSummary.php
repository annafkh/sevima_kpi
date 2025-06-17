<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiSummary extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan Laravel
    protected $table = 'kpi_summaries';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'karyawan_id', 'total_nilai'
    ];

    // Relasi dengan model Karyawan (jika ada)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
