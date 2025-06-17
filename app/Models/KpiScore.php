<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/KpiScore.php
class KpiScore extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_id', 'kpi_indicator_id', 'nilai', 'tanggal'];

    // public function karyawan()
    // {
    //     return $this->belongsTo(Karyawan::class);
    // }

    public function karyawan()
{
    return $this->belongsTo(Karyawan::class, 'karyawan_id');
}

    // public function kpiIndicator()
    // {
    //     return $this->belongsTo(KpiIndicator::class);
    // }

    // App\Models\KpiScore.php
     public function kpiIndicator()
    {
        return $this->belongsTo(KpiIndicator::class, 'kpi_indicator_id');
    }
    
public function indicator()
{
    return $this->belongsTo(KpiIndicator::class, 'kpi_indicator_id');
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }   

}
