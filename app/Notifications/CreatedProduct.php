<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class CreatedProduct extends Notification
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
                    $attachment->title('Producto creado')
                               ->content('El producto fue creado con éxito.')
                               ->fields([
                                    'Nombre' => $this->information['name'],
                                    'Cantidad disponible' => $this->information['stock'],
                                    'Precio' => $this->information['price'],
                                    'RUT tienda' => $this->information['rut'],
                                    'Tienda' => $this->information['store_name'],
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
