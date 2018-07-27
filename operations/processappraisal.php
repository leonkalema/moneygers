<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$id=trim($formvalues['edit']);

if(trim($formvalues['edit']) != ""){
	mysql_query("UPDATE appraisals SET details ='".$formvalues['details']."', madeby ='".$formvalues['madeby']."',	registrationdate =".changeDateFromPageCombosToMySQLFormat($formvalues['appraisal_day'], $formvalues['appraisal_month'], $formvalues['appraisal_year'])." WHERE id = '".$id."'");
	
	//get the last inserted incase no error occured
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
	
// Insert a new appraisal into the database
} else{
	mysql_query("INSERT INTO appraisals (guard,	assignment,	details, madeby, registrationdate) 
			VALUES ('".$formvalues['guard']."', '".$formvalues['assignment']."', '".$formvalues['details']."', '".$formvalues['madeby']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['appraisal_day'], $formvalues['appraisal_month'], $formvalues['appraisal_year']).")");

	//Set a message in case an error occurred
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
}

forwardToPage("appraisals.php");
?>