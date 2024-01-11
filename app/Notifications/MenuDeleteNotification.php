<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MenuDeleteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $menuType;
    public $canceldate;

    public function __construct($menuType, $canceldate)
    {
        $this->menuType = $menuType;
        $this->canceldate = $canceldate;
    }
    

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     return ['mail'];
    // }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line("The {$this->menuType} menu for {$this->canceldate} has been deleted successfully.")
            ->action('View Dashboard', url('/dashboard'))
            ->line('Thank you for using our Cafeteria application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'menu_type' => $this->menuType,
            'canceldate' => $this->canceldate,
            'message'   => "The {$this->menuType}  for {$this->canceldate} has been cancelled successfully.",
        ];
    }
}
