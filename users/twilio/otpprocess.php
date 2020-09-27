<?php
// session_start();
//  include '../header.php'; 
require_once('../../core/includes/master.inc.php');

if(isset($_POST['submit'])){
    $otp = $_POST['otp'];
    $sessionotp = $_SESSION["randnumber"];
    echo"<pre>";
    print_r($sessionotp);die();
    if($sessionotp == $otp){
        echo"login successfully";
    }else{
        header('Location: ../login.php');
    }
    // print_r($sessionotp);
    
}
?>