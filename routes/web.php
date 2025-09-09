<?php

use App\Http\Controllers\PdfExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LaporanDanStatistikController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/masuk_kelas', [KelasController::class,'masuk_kelas']);
    Route::post('/masuk_kelas', [KelasController::class,'masuk_kelas'])->name('masuk.kelas');

    Route::get('/masuk_kelas_2', [KelasController::class, 'masuk_kelas_2'])->name('masuk.kelas.2');

    Route::get('/materi_dan_tugas', [KelasController::class, 'materi_dan_tugas'])->name('materi.dan.tugas');

    Route::get('/formTambahkelas', [KelasController::class, 'formTambahkelas'])->name('formTambahkelas');
    Route::post('/tambahkelas', [KelasController::class, 'tambahkelas'])->name('tambahkelas');

    Route::get('/listkelas', [KelasController::class, 'listkelas'])->name('listkelas');

    Route::delete('/hapuskelas/{id}', [KelasController::class, 'hapuskelas'])->name('hapuskelas');

    Route::get('/formEditkelas/{id}', [KelasController::class, 'formEditkelas'])->name('formEditkelas');
    Route::patch('/editkelas/{id}', [KelasController::class, 'update'])->name('editkelas');

    Route::get('/pendaftaran_siswa', [KelasController::class, 'pendaftaran_siswa'])->name('pendaftaran_siswa');


    Route::get('/show_data_siswa_tiap_kelas/{id}', [KelasController::class, 'show_data_siswa_tiap_kelas'])->name('show_data_siswa_tiap_kelas');

    Route::post('/absensi', [KelasController::class, 'submitAbsensi'])->name('absensi.submit');

    Route::post('/kirim_tugas', [TugasController::class, 'kirim_tugas'])->name('kirim.tugas');
    Route::post('/kirim_tugas_siswa', [TugasController::class, 'kirim_tugas_siswa'])->name('kirim.tugas.siswa');

    Route::get('/daftartugas', [TugasController::class, 'daftartugas'])->name('daftartugas');

    Route::get('/kerjakantugas/{id}', [TugasController::class, 'kerjakantugas'])->name('kerjakantugas');

    Route::get('/absensisiswa', [AbsensiController::class, 'absensisiswa'])->name('absensisiswa');

    Route::get('/lihat_jawaban_anda', [TugasController::class, 'lihat_jawaban_anda'])->name('lihat_jawaban_anda');

    Route::get('/lihat_jawaban_siswa', [TugasController::class, 'lihat_jawaban_siswa'])->name('lihat_jawaban_siswa');

    Route::get('/lihat_jawaban_siswa_2/{id}', [TugasController::class, 'lihat_jawaban_siswa_2'])->name('lihat_jawaban_siswa_2');


    Route::get('/input-nilai/{tugas_id}', [TugasController::class, 'formInputNilai'])->name('input.nilai.form');
    Route::post('/input-nilai', [TugasController::class, 'simpanNilai'])->name('input.nilai.simpan');

    Route::get('/penilaian_siswa/{id}', [TugasController::class, 'penilaian_siswa'])->name('penilaian_siswa');
    Route::get('/masuk_nilai_berdasarkan_kelas', [TugasController::class, 'masuk_nilai_berdasarkan_kelas'])->name('masuk_nilai_berdasarkan_kelas');

    Route::get('/filter-tugas', [TugasController::class, 'filterTugas'])->name('filterTugas');

    // Route untuk menyimpan nilai tugas siswa
    Route::put('/tugas/{jawaban}/nilai', [TugasController::class, 'berikanNilai'])->name('berikan.nilai');

    Route::get('/export-pdf', [PdfExportController::class, 'exportPdf'])->name('export-pdf');
    Route::get('/export-pdf2', [PdfExportController::class, 'exportPdf2'])->name('export-pdf2');

    Route::get('/laporan_dan_statistik', [LaporanDanStatistikController::class, 'laporan_dan_statistik'])->name('laporan.dan.statistik');

    Route::get('/form_pengumuman', [PengumumanController::class, 'form_pengumuman'])->name('form_pengumuman');
    Route::post('/kirim_pengumuman', [PengumumanController::class, 'kirim_pengumuman'])->name('kirim_pengumuman');
    Route::get('/pengumuman_berhasil', [PengumumanController::class, 'pengumuman_berhasil'])->name('pengumuman_berhasil');

    Route::get('/test-mail', function () {
        $user = \App\Models\User::first(); // atau email tujuan
        $task = \App\Models\Tugas_dari_guru::first(); // contoh tugas

        \Mail::to($user->email)->send(new \App\Mail\DeadlineReminderMail($task));

        return "Email dikirim ke " . $user->email;
    });



    










});

require __DIR__.'/auth.php';
