<?php

namespace NotificationChannels\Fcm\Tests;

use Illuminate\Notifications\ChannelManager;
use Mockery as m;
use NotificationChannels\Fcm\Channels;
use NotificationChannels\Fcm\ServiceProvider;

class ServiceProviderTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [];
    }
/**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app->instance('firebase.messaging', m::mock('Kreait\Firebase\Messaging'));
    }

    /** @test */
    public function it_registers_fcm_channels()
    {
        $notification = $this->app->make(ChannelManager::class);

        $this->app->register(ServiceProvider::class);

        $this->assertInstanceOf(Channels\ConditionChannel::class, $notification->driver('fcm-condition'));
        $this->assertInstanceOf(Channels\TokenChannel::class, $notification->driver('fcm'));
        $this->assertInstanceOf(Channels\TopicChannel::class, $notification->driver('fcm-topic'));
    }

    /** @test */
    public function it_doesnt_registers_token_channel_if_service_provider_is_not_loaded()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Driver [fcm] not supported.');

        $this->app->make(ChannelManager::class)->driver('fcm');
    }

    /** @test */
    public function it_doesnt_registers_topic_channel_if_service_provider_is_not_loaded()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Driver [fcm-topic] not supported.');

        $this->app->make(ChannelManager::class)->driver('fcm-topic');
    }

    /** @test */
    public function it_doesnt_registers_condition_channel_if_service_provider_is_not_loaded()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Driver [fcm-condition] not supported.');

        $this->app->make(ChannelManager::class)->driver('fcm-condition');
    }
}
