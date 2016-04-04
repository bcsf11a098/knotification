<?php

namespace Panic\Notifications;


class Notification
{
    public function send(MessageData $data)
    {
        $senderClass = $data->getSender();

        $notification = new $senderClass;

        $notification->send($data);
    }
}