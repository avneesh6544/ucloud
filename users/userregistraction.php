<?php


// print_r($_POST);die();
// echo 'hello';die();
// include_once('db.php');
// $classNameDb = new DB_con();
	
	// $name = $_POST['name'];
	// $email = $_POST['email'];
	// $contact = $_POST['contact'];
	// $password = $_POST['password'];
	// print_r($email);die();
// 	$insertUserSql=$classNameDb->insertUserMember($name,$email,$contact,$password);
// 	if($insertUserSql)
// 	{	
// 		echo json_encode(array("statusCode"=>200));
// 	}
// 	else
// 	{
// 		echo json_encode(array("statusCode"=>201));
// 	}	

// setup includes
require_once('../core/includes/master.inc.php');

// account types
$accountTypeDetails = $db->getRows('SELECT id, level_id, label FROM user_level WHERE id > 0 ORDER BY level_id ASC');

// account status
$accountStatusDetails = array('active', 'pending', 'disabled', 'suspended');

// load all file servers
$sQL = "SELECT id, serverLabel FROM file_server ORDER BY serverLabel";
$serverDetails = $db->getRows($sQL);

$error = False;

// prepare variables
$username = '';
$password = '';
$confirm_password = '';
$account_status = 'active';
$account_type = 1;
$expiry_date = '';
$title = 'Mr';
$first_name = '';
$last_name = '';
$email_address = '';
$storage_limit = '';
$remainingBWDownload = '';
$upload_server_override = '';

// get variables
$username = trim(strtolower($_POST['username']));
$password = trim($_POST['password']);
// $confirm_password = trim($_POST['confirm_password']);
$contact_no = $_POST["contact"];
$account_status = $account_status;
$account_type = $account_type;
$expiry_date = $expiry_date;
$title = trim($_POST['title']);
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email_address = trim(strtolower($_POST['email']));
$storage_limit = str_replace(array(',', ' ', '.', '(', ')', '-'), '', $storage_limit);
$remainingBWDownload = str_replace(array(',', ' ', '.', '(', ')', '-'), '', $remainingBWDownload);
if((int) $remainingBWDownload == 0)
{
	$remainingBWDownload = null;
}
$dbExpiryDate = '';
$uploadedAvatar = null;

if(strlen($first_name) == 0)
    {
		$error = True;
		echo json_encode(array("statusCode"=>201, "message", "enter_first_name"));
    }
elseif(strlen($last_name) == 0)
    {
		$error = True;
		echo json_encode(array("statusCode"=>201, "message", "enter_last_name"));
    }
elseif(strlen($email_address) == 0)
    {
		$error = True;
		echo json_encode(array("statusCode"=>201, "message", "enter_email_address"));
    }
elseif(validation::validEmail($email_address) == false)
    {
		$error = True;
		echo json_encode(array("statusCode"=>201, "message", "entered_email_address_invalid"));
    }
// elseif($password != $confirm_password)
// {
// 	echo json_encode(array("statusCode"=>201, "message": "Your confirmation password does not match"));
// }
// check email/username doesn't already exist
$checkEmail = UserPeer::loadUserByEmailAddress($email_address);
        if($checkEmail)
        	{
				$error = True;
				// email already exist
				echo json_encode(array("statusCode"=>201, "message", "email already exists"));
			}	
        else
        {
            $checkUser = UserPeer::loadUserByUsername($username);
            if($checkUser)
            {
				$error = True;
                // username exists
				echo json_encode(array("statusCode"=>201, "message", "Username already exists on another account"));
            }
		}

if(!$error){
	// create the intial record
	$dbInsert = new DBObject("users", array("username", "password", "level_id", "email", "status", "title", "firstname", "lastname", "paidExpiryDate", "storageLimitOverride", "uploadServerOverride", "remainingBWDownload"));
	$dbInsert->username = $username;
	$dbInsert->password = Password::createHash($password);
	$dbInsert->level_id = $account_type;
	$dbInsert->email = $email_address;
	$dbInsert->status = $account_status;
	$dbInsert->title = $title;
	$dbInsert->firstname = $first_name;
	$dbInsert->lastname = $last_name;
	$dbInsert->contact_no = $contact_no;
	$dbInsert->paidExpiryDate = $dbExpiryDate;
	$dbInsert->storageLimitOverride = strlen($storage_limit) ? $storage_limit : NULL;
	$dbInsert->uploadServerOverride = (int) $upload_server_override ? (int) $upload_server_override : NULL;
	$dbInsert->remainingBWDownload = (int) $remainingBWDownload ? (int) $remainingBWDownload : NULL;
	if($dbInsert->insert())
	{
		echo json_encode(array("statusCode"=>200));
	}
}
else {	
		echo json_encode(array("statusCode"=>201, "message", "error_problem_record"));
	}
?>