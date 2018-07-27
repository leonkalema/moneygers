<?php
	//$url = $_SERVER['HTTP_REFERER'];
	include_once "../include/lib.php";
	$conn = new connection();
	$delete = new utilities();
	$delete->link = $conn->link;
	if(isset($_GET['id'])){
		$delete->id = decrypt($_GET['id'],"code");
		$delete->table = $_GET['table'];
		$delete->rname = $_GET['rname'];
		$delete->delete();
		
		switch($_GET['page']){
			case "sup":
				header("Location: supervision-report.php");
				break;
			case "ins":
				header("Location: manageinspection.php");
				break;
			case "edt":
				header("Location: edit-inspection.php?id=".$_GET['id2']);
				break;
		}
	}
	
?>