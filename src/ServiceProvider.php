<?php

namespace NotificationChannels\Fcm;

use Kreait\Firebase\Messaging;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(Channel::class)
            ->needs(Messaging::class)
            ->give(function () {
                return $this->app->make(Messaging::class);
            });
    }
}
