<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Tugas_dari_siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'siswa_id',
        'feedback',
        'file_url',
        'tugas_id',
        'nilai',
    ];
    public function tugas_dari_guru()
    {
        return $this->belongsTo(Tugas_dari_guru::class, 'tugas_id','id');
    }
     public function user()
    {
        return $this->belongsTo(User::class); 
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }


}
