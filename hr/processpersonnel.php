<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);
$id=decryptValue($formvalues['id']);

if(isset($formvalues['edit'])){
	$editid=decryptValue($formvalues['edit']);
//updating
	$personnelfolder="files";
	   // set the maximum download size
	   // set in the form to 10 MB
	   $maxfilesize=$_POST['MAX_FILE_SIZE'];
	   if ($HTTP_POST_FILES['disciplineletter']['size'] < $maxfilesize)
			if(isset($HTTP_POST_FILES['disciplineletter']))
			{
				$userfile_name=uploadfile($HTTP_POST_FILES['disciplineletter']['tmp_name'],$formvalues['guardname'].$HTTP_POST_FILES['disciplineletter']['name'],$HTTP_POST_FILES['disciplineletter']['size'],$HTTP_POST_FILES['disciplineletter']['type'],$HTTP_POST_FILES['disciplineletter']['error'],$personnelfolder);
				if($userfile_name !="nofile")
				{
					$content=$userfile_name;
					$query=mysql_query("UPDATE personnel SET guard='".$formvalues['name']."', type='".$formvalues['type']."', notes='".$formvalues['notes']."', actiontaken='".$formvalues['action']."', takenby='".$formvalues['takenby']."', disciplineletter='".$content."', date=".changeDateFromPageCombosToMySQLFormat($formvalues['day'], $formvalues['month'], $formvalues['year'])." where id='".$editid."'");
				}
			}else{
				$query=mysql_query("UPDATE personnel SET guard='".$formvalues['name']."', type='".$formvalues['type']."', notes='".$formvalues['notes']."', actiontaken='".$formvalues['action']."', takenby='".$formvalues['takenby']."', date=".changeDateFromPageCombosToMySQLFormat($formvalues['day'], $formvalues['month'], $formvalues['year'])." where id='".$editid."'");
			}
		else {
			$_SESSION['errors']= "The file you are trying to add exceeds the Maximum limit set by the Administrator. ";
		}
		
} else{
// insert the values into the database
	$personnelfolder="files";
	   // set the maximum download size
	   // set in the form to 10 MB
	   $maxfilesize=$_POST['MAX_FILE_SIZE'];
	   if ($HTTP_POST_FILES['disciplineletter']['size'] < $maxfilesize)
	   {
			if(isset($HTTP_POST_FILES['disciplineletter']))
			{
				$userfile_name=uploadfile($HTTP_POST_FILES['disciplineletter']['tmp_name'],$_SESSION['username'].$HTTP_POST_FILES['disciplineletter']['name'],$HTTP_POST_FILES['disciplineletter']['size'],$HTTP_POST_FILES['disciplineletter']['type'],$HTTP_POST_FILES['disciplineletter']['error'],$personnelfolder);
				if($userfile_name !="nofile")
				{
					$content=$userfile_name;
					$query = "INSERT INTO personnel (guard, type, notes, actiontaken, takenby,disciplineletter, date)
					VALUES ('".$formvalues['name']."', '".$formvalues['type']."', '".$formvalues['notes']."', '".$formvalues['action']."', '".$formvalues['takenby']."','".$content."',".changeDateFromPageCombosToMySQLFormat($formvalues['day'], $formvalues['month'], $formvalues['year']).")";
				}
			}else{
					$query = "INSERT INTO personnel (guard, type, notes, actiontaken, takenby, date)
					VALUES ('".$formvalues['name']."', '".$formvalues['type']."', '".$formvalues['notes']."', '".$formvalues['action']."', '".$formvalues['takenby']."',".changeDateFromPageCombosToMySQLFormat($formvalues['day'], $formvalues['month'], $formvalues['year']).")";
			}
		}else {
			$_SESSION['errors']= "The file you are trying to add exceeds the Maximum limit set by the Administrator. ";
		}
			
	$result=mysql_query($query);
}
if(mysql_error() != ""){
	$_SESSION['errors'] = "An error occured when saving the guard discipline information. Please try again or contact your administrator.";
}

forwardToPage("managepersonnel.php");
?>