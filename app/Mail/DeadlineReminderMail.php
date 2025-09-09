<?php

// app/Mail/DeadlineReminderMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeadlineReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->subject('📌 Reminder Deadline Tugas')
                    ->view('emails.deadline_reminder');
    }
}
