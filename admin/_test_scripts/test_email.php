<?php

// setup includes
require_once('../_local_auth.inc.php');

// prepare the variables
$email = "redlorry919@gmail.com";
$subject = "Test email from email_test.php";
$plainMsg = "Test email content";

// send the email
coreFunctions::sendHtmlEmail($email, $subject, $plainMsg, SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM, $plainMsg, true);
