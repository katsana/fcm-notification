<?php

namespace NotificationChannels\Fcm;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging;

class Channel
{
    /**
     * @var \Kreait\Firebase\Messaging
     */
    protected $messaging;

    /**
     * @param \Kreait\Firebase\Messaging $messaging
     */
    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notifications\Notification|Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var Message $message */
        $message = $notification->toFcm($notification);

        if (! $notifiable->routeNotificationFor('fcm', $notification) &&
            ! $message instanceof Message) {
            return;
        }
        
        $this->messaging->send($message->toArray());
    }
}
