# README #


### Notifications Package for Laravel 5.* ###

* Package for sending various types of notifications (Email, SMS and Push notification)
* Version 0.0.1
* https://bitbucket.org/cloudhorizon/notifications/
* This package wraps two other packages https://github.com/davibennun/laravel-push-notification for push notifications and https://github.com/twilio/twilio-php for sms notifications

### Installation ###

* Update your composer.json file to include this package as a dependency 

"require": {
    ...
    "panic/notifications" : "*"
}

"minimum-stability": "dev",
    "repositories": [
        {
            "url": "git@bitbucket.org:cloudhorizon/notifications.git",
            "type": "vcs"
        }
    ],
* Register the Notifications service provider by adding it to the providers array in the app/config/app.php file.

'providers' => array(
    ...
    Panic\Notifications\NotificationsServiceProvider::class
)
* Dependencies
* Database configuration
* How to run tests
* Deployment instructions

### Configuration ###

* Copy the config and view files into your project by running:

php artisan vendor:publish

* Update config file: config/notifications.php with your credentials
* Update view fale template for email: resource/views/panic/notifications/emails/notification.blade.php

### Usage ###

Use this models in your controller

use Panic\Notifications\Notification;
use Panic\Notifications\Email\MailData;
use Panic\Notifications\Push\PushNotificationData;
use Panic\Notifications\SMS\SMSData;

## Email ##

$emails_to = array(email1@domain.com, email2@domain.com, ...);
$subject = 'Notification!';
$message = 'This is your first email notification!';

$data = new MailData($emails_to, $subject, $message);

$notification->send($data);

## SMS ##

$mobile_numbers = array('+3816012345678','0038187654321');
$message = 'This is your first sms notification!';

$data = new SMSData($mobile_numbers, $message);

$notification->send($data);

## Push notification ##

$app_name = "appName"; //from configuration file
$devices_token = array('devicetoken1', 'devicetoken2', ...);
$message = 'This is your first push notification!';

$data = new PushNotificationData($app_name, $devices_token, $message);

$notification->send($data);

* Copy the config and view files into your project by running:

php artisan vendor:publish

### Prerequisites ###



### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Contact ###

* filip@cloudhorizon.com