<?php

namespace NotificationChannels\Fcm\Channels;

use NotificationChannels\Fcm\Message;

class ConditionChannel extends Channel
{
    /**
     * Channel name.
     */
    protected function channelName(): string
    {
        return 'fcm-condition';
    }

    /**
     * Set message to.
     */
    protected function messageTo(Message $message, string $to): Message
    {
        return $message->condition($to);
    }
}
