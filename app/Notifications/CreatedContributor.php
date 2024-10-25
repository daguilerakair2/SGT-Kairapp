<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class CreatedContributor extends Notification
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
                    $attachment->title('Colaborador creado')
                               ->content('El colaborador fue creado con éxito.')
                               ->fields([
                                    'Nombre' => $this->information['name'],
                                    'Email' => $this->information['email'],
                                    'Rol' => $this->information['role'],
                                    'Tienda' => $this->information['store'],
                                    'Sucursal' => $this->information['subStore'],
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
