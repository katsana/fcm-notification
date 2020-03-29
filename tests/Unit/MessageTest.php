<?php

namespace NotificationChannels\Fcm\Tests\Unit;

use Illuminate\Support\Str;
use NotificationChannels\Fcm\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /** @test */
    public function it_can_set_topic()
    {
        $message = new Message();

        $message->topic('a-topic');

        $this->assertSame([
            'topic' => 'a-topic',
        ], $message->toArray());

        $this->assertSame([], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_condition()
    {
        $message = new Message();

        $message->condition("'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)");

        $this->assertSame([
            'condition' => "'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)",
        ], $message->toArray());

        $this->assertSame([], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_token()
    {
        $deviceToken = (string) Str::uuid();

        $message = new Message();

        $message->token($deviceToken);

        $this->assertSame([
            'token' => $deviceToken,
        ], $message->toArray());

        $this->assertSame([], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_data()
    {
        $message = new Message();

        $data = [
            'first_key' => 'First Value',
            'second_key' => 'Second Value',
        ];

        $message->data($data);

        $this->assertSame([
            'data' => $data,
        ], $message->toArray());

        $this->assertSame([
            'data' => $data,
        ], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_notification()
    {
        $message = new Message();

        $message->notification('My Notification Title', 'My Notification Body', 'http://lorempixel.com/400/200/');

        $this->assertSame([
            'notification' => [
                'title' => 'My Notification Title',
                'body' => 'My Notification Body',
                'image' => 'http://lorempixel.com/400/200/',
            ],
        ], $message->toArray());

        $this->assertSame([
            'notification' => [
                'title' => 'My Notification Title',
                'body' => 'My Notification Body',
                'image' => 'http://lorempixel.com/400/200/',
            ],
        ], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_android_configuration()
    {
        $message = new Message();

        $android = [
            'ttl' => '3600s',
            'priority' => 'normal',
            'notification' => [
                'title' => '$GOOG up 1.43% on the day',
                'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                'icon' => 'stock_ticker_update',
                'color' => '#f45342',
            ],
        ];

        $message->android($android);

        $this->assertSame([
            'android' => $android,
        ], $message->toArray());

        $this->assertSame([
            'android' => $android,
        ], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_apns_configuration()
    {
        $message = new Message();

        $apns = [
            'headers' => [
                'apns-priority' => '10',
            ],
            'payload' => [
                'aps' => [
                    'alert' => [
                        'title' => '$GOOG up 1.43% on the day',
                        'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                    ],
                    'badge' => 42,
                ],
            ],
        ];

        $message->apns($apns);

        $this->assertSame([
            'apns' => $apns,
        ], $message->toArray());

        $this->assertSame([
            'apns' => $apns,
        ], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_webpush_configuration()
    {
        $message = new Message();

        $webPush = [
            'notification' => [
                'title' => '$GOOG up 1.43% on the day',
                'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                'icon' => 'https://my-server/icon.png',
            ],
            'fcm_options' => [
                'link' => 'https://my-server/some-page',
            ],
        ];

        $message->webPush($webPush);

        $this->assertSame([
            'webpush' => $webPush,
        ], $message->toArray());

        $this->assertSame([
            'webpush' => $webPush,
        ], (clone $message)->toArray());
    }

    /** @test */
    public function it_can_set_fcm_options_configuration()
    {
        $message = new Message();

        $fcmOptions = [
            'analytics_label' => 'my-analytics-label',
        ];

        $message->fcmOptions($fcmOptions);

        $this->assertSame([
            'fcm_options' => $fcmOptions,
        ], $message->toArray());

        $this->assertSame([
            'fcm_options' => $fcmOptions,
        ], (clone $message)->toArray());
    }
}
