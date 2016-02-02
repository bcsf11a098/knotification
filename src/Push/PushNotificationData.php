<?php

namespace Panic\Notifications\Push;


use Panic\Notifications\MessageData;
use Panic\Notifications\NotificationValidation;


class PushNotificationData extends MessageData
{
    protected $app_name;

    protected $devices_token;

    protected $message;

    protected $sender = "Panic\\Notifications\\Push\\PushNotificationSender";


    function __construct($app_name, $devices_token, $message)
    {
        if(!is_array($devices_token)){

            $devices_token = array($devices_token);

        }

        $data = array("app_name" => $app_name, "devices_token" => $devices_token, "message" => $message);

        if($this->isValid($data)) {

            $this->app_name = $app_name;

            $this->devices_token = $devices_token;

            $this->message = $message;
        }

    }

    public function getAppName()
    {
        return $this->app_name;
    }

    public function setAppName($app_name)
    {
        $this->app_name = $app_name;
    }

    public function getDevicesToken()
    {
        return $this->devices_token;
    }

    public function setDevicesToken($devices_token)
    {
        $this->devices_token = $devices_token;
    }

    public function isValid($data) {
        NotificationValidation::isValidString(array("app_name"=>$data['app_name'], "devices_token"=>$data['devices_token'], "message"=>$data['message']));

        return true;
    }
}