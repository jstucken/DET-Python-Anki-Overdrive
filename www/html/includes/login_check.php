<?

/*
* This script checks that the user has logged in
* If not, they are redirected to login screen
*/

// are they logged in?
if (empty($_SESSION['user']))
{
	loadPage("/login.php");
}

?>