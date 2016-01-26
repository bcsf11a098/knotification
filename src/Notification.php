<?php
namespace Panic\Notifications;

class Notification
{
    public function send($data, NotificationSender $notification)
    {
        $notification->send($data);
    }
}