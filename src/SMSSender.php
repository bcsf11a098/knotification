<?php

namespace Panic\Notifications;


use Illuminate\Support\Facades\Config;
use Services_Twilio;
use Log;


class SMSSender implements NotificationSender
{
    public function send($data)
    {

        $sid = Config::get("notifications.TWILIO_ACCOUNT_SID");

        $token = Config::get("notifications.TWILIO_AUTH_TOKEN");

        $client = new Services_Twilio($sid, $token);

        try {

            $from = Config::get("notifications.TWILIO_FROM");

            $info = $client->account->messages->sendMessage($from, $data->getNumberTo(), $data->getMessage());

            Log::info('SMS successfully sent.', ['sid' => $info->sid, 'status' => $info->status, 'from' => $info->from, 'to' => $info->to, 'body' => $info->body, 'date_created' => $info->date_created]);

        } catch (Exception $e) {

            throw $e;

        }
    }
}