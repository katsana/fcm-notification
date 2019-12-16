<?php

namespace NotificationChannels\Fcm\Tests\Unit\Channels;

use Illuminate\Support\Str;
use Kreait\Firebase\Messaging;
use Mockery as m;
use NotificationChannels\Fcm\Channels\TokenChannel;
use PHPUnit\Framework\TestCase;

class TokenChannelTest extends TestCase
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
        $deviceToken = (string) Str::uuid();

        $notifiable = m::mock('User');
        $firebase = m::mock(Messaging::class);
        $notification = new Stubs\PingNotification();

        $notifiable->shouldReceive('routeNotificationFor')->with('fcm', $notification)
            ->andReturn($deviceToken);

        $firebase->shouldReceive('send')->with([
            'token' => $deviceToken,
            'notification' => [
                'title' => 'Ping',
                'body' => 'Pong',
                'image' => '',
            ],
        ])->andReturn([]);

        $channel = new TokenChannel($firebase);

        $channel->send($notifiable, $notification);

        $this->addToAssertionCount(2);
    }

    /** @test */
    public function it_cant_send_notification_if_notifiable_doesnt_support_fcm()
    {
        $notifiable = m::mock('User');
        $firebase = m::mock(Messaging::class);
        $notification = new Stubs\PingNotification();

        $notifiable->shouldReceive('routeNotificationFor')->with('fcm', $notification)->andReturnNull();
        $firebase->shouldNotReceive('send');

        $channel = new TokenChannel($firebase);
        $channel->send($notifiable, $notification);

        $this->addToAssertionCount(2);
    }
}
