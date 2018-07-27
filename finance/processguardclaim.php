<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
@session_start();
$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;

if(isset($formvalues['edit']) && $formvalues['edit'] != ""){
	// edit loan application
	$query = "UPDATE guardclaims SET guardid = '".$formvalues['guardid']."', amount = '".implode("",split(",",$formvalues['amount']))."', reason = '".$formvalues['reason']."', datecreated = ".changeDateFromPageCombosToMySQLFormat($formvalues['claim_day'], $formvalues['claim_month'], $formvalues['claim_year'])."  WHERE id='".$formvalues['edit']."'";
	
	mysql_query($query);

	if(mysql_error() == ""){
		$url = "manageguardclaims.php";
	} else{
		$_SESSION['errors'] = "An error occurred while saving the guard claim information. Please try again or contact your administrator.<br><br>".mysql_error();
		
		$url = "guardclaim.php?id=".$formvalues['edit']."&a=edit";
	}

// Creation of new guard claim
} else {
	$query = "INSERT INTO guardclaims (guardid, amount, reason, datecreated) VALUES ('".$formvalues['guardid']."', '".implode("",split(",",$formvalues['amount']))."', '".$formvalues['reason']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['claim_day'], $formvalues['claim_month'], $formvalues['claim_year']).")";
	
	$result=mysql_query($query);
	//get the last inserted incase no error occured
	if(mysql_error() == ""){
		$url = "manageguardclaims.php";
		
	}else{
		$_SESSION['errors'] = "An error occurred while saving the guard claim information. Please try again or contact your administrator.<p>".mysql_error();
		$url = "guardclaim.php?id=".mysql_insert_id()."&a=edit";
	}
}


// approving loans
if(isset($_GET['a']) && decryptValue($_GET['a']) == "approve"){
	$query = mysql_query("UPDATE guardclaims SET claimstatus='Approved' WHERE id = '".decryptValue($_GET['d'])."'") or die(mysql_error());
	$url = "manageguardclaims.php";
}

forwardToPage($url);
?>