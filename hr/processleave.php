<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;
$id=decryptValue($formvalues['edit']);
//echo $id;exit;
if(isset($formvalues['edit']) && $formvalues['edit'] != ""){

	$query = "UPDATE leaveapplications SET guardid = '".$formvalues['guardid']."', leavetype = '".$formvalues['leavetype']."', reason = '".$formvalues['reason']."', leavestartdate = ".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'],$formvalues['start_month'],$formvalues['start_year']).", leaveenddate = ".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'],$formvalues['end_month'],$formvalues['end_year'])." WHERE id='".$id."'";
	
	mysql_query($query);

	if(mysql_error() == ""){
		$url = "manageleave.php";
	} else{
		$_SESSION['errors'] = "An error occurred while saving the leave information. Please try again or contact your administrator.";
		
		$url = "leave.php?id=".$formvalues['edit'];
	}


// insert the values into the database
} else if(isset($formvalues['approval']) && $formvalues['approval'] != ""){
	//If the finance is approving
	$id=decryptValue($formvalues['approval']);
	//echo $id;exit;
	if($_SESSION['type'] == "finance"){
		
		$query = "UPDATE leaveapplications SET advancetaken = '".implode("",split(",",$formvalues['advancetaken']))."', travelallowances = '".implode("",split(",",$formvalues['travelallowances']))."', loantaken = '".implode("",split(",",$formvalues['loantaken']))."', payrollclerkapproved = '".$formvalues['payrollclerkapproved']."', financeapprovalmsg = '".$formvalues['financeapprovalmsg']."', dateoffinanceapproval = NOW(), whofinanceapproved='".$_SESSION['userid']."' WHERE id = '".$id."'";
		mysql_query($query);
		
	// If the HR is approving
	} else if($_SESSION['type'] == "hr"){
		
		if(isset($formvalues['uniformreturned']) && $formvalues['uniformreturned'] == "Y"){
			$returned = "Y";
		} else if(isset($formvalues['uniformreturned']) && $formvalues['uniformreturned'] == "N"){
			$returned = "N";
		}
		
		mysql_query("UPDATE guards SET leavedays = '".$formvalues['leavedays']."' WHERE guardid = '".$formvalues['guardid']."'");
		
		$query = "UPDATE leaveapplications SET uniformreturned = '".$returned."', humanresourceapproved = '".$formvalues['humanresourceapproved']."', hrapprovalmsg = '".$formvalues['hrapprovalmsg']."', dateofhrapproval = NOW(), whohrapproved = '".$_SESSION['userid']."' WHERE id = '".$id."'";
		mysql_query($query);
		
	// If the Operations is approving
	}else if($_SESSION['type'] == "operations"){
		
		$query = "UPDATE leaveapplications SET operationsapproved = '".$formvalues['operationsapproved']."', operationsapprovalmsg = '".$formvalues['operationsapprovalmsg']."', dateofoperationsapproval = NOW(), whooperationapproved = '".$_SESSION['userid']."' WHERE id = '".$id."'";
		mysql_query($query);
	
	// If the GM is approving
	}else if($_SESSION['type'] == "gm"){
		
		$query = "UPDATE leaveapplications SET gmapproved = '".$formvalues['gmapproved']."', gmapprovalmsg = '".$formvalues['gmapprovalmsg']."', dateofgmapproval = NOW(), whogmapproved = '".$_SESSION['userid']."' WHERE id = '".$id."'";
		mysql_query($query);
	}
	$url = "manageleave.php";

// Creation of new leave application
} else {
	$query = "INSERT INTO leaveapplications (guardid, leavetype, reason, leavestartdate, leaveenddate,datecreated) VALUES ('".$formvalues['guardid']."', '".$formvalues['leavetype']."', '".$formvalues['reason']."' , ".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'],$formvalues['start_month'],$formvalues['start_year']).", ".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'],$formvalues['end_month'],$formvalues['end_year']).", NOW())";
	
	$result=mysql_query($query);
	//get the last inserted incase no error occured
	if(mysql_error() == ""){
		$url = "manageleave.php";
		
		//Put a reminder to be seen by all concerned parties on their dashboards
		mysql_query("INSERT INTO messages (reason,details,sentby,date) VALUES ('APPROVE LEAVE','<a href=\"../hr/manageleave.php?a=search&leaveid=".mysql_insert_id()."\">Leave Application</a>','".$_SESSION['userid']."',now())");
		
	}else{
		$_SESSION['errors'] = "An error occurred while saving the leave information. Please try again or contact your administrator.";
		$url = "leave.php?id=".mysql_insert_id()."&a=edit";
	}
}

forwardToPage($url);
?>