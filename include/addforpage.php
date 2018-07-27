<?php
//Page returns shows a form for adding items to a list depending on what is passed
include_once "../include/commonfunctions.php";
openDatabaseConnection();
$showlayer = "";

// Return whether the searched guard exists or not
if(isset($_GET['sect']) && $_GET['sect'] == "tribe"){
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM tribe WHERE tribe = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The tribe already exists in our database.";
		} else {
			$query = "INSERT INTO tribe (tribe, date_of_entry) VALUES ('".trim($_GET['item'])."',now())";
			mysql_query($query);
			$message = "Tribe successfully added to database.";
		}
		
	} else {
		$message = "Please enter a tribe.";
	}
	
	
} else if($_GET['sect'] == "district"){
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM district WHERE district = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The district already exists in our database.";
		} else {
			$query = "INSERT INTO district (district, date_of_entry) VALUES ('".trim($_GET['item'])."',now())";
			mysql_query($query);
			$message = "District successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a district.";
	}
	
}else if($_GET['sect'] == "groups"){
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM groups WHERE name = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "User Group already exists in our database.";
		} else {
			$query = "INSERT INTO groups (name) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = " User Group successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a User Group.";
	}
	
}else if($_GET['sect'] == "servicetype"){
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM servicetype WHERE servicetype = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "Service Type already exists in our database.";
		} else {
			$query = "INSERT INTO servicetypes(type, date_of_entry) VALUES ('".trim($_GET['item'])."',now())";
			mysql_query($query);
			$message = " Service type successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a service type.";
	}
	
}else if($_GET['sect'] == "uniformstate"){
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM uniformstate WHERE uniformstate = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "State of uniform already exists in our database.";
		} else {
			$query = "INSERT INTO uniformstate(uniformstate, date_of_entry) VALUES ('".trim($_GET['item'])."',now())";
			mysql_query($query);
			$message = " Uniform state successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter uniform state.";
	}
	}else if($_GET['sect'] == "rights"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM rights WHERE rightname = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The User Right already exists in our database.";
		} else {
			$query = "INSERT INTO rights (rightname) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "User Right successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a User Right.";
	}
	
} else if($_GET['sect'] == "actions"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM actions WHERE name = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The Action already exists in our database.";
		} else {
			$query = "INSERT INTO actions (name) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Action successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter an Action.";
	}
	
} else if($_GET['sect'] == "illness"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM illness WHERE name = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The Illness already exists in our database.";
		} else {
			$query = "INSERT INTO illness (name) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Illness successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter an Illness.";
	}
	
} else if($_GET['sect'] == "guard"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM guard WHERE name = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The Guard already exists in our database.";
		} else {
			$query = "INSERT INTO guard (name) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Guard successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a Guard.";
	}
	
} else if($_GET['sect'] == "commanders"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM commanders WHERE name = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The Commander already exists in our database.";
		} else {
			$query = "INSERT INTO Commander (name) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Commander successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a Commander.";
	}
	
} else if($_GET['sect'] == "mobile"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM mobile WHERE name = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The Mobile already exists in our database.";
		} else {
			$query = "INSERT INTO Mobile (name) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Mobile successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a Mobile.";
	}
	
} else if($_GET['sect'] == "location"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM location WHERE name = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The Location already exists in our database.";
		} else {
			$query = "INSERT INTO location (name) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Location successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a Location.";
	}
	
} else if($_GET['sect'] == "itemtype"){
	
	
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM equipmentdetails WHERE name = '".trim($_GET['item'])."' AND type='Type'";
		
		if(howManyRows($search_query) > 0){
			$message = "The type already exists in our database.";
		} else {
			$query = "INSERT INTO equipmentdetails (name, type) VALUES ('".trim($_GET['item'])."', 'Type')";
			mysql_query($query);
			$message = "Type successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a Type.";
	}
	
} else if($_GET['sect'] == "itemstatus"){
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM equipmentdetails WHERE name = '".trim($_GET['item'])."' AND type='Status'";
		
		if(howManyRows($search_query) > 0){
			$message = "The status already exists in our database.";
		} else {
			$query = "INSERT INTO equipmentdetails (name, type) VALUES ('".trim($_GET['item'])."', 'Status')";
			mysql_query($query);
			$message = "Status successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a Status.";
	}
	
} else if($_GET['sect'] == "leavetype"){
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM leavetype WHERE leavetype = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "Leave Type already exists in our database.";
		} else {
			$query = "INSERT INTO leavetypes (leavetype) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Leave type successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a leave type.";
	}
	
} else if($_GET['sect'] == "suppliers"){
	if($_GET['item'] != ""){
		$search_query = "SELECT * FROM suppliers WHERE suppliername = '".trim($_GET['item'])."'";
		
		if(howManyRows($search_query) > 0){
			$message = "The supplier already exists in our database.";
		} else {
			$query = "INSERT INTO suppliers (suppliername) VALUES ('".trim($_GET['item'])."')";
			mysql_query($query);
			$message = "Supplier successfully added to database.";
		}
		
		
	} else {
		$message = "Please enter a supplier.";
	}
	
}


// Specify where the messages and form are to be dislayed
if(isset($_GET['area']) && $_GET['area'] == "tribe"){
	$showlayer = "guardtribe_add";
} else if($_GET['area'] == "district"){
	$showlayer = "guarddistrict_add";
}else if($_GET['area'] == "groups"){
	$showlayer = "usergroup_add";
}else if($_GET['area'] == "servicetype"){
	$showlayer = "servicetype_add";
}else if($_GET['area'] == "uniformstate"){
	$showlayer = "uniformstate_add";
}else if($_GET['area'] == "rights"){
	$showlayer = "right_add";
}else if($_GET['area'] == "actions"){
	$showlayer = "action_add";
}else if($_GET['area'] == "illness"){
	$showlayer = "illness_add";
}else if($_GET['area'] == "guard"){
	$showlayer = "guard_add";
}else if($_GET['area'] == "commanders"){
	$showlayer = "commander_add";
}else if($_GET['area'] == "mobile"){
	$showlayer = "mobile_add";
}else if($_GET['area'] == "location"){
	$showlayer = "location_add";
}else if($_GET['area'] == "itemtype"){
	$showlayer = "itemtype_add";
}else if($_GET['area'] == "itemstatus"){
	$showlayer = "itemstatus_add";
}else if($_GET['area'] == "leavetype"){
	$showlayer = "leavetype_add";
}else if($_GET['area'] == "suppliers"){
	$showlayer = "suppliers_add";
}
?>

  <table border="0" cellspacing="0" cellpadding="0">
  <?php if(isset($message) && $message != ""){?>
  <tr>
      <td colspan="2" style="color:#000066; font-weight:bold"><?php echo $message;?></td>
    </tr>
 <?php } else {?>
    <tr>
      <td><input type="text" name="item" id="item" value="<?php echo $_GET['item'];?>"/></td>
      <td nowrap="nowrap">&nbsp;
	  <input type="button" name="Button" value="Add" onclick="pickFormItem('item', 'forwardURL','addLayer')" />
	 <input name="forwardURL" id="forwardURL" type="hidden" value="../include/addforpage.php?sect=<?php echo $_GET['area'];?>&item=" /><input name="addLayer" id="addLayer" type="hidden" value="<?php echo $showlayer;?>" />
	 	 
	 
	 </td>
    </tr>
	<?php } ?>
  </table>


