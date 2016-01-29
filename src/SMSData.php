<?php

namespace Panic\Notifications;


class SMSData extends MessageData
{
    protected $number_to;

    protected $message;

    protected $sender = "SMSSender";


    function __construct($number_to, $message)
    {
        $this->number_to = $number_to;

        $this->message = $message;
    }

    public function getNumberTo()
    {
        return $this->number_to;
    }

    public function setNumberTo($number_to)
    {
        $this->number_to = $number_to;
    }


}