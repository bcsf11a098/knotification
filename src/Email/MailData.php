<?php

namespace Panic\Notifications\Email;


use Illuminate\Support\Facades\Validator;
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

        // Laravel Validation
        if($this->laravelValidation($data)->fails()) {
            throw new \Exception('Data is not valid.');
        }

        // Custom Validation NotificationValidation class
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

    public function laravelValidation($data)
    {
        Validator::extend("emails", function($attribute, $value, $parameters) {
            $rules = [
                'email' => 'required|email',
            ];
            foreach ($value as $email) {
                $data = [
                    'email' => $email
                ];
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    return false;
                }
            }
            return true;
        });

        $validator = Validator::make($data, [
            'email' => 'required|emails',
            'subject' => 'required',
            'message' => 'required',
        ]);

        return $validator;
    }

    public function isValid($data) {
        NotificationValidation::isValidEmail($data['emails']);
        NotificationValidation::isValidString(array("subject"=>$data['subject'],"message"=>$data['message']));

        return true;
    }
}