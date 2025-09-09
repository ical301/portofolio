<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Tugas_dari_guru;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kelas', 'jurusan', 'description'];
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
    public function tugas_dari_guru()
    {
        return $this->hasMany(Tugas_dari_guru::class);
    }
    // Model: Kelas.php
    public function user()
    {
        return $this->hasMany(User::class); 
    }




}
