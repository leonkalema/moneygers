<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

$formvalues = array_merge($_POST);
$_SESSION['formvalues'] = $formvalues;
print_r($formvalues);
$today=date("Y-m-d");
$timereceived=date("H:i:s");

//$mobile_no=$formvalues['mobile'];
if(isset($_POST['submit'])){
	// Check whether there is any entry for a particular vehicle.
	if(isset($formvalues['recordid']) && count($formvalues['recordid']) > 0){
		//Get the old IDs into an array
		$oldids = array();
		$result = mysql_query("SELECT id FROM logbook WHERE mobile ='".$formvalues['mobile']."' AND logdate='".date("Y-m-d")."'");
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			array_push($oldids, $row['id']);
		}		
		
		//Remove all those records which have been deleted
		for($k=0;$k<count($oldids);$k++){
			if(!in_array($oldids[$k],$formvalues['recordid'])){
				mysql_query("DELETE FROM logbook WHERE id='".$oldids[$k]."'");
			}
		}
		
		//Update the other sections of the log record apart from the logs
		//which are tackled later
		if(count($formvalues['recordid']) > 0){
			// Update current record for selected mobile.
			mysql_query("UPDATE logbook SET 
				fuelmorning = '".$formvalues['fuelmorning']."',
				fuelevening = '".$formvalues['fuelevening']."',
				conditionsandcomments = '".$formvalues['conditionsandcomments']."', 
				handoverdriver = '".$formvalues['handoverdriver']."', 
				qrfguards = '".str_replace("<><>","<>",implode("<>",$formvalues['qrfguard']))."',
				handovercarcommander = '".$formvalues['handovercarcommander']."',
				receivingdriver = '".$formvalues['receivingdriver']."', 
				receivingcarcommander = '".$formvalues['receivingcarcommander']."',
				receivedby = '".$formvalues['receivedby']."', 
				timereceived = '".$formvalues['timereceived']."' 
			WHERE 
				logdate = NOW() AND
				mobile = '".$formvalues['mobile']."' ");
		}
	}	
	
	// update any other entered records
	for ($i=0; $i<count($formvalues['reason']); $i++){
		if($formvalues['reason'][$i] != "") {
			// Inserting new record(s) for selected mobile
			mysql_query("INSERT INTO logbook SET 
				logdate = NOW(), 
				mobile = '".$formvalues['mobile']."', 
				fuelmorning = '".$formvalues['fuelmorning']."', 
				fuelevening = '".$formvalues['fuelevening']."',
				shift = '".$formvalues['shift']."', 
				driver = '".$formvalues['driver']."', 
				qrfguards = '".str_replace("<><>","<>",implode("<>",$formvalues['qrfguard']))."',
				carcommander = '".$formvalues['carcommander']."',
				timeout = '".$formvalues['timeout'][$i]."',
				timein = '".$formvalues['timein'][$i]."', 
				placefrom = '".$formvalues['placefrom'][$i]."', 
				placeto = '".$formvalues['placeto'][$i]."', 
				odometerstart = '".$formvalues['odometerstart'][$i]."',
				odometerend = '".$formvalues['odometerend'][$i]."', 
				kmtravelled = '".$formvalues['kmtravelled'][$i]."',
				reason = '".$formvalues['reason'][$i]."', 
				conditionsandcomments = '".$formvalues['conditionsandcomments']."', 
				handoverdriver = '".$formvalues['handoverdriver']."', 
				handovercarcommander = '".$formvalues['handovercarcommander']."',
				receivingdriver = '".$formvalues['receivingdriver']."', 
				receivingcarcommander = '".$formvalues['receivingcarcommander']."',
				receivedby = '".$formvalues['receivedby']."', 
				timereceived = '$timereceived' ") or die("Error: ". mysql_error() );
		}
 	}
	$url = "../transport/index.php?logdate=".$today;
} 

//Set the URL if it is not set
if(!isset($url)){
	$url = "../transport";
}
forwardToPage($url);
?>