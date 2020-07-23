<?php

require_once '/path/to/vendor/autoload.php';

use Twilio\Rest\Client;

$sid    = "ACfbcfa3e86cd0611f10af837b27d92edf";
$token  = "your_auth_token";
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("+447772778204", // to
                           [
                               "body" => "Hi How are you?",
                               "from" => "+12056493765"
                           ]
                  );

print($message->sid);