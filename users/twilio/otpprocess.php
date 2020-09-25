<?php
session_start();
if(isset($_POST['submit'])){
    $otp = $_POST['otp'];

    $sessionotp = $_SESSION['otp'];

    if($sessionotp == $otp){
        echo"login successfully";
    }else{
        header('Location: ../login.php');
    }
    // print_r($sessionotp);
    
}
?>