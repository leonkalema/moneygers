<?php
//include_once "../class/class.group.php";
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

$formvalues = array_merge($_POST);
$id= decryptValue($formvalues['edit']);
//echo $id;exit;
if($formvalues['edit'] != ""){
	$query=mysql_query("UPDATE groups SET name='".$formvalues['name']."', description='".$formvalues['description']."', rights='".implode(",",$_POST['rights'])."' WHERE id='".$id."'");

	if($query){
		$url = "viewgroup.php?id=".$formvalues['edit'];
	} else{
		$_SESSION['errors'] = "There were errors in saving the group data.";
		$url = "group.php?id=".$formvalues['edit'];
	}
} else{

	$query = "INSERT INTO groups (name, description,rights,createdby, datecreated) VALUES ('".$formvalues['name']."', '".$formvalues['description']."', '".implode(",",$_POST['rights'])."', '".$_SESSION['userid']."', NOW())";
		
	$result=mysql_query($query);

	//get the last inserted incase no error occured
	if($result){
		$id=mysql_insert_id();
		$url = "viewgroup.php?id=".$id;
	}else{
		$_SESSION['errors'] = "There were errors in saving the group data.";
		$url = "group.php?id=".$formvalues['edit'];
	}
}
forwardToPage($url);
?>