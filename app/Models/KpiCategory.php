<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiCategory extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    /**
     * Relasi dengan KpiIndicator
     */
    // Relasi ke indikator KPI
    public function indicators()
    {
        return $this->hasMany(KpiIndicator::class, 'kategori_id');
    }
}
