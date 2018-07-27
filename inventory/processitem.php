<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;

// Save a new item
if($formvalues['edit'] != ""){
	$id=decryptValue($formvalues['edit']);
	$query = "UPDATE equipment SET type = '".$formvalues['type']."', name = '".$formvalues['name']."', serialno = '".$formvalues['serialno']."', status = '".$formvalues['status']."', date_of_entry = now() WHERE id = '".$id."'";
			
} else {
	$query = "INSERT INTO equipment (type,name,serialno,status,date_of_entry) VALUES ('".$formvalues['type']."','".$formvalues['name']."','".$formvalues['serialno']."','".$formvalues['status']."',now())";
}	

mysql_query($query);
		
if(mysql_error() == ""){
	$msg = "The item was successfully saved";
	$url = "inventorystock.php?msg=".$msg;
	
} else {
	$msg = "There were problems when saving the item. Please try again or contact your administrator.";
	$url = "../inventory/item.php?msg=".$msg;
}

forwardToPage($url);
?>