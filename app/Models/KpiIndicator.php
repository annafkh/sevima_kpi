<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiIndicator extends Model
{
    protected $fillable = ['nama', 'bobot', 'target', 'kpi_category_id', 'deskripsi','status',];

   // app/Models/KpiIndicator.php
public function kategori()
{
    return $this->belongsTo(KpiCategory::class, 'kpi_categori_id'); // pastikan kolom 'kategori_id' sesuai
}

}
