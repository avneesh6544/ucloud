<?php
include_once('db.php');
$classNameDb = new DB_con();
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$password = $_POST['password'];
	
	$insertUserSql=$classNameDb->insertUserMember($name,$email,$contact,$password);
	if($insertUserSql)
	{	
		echo json_encode(array("statusCode"=>200));
	}
	else
	{
		echo json_encode(array("statusCode"=>201));
	}	
?>