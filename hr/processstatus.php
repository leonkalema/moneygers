<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);

$_SESSION['formvalues'] = $formvalues;
$formvalues['date_started'] = changeDateFromPageCombosToMySQLFormat($formvalues['start_day'],$formvalues['start_month'],$formvalues['start_year']);


//If the status is sick
if($_SESSION['type'] == "Sick"){
	$formvalues['date_ended'] = changeDateFromPageCombosToMySQLFormat($formvalues['end_day'],$formvalues['end_month'],$formvalues['end_year']);
	if($formvalues['end_day'] == "" || $formvalues['end_month'] == "" || $formvalues['end_year'] == ""){
		$formvalues['date_ended'] = "'0000-00-00 00:00:00'";
	}
	$query = "INSERT INTO  guardstatustrack (guard, illness, status, notes, date_started, date_ended, reported_by, date_of_entry) VALUES ('".$formvalues['guardid']."', '".$formvalues['illness']."', '".$_SESSION['type']."', '".$formvalues['notes']."', ".$formvalues['date_started'].", ".$formvalues['date_ended'].",'".$formvalues['reported_by']."', NOW())";

// If the status is dismissed
} else{
	$query = "INSERT INTO  guardstatustrack (guard, status, notes, date_started, reported_by, date_of_entry) VALUES ('".$formvalues['guardid']."', '".$_SESSION['type']."', '".$formvalues['notes']."', ".$formvalues['date_started'].",'".$formvalues['reported_by']."', NOW())";
}

mysql_query($query);

if(mysql_error() == ""){
	$url = "manageguards.php";
	mysql_query("UPDATE guards SET status = '".mysql_insert_id()."' WHERE guardid = '".$formvalues['guardid']."'");
	$_SESSION['formvalues'] = "";
} else{
	$_SESSION['errors'] = "An error occurred while saving the status information. Please try again or contact your administrator.";
		
	$url = "changestatus.php?id=".$_SESSION['guardid']."&t=".$_SESSION['type'];
}

if(isset($_SESSION['frompage']) && $_SESSION['frompage'] != ""){
	$url = $_SESSION['frompage'];
	$_SESSION['frompage'] = "";
}

forwardToPage($url);
?>