<?php 
include_once '../include/commonfunctions.php';
include_once "../class/class.user.php";
openDatabaseConnection();

$user = new User;
// initialize a session
	session_start();
	// Unset all of the session variables.
	session_unset();
	// Finally, destroy the session.
	session_destroy();
	// create a new session
	session_start();
	
	// initialze the errors varibale
	$errors = "";
	//checkMode();
	//The user forgot the password
	if(isset($_POST['forgotpw'])){
		if(howManyRows("SELECT * FROM users WHERE username = '".trim($_POST['username'])."'") > 0){
			$userrow = getRowAsArray("SELECT * FROM users WHERE username = '".trim($_POST['username'])."'");
			//Put a reminder to be seen by the admin concerned parties on their dashboards
			mysql_query("INSERT INTO messages (reason,details,sentby,date) VALUES ('FORGOT PASSWORD','<a href=\"../core/manageusers.php?a=search&userid=".$userrow['id']."\">View User</a>','".$userrow['id']."', now())");
			
			$_SESSION['msg'] = "Your message has been sent. Please allow some time for the admin to respond. Check your registered email for the response.";
		} else {
			$_SESSION['errors'] = "Sorry. There is no registered user with that username.";
		}
		
		$url = "../core/login.php?a=forgotpw";
		
	//The user is logging in
	} else {
	// Obtain the username from the post
	$username = $_POST['username'];
	$password = $_POST['password'];
	//die($username." ".$password);
	// add the username entered to the session in case errors occur.
	$_SESSION['username'] = $username;
	$userdata = "";
	
	openDatabaseConnection();
	
	$usernamequery = "SELECT *, SHA('".$password."') as loginpassword FROM users WHERE (username='".$username."') AND isactive= 'Y'";
	$usernameresult = mysql_query($usernamequery);
	// handle the query execution error gracefully
	if (mysql_error() != "") {
		// database errors occured
		$errors = "A system error occured, please try to login again. ".mysql_error();
		$url = "../core/login.php";
	} else {
		// check if the user was found, the number of rows returned is not 0
		if (mysql_num_rows($usernameresult) == 0) {
			// no user or email address was found
			$errors = "You have entered an invalid username or password";
			$url = "../core/login.php";
		} else {
			// user was found
			$userdetails = mysql_fetch_assoc($usernameresult);
			// check if the username and passwords match
			if ($userdetails['password'] == $userdetails['loginpassword']) {
				// add session attributes
				// get the user id from the query results, since this is the unique ID for
				// the user
				$_SESSION['userid'] = $userdetails['id'];
				$_SESSION['username'] = $userdetails['username'];
				$_SESSION['isadmin'] = $userdetails['isadmin'];	
				$_SESSION['emailaddress'] = $userdetails['emailaddress'];
				$_SESSION['names'] = $userdetails['firstname']." ".$userdetails['lastname'];
				//$line = getRowAsArray("SELECT groupid FROM usergroups WHERE userid = '".$_SESSION['userid']."'");
			 	$_SESSION['groups'] =  $userdetails['usergroup'];
			} else {
				// useracount and supplied passwords dont match
				$errors = "You have entered an invalid username or password";
				$url = "../core/login.php";
			}
		}
		// free the result resources
		mysql_free_result($usernameresult);
	}
	if($errors != ""){
		// add the errors to the session
		$_SESSION['errors'] = $errors;
	}
	// check if there were any errors
	if (trim($errors) == "") {
		// there were no errors
		$url = "../core/dashboard.php";
	}
	}
	
	# forward to the next page
	forwardToPage($url);
?>