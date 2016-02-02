<?php

namespace Panic\Notifications\Push;


use Panic\Notifications\NotificationSender;
use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Support\Facades\Config;
use Log;
use Carbon;

class PushNotificationSender implements NotificationSender
{
    public function send($data)
    {
        $app = (Config::get("notifications.".$data->getAppName()));

        $devices_token = $data->getDevicesToken();
        $devices_collection = array();
        foreach($devices_token as $device_token){
            $devices_collection[] = PushNotification::Device($device_token);
        }

        $devices = PushNotification::DeviceCollection($devices_collection);

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