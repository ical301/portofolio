<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas_dari_siswa;
use Illuminate\Support\Facades\Storage;
use App\Models\Tugas_dari_guru;
use App\Models\Siswa;
use App\Models\Kelas;
use Carbon\Carbon;
use PDF; // Import PDF facade

class PdfExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $kelasId = $request->input('kelas_id');
        $mataPelajaran = $request->input('mataPelajaran');

        $tugas_dari_guru = Tugas_dari_guru::all();
        $tugas_dari_siswa = Tugas_dari_siswa::all();

        $test = Siswa::with(['tugas_dari_siswa.tugas_dari_guru', 'kelas'])
            ->where('kelas_id', $kelasId)
            ->orderBy('id', 'desc')
            ->get();


        $tugas = Tugas_dari_guru::with('tugas_dari_siswa.siswa')
            ->whereHas('kelas', function ($query) use ($kelasId) {
                if ($kelasId) {
                    $query->where('id', $kelasId);
                }
            })
            ->when($mataPelajaran, function ($query) use ($mataPelajaran) {
                return $query->where('title', $mataPelajaran);
            })
            ->get();

    
        $data = [
            'kelasId' => $kelasId,
            'mataPelajaran' => $mataPelajaran,
            'tugas' => $tugas,
        ];

        $test2 = Tugas_dari_guru::where('kelas_id', $kelasId)
                        ->pluck('title')
                        ->unique();

        return view('nilai.pdf_download', compact('tugas','kelasId', 'mataPelajaran','tugas_dari_guru','tugas_dari_siswa','test','test2'));
    }


    public function exportPdf2(Request $request)
    {
        $kelasId = $request->input('kelas_id');
        $mataPelajaran = $request->input('mataPelajaran');

        $tugas_dari_guru = Tugas_dari_guru::all();
        $tugas_dari_siswa = Tugas_dari_siswa::all();

        $test = Siswa::with(['tugas_dari_siswa.tugas_dari_guru', 'kelas'])
            ->where('kelas_id', $kelasId)
            ->orderBy('id', 'desc')
            ->get();

        $tugas = Tugas_dari_guru::with('tugas_dari_siswa.siswa')
            ->whereHas('kelas', function ($query) use ($kelasId) {
                if ($kelasId) {
                    $query->where('id', $kelasId);
                }
            })
            ->when($mataPelajaran, function ($query) use ($mataPelajaran) {
                return $query->where('title', $mataPelajaran);
            })
            ->get();

        $test2 = Tugas_dari_guru::where('kelas_id', $kelasId)
            ->pluck('title')
            ->unique();

        $data = compact('tugas','kelasId','mataPelajaran','tugas_dari_guru','tugas_dari_siswa','test','test2');

        $pdf = PDF::loadView('nilai.pdf_download', $data);
        return $pdf->download('exported-file.pdf');
    }


}
