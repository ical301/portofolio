<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    //
    public function absensisiswa()
    {
        $tanggalHariIni = Carbon::today();

        // Ambil semua siswa yang sudah absen hari ini
        $siswaSudahAbsen = Siswa::whereHas('absensi', function ($query) use ($tanggalHariIni) {
            $query->whereDate('created_at', $tanggalHariIni);
        })
        ->with('absensi', 'kelas') // pastikan relasi `kelas` tersedia di model Siswa
        ->get()
        ->groupBy('kelas_id'); // Kelompokkan berdasarkan kelas

        // Ambil daftar semua kelas (buat tampilan tetap urut)
        $kelasList = Kelas::all();

        return view('kelas.absensi_siswa_tiap_kelas', compact('siswaSudahAbsen', 'kelasList'));
    }

}
