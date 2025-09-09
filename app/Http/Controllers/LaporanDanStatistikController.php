<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Tugas_dari_guru;
use App\Models\Tugas_dari_siswa;
use App\Models\Absensi;

class LaporanDanStatistikController extends Controller
{
    //
    public function laporan_dan_statistik(){
        $totalSiswaAktif = Siswa::where('status', 'aktif')->count();
        $totalMateri = Materi::count();
        $totalTugas = Tugas_dari_guru::count();
        $rataRataNilai = Tugas_dari_siswa::whereNotNull('nilai')->avg('nilai');
        $belumDinilai = Tugas_dari_siswa::whereNull('nilai')->count();
        $jumlahHadir = Absensi::where('status', 'hadir')->count();
        $jumlahIzin = Absensi::where('status', 'izin')->count();
        $jumlahAlpa = Absensi::where('status', 'alpa')->count();





        return view('laporan_dan_statistik', [
            'totalSiswaAktif' => $totalSiswaAktif,
            'totalMateri' => $totalMateri,
            'totalTugas' => $totalTugas,
            'rataRataNilai' => $rataRataNilai,
            'belumDinilai' => $belumDinilai,
            'jumlahHadir' => $jumlahHadir,
            'jumlahIzin' => $jumlahIzin,
            'jumlahAlpa' => $jumlahAlpa,
        ]);

    }
}
