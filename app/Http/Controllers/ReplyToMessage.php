<?php

require_once 'vendor/autoload.php'; // Loads the library
use Twilio\Twiml\MessagingResponse;

$response = new MessagingResponse();
$response->message("I'm good thanks! How are you?");
print  str_limit($response, 140, '&raquo');