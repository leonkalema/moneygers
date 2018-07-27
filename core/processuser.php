<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$formvalues = array_merge($_POST);
if(trim($formvalues['edit']) != ""){
	$querysec1 = "";
	
	if($formvalues['oldpassword'] != "" || $formvalues['password'] != ""){
		if(($formvalues['oldpassword'] != "" && howManyRows("SELECT * FROM users WHERE password = SHA('".$formvalues['oldpassword']."') AND id='".$formvalues['edit']."'") != 0 && $formvalues['password'] != "") || ($formvalues['password'] != "" && $_SESSION['groups'] == "1")){
			
			$querysec1 = "password = SHA('".$formvalues['password']."'),";
		} else {
			$wrongpw = true;
			if($formvalues['password'] == ""){
				$msg = "The new password field is empty. Please enter your new password.";
			} else {
				$msg = "The old password doesnt match that in our records.";
			}
		}
	}
	
	//Update the user info
	$querysec = "";
	//Only administrators de-activate or change user's rights but cant  de-activate the super-admin
	if($_SESSION['groups'] == "1" && $formvalues['edit'] != "1"){
		$querysec = "isactive = '".$formvalues['isactive']."', usergroup = '".$formvalues['groups']."',";
	}
	
	$query = "UPDATE users SET firstname = '".ucfirst($formvalues['firstname'])."', lastname = '".ucfirst($formvalues['lastname'])."', username = '".$formvalues['username']."', email = '".$formvalues['email']."', telephonenumber = '".$formvalues['telephonenumber']."',".$querysec1." address = '".$formvalues['address']."', ".$querysec." lastupdatedate = NOW(), lastupdatedby = '".$_SESSION['userid']."'  WHERE id='".$formvalues['edit']."'";
	mysql_query($query);
	
//Insert new user
} else {
		mysql_query("INSERT INTO users (firstname,lastname,username,password,isactive,email,telephonenumber,address,usergroup,createdby,datecreated) VALUES('".ucfirst($formvalues['firstname'])."', '".ucfirst($formvalues['lastname'])."','".$formvalues['username']."',SHA('".$formvalues['password']."'), '".$formvalues['isactive']."', '".$formvalues['email']."', '".$formvalues['telephonenumber']."', '".$formvalues['address']."', '".$formvalues['groups']."','".$_SESSION['userid']."', NOW())");
		
}

if(mysql_error() != ""){
	$_SESSION['error'] = "Errors occurred while saving the user information. Please try again or contact your administrator.";
	$url = "user.php";
} else {
	if($_SESSION['groups'] == "1"){
		$url = "manageusers.php";
	} else {
		if(!(isset($wrongpw) && $wrongpw)){
			$_SESSION['error'] = "Your profile has been updated.";
		} else {
			$_SESSION['error'] = $msg;
		}
		$url = "user.php?action=edit&id=".encryptValue($formvalues['edit']);
	}
}
forwardToPage($url);
?>