<?php

namespace Modules\OrderModule\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderAboutToDeliverNotification extends Notification
{
    use Queueable;

    private $delivery_data;
    private $order_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order_id, $delivery_data)
    {
        $this->order_id = $order_id;
        $this->delivery_data = $delivery_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
    }

    /**
     * @return array
     */
    public function toDatabase(): array
    {
        return [
            'text' =>  'Order #' . $this->order_id . ' about to deliver with no driver',
            'date' => Carbon::parse($this->delivery_data)->diffForHumans(),
            'href' => route('orders.show', $this->order_id)
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
