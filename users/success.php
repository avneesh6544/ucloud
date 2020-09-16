<?php
require_once 'db.php';

echo "<pre>";print_r($_POST);

$sql = "INSERT INTO payment_laser (`payment_id`,`order_id`,`signature_hash`) VALUES ('".$_POST['razorpay_payment_id']."','".$_POST['razorpay_order_id']."','".$_POST['razorpay_signature']."')";

if($conn->query($sql) === TRUE) {
    echo "new record created sucessfully";
}else{
    echo "Error: ".$sql."<br>".$conn->error;
}

$conn->close();


?>