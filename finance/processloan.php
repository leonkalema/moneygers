<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;
$id=decryptValue($formvalues['edit']);
$financeuploadsfolder = "uploads/";
//Pick set maximum upload size in the form.
$maxfilesize=$_POST['MAX_FILE_SIZE'];


if(isset($formvalues['edit']) && $formvalues['edit'] != ""){
	//Pick the scanned copy of the loan appn if available
	if ($HTTP_POST_FILES['appnletter']['size'] < $maxfilesize && isset($HTTP_POST_FILES['appnletter'])) {
	
		$userfile_name=uploadfile($HTTP_POST_FILES['appnletter']['tmp_name'],$formvalues['guardid'].$HTTP_POST_FILES['appnletter']['name'],$HTTP_POST_FILES['appnletter']['size'],$formvalues['MAX_FILE_SIZE'],$HTTP_POST_FILES['appnletter']['error'],$financeuploadsfolder);
	} else {
		$userfile_name = "";
	}	
	
	if($userfile_name !="nofile") {
		$query_extension = ", appnletter = '".$userfile_name."'";
	} else {
		$query_extension = "";
	}
	
	// edit loan application
	$query = "UPDATE loanapplications SET loanamount = '".$formvalues['loanamount']."'".$query_extension." WHERE id='".$id."'";
	
	mysql_query($query);

	if(mysql_error() == ""){
		$url = "manageguardloans.php";
	} else{
		$_SESSION['errors'] = "An error occurred while saving the staff debt information. Please try again or contact your administrator.<p>".mysql_error();
		
		$url = "loan.php?id=".$formvalues['edit'];
	}

}
// approving loans
 if(isset($formvalues['approval']) && $formvalues['approval'] != ""){
	//If the general manager is approving
	$id=decryptValue($formvalues['approval']);

	$query = mysql_query("UPDATE loanapplications SET repayinstallment = '".implode("",split(",",$formvalues['repayinstallment']))."', gmapproved = '".$formvalues['gmapproved']."', gmapprovalmsg = '".$formvalues['gmapprovalmsg']."', dateofgmapproval = NOW(), whogmapproved='".$_SESSION['userid']."' WHERE id = '".$id."'") or die(mysql_error());
}
else {
	
	//Pick the scanned copy of the loan appn if available
	if ($HTTP_POST_FILES['appnletter']['size'] < $maxfilesize && isset($HTTP_POST_FILES['appnletter'])) { 

		$userfile_name=uploadfile($HTTP_POST_FILES['appnletter']['tmp_name'],$formvalues['guardid'].$HTTP_POST_FILES['appnletter']['name'],$HTTP_POST_FILES['appnletter']['size'],$HTTP_POST_FILES['appnletter']['type'],$HTTP_POST_FILES['appnletter']['error'],$financeuploadsfolder);
	}
	
	// Creation of new loan application
	$query = "INSERT INTO loanapplications (guardid, loanamount, appnletter, datecreated) VALUES ('".$formvalues['guardid']."', '".$formvalues['loanamount']."', '".$userfile_name."', NOW())";
	
	$result=mysql_query($query);
	//get the last inserted incase no error occured
	if(mysql_error() == ""){
		$url = "manageguardloans.php";
		
		//Put a reminder to be seen by all concerned parties on their dashboards
		mysql_query("INSERT INTO messages (reason,details,sentby,sentto,date) VALUES ('APPROVE STAFF DEBT','<a href=\"../finance/approvals.php?id=".encryptValue(mysql_insert_id())."&t=gm\">Staff Debt Application</a>','".$_SESSION['userid']."','1,80,81',now())");
		
	}else{
		$_SESSION['errors'] = "An error occurred while saving the staff debt information. Please try again or contact your administrator.<p>".mysql_error();
		$url = "loan.php?id=".mysql_insert_id()."&a=edit";
	}
}

forwardToPage($url);
?>