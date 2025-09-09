<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Pengumuman_dari_guru;
use App\Notifications\AnnouncementNotification;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    //
    public function form_pengumuman(){
        $kelas = Kelas::all();
        return view('pengumuman.pengumuman_dari_guru',['kelas'=>$kelas]);
    }


    public function kirim_pengumuman(Request $request){
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'kelas_id' => 'required|integer',
        ]);

        $pengumuman = Pengumuman_dari_guru::create([
            'subject' => $request->subject,
            'teacher_name' => auth()->user()->name,
            'message' => $request->message,
            'announce_date' => now(),
            'kelas_id' => $request->kelas_id,

        ]);

        $users = User::where('role', 'siswa')->get();
        foreach ($users as $user) {
            $user->notify(new AnnouncementNotification($pengumuman));
        }

        return view('pengumuman.pengumuman_berhasil',[
            'message' => 'Pengumuman berhasil dibuat dan dikirim.',
            'pengumuman' => $pengumuman,
        ]);
    }
}
