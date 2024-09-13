<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostMessage extends Notification
{
    use Queueable;
    protected $post;
    protected $message;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $message, $email)
    {
        //

        $this->post = $post;
        $this->message = $message;
        $this->email = $email;
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
        ->line('Vous avez reçu un message concernant une annonce que vous avez déposée :')
        ->line('--------------------------------------')
        ->line($this->message)
        ->line('--------------------------------------')
        ->action('Voir votre post', route('posts.show', $this->post->id))
        ->line("L'email de l'expéditeur est : " . $this->email)
        ->line("Merci d'utiliser notre site pour vos annonces !");
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
