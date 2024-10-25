<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class CreatedStore extends Notification
{
    use Queueable;
    private $information;

    /**
     * Create a new notification instance.
     */
    public function __construct($information)
    {
        $this->information = $information;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage())
                ->attachment(function ($attachment) {
                    $attachment->title('Tienda creada')
                               ->content('La tienda fue creada con éxito.')
                               ->fields([
                                    'RUT Tienda' => $this->information['rut'],
                                    'Nombre Compañia' => $this->information['companyName'],
                                    'Nombre Fantasia' => $this->information['fantasyName'],
                                    'Nombre Administrador' => $this->information['nameAdmin'],
                                    'Correo Electrónico Administrador' => $this->information['emailAdmin'],
                               ]);
                });
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
        ];
    }
}
