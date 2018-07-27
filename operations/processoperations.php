<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);

$formvalueskeys = array_keys($formvalues);
$assignment_count = 1;
$assignment_array = array();
//For overtime
$assignmento_count = 1;
$assignmento_array = array();

// Move through the passed array values
for($i=0;$i<count($formvalueskeys);$i++){
	//Save current assignment schedule
	if($formvalueskeys[$i] == "assignment_".$assignment_count && trim($formvalues["assignment_".$assignment_count]) != ""){
		
		if(!in_array("assignment_".$assignment_count,$assignment_array)){
			if(howManyRows("SELECT * FROM assignments WHERE callsign = '".trim($formvalues["assignment_".$assignment_count])."'") == 0){
				
				$query = "INSERT INTO assignments (callsign, servicetype, assignedguard, relievers, scheduleunit, startdate, enddate, exception, datecreated, createdby) VALUES ('".trim($formvalues["assignment_".$assignment_count])."', 'Shift','".cleanGuardIDs($formvalues["guard_".$assignment_count])."','".trim($formvalues["gdreliever_1"])."','".getScheduleUnit()."','".getGuardScheduleDate("assignment_",trim($formvalues["assignment_".$assignment_count]),$formvalues['weekviewed'],'start')."','".getGuardScheduleDate("assignment_",trim($formvalues["assignment_".$assignment_count]),$formvalues['weekviewed'],'end')."', '".getExceptionDates($formvalues, $formvalueskeys[$i], "assignment_".$assignment_count)."', now(),'".$_SESSION['userid']."')";
			
			} else {
				$query = "UPDATE assignments SET assignedguard = '".cleanGuardIDs($formvalues["guard_".$assignment_count])."', relievers ='".trim($formvalues["gdreliever_1"])."', startdate = '".getGuardScheduleDate("assignment_",trim($formvalues["assignment_".$assignment_count]),$formvalues['weekviewed'],'start')."', enddate = '".getGuardScheduleDate("assignment_",trim($formvalues["assignment_".$assignment_count]),$formvalues['weekviewed'],'end')."', exception = '".getExceptionDates($formvalues, $formvalueskeys[$i], "assignment_".$assignment_count)."', datecreated = now(), createdby = '".$_SESSION['userid']."' WHERE callsign = '".trim($formvalues["assignment_".$assignment_count])."' AND servicetype <> 'Overtime'";
				
			}
			
			$result = mysql_query($query);
			
			array_push($assignment_array,"assignment_".$assignment_count);
			$assignment_count++;
		}
		
	}

	//Save overtime assignment schedule
	if($formvalueskeys[$i] == "assignmento".$assignmento_count && trim($formvalues["assignmento".$assignmento_count]) != ""){
		
		if(!in_array("assignmento".$assignmento_count,$assignmento_array)){
			if(howManyRows("SELECT * FROM assignments WHERE callsign = '".trim($formvalues["assignmento".$assignmento_count])."' AND servicetype = 'Overtime'") == 0){
				
				$query = "INSERT INTO assignments (callsign, servicetype, assignedguard, relievers, scheduleunit, startdate, enddate, exception, datecreated, createdby) VALUES ('".trim($formvalues["assignmento".$assignmento_count])."', 'Overtime', '".cleanGuardIDs($formvalues["guardo".$assignmento_count])."','".trim($formvalues["gdrelievero1"])."','".getScheduleUnit()."','".getGuardScheduleDate("assignmento",trim($formvalues["assignmento".$assignmento_count]),$formvalues['weekviewed'],'start')."','".getGuardScheduleDate("assignmento",trim($formvalues["assignmento".$assignmento_count]),$formvalues['weekviewed'],'end')."', '".getExceptionDates($formvalues, $formvalueskeys[$i], "assignmento".$assignmento_count)."', now(),'".$_SESSION['userid']."')";
			
			} else {
				$query = "UPDATE assignments SET assignedguard = '".cleanGuardIDs($formvalues["guardo".$assignmento_count])."', relievers = '".trim($formvalues["gdrelievero1"])."', startdate = '".getGuardScheduleDate("assignmento",trim($formvalues["assignmento".$assignmento_count]),$formvalues['weekviewed'],'start')."', enddate = '".getGuardScheduleDate("assignmento",trim($formvalues["assignmento".$assignmento_count]),$formvalues['weekviewed'],'end')."', exception = '".getExceptionDates($formvalues, $formvalueskeys[$i], "assignmento".$assignmento_count)."', datecreated = now(), createdby = '".$_SESSION['userid']."' WHERE callsign = '".trim($formvalues["assignmento".$assignmento_count])."' AND servicetype = 'Overtime'";
			}
			//echo $query;
			$result1 = mysql_query($query);
			array_push($assignment_array,"assignmento".$assignmento_count);
			$assignmento_count++;
		}
		
	}
}


// Cleans the passed ids and returns a clean string for saving to the database
function cleanGuardIDs($idstring){
	$cleanstring = "";
	if(trim($idstring) != ""){
		$idarray = split(",",$idstring);
		for($i=0;$i<count($idarray);$i++){
			if(trim($idarray[$i]) != ""){
				if($cleanstring == ""){ 
					$cleanstring = trim($idarray[$i]);
				} else {
					$cleanstring .= ",".trim($idarray[$i]);
				}
			}
		}
		
	} else {
		$cleanstring = "";
	}
	return $cleanstring;
}

// Returns the appropriate guard time depending on the set system
function getGuardScheduleDate($key,$callsign, $datestring, $type){
	if(substr($datestring,0,1) ==  "a"){
		$str = "+ ".substr($datestring,2);
	} else if(substr($datestring,0,1) ==  "s"){
		$str = "- ".substr($datestring,2);
	}
	$datestr = "next sunday ".$str." week";
	$nextsunday = date("Y-m-d",strtotime($datestr)); 

	if($key == "assignment_"){
		$guarddates_array = getRowAsArray("SELECT startdate, enddate FROM assignments WHERE callsign = '".$callsign."' AND servicetype <> 'Overtime'");
	} else if($key == "assignmento"){
		$guarddates_array = getRowAsArray("SELECT startdate, enddate FROM assignments WHERE callsign = '".$callsign."' AND servicetype = 'Overtime'");
	}
	
	$lastmonday  = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-6, date("Y",strtotime($nextsunday))));	
	
	if($type == "start"){
		if(trim($guarddates_array['startdate']) != "0000-00-00" && trim($guarddates_array['startdate']) != ""){
			
			if($guarddates_array['startdate'] > $lastmonday){
				$date = $lastmonday;
			} else {
				$date = trim($guarddates_array['startdate']);
			}
			
		} else {
			$date = $lastmonday;
		}
		
	} else if($type == "end"){
		if(trim($guarddates_array['enddate']) != "0000-00-00" && trim($guarddates_array['enddate']) != ""){
			if($guarddates_array['enddate'] < $nextsunday){
				$date = $nextsunday;
			} else {
				$date = trim($guarddates_array['enddate']);
			}
			
		} else {
			$date = $nextsunday;
		}
		
	} else {
		$date = $nextsunday;
	}
	
	return $date;
}

//Function to return a comma delimited list of dates where the guards
// wont be assigned to the assignment
function getExceptionDates($formvalues, $passedkey, $key){
	if(substr($formvalues["weekviewed"],0,1) ==  "a"){
		$str = "+ ".substr($formvalues["weekviewed"],2);
	} else if(substr($formvalues["weekviewed"],0,1) ==  "s"){
		$str = "- ".substr($formvalues["weekviewed"],2);
	}
	$datestr = "next sunday ".$str." week";
	$nextsunday = date("Y-m-d",strtotime($datestr)); 
	$exceptionstr = "";
	$normalstr = "";

		if(substr($passedkey,0,12) == $key){
			// Get those days when there is no assignment
			if(trim($formvalues[$key.'_m']) == ""){
				$exceptionstr = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-6, date("Y",strtotime($nextsunday)))).",";
			} else {
				$normalstr = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-6, date("Y",strtotime($nextsunday)))).",";
			}
			
			if(trim($formvalues[$key.'_t']) == ""){
				$exceptionstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-5, date("Y",strtotime($nextsunday)))).","; 
			} else {
				$normalstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-5, date("Y",strtotime($nextsunday)))).",";
			}
			
			if(trim($formvalues[$key.'_w']) == ""){
				$exceptionstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-4, date("Y",strtotime($nextsunday)))).","; 	
			} else {
				$normalstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-4, date("Y",strtotime($nextsunday)))).",";
			}
			
			if(trim($formvalues[$key.'_th']) == ""){
				$exceptionstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-3, date("Y",strtotime($nextsunday)))).","; 
			} else {
				$normalstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-3, date("Y",strtotime($nextsunday)))).",";
			}
			
			if(trim($formvalues[$key.'_f']) == ""){
				$exceptionstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-2, date("Y",strtotime($nextsunday)))).","; 
			} else {
				$normalstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-2, date("Y",strtotime($nextsunday)))).",";
			}
			
			if(trim($formvalues[$key.'_s']) == ""){
				$exceptionstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-1, date("Y",strtotime($nextsunday)))).","; 
			} else {
				$normalstr .= date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($nextsunday))  , date("d",strtotime($nextsunday))-1, date("Y",strtotime($nextsunday)))).",";
			}
			
			if(trim($formvalues[$key.'_su']) == ""){
				$exceptionstr .= $nextsunday.","; 
			} else {
				$normalstr .= $nextsunday.","; 
			}
			
		}
	// If you are saving normal details
	if(substr($key,0,11) == "assignment_"){
		// Pick exception dates from the database
		$array = getRowAsArray("SELECT exception FROM assignments WHERE callsign = '".trim($formvalues[$key])."' AND servicetype <> 'Overtime'");
		if(trim($array['exception']) != ""){
			$exceptionstr = removeDuplicates($array['exception'],substr($exceptionstr,0,-1));
			$exceptionstr = checkRemovals($exceptionstr,substr($normalstr,0,-1));
		} else {
			$exceptionstr = substr($exceptionstr,0,-1);
		}
	// If you are saving ovetime details
	} else if(substr($key,0,11) == "assignmento"){
		$array = getRowAsArray("SELECT exception FROM assignments WHERE callsign = '".trim($formvalues[$key])."' AND servicetype = 'Overtime'");
		if(trim($array['exception']) != ""){
			$exceptionstr = removeDuplicates($array['exception'],substr($exceptionstr,0,-1));
		} else {
			$exceptionstr = substr($exceptionstr,0,-1);
		}
	}
	//Remove excess commas that may be included
	$array = split(",",$exceptionstr);
	$cleanarray = array();
	for($i=0;$i<count($array);$i++){ 
		if(trim($array[$i]) != ""){
			array_push($cleanarray,$array[$i]);
		}
	}
	return implode(",",$cleanarray);
}

// Function to remove duplicate strings in string2 that are in string 1
function removeDuplicates($string1,$string2){
	$array1 = split(",",$string1);
	$array2 = split(",",$string2);
	
	for($i=0;$i<count($array2);$i++){
		if(!in_array($array2[$i],$array1)){
			array_push($array1,$array2[$i]);
		}
	}
	return implode(",",$array1);
}

// Function to remove the exceptions that are now normal
function checkRemovals($exceptionstr,$normalstr){
	$exception_array = split(",",$exceptionstr);
	$normal_array = split(",",$normalstr);
	
	for($i=0;$i<count($normal_array);$i++){
		if(in_array($normal_array[$i],$exception_array)){
			// get the key of the date
			$key = array_search($normal_array[$i],$exception_array);
			// Clear the date from the exceptions
			$exception_array[$key] = "";
		}
	}
	return implode(",",$exception_array);
}

// Function to return a schedule unit number assigned by getting the current timestamp
function getScheduleUnit(){
	return time();
}

if(isset($_POST['saveandnew'])){
	forwardToPage('../operations/');
} else {
	forwardToPage('../operations/?a=mng');
}
?>