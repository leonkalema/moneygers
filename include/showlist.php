<?php
//Page returns shows a form for adding items to a list depending on what is passed
include_once "../include/commonfunctions.php";
openDatabaseConnection();

if($_GET['area'] == "tribe"){
	$id = "tribe";
	$name = "tribe";
} else if($_GET['area'] == "district"){
	$id = "guarddistrict";
	$name = "guarddistrict";
}else if($_GET['area']=="groups"){
    $id="groups";
	$name="groups";
}else if($_GET['area']=="servicetype"){
    $id="servicetype";
	$name="servicetype";
}else if($_GET['area']=="uniformstate"){
    $id="uniformstate";
	$name="uniformstate";
} else if($_GET['area'] == "action"){
	$id = "action";
	$name = "action";
} else if($_GET['area'] == "illness"){
	$id = "illness_add";
	$name = "illness_add";
} else if($_GET['area'] == "itemtype"){
	$id = "type";
	$name = "type";
} else if($_GET['area'] == "itemstatus"){
	$id = "status";
	$name = "status";
} else if($_GET['area'] == "leavetype"){
	$id = "leavetype";
	$name = "leavetype";
} else if($_GET['area'] == "time"){
	if($_GET['t'] == "start"){
		$id = "starttime";
		$name = "starttime";
	} 
	
	if($_GET['t'] == "end"){
		$id = "endtime";
		$name = "endtime";
	}
} else if($_GET['area'] == "suppliers"){
	$id = "supplier";
	$name = "supplier";
}

// First option is for drop downs
if(isset($_GET['type']) && $_GET['type'] == "list"){
	if($_GET['area'] == "rights"){
  		echo showRightsList(array());
	}

// Second option is for lists
} else {
	echo "<select id=".$id." name=".$name.">";
 
  if($_GET['area'] == "tribe"){
  	echo generateSelectOptions(getAllTribes(), "");
  } else if($_GET['area'] == "district"){
  	echo generateSelectOptions(getAllDistricts(), "");
  }else if($_GET['area'] == "groups"){
  	echo generateSelectOptions(getAllUserGroups(), "");
  }else if($_GET['area'] == "servicetype"){
  	echo generateSelectOptions(getAllServiceTypes(), "");
  }else if($_GET['area'] == "uniformstate"){
  	echo generateSelectOptions(getAllUniformStates(), "");
  }else if($_GET['area'] == "actions"){
  	echo generateSelectOptions(getAllActions(), "");
  } else if($_GET['area'] == "illness"){
  	echo generateSelectOptions(getAllIllness(), "");
  } else if($_GET['area'] == "itemtype"){
  	echo generateSelectOptions(getAllEquipmentTypes(), "");
  } else if($_GET['area'] == "itemstatus"){
  	echo generateSelectOptions(getAllEquipmentStatus(), "");
  } else if($_GET['area'] == "leavetype"){
  	echo generateSelectOptions(getAllLeaveTypes(), "");
  } else if($_GET['area'] == "category"){
  	echo generateSelectOptions(getAllCategories(), "");
  } else if($_GET['area'] == "suppliers"){
  	echo generateSelectOptions(getAllSuppliers(), "");
  } else if($_GET['area'] == "time"){
  	//The value to be selected
	$showvalue = "";
	if($_GET['value'] != ""){
		$servicedata = getRowAsArray("SELECT * FROM servicetypes WHERE type='".$_GET['value']."'");
		if($_GET['t'] == "start"){
			$showvalue = $servicedata['starttime'];
		}
		
		if($_GET['t'] == "end"){
			$showvalue = $servicedata['endtime'];
		}
	}
	
	echo generateSelectOptions(getAllTime(), $showvalue);
  }
  
  echo "</select>";
}
?>