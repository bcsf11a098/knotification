<?php

namespace Panic\Notifications\SMS;


use Panic\Notifications\MessageData;
use Illuminate\Support\Facades\Validator;


class SMSData extends MessageData
{
    protected $numbersTo;

    protected $message;

    protected $sender = SMSSender::class;


    function __construct($numbersTo, $message)
    {
        if(!is_array($numbersTo)){

            $numbersTo = array($numbersTo);

        }

        $data = array("numbers" => $numbersTo, "message" => $message);

        if($this->isValid($data)) {

            $this->numbersTo = $numbersTo;

            $this->message = $message;

        }
    }

    public function getNumbersTo()
    {
        return $this->numbersTo;
    }

    public function setNumbersTo($numbersTo)
    {
        $this->numbersTo = $numbersTo;
    }

    public function isValid($data)
    {
        $rules = array('number' => array('regex:/^(\+|\d)[0-9]{7,16}$/'));
        foreach($data['numbers'] as $data['number']){

            $validator = Validator::make($data, $rules);

            if($validator->fails()){
                throw new \Exception($data['number'] . ' is not valid number.');
            }
        }

        $validator = Validator::make($data, [
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        return $validator;
    }

}