<?php
// session_start();
// include_once('db.php');
// include_once('otp/otpprocess.php');
// $classNameDb = new DB_con();
// $classOtp = new otpprocess();

// 	if(isset($_POST))
// 	{
// 			$email=$_POST['email'];
// 			$password=$_POST['password'];
		
// 			$getUserSql=$classNameDb->checkUserMember($email,$password);
			
// 			if($getUserSql)
// 			{
// 				//  $mobileNo = $getUserSql[3];
// 				//  $randomid = mt_rand(1000,9999);  
// 				//  $sendOtpRequest = $classOtp->send($mobileNo,$randomid);
// 				//  var_dump($sendOtpRequest);
// 				//  die();
// 				$_SESSION['id']=$getUserSql[0];
// 				$_SESSION['name']=$getUserSql[1];
// 				$_SESSION['email']=$getUserSql[2];
// 				$_SESSION['mobile']=$getUserSql[3];
// 				// print_r($getUserSql);die();
				
// 		    	echo json_encode(array("statusCode"=>200));
// 			}
// 			else
// 			{
// 				echo json_encode(array("statusCode"=>201));
// 			}
// 	}else{
// 		echo "check";die();
// 	}
	



		// if ($check)
		// {
		// 	$_SESSION['email']=$email;
		// 	echo json_encode(array("statusCode"=>200));
		// }
		// else{
		// 	echo json_encode(array("statusCode"=>201));
		// }

		// if($_POST['type']==2){
		// 		$email=$_POST['email'];
		// 		$password=md5($_POST['password']);
		// 		$check=mysqli_query($conn,"select * from user_member where email='$email' and password='$password'");
		
		// 		if ($check)
		// 		{
		// 			$_SESSION['email']=$email;
		// 			echo json_encode(array("statusCode"=>200));
		// 		}
		// 		else{
		// 			echo json_encode(array("statusCode"=>201));
		// 		}
		// 	}
	

// setup includes
require_once('../core/includes/master.inc.php');

$error = False;
$error_message = "";

// clear any expired IPs
bannedIP::clearExpiredBannedIps();

// do login
$loginUsername = trim($_POST['email']);
$loginPassword = trim($_POST['password']);

// check user isn't banned from logging in
$bannedIp = bannedIP::getBannedIPData();
if ($bannedIp)
{
	if ($bannedIp['banType'] == 'Login')
	{
		$error = True;
		$expiry_time = ($bannedIp['banExpiry'] != null ? coreFunctions::formatDate($bannedIp['banExpiry']) : t('later', 'later'));
		$error_message = "You have been temporarily blocked from logging in due to too many failed login attempts. Please try again '$expiry_time'";
	}

}

// initial validation
if ($error == false)
{
	if (!strlen($loginUsername))
	{
		// log failure
		Auth::logFailedLoginAttempt(coreFunctions::getUsersIPAddress(), $loginUsername);
		$error = True;
		$error_message = "Please enter your username";
	}
	elseif (!strlen($loginPassword))
	{
		// log failure
		Auth::logFailedLoginAttempt(coreFunctions::getUsersIPAddress(), $loginUsername);
		$error = True;
		$error_message = "Please enter your password";
	}
}

if ($error == false)
    {
        $rs = $Auth->login($loginUsername, $loginPassword, true);
        if ($rs)
        {
            // successful login
            echo json_encode(array("statusCode"=>200));
        }
        else
        {
            // login failed
			echo json_encode(array("statusCode"=>201, "message"=> "Your username and password are invalid"));
        }
	}
	else{
		echo json_encode(array("statusCode"=>201, "message"=> $error_message));
	}
	
?>