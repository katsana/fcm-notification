<?php

namespace NotificationChannels\Fcm;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging;

class Channel
{
    /**
     * Messaging driver.
     *
     * @var \Kreait\Firebase\Messaging
     */
    protected $messaging;

    /**
     * Messaging authentication channel.
     *
     * @var array
     */
    protected static $channels = [
        'fcm' => 'token',
        'fcm-by-topic' => 'topic',
        'fcm-by-channel' => 'channel',
    ];

    /**
     * Construct notification channel.
     */
    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Send the given notification.
     *
     * @param mixed                                   $notifiable
     * @param Notifications\Notification|Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $notification instanceof Notifications\Notification) {
            return;
        }

        $message = $notification->toFcm($notifiable);

        if (! $message instanceof Message) {
            return;
        }

        foreach (static::$channels as $name => $method) {
            if (\is_null($value = $notifiable->routeNotificationFor($driver, $notification)) {
                $this->messaging->{$method}($value);
                $this->messaging->send($message->toArray());
            }
        }
    }
}
