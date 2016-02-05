<?php

namespace Panic\Notifications\Push;


use Panic\Notifications\NotificationSender;
use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Support\Facades\Config;
use Log;

class PushNotificationSender implements NotificationSender
{
    public function send($data)
    {
        $app = (Config::get("notifications.".$data->getAppName()));

        $devicesToken = $data->getDevicesToken();
        $devicesCollection = array();
        foreach($devicesToken as $deviceToken){
            $devicesCollection[] = PushNotification::Device($deviceToken);
        }

        $devices = PushNotification::DeviceCollection($devicesCollection);

        $collection = PushNotification::app($app)
            ->to($devices)
            ->send($data->getMessage());

        foreach ($collection->pushManager as $push) {
            $response = $push->getAdapter()->getResponse();

            Log::info('Push notification successfully sent.',
                [
                    'response' => $response
                ]);
        }

    }
}