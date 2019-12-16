<?php

namespace NotificationChannels\Fcm\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as IlluminateNotification;

abstract class Notification extends IlluminateNotification
{
    use Queueable;

    /**
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['fcm'];
    }

    /**
     * Get the message representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \NotificationChannels\Fcm\Message
     */
    abstract public function toFcm($notifiable);
}
