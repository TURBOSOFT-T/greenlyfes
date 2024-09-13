<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InscriptionConfirmation extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Bonjour ' . $this->user->nom . '!')
                    ->line('Merci de vous être inscrit à notre école.')
                    ->line('Votre inscription a été enregistrée avec succès.')
                    ->line('Nous vous contacterons bientôt avec plus d\'informations.')
                    ->action('Visitez notre site', url('/'))
                    ->line('Merci pour votre confiance !');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            // Vous pouvez ajouter des données supplémentaires ici si nécessaire
        ];
    }
}
