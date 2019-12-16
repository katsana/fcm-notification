<?php

namespace NotificationChannels\Fcm\Channels;

use NotificationChannels\Fcm\Message;

class TokenChannel extends Channel
{
    /**
     * Channel name.
     */
    protected function channelName(): string
    {
        return 'fcm';
    }

    /**
     * Set message to.
     */
    protected function messageTo(Message $message, string $to): Message
    {
        return $message->token($to);
    }
}
