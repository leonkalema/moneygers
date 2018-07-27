<?php	include_once '../include/commonfunctions.php';
	// initialize a session
	session_start();
	// forward to home page if cancelling membership
	$url= "login.php";
	$_SESSION = array();
	// Unset all of the session variables.
	session_unset();
	// Finally, destroy the session.
	session_destroy();
	// return to the login page
	forwardToPage($url);

?>