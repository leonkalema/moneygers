<?php
		
	include_once "../include/commonfunctions.php";
	session_start();
			
		$id=$_GET['id'];
		openDatabaseConnection();
		$query = "DELETE FROM sickguard WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
		
		if($query){
		forwardToPage('../operations/managesickguards.php');
}

?>
