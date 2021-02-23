<?php
/*
* Main site configuration file.
* All our site wide constants etc live here
*/

// path to site
//define('DOCUMENT_ROOT', '/home/cowraweb/stockpatrol.cowraweb.com.au/');
define('DOCUMENT_ROOT', '/home/naomi/www/html/');


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
define('SITE_TITLE', 'Stock Patrol - ASX Simulator');

// our error logs dir on the server
define('ERROR_LOG_PATH', '/home/cowraweb/stockpatrol_logs/error_logs/');

// email address where site notifications are sent (eg new resgistrations)
define('ADMIN_EMAIL', 'jstucken@yahoo.com');

// email address where debug emails are sent
//define('DEBUG_EMAIL', 'test@cowraweb.com,jstucken@yahoo.com');
define('DEBUG_EMAIL', 'jstucken@yahoo.com');

// domain name without the http://
define('SITE_DOMAIN', $_SERVER['SERVER_NAME']);

// site url including the http://
define('SITE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/');

// yahoo API keys
define('YAHOO_API_KEY', 'dj0yJmk9ZnpHWVJlbWx0RHZHJmQ9WVdrOVJYQkRXbEZKTjJrbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD1kOQ--');
define('YAHOO_SHARED_SECRET', '5997ab952d7e23d589930f678cd2ca59832264c0');

// connect to our db
$db_host = '112.140.180.71';
$db_name = 'cowraweb_stockpatrol';
$db_user = 'cowraweb_patrol';
$db_pass = 'newHor5e@45';
	

$db = new db($db_name, $db_user, $db_pass, $db_host);

?>