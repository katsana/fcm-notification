<?php

namespace NotificationChannels\Fcm;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $firebase = $this->app->make('firebase.messaging');

            $service->extend('fcm', static function () use ($firebase) {
                return new Channels\TokenChannel($firebase);
            });

            $service->extend('fcm-topic', static function () use ($firebase) {
                return new Channels\TopicChannel($firebase);
            });

            $service->extend('fcm-condition', static function () use ($firebase) {
                return new Channels\ConditionChannel($firebase);
            });
        });
    }
}
