<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RegistrationPassword extends Notification
{
    use Queueable;

    /**
     * The generated password.
     *
     * @var string
     */
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
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
            ->subject('Uw account werd aangemaakt')
            ->greeting('Hallo!')
            ->line('Je ontvangt deze e-mail omdat er een account werd aangemaakt voor dit e-mailadres.')
            ->line('Het wachtwoord voor deze account is ' . $this->password)
            ->line(new HtmlString('Je kan nu <a href="localhost/login">inloggen</a> met dit wachtwoord.'))
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
