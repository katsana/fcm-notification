<?php

namespace NotificationChannels\Fcm\Tests\Unit\Channels;

use Mockery as m;
use Kreait\Firebase\Messaging;
use NotificationChannels\Fcm\Channels\ConditionChannel;
use PHPUnit\Framework\TestCase;

class ConditionChannelTest extends TestCase
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

        $notifiable->shouldReceive('routeNotificationFor')->with('fcm-condition', $notification)
            ->andReturn("'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)");

        $firebase->shouldReceive('send')->with([
            'condition' => "'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)",
            'notification' => [
                'title' => 'Ping',
                'body' => 'Pong',
                'image' => '',
            ],
        ])->andReturn([]);

        $channel = new ConditionChannel($firebase);

        $channel->send($notifiable, $notification);

        $this->addToAssertionCount(2);
    }


    /** @test */
    public function it_cant_send_notification_if_notifiable_doesnt_support_fcm()
    {
        $notifiable = m::mock('User');
        $firebase = m::mock(Messaging::class);
        $notification = new Stubs\PingNotification();

        $notifiable->shouldReceive('routeNotificationFor')->with('fcm-condition', $notification)->andReturnNull();
        $firebase->shouldNotReceive('send');

        $channel = new ConditionChannel($firebase);
        $channel->send($notifiable, $notification);

        $this->addToAssertionCount(2);
    }
}
