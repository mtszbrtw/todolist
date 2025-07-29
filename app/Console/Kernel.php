<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $tasks = \App\Models\Task::whereDate('due_date', now()->addDay()->toDateString())->get();
            foreach ($tasks as $task) {
                $task->user->notify(new \App\Notifications\TaskDueNotification($task));
            }
        })->dailyAt('08:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
