<?php
		
	include_once "../include/commonfunctions.php";
	session_start();
		
		$id=decryptValue($_GET['id']);
		openDatabaseConnection();
		$query = "DELETE FROM assignments WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
		
		if($query){
		forwardToPage('../core/manageassignments.php');
}

?>
