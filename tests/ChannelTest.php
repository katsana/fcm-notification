<?php

namespace NotificationChannels\Fcm\Tests;

use Illuminate\Notifications\Notification as IlluminateNotification;
use Illuminate\Notifications\RoutesNotifications;
use Kreait\Firebase\Factory;
use NotificationChannels\Fcm\Channel;
use NotificationChannels\Fcm\Message;
use NotificationChannels\Fcm\Notifications\Notification;
use PHPUnit\Framework\TestCase;

class ChannelTest extends TestCase
{
    protected function createMessaging()
    {
        $factory = new Factory;

        return $factory->createMessaging();
    }

    public function testDoingNothingOnIncorrectNotificationInstance()
    {
        $channel = new Channel($this->createMessaging());

        $this->assertEmpty($channel->send([], new IlluminateNotification));
    }

    public function testMockingNotificationInstance()
    {
        $channel = new Channel($this->createMessaging());
        $notification = $this->createMock(Notification::class);

        $notification->method('toFcm')
            ->willReturn(new Message);

        $this->assertEmpty($channel->send(new MockNotifiable, $notification));
    }
}

class MockNotifiable
{
    use RoutesNotifications;
}