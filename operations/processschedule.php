<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = $_SESSION['schedulevalues'];

//Save each schedule by the day.
if(count($formvalues['guard']) > 0){
	//Prepare an array of days of the week
	$dayarr = array();
	for($k=6;$k>=0;$k--){
		$day_of_week = date("Y",strtotime($formvalues['weekending']))."-".date("m",strtotime($formvalues['weekending']))."-".(date("d",strtotime($formvalues['weekending']))-$k);
		
		array_push($dayarr,$day_of_week);
	}
		
	//Go through the day array and save the respective schedule
	for($m=0;$m<count($dayarr);$m++){
		$schedulestr = "";
		
		for($i=0;$i<count($formvalues['guard']);$i++){
			//Get the assignment details
			$assignment = getRowAsArray("SELECT * FROM assignments WHERE callsign = '".$formvalues['assign'][$i]."'");
			$exception_array = split(",",$assignment['exception']);
			
			if(trim($formvalues['guard'][$i]) != ""){
				//Get individual guard and assign accordingly
				$guardarr = split(",",trim($formvalues['guard'][$i]));
				
				for($j=0;$j<count($guardarr);$j++){
					if($schedulestr != ""){
						if($i == $m){
							$schedulestr .= ",".trim($guardarr[$j])."=Rest";
							
							if($i != 6){
								if(!(in_array($dayarr[$m], $exception_array) || (strtotime($dayarr[$m]) < strtotime($assignment['startdate'])) || (strtotime($dayarr[$m]) > strtotime($assignment['enddate'])))){
									$schedulestr .= ",".trim($formvalues['guard'][6])."=".$formvalues['assign'][$i];
								}
							}
								
						} else if($i != 6){
							if(in_array($dayarr[$m], $exception_array) || (strtotime($dayarr[$m]) < strtotime($assignment['startdate'])) || (strtotime($dayarr[$m]) > strtotime($assignment['enddate']))){
								$schedulestr .= ",".trim($guardarr[$j])."=";
							} else {
								$schedulestr .= ",".trim($guardarr[$j])."=".$formvalues['assign'][$i];
							}
								
						}
					
					//Starting a new string
					} else {
						if($i == $m){
							$schedulestr = trim($guardarr[$j])."=Rest";
							if($i != 6){
								if(!(in_array($dayarr[$m], $exception_array) || (strtotime($dayarr[$m]) < strtotime($assignment['startdate'])) || (strtotime($dayarr[$m]) > strtotime($assignment['enddate'])))){
									$schedulestr = trim($formvalues['guard'][6])."=".$formvalues['assign'][$i];
								}
							}
								
						} else  if($i != 6){
							if(in_array($dayarr[$m], $exception_array) || (strtotime($dayarr[$m]) < strtotime($assignment['startdate'])) || (strtotime($dayarr[$m]) > strtotime($assignment['enddate']))){
								$schedulestr = trim($guardarr[$j])."=";
							} else {
								$schedulestr = trim($guardarr[$j])."=".$formvalues['assign'][$i];
							}
						}
					}
				}
			}
		}
		
		$dbarr = getRowAsArray("SELECT * FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime($dayarr[$m]))."'");
		
		if(howManyRows("SELECT * FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime($dayarr[$m]))."'") > 0){
			
			//Get all the scheduled guards and dont replace those who havent changed assignments
			$oldschedulearr = split(",",$dbarr['schedule']);
			$newschedulearr = split(",",$schedulestr);
			$overrallschedulearr = array();
			
			//Check all the old array items and replace those which are updated
			for($t=0;$t<count($oldschedulearr);$t++){
				$oldguardassignpair = split("=",$oldschedulearr[$t]);
				//Check the new string if there are assignments for the same guard
				for($i=0;$i<count($newschedulearr);$i++){
					$newguardassignpair = split("=",$newschedulearr[$i]);
					if($oldguardassignpair[0] == $newguardassignpair[0]){
						$oldschedulearr[$t] = $newschedulearr[$i];
						$newschedulearr[$i] = "";
					}
				}
			}
			//Then add the updated old array and re-form the string for saving to the DB
			for($k=0;$k<count($newschedulearr);$k++){
				//Remove elements that are empty strings
				if(trim($newschedulearr[$k]) == ""){
					array_splice($newschedulearr,$k,1);
				}
			}
			
			//IF any, also remove elements that are empty strings from the previous schedule
			for($n=0;$n<count($oldschedulearr);$n++){
				//Remove elements that are empty strings
				if(trim($oldschedulearr[$n]) == ""){
					array_splice($oldschedulearr,$n,1);
				}
			}
			
			$overrallschedulearr = array_merge($newschedulearr,$oldschedulearr);
			//remove duplicates, and any extra commas at the end.
			$schedulestr = trim(implode(",",array_unique($overrallschedulearr)),",");
			
			mysql_query("UPDATE guardschedule SET schedule = '".$schedulestr."' WHERE id = '".$dbarr['id']."'");	
		} else {
			
			mysql_query("INSERT INTO guardschedule (schedule, dateentered) VALUES ('".$schedulestr."',  '".date("Y-m-d",strtotime($dayarr[$m]))."')");
		}
	}
	
	//If the user wants to create a new schedule
	if(isset($formvalues['saveandnew'])){
		$_SESSION['selectedCallSigns'] = array();
		$_SESSION['weekending'] = "";
		
		$url = "../operations/";
	}else {
		//Forward to the schedule calendar
		$url = "../operations/schedulecalendar.php";
	}
	
} else {
	//Forward to back to the schedule
	$url = "../operations/";
}

forwardToPage($url);
?>