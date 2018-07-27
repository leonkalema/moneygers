<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;
$id=decryptValue($formvalues['edit']);

if(isset($formvalues['edit']) && $formvalues['edit'] != ""){
// edit loan application
	$query = "UPDATE loanapplications SET bonusamount = '".$formvalues['bonusamount']."' WHERE id='".$id."'";
	
	mysql_query($query);

	if(mysql_error() == ""){
		$url = "manageappraisals.php";
	} else{
		$_SESSION['errors'] = "An error occurred while saving the staff debt information. Please try again or contact your administrator.<p>".mysql_error();
		
		$url = "loan.php?id=".$formvalues['edit'];
	}

}
// approving loans
 if(isset($formvalues['approval']) && $formvalues['approval'] != ""){
	//If the general manager is approving
	$id=decryptValue($formvalues['approval']);
	//echo $id;exit;
	//if($_SESSION['type'] == "finance"){
		$query = mysql_query("UPDATE loanapplications SET repayinstallment = '".implode("",split(",",$formvalues['repayinstallment']))."', financeapproved = '".$formvalues['financeapproved']."', financeapprovalmsg = '".$formvalues['financeapprovalmsg']."', dateoffinanceapproval = NOW(), whofinanceapproved='".$_SESSION['userid']."' WHERE id = '".$id."'") or die(mysql_error());
		//mysql_query($query);
	//}
}
else {
// Creation of new loan application
	$query = "INSERT INTO loanapplications (guardid, bonusamount, datecreated) VALUES ('".$formvalues['guardid']."', '".$formvalues['bonusamount']."', NOW())";
	
	$result=mysql_query($query);
	//get the last inserted incase no error occured
	if(mysql_error() == ""){
		$url = "manageappraisals.php";		
	}else{
		$_SESSION['errors'] = "An error occurred while saving the staff debt information. Please try again or contact your administrator.<p>".mysql_error();
		$url = "loan.php?id=".mysql_insert_id()."&a=edit";
	}
}


//exit;
forwardToPage($url);
?>