<?php

namespace Panic\Notifications;


interface NotificationSender {

    public function send($data);

}