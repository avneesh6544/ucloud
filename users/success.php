<?php

require('config.php');

// session_start();

require_once 'razorpay/Razorpay.php';
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

session_start();
require('db.php');
$classNameDb = new DB_con();

$success = true;

$error = "Payment Failed";


if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    $user_id = $_SESSION['id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $razorpay_signature = $_POST['razorpay_signature'];
    $ammount = $_POST['ammount']/100;
    
// print_r($user_id);die();
    $insertUserSql = $classNameDb->payment($user_id,$razorpay_payment_id,$razorpay_order_id,$razorpay_signature,$ammount);
    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_order_id' => $_POST['razorpay_order_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
        $classNameDb->update_payment_status($razorpay_payment_id, 1);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $classNameDb->update_payment_status($razorpay_payment_id, 2);
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
