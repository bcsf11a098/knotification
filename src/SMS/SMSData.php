<?php

namespace Panic\Notifications\SMS;


use Panic\Notifications\MessageData;
use Panic\Notifications\NotificationValidation;


class SMSData extends MessageData
{
    protected $numbers_to;

    protected $message;

    protected $sender = "Panic\\Notifications\\SMS\\SMSSender";


    function __construct($numbers_to, $message)
    {
        if(!is_array($numbers_to)){

            $numbers_to = array($numbers_to);

        }

        $data = array("numbers" => $numbers_to, "message" => $message);

        if($this->isValid($data)) {

            $this->numbers_to = $numbers_to;

            $this->message = $message;

        }
    }

    public function getNumbersTo()
    {
        return $this->numbers_to;
    }

    public function setNumbersTo($numbers_to)
    {
        $this->numbers_to = $numbers_to;
    }

    public function isValid($data) {
        NotificationValidation::isValidNumbers($data['numbers']);
        NotificationValidation::isValidString(array("message"=>$data['message']));

        return true;
    }

}