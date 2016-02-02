<?php

namespace Panic\Notifications;


class Notification
{
    public function send(MessageData $data)
    {
        $sender_class = $data->getSender();

        $notification = new $sender_class;

        $notification->send($data);
    }
}