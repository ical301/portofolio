<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pengumuman_dari_guru;

class AnnouncementNotification extends Notification
{
    use Queueable;

    protected $pengumuman;

    public function __construct(Pengumuman_dari_guru $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📢 Pengumuman dari ' . $this->pengumuman->teacher_name)
            ->line('📚 Pengumuman: ' . $this->pengumuman->subject)
            ->line('🗓️ Tanggal: ' . $this->pengumuman->announce_date->format('d M Y'))
            ->line('📝 ' . $this->pengumuman->message)
            ->line('📌 Harap dicatat dan diinformasikan ke teman-teman.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'pengumuman_dari_guru',
            'teacher_name' => $this->pengumuman->teacher_name,
            'subject' => $this->pengumuman->subject,
            'message' => $this->pengumuman->message,
            'announce_date' => $this->pengumuman->announce_date->format('Y-m-d'),
        ];
    }
}
