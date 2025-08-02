<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class TaskDueNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Przypomnienie o zadaniu')
            ->line('Twoje zadanie "' . $this->task->title . '" jest do
            wykonania jutro (' .
            Carbon::parse($this->task->due_date)->format('Y-m-d') . ').')
            ->action('Zobacz zadanie', url(route('tasks.edit', $this->task->id)))
            ->line('Dziękujemy za korzystanie z aplikacji To-Do List.');
    }
}
