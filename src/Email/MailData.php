<?php

namespace Panic\Notifications\Email;


use Panic\Notifications\MessageData;
use Panic\Notifications\NotificationValidation;


class MailData extends MessageData
{
    protected $emails_to;

    protected $subject;

    protected $sender = "Panic\\Notifications\\Email\\MailSender";


    function __construct($emails_to, $subject, $message)
    {
        if(!is_array($emails_to)){

            $emails_to = array($emails_to);

        }

        $data = array("emails" => $emails_to, "subject" => $subject, "message" => $message);

        if($this->isValid($data)) {

            $this->emails_to = $emails_to;

            $this->subject = $subject;

            $this->message = $message;

        }
    }


    public function getEmailsTo()
    {
        return $this->emails_to;
    }

    public function setEmailsTo($emails_to)
    {
        $this->emails_to = $emails_to;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function isValid($data) {
        NotificationValidation::isValidEmail($data['emails']);
        NotificationValidation::isValidString(array("subject"=>$data['subject'],"message"=>$data['message']));

        return true;
    }
}