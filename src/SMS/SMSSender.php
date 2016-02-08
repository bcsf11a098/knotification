<?php

namespace Panic\Notifications\SMS;


use Panic\Notifications\NotificationSenderInterface;
use Illuminate\Support\Facades\Config;
use Services_Twilio;
use Log;
use Carbon;


class SMSSender implements NotificationSenderInterface
{
    public function send($data)
    {

        $sid = Config::get("notifications.TWILIO_ACCOUNT_SID");

        $token = Config::get("notifications.TWILIO_AUTH_TOKEN");

        $client = new Services_Twilio($sid, $token);

        try {

            $from = Config::get("notifications.TWILIO_FROM");

            $numbers = $data->getNumbersTo();
            foreach($numbers as $number) {
                $info = $client->account->messages->sendMessage($from, $number, $data->getMessage());

                Log::info('SMS successfully sent.', [
                    'sid' => $info->sid,
                    'date_created' => Carbon\Carbon::now()
                ]);
            }

        } catch (Exception $e) {

            throw $e;

        }
    }
}