<?php
//include_once "../class/class.personnelfile.php";
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

$formvalues = array_merge($_POST);

//Concantenate date values
$date = $formvalues['day'].'-'.$formvalues['month'].'-'.$formvalues['year'];

if($formvalues['edit'] == "YES"){

	$query=mysql_query("UPDATE personnel SET guard='".$formvalues['name']."', type='".$formvalues['type']."', notes='".$formvalues['notes']."', actiontaken='".$formvalues['action']."', date='$date' where id='".$_POST['id']."'");
	
	
	if($query){
header("location:viewpersonnelfile.php?id=".$_POST['id']);
}
	else{
echo "NO";
}
	
	
	
	/*if($query){
	header("location:viewpersonnnelfile.php?id=".$_GET['id']);

} else {
	header("location:personnel.php?id=".$_GET['id']."&msg=Error Occured! Please try again.");
				
			}*/


} 


else{


// insert the values into the database

$query = "INSERT INTO personnel (guard, type, notes, actiontaken, date) 
			VALUES ('".$formvalues['name']."', '".$formvalues['type']."', '".$formvalues['notes']."', '".$formvalues['action']."', '$date')";
			
	$result=mysql_query($query);

	//get the last inserted incase no error occured
	if($result){
		$id=mysql_insert_id();
		header("location:viewpersonnelfile.php?id=$id");
	}else{
		echo "Error Occured, Please Try Again !";
	}



}

?>