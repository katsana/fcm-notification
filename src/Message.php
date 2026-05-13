<?php

namespace NotificationChannels\Fcm;

use Kreait\Firebase\Messaging\MessageTarget;

class Message
{
    protected ?string $topic = null;

    protected ?string $condition = null;

    protected ?string $token = null;

    protected ?array $data = null;

    protected array $notification = [];

    protected array $androidConfig = [];

    protected array $apnsConfig = [];

    protected array $webPushConfig = [];

    protected array $fcmOptions = [];

    /**
     * Topic name.
     *
     * @return $this
     */
    public function topic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Topic condition.
     *
     * @return $this
     */
    public function condition(string $condition): self
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Device token.
     *
     * @return $this
     */
    public function token(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Data payload.
     *
     * @return $this
     */
    public function data(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Notification data.
     *
     * @return $this
     */
    public function notification(?string $title = null, ?string $body = null, ?string $image = null): self
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
    public function android(array $androidConfig): self
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
    public function apns(array $apnsConfig): self
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
    public function webPush(array $webPushConfig): self
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
    public function fcmOptions(array $fcmOptions): self
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
