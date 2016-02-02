<?php


namespace Panic\Notifications;


abstract class NotificationValidation
{
    public static function isValidEmail($emails) {
        foreach ($emails as $email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new \Exception($email.' is not a valid email address.');
            }
        }
    }

    public static function isValidNumbers($numbers) {

        foreach ($numbers as $number) {
            //^\+[1-9]{1}[0-9]{3,14}$
            if(!preg_match('/^(\+|\d)[0-9]{7,16}$/', $number)) {
                throw new \Exception($number.' is not valid number.');
            }
        }
    }

    public static function isValidString($strings) {
        foreach ($strings as $field=>$string) {
            if(is_array($string)){
                foreach ($string as $string_type=>$string_value) {
                    if($string_value == "" || !is_string($string_value)){
                        throw new \Exception($string_type.' is not valid string.');
                    }
                }
            }elseif($string == "" || !is_string($string)){
                throw new \Exception($field.' is not valid string.');
            }
        }
    }

    abstract function isValid($data);
}