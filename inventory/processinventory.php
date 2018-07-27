<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;

// Return the item
if($formvalues['documenttype'] == "return"){
	if($formvalues['edit'] != ""){
		$issuequery = "UPDATE itemissue SET date = '".date("Y-m-d H:i:s",strtotime($formvalues['issue_day']."-".$formvalues['issue_month']."-".$formvalues['issue_year']))."', guardresponsible = '".$formvalues['guardresponsible']."',assignment='".$formvalues['assignment']."', status = '".$formvalues['itemstatus']."',issuecondition = '".$formvalues['presentcondition']."',lastupdatedate = now(), lastupdatedby = '".$_SESSION['userid']."' WHERE id = '".$formvalues['edit']."'";
			
	} else {
		if(howmanyRows("SELECT * FROM equipment WHERE serialno = '".$formvalues['itemserial']."' AND instore = 'N'") > 0){
		mysql_query("UPDATE equipment SET instore = 'Y' WHERE serialno = '".$formvalues['itemserial']."'");
		mysql_query("DELETE FROM itemissue WHERE serialno = '".$formvalues['itemserial']."'");
			$issuequery = "INSERT INTO itemissue (type,serialno,inventoryofficer,date,guardresponsible,assignment,status,issuecondition) VALUES ('".$formvalues['documenttype']."','".$formvalues['itemserial']."','".$_SESSION['userid']."','".date("Y-m-d H:i:s",strtotime($formvalues['issue_day']."-".$formvalues['issue_month']."-".$formvalues['issue_year']))."','".$formvalues['guardresponsible']."','".$formvalues['assignment']."','".$formvalues['itemstatus']."','".$formvalues['presentcondition']."')";
			
		} else {
			$_GET['error'] = "The item you are trying to return was never recorded as ISSUED. Please first issue it before returning.";
		}
	}	
	
	mysql_query($issuequery);
		
	if(mysql_error() == ""){
		if($formvalues['edit'] == ""){
			mysql_query("UPDATE equipment SET instore = 'Y' WHERE serialno = '".$formvalues['itemserial']."'");
			$msg = "Your return was successfully saved";
		} else {
			$msg= "Your return was successfully updated";
		}
		
		$url = "itemissues.php?a=return";
	} else if(!isset($_GET['error']) || $_GET['error'] == ""){
		$_GET['error'] = "There were problems when saving your return. Please try again or contact your administrator.";
		$url = "../inventory/index.php?a=return";
	}
	
	
//Issue the item
} else {
	
	if($formvalues['edit'] != ""){
		$id=decryptValue($formvalues['edit']);
		$issuequery = "UPDATE itemissue SET date = '".date("Y-m-d H:i:s",strtotime($formvalues['issue_day']."-".$formvalues['issue_month']."-".$formvalues['issue_year']))."', guardresponsible = '".$formvalues['guardresponsible']."', assignment='".$formvalues['assignment']."', status = '".$formvalues['itemstatus']."',issuecondition = '".$formvalues['presentcondition']."',lastupdatedate = now(), lastupdatedby = '".$_SESSION['userid']."' WHERE id = '".$id."'";
			
	} else {
		if(howmanyRows("SELECT * FROM equipment WHERE serialno = '".$formvalues['itemserial']."' AND instore = 'Y'") > 0){
		mysql_query("UPDATE equipment SET instore = 'N' WHERE serialno = '".$formvalues['itemserial']."'");
			$issuequery = "INSERT INTO itemissue (type,serialno,inventoryofficer,date,guardresponsible,assignment,status,issuecondition) VALUES ('".$formvalues['documenttype']."','".$formvalues['itemserial']."','".$_SESSION['userid']."','".date("Y-m-d H:i:s",strtotime($formvalues['issue_day']."-".$formvalues['issue_month']."-".$formvalues['issue_year']))."','".$formvalues['guardresponsible']."', '".$formvalues['assignment']."','".$formvalues['itemstatus']."','".$formvalues['presentcondition']."')";
			
		} else {
			$_GET['error'] = "The item you are trying to issue is out of the store or not yet registered. Please check its availability.";
			
		}
	}
	mysql_query($issuequery);
	if(mysql_error() == ""){
		if($formvalues['edit'] == ""){
			mysql_query("UPDATE equipment SET instore = 'N' WHERE serialno = '".$formvalues['itemserial']."'");
			$msg = "Your return was successfully saved";
		} else {
			$msg= "Your return was successfully updated";
		}
		
		$url = "itemissues.php";
	} else if(!isset($_GET['error']) || $_GET['error'] == ""){
		$_GET['error'] = "There were problems when saving your issue. Please try again or contact your administrator.";
		$url = "../inventory/index.php";
	}
}
forwardToPage($url);
?>