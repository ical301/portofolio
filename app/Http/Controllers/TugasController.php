<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tugas_dari_siswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Tugas_dari_guru;
use App\Models\Kelas;
use Carbon\Carbon;

class TugasController extends Controller
{
    //
    public function kirim_tugas(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kelas_id'=> 'required|integer|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file_url' => 'nullable|file|mimes:pdf,docx,doc,txt,jpg,png|max:2048',
        ]);

        $existing = tugas_dari_guru::where('title', $request->title)
            ->where('kelas_id', $request->kelas_id)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors(['duplicate' => 'Tugas dengan materi dan kelas yang sama sudah ada.'])->withInput();
        }


        $filePath = null;


        if ($request->hasFile('file_url')) {
            $filePath = $request->file('file_url')->store('uploads/files', 'public');
        }

        tugas_dari_guru::create([
            'user_id' => auth()->id(),
            'kelas_id'=>$request->kelas_id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'file_url' => $filePath,
        ]);

        return redirect()->route('materi.dan.tugas')->with('success', 'Tugas berhasil disimpan.');
    }


    public function kirim_tugas_siswa(Request $request)
    {

            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'tugas_id' => 'required|exists:tugas_dari_gurus,id',
                'siswa_id' => 'required|exists:siswas,id',
                'description' => 'nullable|string',
                'file_jawaban' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            ]);

            $sudahAda = Tugas_dari_siswa::where('user_id', $validated['user_id'])
                ->where('tugas_id', $validated['tugas_id'])
                ->exists();

            if ($sudahAda) {
                return redirect()->back()->with('error', 'Anda sudah mengumpulkan jawaban untuk tugas ini.');
            }


            // 2. Simpan file
            $filePath = $request->file('file_jawaban')->store('jawaban_tugas', 'public');
            

            // 3. Simpan ke DB
            Tugas_dari_siswa::create([
                'user_id' => $validated['user_id'],
                'tugas_id' => $validated['tugas_id'],
                'siswa_id' => $validated['siswa_id'],
                'description' => $validated['description'],
                'file_url' => $filePath,
            ]);

            return redirect()->route('index')->with('success', 'Jawaban berhasil dikirim!');
            return dd($request->all());

    }




    public function daftartugas(){
        $userId = auth()->id();
        $user_name = auth()->user()->name;

 
        $tugas = Tugas_dari_guru::with('kelas')
        ->where('user_id', $userId)
        ->get();

        return view('tugas.show_tugas_dari_guru', compact('tugas','user_name'));
    }



    public function kerjakantugas($id)
    {
        $user_id = auth()->id();
        $kelas = Kelas::find($id);

        $tugasKelas = $kelas->tugas_dari_guru->filter(function ($tugas) {
            return Carbon::parse($tugas->deadline)->isFuture(); 
        });

        return view('materi_dan_tugas_untuk_siswa', ['tugaskelas' => $tugasKelas]);
    }



    public function lihat_jawaban_anda(){

        $user = Auth::user()->load('Tugas_dari_siswa.tugas_dari_guru');


        return view('tugas.lihat_jawaban_anda',['user'=>$user]);
    }



    public function lihat_jawaban_siswa(){
        $kelas = Kelas::all();
        return view('tugas.lihat_jawaban_siswa',['kelas'=>$kelas]);
    }
    public function lihat_jawaban_siswa_2($id){
        $kelas = Kelas::with('siswa.tugas_dari_siswa.tugas_dari_guru')->findOrFail($id);
        return view('tugas.jawaban_siswa_tiap_kelas', compact('kelas'));
    }

    public function penilaian_siswa($id){


        $kelas = Kelas::with('siswa.tugas_dari_siswa.tugas_dari_guru')->findOrFail($id);



        $tugas_dari_guru = Tugas_dari_guru::all();
        return view('nilai.penilaian_siswa', compact('kelas','tugas_dari_guru'));
    }


    public function masuk_nilai_berdasarkan_kelas(){
        $kelas = Kelas::all();
        return view('nilai.pilih_kelas',['kelas'=>$kelas]);
    }


    public function formInputNilai($tugas_id)
    {
        $tugas = Tugas_dari_guru::with('tugas_dari_siswa.siswa')->findOrFail($tugas_id);

        return view('nilai.form_input_nilai', compact('tugas'));
    }



    public function filterTugas(Request $request)
    {
       
        $kelasId = $request->input('kelas');
        $mataPelajaran = $request->input('mata_pelajaran');

        $tugas = Tugas_dari_guru::with('tugas_dari_siswa.siswa') 
            ->whereHas('kelas', function($query) use ($kelasId) {
                if ($kelasId) {
                    $query->where('id', $kelasId);  
                }
            })
            ->when($mataPelajaran, function ($query) use ($mataPelajaran) {
                return $query->where('title', $mataPelajaran);  
            })
            ->get();
        
        // Kirim data tugas ke view
        return view('nilai.TEST_filter_siswa', compact('tugas','kelasId', 'mataPelajaran'));

    }






    public function berikanNilai(Request $request, $jawabanId)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100', // Nilai harus antara 0 dan 100
        ]);

        $jawaban = Tugas_dari_siswa::findOrFail($jawabanId);

        $jawaban->nilai = $request->input('nilai');
        $jawaban->save();

        return redirect()->back()->with('success', 'Nilai berhasil diberikan!');
    }







}
