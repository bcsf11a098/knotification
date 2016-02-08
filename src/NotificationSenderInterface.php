<?php

namespace Panic\Notifications;


interface NotificationSenderInterface {

    public function send($data);

}