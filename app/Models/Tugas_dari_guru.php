<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Tugas_dari_guru extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kelas_id',
        'deadline',
        'file_url',
        'title',
        'description',
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }


    public function tugas_dari_siswa()
    {
        return $this->hasMany(Tugas_dari_siswa::class, 'tugas_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
