<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
print_r($formvalues);

if(isset($formvalues['edit']) && $formvalues['edit'] != ""){

	$query = mysql_query("UPDATE alarms SET alarmid='".$formvalues['alarmid']."', assignment='".$formvalues['assignment']."', startdate=".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']).", enddate=".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']).", expirydate=".changeDateFromPageCombosToMySQLFormat($formvalues['expiry_day'], $formvalues['expiry_month'], $formvalues['expiry_year'])." WHERE id = '".trim($formvalues['edit'])."'") or die("Error: ".mysql_error());
	
	
	if(mysql_error() == ""){
		$url = "managealarminstallations.php";
	} else{
		$_SESSION['errors'] = "An error occurred while saving the alarm information. Please try again or contact your administrator.";
		
		$url = "managealarminstallations.php?action=edit&id=".$formvalues['id'];
	}
} 
else if(isset($formvalues['submit']) && $formvalues['submit'] != "") {

$query = mysql_query("INSERT INTO alarms (alarmid, assignment, startdate, enddate, expirydate) 
			VALUES ('".$formvalues['alarmid']."', '".$formvalues['assignment']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']).", ".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']).",".changeDateFromPageCombosToMySQLFormat($formvalues['expiry_day'], $formvalues['expiry_month'], $formvalues['expiry_year'])." )");

	//get the last inserted incase no error occured
	if(mysql_error() == ""){
		$url = "managealarminstallations.php";
	} else {
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
		$url = "managealarminstallations.php";		
	}
}

forwardToPage($url);
?>