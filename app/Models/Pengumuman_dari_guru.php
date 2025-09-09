<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman_dari_guru extends Model
{
    use HasFactory;
     protected $fillable = ['subject', 'teacher_name','message','announce_date','kelas_id'];
     protected $dates = ['announce_date'];
     public function kelas()
    {
        return $this->belongsTo(Kelas::class); 
    }
}
