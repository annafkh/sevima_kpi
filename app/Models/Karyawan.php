<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['nama', 'ktp', 'jabatan', 'nohp', 'jk'];
    protected $table = 'karyawans';

    public function kpiScores()
    {
        return $this->hasMany(KpiScore::class, 'karyawan_id');
    }

    public function kpiIndicators()
    {
        return $this->hasManyThrough(
            \App\Models\KpiIndicator::class,
            \App\Models\KpiScore::class,
            'karyawan_id',
            'id',
            'id',
            'kpi_indicator_id'
        );
    }
    public function leaders()
{
    return $this->belongsToMany(User::class, 'leader_karyawans', 'karyawan_id', 'leader_user_id');
}

}
