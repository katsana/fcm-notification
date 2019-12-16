<?php

namespace NotificationChannels\Fcm\Tests\Feature;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            'NotificationChannels\Fcm\ServiceProvider',
        ];
    }
}
