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
     * Topic name.
     *
     * @return $this
     */
    public function topic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Topic condition.
     *
     * @return $this
     */
    public function condition(string $condition)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Device token.
     *
     * @return $this
     */
    public function token(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Data payload.
     *
     * @return $this
     */
    public function data(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Notification data.
     *
     * @return $this
     */
    public function notification(string $title = null, string $body = null, string $image = null)
    {
        $this->notification = compact('title', 'body', 'image');

        return $this;
    }

    /**
     * Android configuration.
     *
     * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidconfig
     *
     * @return $this
     */
    public function android(array $androidConfig)
    {
        $this->androidConfig = $androidConfig;

        return $this;
    }

    /**
     * Apple Push Notification Service configuration.
     *
     * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#apnsconfig
     *
     * @return $this
     */
    public function apns(array $apnsConfig)
    {
        $this->apnsConfig = $apnsConfig;

        return $this;
    }

    /**
     * WebPush configuration.
     *
     * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#webpushconfig
     *
     * @return $this
     */
    public function webPush(array $webPushConfig)
    {
        $this->webPushConfig = $webPushConfig;

        return $this;
    }

    /**
     * FCM Options.
     *
     * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#fcmoptions
     *
     * @return $this
     */
    public function fcmOptions(array $fcmOptions)
    {
        $this->fcmOptions = $fcmOptions;

        return $this;
    }

    /**
     * Get the instance as an array.
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

    /**
     * Clone the instance.
     */
    public function __clone()
    {
        $this->topic = null;
        $this->condition = null;
        $this->token = null;
        $this->data = $this->data;
        $this->notification = $this->notification;
        $this->androidConfig = $this->androidConfig;
        $this->apnsConfig = $this->apnsConfig;
        $this->webPushConfig = $this->webPushConfig;
        $this->fcmOptions = $this->fcmOptions;
    }
}
