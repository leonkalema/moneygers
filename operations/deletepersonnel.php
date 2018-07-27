<?php
		
	include_once "../include/commonfunctions.php";
	session_start();
			
		$id=$_GET['id'];
		openDatabaseConnection();
		$query = "DELETE FROM personnel WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
		
		if($query){
		forwardToPage('../operations/managepersonnel.php');
}

?>
