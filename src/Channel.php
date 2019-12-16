<?php

namespace NotificationChannels\Fcm;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
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
        'fcm-by-condition' => 'condition',
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
        if (! \method_exists($notification, 'toFcm')) {
            return;
        }

        $messageBag = $notification->toFcm($notifiable);

        if (! $messageBag instanceof Message) {
            return;
        }

        $messages = Collection::make();

        foreach (static::$channels as $name => $method) {
            if (\is_null($value = $notifiable->routeNotificationFor($name, $notification))) {
                $message = clone $messageBag;
                $messages->push($message->{$method}($value)->toArray());
            }
        }

        $this->messaging->sendAll($messages->all());
    }
}
