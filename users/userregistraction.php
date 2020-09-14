<?php

include_once('db.php');

	session_start();
	if($_POST['type']==1){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$sql = mysqli_query($conn,"INSERT INTO user_member (`name`,`email`,`password`,`status`)
		VALUES ('$name','$email','$password','1')");

		if ($sql) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
	}

	if($_POST['type']==2){
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$check=mysqli_query($conn,"select * from user_member where email='$email' and password='$password'");

		if ($check)
		{
			$_SESSION['email']=$email;
			echo json_encode(array("statusCode"=>200));
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
?>