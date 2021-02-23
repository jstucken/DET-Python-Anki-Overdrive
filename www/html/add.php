<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/site_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/smarty_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/login_check.php');

// if user has submitted form
if ($_POST) {
	
	//dbug($_POST,'$_POST');
	
	// sanitise user input
	$school_id = db::makeDBSafe($_POST['school_id']);
	$mac = db::makeDBSafe($_POST['mac']);
	$player_name = db::makeDBSafe($_POST['player_name']);
	$speed = db::makeDBSafe($_POST['speed']);
	$location = db::makeDBSafe($_POST['location']);
	$car_type = db::makeDBSafe($_POST['car_type']);

	// get current timestamp
	// needs to be in format like: 2021-02-10 04:13:15
	$date_time = date('Y-m-d H:i:s');
	
	//dbug($date_time,'date_time');
	
	$insert_sql = "INSERT INTO cars_data (school_id, date_time, mac, player_name, speed, location, car_type) VALUES ('$school_id', '$date_time','$mac', '$player_name', '$speed', '$location', '$car_type')";
	
	$insert_result = db::doQuery($insert_sql);
	if (!$insert_result) {
		trigger_error('Error - could not insert new record into cars_data table. $insert_sql: '.$insert_sql, E_USER_ERROR);
	}
	
	$new_id = db::getLastID();
	$message = "New record created (id: $new_id)";
	
	setStatusMessage($message, false);
	loadPage("/view.php");
	
	exit;
}

$smarty->assign('template', getPageTemplate());
$smarty->display('default.tpl');
?>