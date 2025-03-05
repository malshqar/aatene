<?php

namespace Modules\Store\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Store\Entities\Story;
use Modules\User\Entities\User;

class NewStoryReactionNotifiaction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $story, public $user_id)
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
        return ['database', 'broadcast'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = User::find($this->user_id);
        return [
            'body' => [
                'name' => 'تفاعل مع قصتك',
                'message' => "تفاعل {$user->name} مع قصتك "
            ]
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $user = User::find($this->user_id);

        return new BroadcastMessage([
            'body' => [
                'name' => 'تفاعل مع قصتك',
                'message' => "تفاعل {$user->name} مع قصتك "
            ]
        ]);
    }
}
