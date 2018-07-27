<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$id=trim($formvalues['edit']);

if(trim($formvalues['edit']) != ""){
	mysql_query("UPDATE incidents SET refno='".$formvalues['refno']."', assignment='".$formvalues['assignment']."', date=".changeDateFromPageCombosToMySQLFormat($formvalues['incident_day'], $formvalues['incident_month'], $formvalues['incident_year']).", guardresponsible='".$formvalues['guardresponsible']."' , details ='".$formvalues['details']."', reportedby='".$formvalues['reportedby']."', timereported='".$formvalues['timereported']."', checkedby='".$formvalues['checkedby']."', timechecked='".$formvalues['timechecked']."' WHERE id = '".$id."'");
	
	//get the last inserted incase no error occured
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
	
// Insert a new incident into the database
} else{
	if(trim($formvalues['actiontaken']) != ""){
		mysql_query("INSERT INTO incidentactions (details, date_of_entry) VALUES ('".$formvalues['actiontaken']."',now())");
		$actionid = mysql_insert_id();
	} else {   
		$actionid = "";
	}
	
	mysql_query("INSERT INTO incidents (refno, assignment,date,guardresponsible, details, reportedby, timereported, checkedby, timechecked, actiontaken, date_of_entry) 
			VALUES ('".$formvalues['refno']."', '".$formvalues['assignment']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['incident_day'], $formvalues['incident_month'], $formvalues['incident_year']).", '".$formvalues['guardresponsible']."', '".$formvalues['details']."', '".$formvalues['reportedby']."', '".$formvalues['timereported']."', '".$formvalues['checkedby']."', '".$formvalues['timechecked']."' , '".$actionid."', NOW())");

	//get the last inserted incase no error occured
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
}

forwardToPage("manageincidents.php");
?>