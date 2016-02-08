<?php

namespace Panic\Notifications;


use Panic\Notifications\Email\MailSender;


abstract class MessageData
{
    protected $message;

    protected $sender = MailSender::class;

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