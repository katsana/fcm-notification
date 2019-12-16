<?php

namespace NotificationChannels\Fcm\Channels;

use NotificationChannels\Fcm\Message;

class TopicChannel extends Channel
{
    /**
     * Channel name.
     */
    protected function channelName(): string
    {
        return 'fcm-topic';
    }

    /**
     * Set message to.
     */
    protected function messageTo(Message $message, string $to): Message
    {
        return $message->topic($to);
    }
}
