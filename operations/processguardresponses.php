<?php
//include_once "../class/class.personnelfile.php";
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

$formvalues = array_merge($_POST);
$date=date('y-m-d');

//Pick values as an array
$guardres=$formvalues['guardres'];
$impguardres=implode(",", $guardres);
$commander=$formvalues['commander'];
$impcommander=implode(",", $commander);
$mobile=$formvalues['mobile'];
$impmobile=implode(",", $mobile);
$location=$formvalues['Location'];
$implocation=implode(",", $location);


if($formvalues['edit'] == "YES"){

$query=mysql_query("UPDATE guardresponseforms SET assignment='".$formvalues['assignment']."', guard='".$impguardres."', commander='".$impcommander."', mobile='".$impmobile."',datecreated='$date', location='".$implocation."' where id='".$_POST['id']."'");


$query1=mysql_query("UPDATE guard SET name='".$impguardres."' where id='".$_POST['id']."'");

$query1=mysql_query("UPDATE commanders SET name='".$impcommander."' where id='".$_POST['id']."'");

$query1=mysql_query("UPDATE mobile SET name='".$impmobile."' where id='".$_POST['id']."'");

$query1=mysql_query("UPDATE location SET guard='".$implocation."' where id='".$_POST['id']."'");


	
	
	if($query){
header("location:viewguardresponses.php?id=".$_POST['id']);
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

$query1 = "INSERT INTO guard (name) VALUES ('".$impguardres."')";	
$query2 = "INSERT INTO commanders (name) VALUES ('".$impcommander."')";
$query3 = "INSERT INTO mobile (number) VALUES ('".$impmobile."')";
$query4 = "INSERT INTO location (name) VALUES ('".$implocation."')";
		
	$result1=mysql_query($query1);
	$result2=mysql_query($query2);
	$result3=mysql_query($query3);
	$result4=mysql_query($query4);



$query = "INSERT INTO guardresponseforms (assignment, guard,commander, mobile, datecreated, location) 
			VALUES ('".$formvalues['assignment']."', '".$impguardres."', '".$impcommander."', '".$impmobile."', '$date', '".$implocation."')";
			
	
	
	
	
	
	$result=mysql_query($query);

	
	
	
	
	
	
	//get the last inserted incase no error occured
	if($result){
		$id=mysql_insert_id();
		header("location:viewguardresponses.php?id=$id");
	}else{
		echo "Error Occured, Please Try Again !";
	}



}

?>