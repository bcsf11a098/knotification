<?php

namespace Panic\Notifications;


use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Config;


class MailSender implements NotificationSender {

    public function send($data)
    {
        Mail::send('notifications::emails.notification', ['data' => $data], function ($m) use ($data) {
            $m->from(Config::get("notifications.MAIL_FROM"), Config::get("notifications.MAIL_FROM_TITLE"));

            $m->to($data->getEmailTo(), 'Cloud Horizon')->subject($data->getSubject());
        });

        Log::info('Email successfully sent.', ['subject' => $data->getSubject(), 'from' => Config::get("notifications.MAIL_FROM"), 'to' => $data->getEmailTo(), 'body' => $data->getMessage(), 'date_created' => Carbon::now()]);
    }

}