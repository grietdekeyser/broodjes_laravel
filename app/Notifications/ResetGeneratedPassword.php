<?php

namespace App\Notifications;

use App\Http\Controllers\Auth\GeneratePassword;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ResetGeneratedPassword extends ResetPasswordNotification
{
    use Queueable;

    /**
     * The new password.
     *
     * @var string
     */
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $password)
    {
        $this->token = $token;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Wachtwoord opnieuw instellen')
            ->greeting('Hallo!')
            ->line('Je ontvangt deze e-mail omdat we een aanvraag ontvingen om uw wachtwoord opnieuw in te stellen.')
            ->line('Het nieuwe wachtwoord voor deze account is ' . $this->password)
            ->line(new HtmlString('Je kan nu <a href="localhost/login">inloggen</a> met dit nieuwe wachtwoord.'))
            ->salutation(new HtmlString('Vriendelijke groeten, <br>Broodjesbar'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
