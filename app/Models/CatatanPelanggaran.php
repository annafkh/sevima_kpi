<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanPelanggaran extends Model
{
    protected $table = 'catatan_pelanggaran'; // <--- ini baris pentingnya

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'deskripsi',
    ];
}
