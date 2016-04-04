# README #


### Notifications Package for Laravel 5.* ###

* Package for sending various types of notifications (Email, SMS and Push notification)
* Version 1.0.3
* https://bitbucket.org/cloudhorizon/notifications/
* This package wraps two other packages https://github.com/davibennun/laravel-push-notification for push notifications and https://github.com/twilio/twilio-php for sms notifications

### Installation ###

* Update your composer.json file to include this package as a dependency 
```
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
```
* Register the Notifications service provider by adding it to the providers array in the app/config/app.php file.

```
'providers' => array(
    ...
    Panic\Notifications\NotificationsServiceProvider::class
    Davibennun\LaravelPushNotification\LaravelPushNotificationServiceProvider::class,
)

'aliases' => [ array(
    ...
    'PushNotification' => Davibennun\LaravelPushNotification\Facades\PushNotification::class
)
```

### Configuration ###

* Copy the config and view files into your project by running:

```
php artisan vendor:publish --provider="Panic\Notifications\NotificationsServiceProvider"
```
* Update config file: config/notifications.php with your credentials
* Update view fale template for email: resource/views/panic/notifications/emails/notification.blade.php

### Usage ###

Use this models in your controller

use Panic\Notifications\Notification;
use Panic\Notifications\Email\MailData;
use Panic\Notifications\Push\PushNotificationData;
use Panic\Notifications\SMS\SMSData;

## Email ##

```
$emailView = 'emails.notification'; // choose email view, if not set use default
$emailFrom = 'notification@domain.com'; // if not set use from config file
$emailFromTitle = 'Domain title'; // if not set use from config file
$emails_to = array(email1@domain.com, email2@domain.com, ...);
$subject = 'Notification!';
$message = 'This is your first email notification!';

$data = new MailData($emailsTo, $subject, $message, $emailView, $emailFrom, $emailFromTitle);

$notification->send($data);
```
## SMS ##
```
$mobileNumbers = array('+3816012345678','0038187654321');
$message = 'This is your first sms notification!';

$data = new SMSData($mobileNumbers, $message);

$notification->send($data);
```
## Push notification ##
```
$appName = "appName"; //from configuration file
$devicesToken = array('devicetoken1', 'devicetoken2', ...);
$message = 'This is your first push notification!';

$data = new PushNotificationData($appName, $devicesToken, $message);

$notification->send($data);
```
* Copy the config and view files into your project by running:
```
php artisan vendor:publish
```
### Prerequisites ###

php >= 5.5.9
laravel/framework : 5.1.*

### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Contact ###

* filip@cloudhorizon.com