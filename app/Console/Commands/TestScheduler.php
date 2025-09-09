<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tugas_dari_guru;
use App\Mail\DeadlineReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class TestScheduler extends Command
{
    protected $signature = 'test:scheduler';
    protected $description = 'Kirim reminder email untuk tugas dari guru yang akan deadline';

    public function handle()
    {
        \Log::info('🔍 Mengecek tugas yang deadlinenya 5 menit lagi...');

        $tasks = \App\Models\Tugas_dari_guru::with(['kelas', 'user']) // load relasi kelas dan user
    ->whereBetween('deadline', [now(), now()->addMinutes(5)])
    ->whereNull('reminder_sent')
    ->get();
// tambah kolom ini nanti

        foreach ($tasks as $task) {
            if (!$task->user || !$task->user->email) {
                \Log::warning("⚠️ Tidak bisa kirim email, user/email kosong untuk tugas ID: {$task->id}");
                continue;
            }

            \Mail::to($task->user->email)->send(new \App\Mail\DeadlineReminderMail($task));

            // update supaya gak dikirim ulang
            $task->reminder_sent = now();
            $task->save();

            \Log::info("📧 Email dikirim ke: {$task->user->email} untuk tugas: {$task->title}");
        }

        \Log::info('✅ Pengecekan selesai.');
}

}
