<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        \Log::info('Reset hasła wysyłany na: ' . $notifiable->email);

        return (new MailMessage)
            ->subject('Resetowanie hasła')
            ->line('Otrzymaliśmy żądanie zresetowania hasła.')
            ->action('Resetuj hasło', url('/reset-password/' . $this->token . '?email=' . urlencode($notifiable->email)))
            ->line('Jeśli to nie Ty, po prostu zignoruj tego maila.');
    }
}