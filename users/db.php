
<?php
	// $servername = "localhost";
	// $username = "root";
	// $password = "";
	// $db="ucloud";
	// /*Create connection*/
	// $conn = mysqli_connect($servername, $username, $password,$db);
	
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASS' ,'');
	define('DB_NAME', 'ucloud');
	class DB_con
	{
	function __construct()
	{
	$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$this->dbh=$con;
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	}
	public function insertUserMember($name,$email,$contact,$password)
	{
	
	$sqlInsertUser = mysqli_query($this->dbh,"insert into user_member(name,email,contact,password,status)
	values('$name','$email','$contact','$password','1')");
	return $sqlInsertUser;
	}
	public function checkUserMember($email,$password)
	{
	
	$sqlGetUser = mysqli_query($this->dbh,"select * from user_member where email='$email' and password='$password'");
	if(mysqli_num_rows($sqlGetUser)>0){
		return  mysqli_fetch_row(mysqli_query($this->dbh,"select * from user_member where email='$email' and password='$password'"));
     

	}else{
        return  false;
	}
	
	}

}


   ?>