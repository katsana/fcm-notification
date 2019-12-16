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

    public function topic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    public function condition(string $condition)
    {
        $this->condition = $condition;

        return $this;
    }

    public function token(string $token)
    {
        $this->token = $token;

        return $this;
    }

    public function data(array $data)
    {
        $this->data = $data;

        return $this;
    }

    public function notification(string $title = null, string $body = null, string $image = null)
    {
        $this->notification = compact('title', 'body', 'image');

        return $this;
    }

    public function android(array $androidConfig)
    {
        $this->androidConfig = $androidConfig;

        return $this;
    }

    public function apns(array $apnsConfig)
    {
        $this->apnsConfig = $apnsConfig;

        return $this;
    }

    public function webPush(array $webPushConfig)
    {
        $this->webPushConfig = $webPushConfig;

        return $this;
    }

    public function fcmOptions(array $fcmOptions)
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return \array_filter([
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
