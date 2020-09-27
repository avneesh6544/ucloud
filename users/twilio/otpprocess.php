<?php
// session_start();
if(isset($_POST['submit'])){
    $otp = $_POST['otp'];
    session_start();
    $sessionotp = $_SESSION;
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