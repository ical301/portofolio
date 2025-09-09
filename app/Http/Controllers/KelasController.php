<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Tugas_dari_guru;
use App\Models\Tugas_dari_siswa;


class KelasController extends Controller
{
    //
   public function masuk_kelas(Request $request)
    {
        // Cek apakah user_id sudah pernah dipakai
        $sudahAda = Siswa::where('user_id', $request->user_id)->exists();

        if (!$sudahAda) {
            // Kalau belum ada, baru insert
            Siswa::create([
                'nama' => $request->nama,
                'kelas_id' => $request->kelas_id,
                'user_id' => $request->user_id,
            ]);
        }

        // Tetap return ke view meskipun data tidak disimpan
        $kelas = Kelas::all();
        return view('masuk_kelas', ['kelas' => $kelas]);
    }


    public function masuk_kelas_2()
    {
        $kelas = Kelas::all();
        return view('masuk_kelas', ['kelas' => $kelas]);
    }





    public function formTambahkelas(){
        return view('formTambahkelas');
    }


    public function listkelas(){
        $kelas = Kelas::all();
        return view('listkelas',['kelas'=>$kelas]);
    }



    public function tambahkelas(Request $request){
        // Validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Simpan data ke tabel kelas
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'jurusan' => $request->jurusan,
            'description' => $request->description,
        ]);

        // Redirect / response
        return redirect('/masuk_kelas')->with('success', 'Data kelas berhasil disimpan!');
    }



    public function hapuskelas($id){
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('listkelas')->with('success', 'Kelas berhasil dihapus!');
    }




    public function formEditkelas($id){
       $kelas = Kelas::findOrFail($id);
       return view('formEditkelas',['kelas'=>$kelas]);
    }




    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $kelas->update($validated);

        return redirect()->route('listkelas')->with('success', 'Booking berhasil diperbarui!');
    }


     public function pendaftaran_siswa()
    {
        $kelas = Kelas::all();
        return view('form_siswa_masuk_kelas',['kelas'=>$kelas]);
    }



    public function show_data_siswa_tiap_kelas($id)
    {
        $kelas = Kelas::with('siswa.tugas_dari_siswa.tugas_dari_guru')->findOrFail($id);
        return view('kelas.data_siswa_tiap_kelas', compact('kelas'));
    }



    public function submitAbsensi(Request $request)
    {
        $alreadyAbsent = Absensi::where('siswa_id', $request->siswa_id)
            ->whereDate('tanggal_absen', now()->toDateString())
            ->exists();

        if ($alreadyAbsent) {
            return back()->with('error', 'Kamu sudah absen hari ini.');
        }

        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_absen' => now()->toDateString(),
            'waktu_absen' => now()->toTimeString(),
            'status' => $request->status,
        ]);
        $parameter = $request->kelas_id;

        return redirect()->route('show_data_siswa_tiap_kelas',$parameter)->with('success', 'Absensi berhasil!');
    }


    public function materi_dan_tugas(){
        $user = auth()->user(); // Ambil user yang sedang login

        if ($user->role == 'guru') {
            $kelas = Kelas::all();
            $materi = Materi::all();
            return view('materi_dan_tugas_untuk_guru',compact('kelas','materi')); // Tampilkan view untuk guru

        } else if ($user->role == 'siswa') {

            $user_id = auth()->id();
            $kelas = Kelas::find(2);
            $tugasKelas = $kelas->tugas; 

            return view('siswa_tidak_boleh_masuk');
        } else {
            return redirect('/')->with('error', 'Role tidak dikenali');
        }
    }




}
