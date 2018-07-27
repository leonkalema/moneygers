<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$id=trim($formvalues['edit']);

if(trim($formvalues['edit']) != ""){
	mysql_query("UPDATE complaints SET details ='".$formvalues['details']."', madeby ='".$formvalues['madeby']."', callsign = '".$formvalues['callsign']."', contactphone ='".$formvalues['contactphone']."',	madeon =".changeDateFromPageCombosToMySQLFormat($formvalues['complaint_day'], $formvalues['complaint_month'], $formvalues['complaint_year'])." WHERE id = '".$id."'");
	
	//get the last inserted incase no error occured
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
	
// Insert a new appraisal into the database
} else{
	mysql_query("INSERT INTO complaints (madeby, callsign, contactphone, details, madeon, type) 
			VALUES ('".$formvalues['madeby']."', '".$formvalues['callsign']."', '".$formvalues['contactphone']."', '".$formvalues['details']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['complaint_day'], $formvalues['complaint_month'], $formvalues['complaint_year']).", '".$formvalues['whotype']."')");
			
	//Set a message in case an error occurred
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
}

forwardToPage("complaints.php?t=".encryptValue($formvalues['whotype']));
?>