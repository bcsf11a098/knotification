<?php

namespace Panic\Notifications;


abstract class MessageData
{
    protected $message;

    protected $sender = 'MailSender';

    public function getSender()
    {
        return $this->sender;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}