<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;

// Save a new item purchase
if($formvalues['edit'] != ""){
	$id=decryptValue($formvalues['edit']);
	$query = "UPDATE itempurchases SET itemtype = '".$formvalues['itemtype']."', itemname = '".$formvalues['itemname']."', description = '".$formvalues['description']."', status = '".$formvalues['status']."', cost = '".implode("",explode(",",$formvalues['cost']))."', supplier = '".$formvalues['supplier']."', department = '".$formvalues['department']."',  approvedby = '".$formvalues['whoapproved']."' WHERE id = '".$id."'";
			
} else {
	$query = "INSERT INTO itempurchases SET itemtype = '".$formvalues['itemtype']."', itemname = '".$formvalues['itemname']."', description = '".$formvalues['description']."', status = '".$formvalues['status']."', cost = '".implode("",explode(",",$formvalues['cost']))."', supplier = '".$formvalues['supplier']."', department = '".$formvalues['department']."',  approvedby = '".$formvalues['whoapproved']."', date_of_entry = now()";
}	

mysql_query($query);
		
if(mysql_error() == ""){
	$msg = "The the item purchase was successfully registered.";
	$url = "manageitempurchases.php?msg=".$msg;
	
} else {
	$msg = "There were problems when saving the purchase. Please try again or contact your administrator.";
	$url = "../inventory/itempurchases.php?msg=".$msg;
}

forwardToPage($url);
?>