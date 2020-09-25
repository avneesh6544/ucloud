<?php

include_once('db.php');
require_once 'razorpay/Razorpay.php';


use Razorpay\Api\Api;

$keyId = 'rzp_test_U6ih3nl2Ekdvmz';
$secretkey = 'RIgM45KV3io8IbA0hfAHcgwQ';

$api = new Api($keyId , $secretkey);
if(isset($_POST['submit']))
{	
$name = 'avneesh';
$email = 'avneesh.patel.it@gmail.com';
$PAT_AMT = $_POST['payment'];

}

$order = $api->order->create(array(
	'receipt' => rand(1000 , 9999) . 'ORD',
	'amount' => $PAT_AMT,
	'payment_capture' => 1,
	'currency' => 'INR',
	)
);

?>

<!-- <meta name="viewport" content="width=device-width"> -->
<div style="margin: auto;width: 10%;">

		<br>
<form action="success.php" method="POST">
<input type="hidden" value="<?php echo $order->amount ?>" name="ammount">
<script
	src="https://checkout.razorpay.com/v1/checkout.js"
	data-key="<?php echo $keyId ?>"
	data-amount="<?php echo $order->amount ?>"
	data-currency="INR"
	data-order_id="<?php echo $order->id ?>"
	data-buttontext="pay with razorpay"
	data-name="Myinboxhub"
	data-description="For Donation"
	data-image="<?php echo 'https://myinboxhub.co.in/data/logo/logo.png' ?>"
	data-prefill.name="<?php echo $name ?>"
	data.prefill.email="<?php echo $email ?>"
	data-theme.color="#foa43c"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">

	
</form>

</div>
	