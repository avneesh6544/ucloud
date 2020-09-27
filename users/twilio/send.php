<?php

//  include '../header.php'; 
require_once('../../core/includes/master.inc.php');

$AuthUser = Auth::getAuth();
$db = Database::getDatabase();
if(!$AuthUser->id){
    coreFunctions::redirect(WEB_ROOT.'/users/login.php');
}
?>
<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
$sid    = "AC84236a3b4cabd5755ff374b6baccbc0f";
$token  = "c8d127cf38f201346bcfb7441d15b356";

$mobilenumber = $AuthUser->contact_no;

$rndno=rand(1000, 9999);

$_SESSION['randnumber'] = $rndno;

$message = urlencode("otp number is ".$rndno);

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