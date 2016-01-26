<?php
namespace Panic\Notifications;

use Mail;

class MailSender implements NotificationSender {

    public function send($data)
    {
        $user = $data['user'];

        Mail::send('notifications::emails.notification', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@cloudhorizon.com', 'Notification package');

            $m->to($user->email, $user->name)->subject('Your Notification!');
        });
    }

}