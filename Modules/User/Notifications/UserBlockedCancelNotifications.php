<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserBlockedCancelNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
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
        ->subject('!لقد تم إلغاء حظر حسابك')
        ->greeting("مرحبا بك $notifiable->name")
        ->line("لقد تم إلغاء حظر حسابك")
        ->line("الرجاء الإلتزام بقواعد وتعليمات المنصة، نتمنى لك تصفح ممتع")
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
