<?php

namespace NotificationChannels\Fcm;

use Illuminate\Contracts\Container\Container;
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
            ->give(static function (Container $app) {
                return $app->make(Messaging::class);
            });
    }
}
