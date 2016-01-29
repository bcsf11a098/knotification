<?php

/**
 * Package config template
 */
return [
    "TWILIO_ACCOUNT_SID" => "Your Twilio account sid",
    "TWILIO_AUTH_TOKEN" => "Your Twilio auth token",
    "TWILIO_FROM" => "Your Twilio number from",

    "MAIL_FROM" => "from@mail.com",
    "MAIL_FROM_TITLE" => "Title",

    "appNameIOS" => array(
        "environment" => "development",
        "certificate" => "/path/to/certificate.pem",
        "passPhrase"  => "password",
        "service"     => "apns"
    ),
    "appNameAndroid" => array(
        "environment" => "production",
        "apiKey"      => "yourAPIKey",
        "service"     => "gcm"
    )
];