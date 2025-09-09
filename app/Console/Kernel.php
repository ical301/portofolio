<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Tugas_dari_guru;
use App\Models\User;
use App\Notifications\TaskReminderNotification;
use Illuminate\Support\Facades\Log;
use App\Console\Commands\TestScheduler;

class Kernel extends ConsoleKernel
{
    protected $commands = [
       \App\Console\Commands\TestScheduler::class, 
        
    ];


    protected function schedule(Schedule $schedule)
    {
        $schedule->command('test:scheduler')->everyMinute();
        Log::info('Scheduler method loaded');

        $schedule->call(function () {
            echo "⏰ Schedule callback STARTED\n";

            try {
                $tasks = \App\Models\Tugas_dari_guru::whereBetween('deadline', [
                    now(), now()->addMinutes(5)
                ])
                ->where('reminder_sent', false)
                ->get();

                echo "🎯 Jumlah tugas: " . $tasks->count() . "\n";

                foreach ($tasks as $task) {
                    foreach (\App\Models\User::all() as $user) {
                        echo "📩 Mengirim ke: " . $user->email . "\n";
                        $user->notify(new \App\Notifications\TaskReminderNotification($task));
                    }

                    $task->reminder_sent = true;
                    $task->save();
                }
            } catch (\Exception $e) {
                echo "❌ Reminder Error: " . $e->getMessage() . "\n";
            }

            echo "✅ Schedule callback ENDED\n";
        })->everyMinute();

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
