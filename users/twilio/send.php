<?php

session_start();
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
$sid    = "AC84236a3b4cabd5755ff374b6baccbc0f";
$token  = "26313450082ded81a42125cd01d8cdf5";

$mobilenumber = $_SESSION['mobile'];


$rndno=rand(1000, 9999);

$_SESSION['otp'] = $rndno;
// $message = urlencode("otp number is ".$rndno);

$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("+91".$mobilenumber, // to
                           [
                               "body" => 'your otp number is. '.$rndno,
                               "from" => "+14159174964"
                           ]
                  );

// print($message->sid);
header('Location: otp.php');
?>