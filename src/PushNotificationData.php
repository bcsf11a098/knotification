<?php

namespace Panic\Notifications;


class PushNotificationData extends MessageData
{
    protected $app_name;

    protected $device_token;

    protected $message;

    protected $sender = "PushNotificationSender";


    function __construct($app_name, $device_token, $message)
    {
        $this->app_name = $app_name;

        $this->device_token = $device_token;

        $this->message = $message;
    }

    public function getAppName()
    {
        return $this->app_name;
    }

    public function setAppName($app_name)
    {
        $this->app_name = $app_name;
    }

    public function getDeviceToken()
    {
        return $this->device_token;
    }

    public function setDeviceToken($device_token)
    {
        $this->device_token = $device_token;
    }
}