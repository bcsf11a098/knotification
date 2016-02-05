<?php

namespace Panic\Notifications\Push;


use Panic\Notifications\MessageData;
use Illuminate\Support\Facades\Validator;


class PushNotificationData extends MessageData
{
    protected $appName;

    protected $devicesToken;

    protected $message;

    protected $sender = "Panic\\Notifications\\Push\\PushNotificationSender";


    function __construct($appName, $devicesToken, $message)
    {
        if(!is_array($devicesToken)){

            $devicesToken = array($devicesToken);

        }

        $data = array("appName" => $appName, "devicesToken" => $devicesToken, "message" => $message);

        if($this->isValid($data)->fails()) {
            throw new \Exception('Data is not valid.');
        }

        $this->appName = $appName;

        $this->devicesToken = $devicesToken;

        $this->message = $message;

    }

    public function getAppName()
    {
        return $this->appName;
    }

    public function setAppName($appName)
    {
        $this->appName = $appName;
    }

    public function getDevicesToken()
    {
        return $this->devicesToken;
    }

    public function setDevicesToken($devicesToken)
    {
        $this->devicesToken = $devicesToken;
    }

    public function isValid($data)
    {

        foreach($data['devicesToken'] as $data['deviceToken']){
            $validator = Validator::make($data, [
                'deviceToken' => 'required|string',
            ]);

            if($validator->fails()){
                throw new \Exception($data['deviceToken'] . ' is not a valid device token.');
            }
        }

        $validator = Validator::make($data, [
            'appName' => 'required|string',
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        return $validator;
    }
}