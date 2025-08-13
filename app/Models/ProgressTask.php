<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'judul_tugas',
        'deadline',
        'tanggal_selesai',
        'tepat_waktu',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}