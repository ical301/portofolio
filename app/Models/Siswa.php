<?php

namespace App\Models;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Materi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'kelas_id','user_id'];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function tugas_dari_siswa()
    {
        return $this->hasMany(\App\Models\Tugas_dari_siswa::class, 'siswa_id', 'id','nilai');
    }
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }



}
