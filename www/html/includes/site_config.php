<?php
/*
* Main site configuration file.
* All our site wide constants etc live here
*/


// path to site
define('DOCUMENT_ROOT', '/var/www/html/');

// where publically inaccessible stuff should live (eg error logs)
define('SYSTEM_ROOT', '/var/www/html/');	

// determine if script is running in user's browser or command line (shell)
if (isset($_SERVER['SHELL'])) {
	define('SHELL', 1);
}
else {
	// running in browser
	session_start();
	define('SHELL', 0);
}

// these will be included on every page of the site
require_once(DOCUMENT_ROOT.'includes/common_functions.php');

// set our custom error handler which will run when trigger_error is called
set_error_handler("customErrorHandler");	// in common_functions.php

// db class
require_once(DOCUMENT_ROOT.'/includes/classes/db.class.php');

// our site wide constants
define('SITE_TITLE', 'DET Python Anki Overdrive - Local Database App');

// our error logs dir on the server
define('ERROR_LOG_PATH', SYSTEM_ROOT.'error_logs/');

// email address where site notifications are sent (eg new resgistrations)
define('ADMIN_EMAIL', 'stooks@protonmail.com');

// email address where debug emails are sent
define('DEBUG_EMAIL', 'stooks@protonmail.com');

// domain name without the http://
define('SITE_DOMAIN', $_SERVER['SERVER_NAME']);

// site url including the http://
define('SITE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/');


// connect to our db
$db_name = 'det_anki';
$db_user = 'phpmyadmin';
$db_pass = 'fullthrottle';

db = new db($db_name, $db_user, $db_pass);

?>
