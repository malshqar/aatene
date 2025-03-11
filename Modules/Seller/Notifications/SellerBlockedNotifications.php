<?php

namespace Modules\Seller\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Seller\Entities\Seller;

class SellerBlockedNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Seller $seller)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
        ->view('user::emails.ban')
        ->subject('!لقد تم حظر حسابك')
        ->greeting("مرحبا بك $notifiable->name")
        ->line("لقد تم حظر حسابك    : $notifiable->ban_reason")
        ->line("الوقت المتبقي حتى انتهاء  الحظر هو : {$notifiable->ban_at->diffForHumans()}")
        // ->line("ملاحظة في حال حظر حسابك لأكثر من مرة سيتم حذفه بشكل تلقائي بعد المرة الثالثة")
        ->action('الدعم الفني', url('/'));
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
