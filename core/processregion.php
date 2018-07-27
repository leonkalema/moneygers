<?php
include_once "../class/class.region.php";
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
//$areas = $_POST['Area'];

$formvalues = array_merge($_POST);
//echo $formvalues['id'];exit;
$areas = $formvalues['Area'];
//print_r($areas);exit;
$id=$formvalues['id'];
for($i=0;$i<count($areas);$i++){
	if(strlen($areascovered)<1){
		$areascovered.= $areas[$i];
	}else{
		$areascovered.= ",".$areas[$i];
	}
}
if(trim($formvalues['id']) != ""){
	mysql_query("UPDATE regions SET name = '".$formvalues['name']."',description = '".$formvalues['description']."',areascovered = '".$areascovered."',code = '".$formvalues['code']."' WHERE id='".$id."'");
} else{
	$code_sql=mysql_query("SELECT code FROM regions WHERE code ='".$_POST['code']."' ");
	if(mysql_num_rows($code_sql)==0){
	mysql_query("INSERT INTO regions(name,description,areascovered,code,createdby,datecreated) VALUES('".$_POST['name']."','".$_POST['description']."','".$areascovered."','".$_POST['code']."','".$_SESSION['userid']."',now())")or die("Invalid Query on Insert Region: ".mysql_error()."<br/>Error No: ".mysql_errno());
	}else{
		$msg="The code you entered is already in use.";
		forwardToPage("region.php?message=".$msg);
	}
}
	
forwardToPage("manageregions.php");

?>