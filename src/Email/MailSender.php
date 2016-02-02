<?php

namespace Panic\Notifications\Email;

use Panic\Notifications\NotificationSender;
use Illuminate\Support\Facades\Config;
use Mail;
use Log;
use Carbon;


class MailSender implements NotificationSender {

    public function send($data)
    {
        dd($data->getEmailsTo());
        Mail::send('notifications::emails.notification', ['data' => $data], function ($m) use ($data) {
            $m->from(Config::get("notifications.MAIL_FROM"), Config::get("notifications.MAIL_FROM_TITLE"));

            $m->to($data->getEmailsTo(), 'Cloud Horizon')->subject($data->getSubject());
        });

        Log::info('Email successfully sent.',
            [
                'subject' => $data->getSubject(),
                'from' => Config::get("notifications.MAIL_FROM"),
                'to' => implode(", ", $data->getEmailsTo()),
                'body' => $data->getMessage(),
                'date_created' => Carbon::now()
            ]);
    }

}