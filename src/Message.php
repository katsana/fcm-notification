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

    /**
     * @param string $topic
     * @return self
     */
    public function topic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * @param string $condition
     * @return self
     */
    public function condition(string $condition): self
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @param string $token
     * @return self
     */
    public function token(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @param array $data
     * @return self
     */
    public function data(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string|null $title
     * @param string|null $body
     * @param string|null $image
     * @return self
     */
    public function notification(string $title = null, string $body = null, string $image = null): self
    {
        $this->notification = compact('title', 'body', 'image');

        return $this;
    }

    /**
     * @param array $androidConfig
     * @return self
     */
    public function android(array $androidConfig): self
    {
        $this->androidConfig = $androidConfig;

        return $this;
    }

    /**
     * @param array $apnsConfig
     * @return self
     */
    public function apns(array $apnsConfig): self
    {
        $this->apnsConfig = $apnsConfig;

        return $this;
    }

    /**
     * @param array $webPushConfig
     * @return self
     */
    public function webPush(array $webPushConfig): self
    {
        $this->webPushConfig = $webPushConfig;

        return $this;
    }

    /**
     * @param array $fcmOptions
     * @return self
     */
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
