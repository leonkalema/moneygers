<?php

define("NUM_OF_COLUMNS", 3);
# This class include functions to access and use the different check box lists within
# this application
	# function to return the results of an checkboxes query as array. This function assumes that
	# the query returns two columns optionvalue and optiontext which correspond to the corresponding key
	# and values respectively. 
	# The selection of the names is to avoid name collisions with database reserved words
	function getCheckboxValuesFromDatabaseQuery($query) {
		openDatabaseConnection();
		$result = mysql_query($query) or die("Invalid query ".mysql_error());
		$valuesarray = array();
		while ($line = mysql_fetch_assoc ($result)) {
			$valuesarray[$line['optionvalue']]	= $line['optiontext'];
		}
		return $valuesarray;
		
	}

	# Generates HTML select options from data in an array. This function assumes that the
	# array key is the value of the option and the array key value is the text to be displayed
	# If the current value is an empty sting, a <Select One> option is displayed
	# as the first option
	function generateCheckboxOptions($optionvalues, $name, $currentvalues, $columns, $idprefix = "") {
		//print_r(array_keys($optionvalues));
		//print_r($currentvalues);
		#$columns = NUM_OF_COLUMNS;
		$checkboxHTML = "";
		$counter = 0;
		$checkboxHTML .= "<table width=\"100%\"><tr>";
		foreach($optionvalues as $key => $value) {
			$counter++;
			$col = $counter%$columns;
			$checkboxHTML .= "<td nowrap=\"nowrap\"><input type=\"checkbox\" "; 
			if (in_array($key, $currentvalues)) {
			
				$checkboxHTML .= "checked "; 
			 } 
		 	$checkboxHTML .= "name=\"".$name."[]\" id=\"".$idprefix.$key."\" class=\"checkbox\" value=\"".$key."\">&nbsp;".$value."</td>";
			 if($col==0) {			 	
			 	$checkboxHTML .= "</tr><tr>";
			 }
		}
		//generate the remaining columns is the last checkbox was not in the fourth column
		if($col == 1) {
			$checkboxHTML .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr>";
		} else if($col == 2) {
			$checkboxHTML .= "<td>&nbsp;</td><td>&nbsp;</td></tr><tr>";
		} else if($col == 3) {
			$checkboxHTML .= "<td>&nbsp;</td></tr><tr>";
		}
		$checkboxHTML .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>";
		return $checkboxHTML;
	}
	
	#function to obtain an array of all the user groups
	function getAllUserGroups() {
		 $groupsquery = "SELECT id as optionvalue, name as optiontext FROM groups";		
		 $groupsquery .= " ORDER BY optiontext";
		return getCheckboxValuesFromDatabaseQuery($groupsquery);
	}

	?>