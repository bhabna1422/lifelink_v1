<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

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
        $link = 'https://www.lifelinkapps.com/v1/reset/' . $this->token;

        return (new MailMessage)
            ->subject('Reset your password')
            ->line('You are receiving this because you (or someone else) have requested the reset of the password.')
            ->line("Please click the following link or paste it in your browser to complete the process:")
            ->action('Reset Password', $link)
            ->line($link)
            ->line('If you did not request a password reset, please ignore this email.');
    }
}
