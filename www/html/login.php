<?php
/**
* Our login handling page which uses inbuilt php functions password_hash() and password_verify()
*
* This page can also be used to MAKE a hashed password to manually insert into the DB
* Example usage: login.php?make_pass=1&plaintext_pass=PASSWORD
*
*
*/

require_once ('includes/site_config.php');
require_once ('includes/smarty_config.php');
require_once ('includes/header.php');


/*
* Has an admin user (Jono) used $_GET vars to make a hashed pass?
*/
if ($_GET['make_pass'] == '1' AND (!empty($_GET['plaintext_pass']))) {
	
	// make new hashed password now
	$user_pass = $db->makeDBSafe($_GET['plaintext_pass']);
	$hash_pass = password_hash($user_pass, PASSWORD_DEFAULT);
	
	dbug($hash_pass);
	exit;
	
	// note:
	// David's pass: hillbrick
	// Naomi: jojos...
}

/*
if ($_GET['clear_session'] == '1') {
	unset($_SESSION['login_attempts']);
	echo "session cleared";
	exit;
}
*/

////////////////////// TODO  - MAKE PASSWORD EMAIL RESET OPTION ///////////////////////
////////////////////// TODO  - MAKE PASSWORD EMAIL RESET OPTION ///////////////////////
////////////////////// TODO  - MAKE PASSWORD EMAIL RESET OPTION ///////////////////////
////////////////////// TODO  - MAKE PASSWORD EMAIL RESET OPTION ///////////////////////
////////////////////// TODO  - MAKE PASSWORD EMAIL RESET OPTION ///////////////////////

// if user has tried to login...
if (!empty($_POST)) {
	
	// brute force prevention
	if ($_SESSION['login_attempts']['counter'] >= 3)
	{
		
		$last_timestamp = $_SESSION['login_attempts']['last_timestamp'];
		$current_timestamp = time();
		
		$timestamp_difference = $current_timestamp - $last_timestamp;
		
		//dbug($last_timestamp,'$last_timestamp');
		//dbug($current_timestamp,'$current_timestamp');
		//dbug($timestamp_difference,'$timestamp_difference');
		
		// 3 minute login failure window
		if ($timestamp_difference <= 180) {
			//die("Too many incorrect login attempts! Please try again later.");
			setStatusMessage("Too many incorrect login attempts! Please try again later.");
			loadPage('/index.php');
		}
	}	

	$clean_email = $db->makeDBSafe($_POST['email']);
	$clean_user_password_guess = $db->makeDBSafe($_POST['password']);
	
	
	// check if user exists in db and get their correct hashed password
	$sql = "SELECT * FROM users WHERE email='{$clean_email}'";

	//dbug($sql);
	$user = $db->getRow($sql);
	
	//dbug($user,'user');
	
	// do we have a user match in the DB?
	if (!empty($user))
	{
		// user exists
		// check user's password guess matches the hidden hashed pass in db
		
		if (password_verify($clean_user_password_guess, $user['password'])) {
			
			// all ok!
			// update DB last_login_time
			
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$agent = db::makeDBSafe($_SERVER['HTTP_USER_AGENT']);
			
			$update_sql = "UPDATE users SET	last_ip = '$ip_address', last_agent = '$agent', last_login_time = NOW() WHERE id = '{$user['id']}' LIMIT 1";

			if (!$result = $db->doQuery($update_sql))
			{
				trigger_error('Could not update last_login_time.', E_USER_ERROR);
			}
			
			// add user data into session
			$_SESSION['user']['id'] = $user['id'];
			$_SESSION['user']['email'] = $user['email'];
			$_SESSION['user']['firstname'] = $user['firstname'];
			$_SESSION['user']['lastname'] = $user['lastname'];
			$_SESSION['user']['admin'] = $user['admin'];
			unset($_SESSION['login_attempts']);
			
			setStatusMessage('Welcome '.$user['firstname'], false);
			
			loadPage('/reports');
		}
		
	}
	
	// default catch all
	// if the login has failed, we'll catch them here
	
	// brute force prevention
	// check session for number of previos login attempts
	if (empty($_SESSION['login_attempts']['counter'])) {
		$login_attempts = 1;
	}
	else {
		$login_attempts = $_SESSION['login_attempts']['counter'] + 1;
	}
	$_SESSION['login_attempts']['counter'] = $login_attempts;
	$_SESSION['login_attempts']['last_timestamp'] = time();
		
	setStatusMessage("Incorrect username or password.");
	loadPage('/login.php');
	exit;
}

$smarty->assign('template', getPageTemplate());
$smarty->display('default.tpl');
//debug($_SESSION,'_SESSION');
?>