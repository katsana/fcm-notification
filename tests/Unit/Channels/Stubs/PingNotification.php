<?php

namespace NotificationChannels\Fcm\Tests\Unit\Channels\Stubs;

use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\Message;

class PingNotification extends Notification
{
    public function via($notifiable)
    {
        return ['fcm', 'fcm-topic', 'fcm-condition'];
    }

    public function toFcm($notifiable)
    {
        return (new Message)
            ->notification('Ping', 'Pong');
    }
}
