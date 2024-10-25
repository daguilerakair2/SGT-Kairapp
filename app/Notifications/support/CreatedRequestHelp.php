<?php

namespace App\Notifications\support;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class CreatedRequestHelp extends Notification
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
                    $attachment->title('Solicitud Recibida')
                               ->content('Detalle de la inquietud:')
                               ->fields([
                                    'Asunto: ' => $this->information['title'],
                                    'Mensaje: ' => $this->information['message'],
                                    'Fecha: ' => $this->information['date'],
                                    'Nombre usuario' => $this->information['name_user'],
                                    'Correo electrónico usuario' => $this->information['email_user'],
                                    'Nombre compañia:' => $this->information['companyNameStore'],
                                    'Nombre tienda:' => $this->information['nameStore'],
                                    'Teléfono de contacto' => $this->information['phone'],
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
