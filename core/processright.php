<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$formvalues = array_merge($_POST);
$id=decryptValue($formvalues['edit']);
if(trim($formvalues['edit']) != ""){
	mysql_query("UPDATE rights SET rightname = '".$formvalues['name']."' WHERE id='".$id."'");
} else {
	mysql_query("INSERT INTO rights (rightname) VALUES ('".$formvalues['name']."')");
}

forwardToPage("managerights.php");
?>