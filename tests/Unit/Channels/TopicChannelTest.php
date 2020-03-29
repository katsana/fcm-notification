<?php

namespace NotificationChannels\Fcm\Tests\Unit\Channels;

use Kreait\Firebase\Messaging;
use Mockery as m;
use NotificationChannels\Fcm\Channels\TopicChannel;
use PHPUnit\Framework\TestCase;

class TopicChannelTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_can_send_notification()
    {
        $notifiable = m::mock('User');
        $firebase = m::mock(Messaging::class);
        $notification = new Stubs\PingNotification();

        $notifiable->shouldReceive('routeNotificationFor')->with('fcm-topic', $notification)
            ->andReturn('a-topic');

        $firebase->shouldReceive('send')->with([
            'topic' => 'a-topic',
            'notification' => [
                'title' => 'Ping',
                'body' => 'Pong',
                'image' => '',
            ],
        ])->andReturn([]);

        $channel = new TopicChannel($firebase);

        $channel->send($notifiable, $notification);

        $this->addToAssertionCount(2);
    }

    /** @test */
    public function it_cant_send_notification_if_notifiable_doesnt_support_fcm()
    {
        $notifiable = m::mock('User');
        $firebase = m::mock(Messaging::class);
        $notification = new Stubs\PingNotification();

        $notifiable->shouldReceive('routeNotificationFor')->with('fcm-topic', $notification)->andReturnNull();
        $firebase->shouldNotReceive('send');

        $channel = new TopicChannel($firebase);
        $channel->send($notifiable, $notification);

        $this->addToAssertionCount(2);
    }
}
