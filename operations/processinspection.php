<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = $_SESSION['inspectionvalues'];
$id=trim($formvalues['edit']);

if(trim($formvalues['edit']) != ""){
	//Vehicle inspections
	if(isset($_GET['t'])){
		mysql_query("UPDATE vehicleinspections SET madeby ='".$formvalues['madeby']."', commentids ='".implode(",",$formvalues['comment'])."', inspectiondate =".changeDateFromPageCombosToMySQLFormat($formvalues['inspection_day'], $formvalues['inspection_month'], $formvalues['inspection_year']).", vehicleno = '".$formvalues['vehicleregno']."' WHERE id = '".$id."'");
	
	} else {
		mysql_query("UPDATE inspections SET madeby ='".$formvalues['madeby']."', commentids ='".implode(",",$formvalues['comment'])."', date_of_entry =".changeDateFromPageCombosToMySQLFormat($formvalues['inspection_day'], $formvalues['inspection_month'], $formvalues['inspection_year'])." WHERE id = '".$id."'");
	}
	
	//get the last inserted incase no error occured
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
	
// Insert a new appraisal into the database
} else{
	if(isset($_GET['t'])){
		mysql_query("INSERT INTO vehicleinspections (madeby, commentids, inspectiondate, vehicleno) 
			VALUES ('".$formvalues['madeby']."', '".implode(",",$formvalues['comment'])."', ".changeDateFromPageCombosToMySQLFormat($formvalues['inspection_day'], $formvalues['inspection_month'], $formvalues['inspection_year']).", '".$formvalues['vehicleregno']."')");
			
	} else {
		mysql_query("INSERT INTO inspections (madeby, commentids, date_of_entry) 
			VALUES ('".$formvalues['madeby']."', '".implode(",",$formvalues['comment'])."', ".changeDateFromPageCombosToMySQLFormat($formvalues['inspection_day'], $formvalues['inspection_month'], $formvalues['inspection_year']).")");
	}
	
	//Set a message in case an error occurred
	if(mysql_error() != ""){
		$_SESSION['error'] = "There were problems saving your data. Please try again or contact the administrator.";
	}
}

//Get appropriate re-direct URL
if(isset($_GET['t'])){
	$url = "../transport/vehicleinspections.php";
} else {
	$url = "inspections.php";
}

forwardToPage($url);
?>