<?php

namespace NotificationChannels\Fcm;

use Illuminate\Support\Arr;
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
     * @var string|null
     */
    protected $notification = null;
    
    /**
     * @var array|null
     */
    protected $androidConfig = null;
    
    /**
     * @var array|null
     */
    protected $apnsConfig = null;
    
    /**
     * @var array|null
     */
    protected $webpushConfig = null;
    
    /**
     * @var array|null
     */
    protected $fcmOptions = null;

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
     * @param string $notification
     * @return self
     */
    public function notification(string $notification): self
    {
        $this->notification = $notification;

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
     * @param string $fcmOptions
     * @return self
     */
    public function fcmOptions(string $fcmOptions): self
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
