<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
//Page returns search results for passed values depending on what is passed

// Return whether the searched guard exists or not
if($_GET['area'] == "guards"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM guards WHERE guardid='".$_GET['value']."'";
		
		if(howManyRows($query) > 0){
			echo "ID is taken.";
		} else {
			echo "ID is NOT taken.";
		}
	} else {
		echo "Please enter a guard ID.";
	}
} 

// Return whether the searched guard exists or not
if($_GET['area'] == "assignments"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM assignments WHERE callsign='".$_GET['value']."'";
		
		if(howManyRows($query) > 0){
			echo "Call sign is taken.";
		} else {
			echo "Call sign is NOT taken.";
		}
	} else {
		echo "Please enter a call sign.";
	}
}

// Return whether the searched group exists or not
if($_GET['area'] == "groups"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM groups WHERE name='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Group Name is Taken.";
		} else {
			echo "Group Name is Not Taken.";
		}
	} else {
		echo "Please enter a Group Name.";
	}
}  


// Return whether the searched action exists or not
if($_GET['area'] == "personnel"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM personnel WHERE guard='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Personnel Name is Taken.";
		} else {
			echo "Personnel Name is Not Taken.";
		}
	} else {
		echo "Please enter a Personnel Name.";
	}
}

// Return whether the searched illness exists or not
if($_GET['area'] == "sickguard"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM sickguard WHERE guard='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Sick Guard Name is Taken.";
		} else {
			echo "Sick Guard Name is Not Taken.";
		}
	} else {
		echo "Please enter a Sick Guard Name.";
	}
} 

//Return whether the searched username exists or not
if($_GET['area']=="users"){
   
   if($_GET['value'] !=""){
      $query1="SELECT * FROM users WHERE username='".trim($_GET['value'])."'";
	  
	  if(howManyRows($query1)>0){
	     echo "Username is taken.";
	  }else{
	     echo "Username is NOT taken";
	  }
   }else{
	   echo "Please enter a username.";
   }
}

// Return whether the searched region code exists or not
if($_GET['area']=="regions"){
   
   if($_GET['value'] !=""){
      $query1="SELECT * FROM regions WHERE code='".$_GET['value']."'";
	  
	  if(howManyRows($query1)>0){
	     echo "Code is already taken.";
	  }else{
	     echo "Code is NOT taken";
	  }
   }else{
	   echo "Please enter a region code.";
   }
}
// Return whether the searched region name exists or not
if($_GET['area']=="names"){
   
   if($_GET['value'] !=""){
      $query2="SELECT * FROM regions WHERE name='".trim($_GET['value'])."'";
	  
	  if(howManyRows($query2)>0){
	     echo "Name is already taken.";
	  }else{
	     echo "Name is NOT taken";
	  }
   }else{
	   echo "Please enter a region name.";
   }
}

// Return whether the searched assignment exists or not
if($_GET['area'] == "guardresponseforms"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM guardresponseforms WHERE assignment='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Assignment already assigned.";
		} else {
			echo "Assignment not yet assigned .";
		}
	} else {
		echo "Please enter an Assignment.";
	}
}
// Return whether the searched guard exists or not
if($_GET['area'] == "commanders"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM commanders WHERE name='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Commander already assigned.";
		} else {
			echo "Commander not yet assigned .";
		}
	} else {
		echo "Please enter a Commander.";
	}
}
// Return whether the searched guard exists or not
if($_GET['area'] == "mobile"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM mobile WHERE number='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Mobile already assigned.";
		} else {
			echo "Mobile not yet assigned .";
		}
	} else {
		echo "Please enter a Mobile.";
	}
} 

// Return whether the searched guard exists or not
if($_GET['area'] == "location"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM location WHERE name='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Location already assigned.";
		} else {
			echo "Location not yet assigned .";
		}
	} else {
		echo "Please enter a Location.";
	}
}	

// Return whether the searched call sign exists or not
if($_GET['area'] == "callsign"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM assignments WHERE callsign='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Call sign already taken.";
		} else {
			echo "Call sign not yet taken.";
		}
	} else {
		echo "Please enter a Call sign.";
	}
}

// Return whether the searched alarm id exists or not
if($_GET['area'] == "alarmid"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM alarms WHERE alarmid='".trim($_GET['value'])."'";
		
		if(howManyRows($query) > 0){
			echo "Call sign already taken.";
		} else {
			echo "Call sign not yet taken.";
		}
	} else {
		echo "Please enter a Call sign.";
	}
}

// Return the searched item serial no
if($_GET['area'] == "itemserial"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM equipment WHERE serialno='".$_GET['value']."'";
		
		if(howManyRows($query) > 0){
			$storequery = "SELECT * FROM equipment WHERE serialno='".$_GET['value']."' AND instore = 'Y'";
			if(howManyRows($storequery) > 0){
				echo "The item is available.";
			} else {
				$item = getRowAsArray("SELECT id FROM itemissue WHERE serialno = '".trim($_GET['value'])."' AND type = 'issue'");
				echo "The item is NOT available. <br><a href=\"../inventory/?id=".$item['id']."&d=view\">View issue details</a>";
			}
		} else {
			echo "There is no registered item with the entered serial number.";
		}
	} else {
		echo "Please enter an item serial number.";
	}
}


// Return the searched item serial no
if($_GET['area'] == "return_serialno"){
	if($_GET['value'] != ""){
		$query = "SELECT * FROM equipment WHERE serialno='".$_GET['value']."'";
		
		if(howManyRows($query) > 0){
			echo "The serial number is TAKEN.";
		} else {
			echo "The serial number is available.";
		}
	} else {
		echo "Please enter an item serial number.";
	}
}
?>
