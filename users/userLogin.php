<?php
session_start();
include_once('db.php');
include_once('otp/otpprocess.php');
$classNameDb = new DB_con();
$classOtp = new otpprocess();

	if(isset($_POST))
	{
			$email=$_POST['email'];
			$password=$_POST['password'];
		
			$getUserSql=$classNameDb->checkUserMember($email,$password);
			
			
			if($getUserSql)
			{
				//  $mobileNo = $getUserSql[3];
				//  $randomid = mt_rand(1000,9999);  
				//  $sendOtpRequest = $classOtp->send($mobileNo,$randomid);
				//  var_dump($sendOtpRequest);
				//  die();
				$_SESSION['id']=$getUserSql[0];
				$_SESSION['name']=$getUserSql[1];
				$_SESSION['email']=$getUserSql[2];
				
		    	echo json_encode(array("statusCode"=>200));
			}
			else
			{
				echo json_encode(array("statusCode"=>201));
			}
	}else{
		echo "check";die();
	}
	



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
	
?>