<?php
include_once "../class/class.client.php";
include_once "../class/class.building.php";
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$date=date('y-m-d');

$formvalues = array_merge($_POST);
$id=decryptValue($_GET['id']);



if($formvalues['edit'] == "YES"){
	$query=mysql_query("UPDATE clients SET name='".$formvalues['name']."', plotno='".$formvalues['plotno']."', boxno='".$formvalues['boxno']."', floorno='".$formvalues['floorno']."', genphone='".$formvalues['genphone']."', contname='".$formvalues['contname']."', contposition='".$formvalues['contposition']."', contphone='".$formvalues['contphone']."', fax='".$formvalues['fax']."', email='".$formvalues['email']."', isactive='".$formvalues['activity']."',datecreated='$date', createdby='".$_SESSION['userid']."' where id='".$id."'");

	if($query){
		$url="viewclient.php?id=".encryptValue($id);
	} else{
		$url="client.php?id=".encryptValue($id)."&msg=Error Occured! Please try again.";
				
	}

} else{
	$query = "INSERT INTO clients (name, plotno, boxno, floorno, genphone, contname, contposition, contphone, fax, email, isactive, datecreated, createdby)  
			VALUES ('".$formvalues['name']."', '".$formvalues['plotno']."', '".$formvalues['boxno']."', '".$formvalues['floorno']."', '".$formvalues['genphone']."','".$formvalues['contname']."', '".$formvalues['contposition']."', '".$formvalues['contphone']."', '".$formvalues['fax']."','".$formvalues['email']."', '".$formvalues['activity']."', '".$date."', '".$_SESSION['userid']."')";

	$result=mysql_query($query);

	//get the last inserted id incase no error occured
	if($result){
		$id=mysql_insert_id();
		$url="viewclient.php?id=".encryptValue($id);
	//Insert new building
	$building = new building();
	$building->clientId = $id;
	$building->buildingName = $formvalues['buildname'];
	$buildingId = $building->set_building();
	unset($building);
		
		//Show a reminder on the operations dashboard
		$reason = "NEW CLIENT";
		$details = "Register new assignment(s) for <a href=\"../core/viewclient.php?id=".encryptValue($id)."\">".$formvalues['name']."</a>";
		mysql_query("INSERT INTO messages (reason,details,sentby,sentto,date) VALUES ('".$reason."','".$details."','','1,79,82',now())") or die (mysql_error());
	}else{
		$url="client.php?id=".encryptValue($id)."&msg=Error Occured! Please try again.";
	}
}

forwardToPage($url);
?>