<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PictureAdded extends Notification
{
    use Queueable;

    private $user_product;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_product)
    {
        $this->user_product = $user_product;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $info_about_product = UserProduct::where('id', $this->user_product->id)->first();
        $product = Product::where('id', $info_about_product->product_id)->first();
        $user = User::where('id', $info_about_product->user_id)->first();

        return [
            'painter' => $product->product,
            'number' => $product->number,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
            ],
        ];
    }
}
