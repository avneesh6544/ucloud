<?php

include_once('db.php');

	session_start();

	
		$email = $_POST['email'];
		$password = $_POST['password'];

		$check = mysqli_query($conn,"select * from user_member where email='$email' and password='$password'");

		if(mysqli_num_rows($check)>0){
			$_SESSION['email'] = $row['email'];
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
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