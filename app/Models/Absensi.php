<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Siswa;


class Absensi extends Model

{
    use HasFactory;
    protected $table = 'absensi'; 
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tanggal_absen',
        'waktu_absen',
        'status',
    ];
    public function siswa()
{
    return $this->belongsTo(Siswa::class);
}

public function kelas()
{
    return $this->belongsTo(Kelas::class);
}

}
