<?php

namespace Panic\Notifications;


class MailData extends MessageData
{
    protected $email_to;

    protected $subject;

    protected $sender = "MailSender";


    function __construct($email_to, $subject, $message)
    {
        $this->email_to = $email_to;

        $this->subject = $subject;

        $this->message = $message;
    }


    public function getEmailTo()
    {
        return $this->email_to;
    }

    public function setEmailTo($email_to)
    {
        $this->email_to = $email_to;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
}