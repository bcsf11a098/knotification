<?php

namespace Panic\Notifications\Email;

use Panic\Notifications\NotificationSenderInterface;
use Illuminate\Support\Facades\Config;
use Mail;
use Log;


class MailSender implements NotificationSenderInterface {

    public function send($data)
    {
        $emailFrom = $data->getEmailFrom();
        $emailFromTitle = $data->getEmailFromTitle();
        $emailsTo = $data->getEmailsTo();
        $subject = $data->getSubject();
        $view = $data->getEmailView();
        $view_path = 'notifications::'.$view;

        foreach ($emailsTo as $emailTo) {

            Mail::send($view_path, ['data' => $data], function ($m) use ($data, $emailFrom, $emailFromTitle, $emailTo, $subject) {
                $m->from($emailFrom, $emailFromTitle);

                $m->to($emailTo, 'Cloud Horizon')->subject($subject);
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