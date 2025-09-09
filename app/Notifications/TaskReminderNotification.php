<?php

namespace App\Notifications;

    use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskReminderNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        // Bisa juga pake 'database', 'mail', 'broadcast' sesuai kebutuhan
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $deadline = Carbon::parse($this->task->deadline);

        return (new MailMessage)
                    ->subject('📌 Reminder Deadline Tugas: ' . $this->task->title)
                    ->line('Hai! Jangan lupa tugas ' . $this->task->kelas->nama_kelas .$this->task->kelas->jurusan. ' untuk mata pelajaran ' . $this->task->title)
                    ->line('Deadline-nya tanggal ' . $deadline->format('d M Y H:i'))
                    ->line('Segera kerjakan dan kumpulkan tepat waktu ya!');
    }


    // Kalau mau simpan di database juga bisa buat fungsi toArray()
}
