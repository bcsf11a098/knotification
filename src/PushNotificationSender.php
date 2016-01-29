<?php

namespace Panic\Notifications;


use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Support\Facades\Config;

class PushNotificationSender implements NotificationSender
{
    public function send($data)
    {
        $app = (Config::get("notifications.".$data->getAppName()));

        //dd($app);

        PushNotification::app($app)
            ->to($data->getDeviceToken())
            ->send($data->getMessage());
    }
}