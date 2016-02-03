<?php

namespace Panic\Notifications\Email;

use Panic\Notifications\NotificationSender;
use Illuminate\Support\Facades\Config;
use Mail;
use Log;


class MailSender implements NotificationSender {

    public function send($data)
    {
        $emails = $data->getEmailsTo();
        $subject = $data->getSubject();
        foreach ($emails as $email) {

            Mail::send('notifications::emails.notification', ['data' => $data], function ($m) use ($data, $email, $subject) {
                $m->from(Config::get("notifications.MAIL_FROM"), Config::get("notifications.MAIL_FROM_TITLE"));

                $m->to($email, 'Cloud Horizon')->subject($subject);
            });

        }

        Log::info('Email successfully sent.',
            [
                'subject' => $data->getSubject(),
                'from' => Config::get("notifications.MAIL_FROM"),
                'to' => implode(", ", $data->getEmailsTo()),
                'body' => $data->getMessage()
            ]);
    }

}