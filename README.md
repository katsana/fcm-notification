
Firebase Cloud Messaging (FCM) Notification Channel for Laravel
===================

This package makes it easy to send notifications using [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/) with Laravel 6.0+ using [kreait/laravel-firebase](https://github.com/kreait/laravel-firebase)

## Installation

FCM Notification can be installed via composer:

```
composer require "katsana/fcm-notification"
```

### Configuration

> This part is based on [Firebase for Laravel Configuration](https://github.com/kreait/laravel-firebase#configuration)

In order to access a Firebase project and its related services using a server SDK, requests must be authenticated. For server-to-server communication this is done with a Service Account.

The package uses auto discovery to find the credentials needed for authenticating requests to the Firebase APIs by inspecting certain environment variables and looking into Google's well known path(s).

If you don't already have generated a Service Account, you can do so by following the instructions from the official documentation pages at https://firebase.google.com/docs/admin/setup#initialize_the_sdk.

Once you have downloaded the Service Account JSON file, you can use it to configure the package by specifying the environment variable `FIREBASE_CREDENTIALS` in your `.env` file:

```
FIREBASE_CREDENTIALS=/full/path/to/firebase_credentials.json
# or
FIREBASE_CREDENTIALS=relative/path/to/firebase_credentials.json
```

For further configuration, please see `config/firebase.php`. You can modify the configuration by copying it to your local config directory with the publish command:

```
php artisan vendor:publish --provider="Kreait\Laravel\Firebase\ServiceProvider" --tag=config
```

## Usages

If a notification supports being sent as an FCM, you should define a `toFcm` method on the notification class. This method will receive a $notifiable entity and should return a `NotificationChannels\Fcm\Message` instance:

```php
/**
 * Get the FCM representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \NotificationChannels\Fcm\Message
 */
public function toNexmo($notifiable)
{
    return (new Message)
        ->notification('Your title', 'Your body');
}
```

### Routing FCM Notifications

When sending notifications via the `fcm` channel, the notification system will automatically look for `routeNotificationForFcm` method on the entity:

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the FCM channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
        return $this->deviceToken;
    }
}
```
