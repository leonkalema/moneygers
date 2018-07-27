<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

$formvalues = array_merge($_POST);

if($formvalues['edit'] == "YES"){
	$query=mysql_query("UPDATE sickguard SET guard='".$formvalues['name']."', illness='".$formvalues['illness']."', notes='".$formvalues['notes']."', date_started=".changeDateFromPageCombosToMySQLFormat($formvalues['day'],$formvalues['month'],$formvalues['year']).", date_recovery=".changeDateFromPageCombosToMySQLFormat($formvalues['day1'],$formvalues['month1'],$formvalues['year1'])." where id='".$formvalues['id']."'");

if($query){
	header("location:viewsickguard.php?id=".$formvalues['id']);
}else{
	header("location:sickguard.php?id=".$formvalues['id']."&msg=ERROR: There were problems saving the information.");
}

} else{
// insert the values into the databas
$query = "INSERT INTO sickguard (guard, illness, notes, date_started,date_recovery) 
			VALUES ('".$formvalues['name']."', '".$formvalues['illness']."', '".$formvalues['notes']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['day'],$formvalues['month'],$formvalues['year']).", ".changeDateFromPageCombosToMySQLFormat($formvalues['day1'],$formvalues['month1'],$formvalues['year1']).")";		
	$result=mysql_query($query);

	//get the last inserted incase no error occured
	if($result){
		header("location:managesickguards.php");
	}else{
		header("location:sickguard.php?id=".$formvalues['id']."&msg=ERROR: There were problems saving the information.");
	}
}

?>