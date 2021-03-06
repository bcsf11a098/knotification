<?php

namespace Panic\Notifications\Email;


use Panic\Notifications\MessageData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use View;


class MailData extends MessageData
{
    protected $emailView;

    protected $emailFrom;

    protected $emailFromTitle;

    protected $emailsTo;

    protected $subject;

    protected $sender = MailSender::class;


    function __construct($emailsTo, $subject, $message, $emailView = "", $emailFrom = "", $emailFromTitle = "")
    {


        if(!is_array($emailsTo)){

            $emailsTo = array($emailsTo);

        }

        if($emailView == ""){

            $this->emailView = "emails.notification";

        }else{

            $this->emailView = $emailView;

        }

        if($emailFrom == ""){

            $this->emailFrom = Config::get("notifications.MAIL_FROM");

        }else{

            $this->emailFrom = $emailFrom;

        }

        if($emailFromTitle == ""){

            $this->emailFromTitle = Config::get("notifications.MAIL_FROM_TITLE");

        }else{

            $this->emailFromTitle = $emailFromTitle;

        }

        $data = array("emailView" => $emailView, "emailFrom" => $emailFrom, "emailFromTitle" => $emailFromTitle, "emailsTo" => $emailsTo, "subject" => $subject, "message" => $message);

        if($this->isValid($data)->fails()) {
            throw new \Exception('Data is not valid.');
        }

        $this->emailsTo = $emailsTo;

        $this->subject = $subject;

        $this->message = $message;

    }

    public function getEmailView()
    {
        return $this->emailView;
    }

    public function setEmailView($emailView)
    {
        $this->emailView = $emailView;
    }

    public function getEmailFrom()
    {
        return $this->emailFrom;
    }

    public function setEmailFrom($emailFrom)
    {
        $this->emailFrom = $emailFrom;
    }

    public function getEmailFromTitle()
    {
        return $this->emailFromTitle;
    }

    public function setEmailFromTitle($emailFromTitle)
    {
        $this->emailFromTitle = $emailFromTitle;
    }

    public function getEmailsTo()
    {
        return $this->emailsTo;
    }

    public function setEmailsTo($emailsTo)
    {
        $this->emailsTo = $emailsTo;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function isValid($data)
    {
        foreach($data['emailsTo'] as $data['emailTo']){
            $validator = Validator::make($data, [
                'emailTo' => 'required|email',
            ]);

            if($validator->fails()){
                throw new \Exception($data['emailTo'] . ' is not a valid email address.');
            }
        }

        if (!View::exists('notifications::'.$data['emailView']))
        {
            throw new \Exception('Email view not exists');
        }

        $validator = Validator::make($data, [
            'emailFrom' => 'email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        return $validator;
    }
}