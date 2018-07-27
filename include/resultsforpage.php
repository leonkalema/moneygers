<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
//Page returns search results for passed values depending on what is passed

// Return whether the searched guard exists or not
if($_GET['area'] == "return_guards"){
	if(trim($_GET['value']) != ""){
		$searchterm = trim($_GET['value']);
		
		$query = "SELECT g.guardid, g.status, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid AND (p.firstname LIKE '%".$searchterm."%' OR p.lastname LIKE '%".$searchterm."%' OR p.othernames LIKE '%".$searchterm."%' OR p.birthlastname LIKE '%".$searchterm."%')";
		
		if(howManyRows($query) > 0){
			$result=mysql_query($query) or die ("Error: ".mysql_error());
			$tablestr = "<table>";
			$count = 0;
			
			//Go through the results
			while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				if($count%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
				
				if(isset($_GET['a']) && !isOccupiedGuard($line['guardid'])){
					
					//Remove the active or inactive guards depending on 
					if(isset($_GET['type'])){
						$status = "";
						
						$statusdata = getRowAsArray("SELECT g.status, a.leavestartdate, a.payrollclerkapproved, a.operationsapproved, a.humanresourceapproved FROM guardstatustrack g, leaveapplications a WHERE g.id = '".$line['status']."' AND g.guard = '".$line['guardid']."' AND g.guard = a.guardid");
						if(count($statusdata) > 0){
							$status = $statusdata['status'];
							
							//IF the guard is active, make sure that he is not on leave
							if($_GET['type'] == "active" && $status == "Active" && ((strtotime("now") < strtotime($statusdata['leavestartdate']) && $statusdata['payrollclerkapproved'] == "Y" && $statusdata['operationsapproved'] == "Y" && $statusdata['humanresourceapproved'] == "Y") || $statusdata['leavestartdate'] == "0000-00-00 00:00:00")){
							
								$tablestr .= "<tr bgcolor=\"".$shade."\"><td>- <a href=\"#addguards\" onClick=\"showSelectedValue('".$_GET['field']."', '".$line['guardid']."')\" style=\"font-family: verdana;font-size: 10px;\">".$line['firstname']." ".$line['lastname']." ".$line['othernames'].$line['birthlastname']."</a></td></tr>";
							}
							if($_GET['type'] == "inactive" &&  $status != "Active"){
								$tablestr .= "<tr class=\"".$shade."\"><td>- <a href=\"#addguards\" onClick=\"showSelectedValue('".$_GET['field']."', '".$line['guardid']."')\" style=\"font-family: verdana;font-size: 10px;\">".$line['firstname']." ".$line['lastname']." ".$line['othernames'].$line['birthlastname']."</a></td></tr>";
							}
						}
						
					}
					
				} else {
						$tablestr .= "<tr class=\"".$shade."\"><td>- <a href=\"#addguards\" onClick=\"showSelectedValue('".$_GET['field']."', '".$line['guardid']."')\" style=\"font-family: verdana;font-size: 10px;\">".$line['firstname']." ".$line['lastname']." ".$line['othernames'].$line['birthlastname']."</a></td></tr>";
				}
				$count++;
			}
			$tablestr .= "</table>";
			
			echo $tablestr;
		} else {
			echo "Sorry. There are no results.";
		}
	} else {
		echo "Please enter a guard name.";
	}
} 

// Return whether the searched guard exists or not
if($_GET['area'] == "return_clients"){
	if(trim($_GET['value']) != ""){
		$searchterm = trim($_GET['value']);
		
		$query = "SELECT callsign, client FROM assignments WHERE client LIKE '%".$searchterm."%'";
		
		if(howManyRows($query) > 0){
			$result=mysql_query($query) or die ("Error: ".mysql_error());
			$tablestr = "<table>";
			$count = 0;
			
			//Go through the results
			while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				if($count%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
				
				$tablestr .= "<tr class=\"".$shade."\"><td><input name=\"callsign[]\" type=\"checkbox\" value=\"".$line['callsign']."\"></td><td>".$line['client']."</td><td>".$line['callsign']."</td></tr>";
				
				$count++;
			}
			$tablestr .= "</table>";
			echo $tablestr;
		} else {
			echo "Sorry. There are no results.";
		}
	} else {
		echo "Please enter a client name.";
	}
} 

// Return the assignments call signs so that the user selects the appropriate signs
if($_GET['area'] == "return_assignments"){
	if(trim($_GET['value']) != ""){
		$searchterm = trim($_GET['value']);
		
		$query = "SELECT callsign, client FROM assignments WHERE client LIKE '%".$searchterm."%'";
		
		if(howManyRows($query) > 0){
			$result=mysql_query($query) or die ("Error: ".mysql_error());
			$tablestr = "<table>";
			$count = 0;
			
			//Go through the results
			while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				if($count%2 == 0){ $shade = "oddrow"; } else { $shade = "even";}
				
				$tablestr .= "<tr class=\"".$shade."\"><td>".$line['client']."</td><td><a href=\"#\" onClick=\"showSelectedValue('".$_GET['field']."', '".$line['callsign']."')\" style=\"font-family: verdana;font-size: 10px;\">".$line['callsign']."</a></td></tr>";
				
				$count++;
			}
			$tablestr .= "</table>";
			echo $tablestr;
		} else {
			echo "Sorry. There are no results.";
		}
	} else {
		echo "Please enter a client name.";
	}
} 

// Return whether the searched guard exists or not
if($_GET['area'] == "return_clientname"){
	if(trim($_GET['value']) != ""){
		$searchterm = trim($_GET['value']);
		
		$query = "SELECT id, name FROM clients WHERE name LIKE '%".$searchterm."%'";
		
		if(howManyRows($query) > 0){
			$result=mysql_query($query) or die ("Error: ".mysql_error());
			$tablestr = "<table>";
			$count = 0;
			
			//Go through the results
			while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				if($count%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
				
				$tablestr .= "<tr class=\"".$shade."\"><td><a href=\"#\" onClick=\"showSelectedValue('".$_GET['field']."', '".$line['name']."')\" style=\"font-family: verdana;font-size: 10px;\">".$line['name']."</a></td></tr>";
				
				$count++;
			}
			$tablestr .= "</table>";
			echo $tablestr;
		} else {
			echo "Sorry. There are no results.";
		}
	} else {
		echo "Please enter a client name.";
	}
} 


// Return the searched guard's working rate
if($_GET['area'] == "return_guardrates"){
	if(trim($_GET['value']) != ""){
		$searchterm = trim($_GET['value']);
		
		$query = "SELECT g.id,g.guardid, g.rate, g.overtimerate, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid AND (p.firstname LIKE '%".$searchterm."%' OR p.lastname LIKE '%".$searchterm."%' OR p.othernames LIKE '%".$searchterm."%' OR p.birthlastname LIKE '%".$searchterm."%')";
		
		if(howManyRows($query) > 0){
			$result=mysql_query($query) or die ("Error: ".mysql_error());
			$tablestr = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
			$tablestr .= "<tr class=\"tabheadings\"><td></td><td>Guard</td><td>Rate (Shs)</td><td>Overtime Rate (Shs)</td></tr>";
			$count = 0;
			
			//Go through the results
			while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				if($count%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
				
				$tablestr .= "<tr class=\"".$shade."\"><td><input type=\"checkbox\" name=\"guard[]\" id=\"guard[]".$line['id']."\" value=\"".$line['id']."\"></td><td>".$line['firstname']." ".$line['lastname']." ".$line['othernames']." ".$line['birthlastname']." (".$line['guardid'].")</td><td>".number_format($line['rate'])."</td><td>".number_format($line['overtimerate'])."</td></tr>";
				
				$count++;
			}
			$tablestr .= "</table>";
			echo $tablestr;
		} else {
			echo "Sorry. There are no results.";
		}
	} else {
		echo "Please enter a guard name.";
	}
} 

?>
