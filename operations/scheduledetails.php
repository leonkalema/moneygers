<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();

//List the items depending on section
if($_GET['area'] == "guards"){
	$array = $_SESSION['displayarray'][$_GET['count']][2];
	for($i=0;$i<count($array);$i++){
		echo $array[$i]."<br>";
	}
} else if($_GET['area'] == "assign"){
	$array = $_SESSION['displayarray'][$_GET['count']][3];
	for($i=0;$i<count($array);$i++){
		echo $array[$i]."<br>";
	}
} else if($_GET['area'] == "leave"){
	$array = $_SESSION['displayarray'][$_GET['count']][4];
	for($i=0;$i<count($array);$i++){
		echo $array[$i]."<br>";
	}
} else if($_GET['area'] == "rest"){
	$array = $_SESSION['displayarray'][$_GET['count']][5];
	for($i=0;$i<count($array);$i++){
		echo $array[$i]."<br>";
	}
} else if($_GET['area'] == "sick"){
	$array = $_SESSION['displayarray'][$_GET['count']][6];
	for($i=0;$i<count($array);$i++){
		echo $array[$i]."<br>";
	}
} else if($_GET['area'] == "police"){
	$array = $_SESSION['displayarray'][$_GET['count']][7];
	for($i=0;$i<count($array);$i++){
		echo $array[$i]."<br>";
	}
}
?>
