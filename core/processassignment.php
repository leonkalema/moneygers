<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);

$id=decryptValue($formvalues['edit']);
	//Pick values as an array
	$exception_day=$formvalues['exception_day'];
	$exception_month=$formvalues['exception_month'];
	$exception_year=$formvalues['exception_year'];
	for($i=0;$i<count($exception_day);$i++){
		if($exception_day[$i] != "" && $exception_month[$i] != "" && $exception_year[$i] != ""){
			$exceptiontime[$i] = trim(changeDateFromPageCombosToMySQLFormat($exception_day[$i],$exception_month[$i],$exception_year[$i]),"'");
		}
	}
	$exceptiontime_final = implode(",",$exceptiontime);
	
	//The number of each equipment type for the assignment
	$number = $formvalues['number'];
	$equipmenttypesarr = $formvalues['equipmenttypes'];
	$equip=array();
	for ($i=0; $i<sizeof($equipmenttypesarr);$i++){
		array_push($equip,$equipmenttypesarr[$i].$number[$i]);
	}
	
	
// if you are updating assignment
if(trim($formvalues['edit']) != ""){
	$query=mysql_query("UPDATE assignments SET callsign='".$formvalues['callsign']."', servicetype='".$formvalues['servicetype']."', client='".$formvalues['client_name']."',  region='".$formvalues['region']."', directions='".$formvalues['directions']."', contactname='".$formvalues['contactname']."', contactphone='".$formvalues['contactphone']."', contactemail='".$formvalues['contactemail']."', contactfax='".$formvalues['contactfax']."', emergencyno = '".$formvalues['emergencyno']."', equipmenttypes='".implode(",",$equip)."', starttime='".$formvalues['starttime']."', endtime='".$formvalues['endtime']."', startdate=".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']).", enddate=".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']).", exception='".$exceptiontime_final."', assignedguards='".$formvalues['assignedguards']."',  datecreated=now(),  createdby='".$_SESSION['userid']."',  lastupdatedby ='".$_SESSION['userid']."',  lastupdatedate =now() where id='".$id."'");
		
		if($query){
			$url = "manageassignments.php";
		} else{
			$url = "assignment.php?id=".$id."&msg=Error Occured! Please try again.";
				
		}
		
		
	// Insert a new assignment
	}else{
		// insert the values into the database
		$query = "INSERT INTO assignments (callsign, servicetype, client, region, directions, contactname, contactphone, contactemail, contactfax, emergencyno, equipmenttypes, starttime, endtime, startdate, enddate, exception, datecreated, assignedguards,  createdby, lastupdatedby, lastupdatedate) 
			VALUES ('".$formvalues['callsign']."', '".$formvalues['servicetype']."', '".$formvalues['client_name']."', '".$formvalues['region']."', '".$formvalues['directions']."', '".$formvalues['contactname']."','".$formvalues['contactphone']."', '".$formvalues['contactemail']."', '".$formvalues['contactfax']."', '".$formvalues['emergencyno']."', '".implode(",",$equip)."', '".$formvalues['starttime']."', '".$formvalues['endtime']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']).", ".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year'])." ,  '".addslashes($exceptiontime_final)."', NOW(), '".$formvalues['assignedguards']."', '".$_SESSION['userid']."', '".$_SESSION['userid']."', NOW())";
		
 		$result=mysql_query($query);
		
		//get the last inserted incase no error occured
		if($result){
			$url = "manageassignments.php";
			
			
			//Show a reminder on the operations dashboard
			$reason = "NEW ASSIGNMENT";
			$details = "Generate contract For <a href=\"../core/manageassignments.php?a=search&v=".trim($formvalues['callsign'])."&type=Call Sign\">".$formvalues['client_name']."</a>";
			mysql_query("INSERT INTO messages (reason,details,sentby,sentto,date) VALUES ('".$reason."','".$details."','','1,79,82',now())") or die (mysql_error());
			
		}else{
			$url = "assignment.php?id=".$id."&msg=Error Occured! Please try again.";
		}
	}
	
if(isset($_SESSION['returnURL']) && $_SESSION['returnURL'] != ""){
	$url = $_SESSION['returnURL'];
}
forwardToPage($url);
?>