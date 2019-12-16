<?php

namespace NotificationChannels\Fcm;

use Kreait\Firebase\Messaging\MessageTarget;

class Message
{
    /**
     * @var string|null
     */
    protected $topic = null;

    /**
     * @var string|null
     */
    protected $condition = null;

    /**
     * @var string|null
     */
    protected $token = null;

    /**
     * @var array|null
     */
    protected $data = null;

    /**
     * @var array
     */
    protected $notification = [];

    /**
     * @var array
     */
    protected $androidConfig = [];

    /**
     * @var array
     */
    protected $apnsConfig = [];

    /**
     * @var array
     */
    protected $webPushConfig = [];

    /**
     * @var array
     */
    protected $fcmOptions = [];

    public function topic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function condition(string $condition): self
    {
        $this->condition = $condition;

        return $this;
    }

    public function token(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function data(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function notification(string $title = null, string $body = null, string $image = null): self
    {
        $this->notification = compact('title', 'body', 'image');

        return $this;
    }

    public function android(array $androidConfig): self
    {
        $this->androidConfig = $androidConfig;

        return $this;
    }

    public function apns(array $apnsConfig): self
    {
        $this->apnsConfig = $apnsConfig;

        return $this;
    }

    public function webPush(array $webPushConfig): self
    {
        $this->webPushConfig = $webPushConfig;

        return $this;
    }

    public function fcmOptions(array $fcmOptions): self
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    public function toArray()
    {
        return array_filter([
            MessageTarget::TOPIC => $this->topic,
            MessageTarget::CONDITION => $this->condition,
            MessageTarget::TOKEN => $this->token,
            'data' => $this->data,
            'notification' => $this->notification,
            'android' => $this->androidConfig,
            'apns' => $this->apnsConfig,
            'webpush' => $this->webPushConfig,
            'fcm_options' => $this->fcmOptions,
        ]);
    }
}
