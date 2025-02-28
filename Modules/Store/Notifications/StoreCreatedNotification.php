<?php

namespace Modules\Store\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Store\Entities\Store;

class StoreCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Store $store)
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
        return ['mail','database', 'broadcast'];
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
            ->subject('إنشاء متجر جديد')
            ->line('لديك اشعار جديد تحقق من لوحة التحكم')
            ->action('لوحة التحكم', route('dashboard.index'));
    }


    public function toDatabase($notifiable)
    {
        return [
            'name' => 'طلب انشاء متجر',
            'url' => route('dashboard.stores.show', $this->store->id),
            'icon' => 'ki-duotone ki-shop',
            'message' => __("تم ارسال طلب انشاء متجر جديد باسم {$this->store->name}"),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'name' => 'طلب انشاء متجر',
            'url' => route('dashboard.stores.show', $this->store->id),
            'icon' => 'ki-duotone ki-shop',
            'message' => __("تم ارسال طلب انشاء متجر جديد باسم {$this->store->name}"),
        ]);
    }
}
