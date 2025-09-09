<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = ['mata_pelajaran', 'nilai', 'rata_rata'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
