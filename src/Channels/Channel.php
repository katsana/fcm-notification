<?php

namespace NotificationChannels\Fcm\Channels;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging;
use NotificationChannels\Fcm\Message;

abstract class Channel
{
    /**
     * Messaging driver.
     *
     * @var \Kreait\Firebase\Messaging
     */
    protected $messaging;

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
     * @param mixed                                 $notifiable
     * @param \Illuminate\Notification|Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if (\is_null($to = $notifiable->routeNotificationFor($this->channelName(), $notification))) {
            return;
        }

        $message = $notification->toFcm($notifiable);

        if (! $message instanceof Message) {
            return;
        }

        $this->messaging->send($this->messageTo(clone $message, $to)->toArray());
    }

    /**
     * Channel name.
     */
    abstract protected function channelName(): string;

    /**
     * Set message to.
     */
    abstract protected function messageTo(Message $message, string $to): Message;
}
