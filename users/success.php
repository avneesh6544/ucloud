<?php
require_once 'db.php';
$classNameDb = new DB_con();

// echo "<pre>";print_r($_POST);die();

$razorpay_payment_id = $_POST['razorpay_payment_id'];
$razorpay_order_id = $_POST['razorpay_order_id'];
$razorpay_signature = $_POST['razorpay_signature'];


$insertUserSql = $classNameDb->payment($razorpay_payment_id,$razorpay_order_id,$razorpay_signature);

if($insertUserSql === TRUE) {
    echo "your payment sucess";
}else{
    echo "Error: ".$sql."<br>".$conn->error;
}

// $conn->close();


?>