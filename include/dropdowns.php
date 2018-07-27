<?php
	# prints the HTML code for an HTML select option if the value is not empty
	function getSelectOption($text) {
		# first trim the whitespace at the beginning and end of the text
		$text = trim($text);
		# print out the option only if its not an empty string
		if ($text != "") {
			echo "<option value=\"".$text."\">".$text."</option>";
		}
	}
	

	# Generates HTML Selected Option if the $newvalue is the
	# same as the current value
	# $currentvalue - the current value of the select option
	# $newvalue - one of the values of the select option
	# $newvaluetext - the text to be displayed for the new value
	function getSelectOptionFromValues($currentvalue, $newvalue, $newvaluetext) {
		# print out the option only if the newvalue is the
		# same as the old value
		if (trim($newvalue)  == trim($currentvalue)) {
			return "<option value=\"".$newvalue."\" selected>".$newvaluetext."</option>";
		}
	}
	
	# Generates HTML select options from data in an array. This function assumes that the
	# array key is the value of the option and the array key value is the text to be displayed
	# If the current value is an empty sting, a <Select One> option is displayed
	# as the first option
	# you do not want 'All " to appear in your list lits? set $isfilterlist=true
	# you do not want "<Select One>", "Select[listname]" in your list? set $isfilterlist=false and $listitemsonly=true
	function generateSelectOptions($optionvalues, $currentvalue, $isfilterlist=false,$listitemsonly=false, $listname) {
		$optionsHTML = "";
		if($currentvalue == "0000-00-00 00:00:00"){
			$currentvalue = "";
		}
		if (trim($currentvalue) != "") {
			# show the current option, as the first option
			$optionsHTML .= "<option value=\"".$currentvalue."\" selected>".$optionvalues[$currentvalue]."</option>";
		}
		# the current value is empty so display the <Select One> option. Note the use of &gt; and &lt;
		# instead of < and > respectively since these may cause errors in the tag as they are only for
		# display purposes
		#use select one only if it is not a filter list
		if($isfilterlist) {
			$optionsHTML .= "<option value=\"\">All ".$listname."</option>";
		} elseif(!$listitemsonly) {
			$optionsHTML .= "<option value=\"\">&lt;Select&gt;</option>";
		}
		
		
		foreach($optionvalues as $key => $value) {
			$optionsHTML .= "<option value=\"".$key."\">".$value."</option>";
		}
		return $optionsHTML;
	}

	# function to return the results of an options query as array. This function assumes that
	# the query returns two columns optionvalue and optiontext which correspond to the corresponding key
	# and values respectively. 
	# The selection of the names is to avoid name collisions with database reserved words
	function getOptionValuesFromDatabaseQuery($query) {
		openDatabaseConnection();
		$result = mysql_query($query) or die("Invalid query ".mysql_error());
		$valuesarray = array();
		while ($line = mysql_fetch_assoc ($result)) {
			$valuesarray[$line['optionvalue']]	= $line['optiontext'];
		}
		return $valuesarray;
		
	}

	# function to generate client billing types
	function getAllBillingTypes() {
		$billingtypes = array(
		"Cash" => "Cash",		
		"Cheque" => "Cheque",
		"Money Order" => "Money Order",
		"Other" => "Other"
		);
		return $billingtypes;
	}
	
	# function to generate status
	function getAllStatus(){
	 $stati= array(
	 "Pending" => "Pending",
	 "Approved" => "Approved",
	 "Rejected" =>  "Rejected"
	 );
	 return $stati;
	 }
	 
	 # function to generate action taken
	function getAction(){
	 $action= array(
	 "Approve" => "Approve",
	 "Reject" => "Reject"
	 );
	 return $action;
	 }
	 
	 #function to generate uniform state
	function getAllUniformStates(){
 		$query="SELECT id AS optionvalue, uniformstate AS optiontext FROM uniformstate ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	 
	 #function to generate all leave types
	 function getAllLeaveTypes(){
	    $query="SELECT leavetype AS optionvalue, leavetype AS optiontext FROM leavetypes ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	#function to get all job titles
	 function getAllJobTitles(){
	    $query="SELECT id AS optionvalue, jobtitle AS optiontext FROM jobtitles ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	#function to generate all item categories types
	 function getItemCategories(){
	    $query="SELECT category AS optionvalue, category AS optiontext FROM categories ORDER BY id";
		return getOptionValuesFromDatabaseQuery($query);
	}
		
	#function to generate all document names
	function getAllDocumentNames(){
	   $documentnames= array(
	    "Application Letter"=> "Application Letter",
		"Reference Letter"=> "Reference Letter",
		"Medical Examination"=> "Medical Examination",
		"Training Results"=> "Training Results",
		"Lc Letter"=> "Lc Letter",
		"Finger Print Results"=> "Finger Print Results",
		"Vetting Form"=> "Vetting Form",
		"Appointment Letter"=> 	"Appointment Letter",
		"Contract"=> "Contract",
		"Renewed Contract"=> "Renewed Contract",
		"ID Photocopy"=> "ID Photocopy",
		"Uniform Issued"=> "Uniform Issued",
		"Internal Investigations Result"=> "Internal Investigations Result",
		"Passport Photographs"=> "Passport Photographs"
		);
		return $documentnames;
		}
			
	# function to generate regions
	function getAllRegions() {
		//$query = "Select id AS optionvalue, code AS optiontext From regions ORDER BY optiontext";
		$query = "Select code AS optionvalue, code AS optiontext From regions ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	function getAllServiceTypes(){
	    $query="SELECT type AS optionvalue, type AS optiontext FROM servicetypes ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}

#function to return all guard status including the assignment
	function getAllGuardStatus(){
		openDatabaseConnection();
		$today = date("Y-m-d");
		
		$statusquery="SELECT status AS optionvalue, statusvalue AS optiontext FROM guardstatus WHERE statusvalue <> '' ORDER BY optiontext";
		$assignquery="SELECT exception, callsign AS optionvalue, callsign AS optiontext FROM assignments WHERE callsign <> '' AND (enddate >= '".date("Y-m-d")."' OR enddate = '0000-00-00') AND startdate <= '".date("Y-m-d")."' AND assignedguards > 0 ORDER BY optiontext";
		
		$result = mysql_query($statusquery) or die("Invalid query ".mysql_error());
		$result1 = mysql_query($assignquery) or die("Invalid query ".mysql_error());
		$valuesarray = array();
		while ($line = mysql_fetch_assoc ($result)) {
			$valuesarray[$line['optionvalue']]	= $line['optiontext'];
		}
		while ($line1 = mysql_fetch_assoc ($result1)) {
			if(!in_array($today, split(",",$line1['exception']))){
				$valuesarray[$line1['optionvalue']]	= $line1['optiontext'];
			}
		}
		
		return $valuesarray;
	}
	
	#Get all known guard statuses
	function getAllScheduleStatus(){
		$result = mysql_query("SELECT status FROM guardstatus");
		$statusarr = array();
		$counter = 0;
		while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
			$statusarr[$counter] = $line['status'];
			$counter++;
		}
		return $statusarr;
	}
	
	#Get all registered satuses for the drop down
	function getAllGuardStatusDrop(){
		$query="SELECT id AS optionvalue, status AS optiontext FROM  guardstatus ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}

	# function to get all suppliers
	function getAllSuppliers(){
		$query="SELECT id AS optionvalue, suppliername AS optiontext FROM  suppliers ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all the payment forms
	function getAllPaymentForms(){
		$query="SELECT form AS optionvalue, form AS optiontext FROM  paymentforms ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all inspectors
	function getAllInspectors(){
		$jobidarr = getRowAsArray("SELECT id FROM jobtitles WHERE jobtitle = 'Inspector'");
		$query="SELECT g.guardid AS optionvalue, concat(p.firstname,' ', p.lastname,' ', p.othernames)  AS optiontext FROM persons p, guards g WHERE g.personid=p.id AND jobtitle = '".$jobidarr['id']."' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}

	# function to get all departments
	function getAllDepartments(){
		$query="SELECT id AS optionvalue, departmentname AS optiontext FROM  department ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get equipment serial numbers
	function getSerialNumbers(){
	    $query="SELECT serialno AS optionvalue, serialno AS optiontext FROM equipment WHERE type ='Deployment Pickup' OR type = 'Transport van' AND instore='Y' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get assignment call signs
	function getCallSigns(){
	    $query="SELECT callsign AS optionvalue, callsign AS optiontext FROM assignments WHERE isactive='Y' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all transaction types as stored in the database
	function getAllAccounts($accounttype){
		$query="SELECT id AS optionvalue, accountname AS optiontext FROM accounts WHERE type = '".$accounttype."' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get alarm assignment call signs
	function getAlarmCallSigns(){
		$query="SELECT callsign AS optionvalue, callsign AS optiontext FROM assignments WHERE isactive='Y' AND (servicetype like 'Alarm%' OR servicetype like '%Both%') ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to generate titles
	function getAllDays() {
		$days = array(
		"Sat" => "Sat",		
		"Sun" => "Sun",
		"Mon" => "Mon",
		"Tue" => "Tue",		
		"Wed" => "Wed",
		"Thur" => "Thur",
		"Fri" => "Fri"
		);
		return $days;
	}
	
	# function to generate the time drop down
	function getAllTime() {
		$time = array(
		"00:00:00" => "00:00",
		"00:30:00" => "00:30",		
		"01:00:00" => "01:00",
		"01:30:00" => "01:30",
		"02:00:00" => "02:00",		
		"02:30:00" => "02:30",
		"03:00:00" => "03:00",
		"03:30:00" => "03:30",		
		"04:00:00" => "04:00",
		"04:30:00" => "04:30",
		"05:00:00" => "05:00",		
		"05:30:00" => "05:30",
		"06:00:00" => "06:00",
		"06:30:00" => "06:30",
		"07:00:00" => "07:00",
		"07:30:00" => "07:30",
		"08:00:00" => "08:00",
		"08:30:00" => "08:30",
		"09:00:00" => "09:00",
		"09:30:00" => "09:30",
		"10:00:00" => "10:00",
		"10:30:00" => "10:30",
		"11:00:00" => "11:00",
		"11:30:00" => "11:30",
		"12:00:00" => "12:00",
		"12:30:00" => "12:30",
		"13:00:00" => "13:00",
		"13:30:00" => "13:30",
		"14:00:00" => "14:00",
		"14:30:00" => "14:30",
		"15:00:00" => "15:00",
		"15:30:00" => "15:30",
		"16:00:00" => "16:00",
		"16:30:00" => "16:30",
		"17:00:00" => "17:00",
		"17:30:00" => "17:30",
		"18:00:00" => "18:00",
		"18:30:00" => "18:30",
		"19:00:00" => "19:00",
		"19:30:00" => "19:30",
		"20:00:00" => "20:00",
		"20:30:00" => "20:30",
		"21:00:00" => "21:00",
		"21:30:00" => "21:30",
		"22:00:00" => "22:00",
		"22:30:00" => "22:30",
		"23:00:00" => "23:00",
		"23:30:00" => "23:30",
		"24:00:00" => "24:00"		
		);
		return $time;
	}
	
	# function to generate months
	function getAllMonths($length) {
		if($length == "3"){
			$months = array(
			"January" => "Jan",		
			"February" => "Feb",
			"March" => "Mar",
			"April" => "Apr",
			"May" => "May",		
			"June" => "Jun",
			"July" => "Jul",
			"August" => "Aug",
			"September" => "Sep",		
			"October" => "Oct",
			"November" => "Nov",
			"December" => "Dec"	
			);
		} else{
			$months = array(
			"January" => "January",		
			"February" => "February",
			"March" => "March",
			"April" => "April",
			"May" => "May",		
			"June" => "June",
			"July" => "July",
			"August" => "August",
			"September" => "September",		
			"October" => "October",
			"November" => "November",
			"December" => "December"	
			);
		}
		return $months;
	}

	# function to generate day of the month
	function getAllMonthDays() {
		$monthdays = array(
		"01" => "01",		
		"02" => "02",
		"03" => "03",
		"04" => "04",
		"05" => "05",
		"06" => "06",
		"07" => "07",
		"08" => "08",
		"09" => "09",
		"10" => "10",
		"11" => "11",		
		"12" => "12",
		"13" => "13",
		"14" => "14",
		"15" => "15",
		"16" => "16",
		"17" => "17",
		"18" => "18",
		"19" => "19",
		"20" => "20",
		"21" => "21",		
		"22" => "22",
		"23" => "23",
		"24" => "24",
		"25" => "25",
		"26" => "26",
		"27" => "27",
		"28" => "28",
		"29" => "29",
		"30" => "30",
		"31" => "31"				
		);
		return $monthdays;
	}

	# function to generate assignment frequencies
	function getAllFrequencies() {
		$frequencies = array(
		"Every Day" => "Every Day",		
		"Weekly" => "Weekly",
		"Monthly" => "Monthly"
		);
		return $frequencies;
	}
	#Function to generate all countries
	function getAllCountries(){
		$countries = array(
				 "Uganda" => "Uganda",
				 "Canada" => "Canada",
				 "Afghanistan" => "Afghanistan",
				 "Albania" => "Albania",
				 "Algeria" => "Algeria",
				 "American Samoa" => "American Samoa",
				 "Andorra" => "Andorra",
				 "Angola" => "Angola",
				 "Anguilla" => "Anguilla",
				 "Antarctica" => "Antarctica",
				 "Antigua and Barbuda" => "Antigua and Barbuda",
				 "Argentina" => "Argentina",
				 "Armenia" => "Armenia",
				 "Aruba" => "Aruba",
				 "Australia" => "Australia",
				 "Austria" => "Austria",
				 "Azerbaijan" => "Azerbaijan",
				 "Bahamas" => "Bahamas",
				 "Bahrain" => "Bahrain",
				 "Bangladesh" => "Bangladesh",
				 "Barbados" => "Barbados",
				 "Belarus" => "Belarus",
				 "Belgium" => "Belgium",
				 "Belize" => "Belize",
				 "Benin" => "Benin",
				 "Bermuda" => "Bermuda",
				 "Bhutan" => "Bhutan",
				 "Bolivia" => "Bolivia",
				 "Bosnia and Herzegovina" => "Bosnia and Herzegovina",
				 "Botswana" => "Botswana",
				 "Bouvet Island" => "Bouvet Island",
				 "Brazil" => "Brazil",
				 "British Indian Ocean Territory" => "British Indian Ocean Territory",
				 "Brunei Darussalam" => "Brunei Darussalam",
				 "Bulgaria" => "Bulgaria",
				 "Burkina Faso" => "Burkina Faso",
				 "Burundi" => "Burundi",
				 "Cambodia" => "Cambodia",
				 "Cameroon" => "Cameroon",
				 "Cape Verde" => "Cape Verde",
				 "Cayman Islands" => "Cayman Islands",
				 "Central African Republic" => "Central African Republic",
				 "Chad" => "Chad",
				 "Chile" => "Chile",
				 "China" => "China",
				 "Christmas Island" => "Christmas Island",
				 "Cocos (Keeling) Islands" => "Cocos (Keeling) Islands",
				 "Colombia" => "Colombia",
				 "Comoros" => "Comoros",
				 "Congo" => "Congo",
				 "Cook Islands" => "Cook Islands",
				 "Costa Rica" => "Costa Rica",
				 "Cote D'Ivoire (Ivory Coast)" => "Cote D'Ivoire (Ivory Coast)",
				 "Croatia (Hrvatska)" => "Croatia (Hrvatska)",
				 "Cuba" => "Cuba",
				 "Cyprus" => "Cyprus",
				 "Czech Republic" => "Czech Republic",
				 "Czechoslovakia (former)" => "Czechoslovakia (former)",
				 "Denmark" => "Denmark",
				 "Djibouti" => "Djibouti",
				 "Dominica" => "Dominica",
				 "Dominican Republic" => "Dominican Republic",
				 "East Timor" => "East Timor",
				 "Ecuador" => "Ecuador",
				 "Egypt" => "Egypt",
				 "El Salvador" => "El Salvador",
				 "Equatorial Guinea" => "Equatorial Guinea",
				 "Eritrea" => "Eritrea",
				 "Estonia" => "Estonia",
				 "Ethiopia" => "Ethiopia",
				 "Falkland Islands (Malvinas)" => "Falkland Islands (Malvinas)",
				 "Faroe Islands" => "Faroe Islands",
				 "Fiji" => "Fiji",
				 "Finland" => "Finland",
				 "France" => "France",
				 "French Guiana" => "French Guiana",
				 "French Polynesia" => "French Polynesia",
				 "French Southern Territories" => "French Southern Territories",
				 "Gabon" => "Gabon",
				 "Gambia" => "Gambia",
				 "Georgia" => "Georgia",
				 "Germany" => "Germany",
				 "Ghana" => "Ghana",
				 "Gibraltar" => "Gibraltar",
				 "Great Britain (UK)" => "Great Britain (UK)",
				 "Greece" => "Greece",
				 "Greenland" => "Greenland",
				 "Grenada" => "Grenada",
				 "Guadeloupe" => "Guadeloupe",
				 "Guam" => "Guam",
				 "Guatemala" => "Guatemala",
				 "Guinea" => "Guinea",
				 "Guinea-Bissau" => "Guinea-Bissau",
				 "Guyana" => "Guyana",
				 "Haiti" => "Haiti",
				 "Heard and McDonald Islands" => "Heard and McDonald Islands",
				 "Honduras" => "Honduras",
				 "Hong Kong" => "Hong Kong",
				 "Hungary" => "Hungary",
				 "Iceland" => "Iceland",
				 "India" => "India",
				 "Indonesia" => "Indonesia",
				 "Iran" => "Iran",
				 "Iraq" => "Iraq",
				 "Ireland" => "Ireland",
				 "Israel" => "Israel",
				 "Italy" => "Italy",
				 "Jamaica" => "Jamaica",
				 "Japan" => "Japan",
				 "Jordan" => "Jordan",
				 "Kazakhstan" => "Kazakhstan",
				 "Kenya" => "Kenya",
				 "Kiribati" => "Kiribati",
				 "Korea (North)" => "Korea (North)",
				 "Korea (South)" => "Korea (South)",
				 "Kuwait" => "Kuwait",
				 "Kyrgyzstan" => "Kyrgyzstan",
				 "Laos" => "Laos",
				 "Latvia" => "Latvia",
				 "Lebanon" => "Lebanon",
				 "Lesotho" => "Lesotho",
				 "Liberia" => "Liberia",
				 "Libya" => "Libya",
				 "Liechtenstein" => "Liechtenstein",
				 "Lithuania" => "Lithuania",
				 "Luxembourg" => "Luxembourg",
				 "Macau" => "Macau",
				 "Macedonia" => "Macedonia",
				 "Madagascar" => "Madagascar",
				 "Malawi" => "Malawi",
				 "Malaysia" => "Malaysia",
				 "Maldives" => "Maldives",
				 "Mali" => "Mali",
				 "Malta" => "Malta",
				 "Marshall Islands" => "Marshall Islands",
				 "Martinique" => "Martinique",
				 "Mauritania" => "Mauritania",
				 "Mauritius" => "Mauritius",
				 "Mayotte" => "Mayotte",
				 "Mexico" => "Mexico",
				 "Micronesia" => "Micronesia",
				 "Moldova" => "Moldova",
				 "Monaco" => "Monaco",
				 "Mongolia" => "Mongolia",
				 "Montserrat" => "Montserrat",
				 "Morocco" => "Morocco",
				 "Mozambique" => "Mozambique",
				 "Myanmar" => "Myanmar",
				 "Namibia" => "Namibia",
				 "Nauru" => "Nauru",
				 "Nepal" => "Nepal",
				 "Netherlands Antilles" => "Netherlands Antilles",
				 "Netherlands" => "Netherlands",
				 "Neutral Zone" => "Neutral Zone",
				 "New Caledonia" => "New Caledonia",
				 "New Zealand (Aotearoa)" => "New Zealand (Aotearoa)",
				 "Nicaragua" => "Nicaragua",
				 "Niger" => "Niger",
				 "Nigeria" => "Nigeria",
				 "Niue" => "Niue",
				 "Norfolk Island" => "Norfolk Island",
				 "Northern Mariana Islands" => "Northern Mariana Islands",
				 "Norway" => "Norway",
				 "Oman" => "Oman",
				 "Pakistan" => "Pakistan",
				 "Palau" => "Palau",
				 "Panama" => "Panama",
				 "Papua New Guinea" => "Papua New Guinea",
				 "Paraguay" => "Paraguay",
				 "Peru" => "Peru",
				 "Philippines" => "Philippines",
				 "Pitcairn" => "Pitcairn",
				 "Poland" => "Poland",
				 "Portugal" => "Portugal",
				 "Puerto Rico" => "Puerto Rico",
				 "Qatar" => "Qatar",
				 "Reunion" => "Reunion",
				 "Romania" => "Romania",
				 "Russian Federation" => "Russian Federation",
				 "Rwanda" => "Rwanda",
				 "S. Georgia and S. Sandwich Isls." => "S. Georgia and S. Sandwich Isls.",
				 "Saint Kitts and Nevis" => "Saint Kitts and Nevis",
				 "Saint Lucia" => "Saint Lucia",
				 "Saint Vincent and the Grenadines" => "Saint Vincent and the Grenadines",
				 "Samoa" => "Samoa",
				 "San Marino" => "San Marino",
				 "Sao Tome and Principe" => "Sao Tome and Principe",
				 "Saudi Arabia" => "Saudi Arabia",
				 "Senegal" => "Senegal",
				 "Seychelles" => "Seychelles",
				 "Sierra Leone" => "Sierra Leone",
				 "Singapore" => "Singapore",
				 "Slovak Republic" => "Slovak Republic",
				 "Slovenia" => "Slovenia",
				 "Solomon Islands" => "Solomon Islands",
				 "Somalia" => "Somalia",
				 "South Africa" => "South Africa",
				 "Spain" => "Spain",
				 "Sri Lanka" => "Sri Lanka",
				 "St. Helena" => "St. Helena",
				 "St. Pierre and Miquelon" => "St. Pierre and Miquelon",
				 "Sudan" => "Sudan",
				 "Suriname" => "Suriname",
				 "Svalbard and Jan Mayen Islands" => "Svalbard and Jan Mayen Islands",
				 "Swaziland" => "Swaziland",
				 "Sweden" => "Sweden",
				 "Switzerland" => "Switzerland",
				 "Syria" => "Syria",
				 "Taiwan" => "Taiwan",
				 "Tajikistan" => "Tajikistan",
				 "Tanzania" => "Tanzania",
				 "Thailand" => "Thailand",
				 "Togo" => "Togo",
				 "Tokelau" => "Tokelau",
				 "Tonga" => "Tonga",
				 "Trinidad and Tobago" => "Trinidad and Tobago",
				 "Tunisia" => "Tunisia",
				 "Turkey" => "Turkey",
				 "Turkmenistan" => "Turkmenistan",
				 "Turks and Caicos Islands" => "Turks and Caicos Islands",
				 "Tuvalu" => "Tuvalu",
				 "Ukraine" => "Ukraine",
				 "United Arab Emirates" => "United Arab Emirates",
				 "United Kingdom" => "United Kingdom",
				 "United States" => "United States",
				 "Uruguay" => "Uruguay",
				 "US Minor Outlying Islands" => "US Minor Outlying Islands",
				 "USSR (former)" => "USSR (former)",
				 "Uzbekistan" => "Uzbekistan",
				 "Vanuatu" => "Vanuatu",
				 "Vatican City State (Holy See)" => "Vatican City State (Holy See)",
				 "Venezuela" => "Venezuela",
				 "Viet Nam" => "Viet Nam",
				 "Virgin Islands (British)" => "Virgin Islands (British)",
				 "Virgin Islands (U.S.)" => "Virgin Islands (U.S.)",
				 "Wallis and Futuna Islands" => "Wallis and Futuna Islands",
				 "Western Sahara" => "Western Sahara",
				 "Yemen" => "Yemen",
				 "Yugoslavia" => "Yugoslavia",
				 "Zaire" => "Zaire",
				 "Zambia" => "Zambia",
				 "Zimbabwe" => "Zimbabwe"
		);
		return $countries;
	}	
	# function to generate titles
	function getGenders() {
		$genders = array(
		"Male" => "Male",		
		"Female" => "Female",
		);
		return $genders;
	}
	
	# function to generate all fuel tank levels
	function getAllTankLevels() {
		$levels = array(
		"full" => "Full",		
		"sa3_4" => "Slightly Above &frac34;",
		"3_4" => "&frac34;",
		"sb3_4" => "Slightly Below &frac34;",
		"sa1_2" => "Slightly Above &frac12;",
		"1_2" => "&frac12;",
		"sb1_2" => "Slightly Below &frac12;",
		"sa1_4" => "Slightly Above &frac14;",
		"1_4" => "&frac14;",
		"sb1_4" => "Slightly Below &frac14;",
		"reserve" => "Reserve",
		"empty" => "Empty"
		);
		return $levels;
	}
	
	# function to generate tribes
	function getAllTribes() {
		$query = "SELECT id AS optionvalue, tribe AS optiontext FROM tribe ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get guards who are drivers
	function getAllDrivers() {
		$query = "SELECT g.guardid AS optionvalue, concat(p.firstname,' ', p.lastname,' ', p.othernames,' ', p.birthlastname) AS optiontext FROM persons p INNER JOIN guards g ON (p.id=g.personid) JOIN jobtitles j WHERE g.jobtitle=j.id AND j.id='1' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get guards who are car commanders
	function getAllCommanders() {
		$query = "SELECT g.guardid AS optionvalue, concat(p.firstname,' ', p.lastname,' ', p.othernames,' ', p.birthlastname) AS optiontext FROM persons p INNER JOIN guards g ON (p.id=g.personid) JOIN jobtitles j WHERE g.jobtitle=j.id AND j.id='2' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to generate districts of Uganda
	function getAllDistricts() {
		$query = "SELECT id AS optionvalue, district AS optiontext FROM district ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	
	# function to generate all rights
	function getAllRights() {
		$query = "SELECT id AS optionvalue, rightname AS optiontext FROM rights ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all actions taken on personnels
	function getAllActions() {
		$query = "SELECT id AS optionvalue, name AS optiontext FROM actions ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all the equipment types
	function getAllEquipmentTypes() {
		$query = "SELECT name AS optionvalue, name AS optiontext FROM equipmentdetails WHERE type='Type' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all finance categories
	function getAllFinanceCategories($type){
		$query = "SELECT id AS optionvalue, category AS optiontext FROM financecategories WHERE type='".$type."' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all the equipment types
	function getAllEquipmentStatus() {
		$query = "SELECT name AS optionvalue, name AS optiontext FROM equipmentdetails WHERE type='Status' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all the item serial numbers 
	function getAllItemSerials() {
		$query = "SELECT serialno AS optionvalue, serialno AS optiontext FROM equipment WHERE instore='Y' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all the item serial numbers for issueing items
	function getAllItemSerialsForIssue($itemtype) {
		$query = "SELECT serialno AS optionvalue, serialno AS optiontext FROM equipment WHERE instore='Y' AND type = '".$itemtype."' ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	
	# function to get all the item serial numbers for returning items
	function getAllItemSerialsForReturn($itemtype) {
		//$query = "SELECT i.serialno AS optionvalue, i.serialno AS optiontext FROM itemissue i, equipment e WHERE i.type='issue' AND e.type = '".$itemtype."' ORDER BY optiontext";
		$arrayofserials = array();
		$result = mysql_query("SELECT serialno FROM equipment WHERE instore <> 'Y' AND type = '".$itemtype."' ORDER BY serialno");
		echo "SELECT serialno FROM equipment WHERE instore <> 'Y' AND type = '".$itemtype."' ORDER BY optiontext<br><br>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$result2 = mysql_query("SELECT * FROM itemissue WHERE type = 'issue' AND serialno = '".$row['serialno']."'");
			echo "SELECT * FROM itemissue WHERE type = 'issue' AND serialno = '".$row['serialno']."'";
			if(mysql_num_rows($result2) > 0){
				$arrayofserials[$row['serialno']] = $row['serialno'];
			}
		}
		
		//return getOptionValuesFromDatabaseQuery($query);
		return $arrayofserials;
	}
	
	# function to get all Illness for guards
	function getAllIllness() {
		$query = "SELECT id AS optionvalue, name AS optiontext FROM illness ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}
	/*# Returns all status of the guard for display
	function getAllGuardStatus(){
		$query = "SELECT state AS optionvalue, state AS optiontext FROM state ORDER BY optiontext";
		return getOptionValuesFromDatabaseQuery($query);
	}*/
	# function to return the appropriate date format array for display in a drop down
	# The type specifies which results are sent; days,months or years
	# The value set determines the values sent in the results, e.g., if the it birthday, you return 
	# values 18 years from the current year and 100 years earlier
	function getTime($type,$valueset){
		if($type == "day"){
			return getAllMonthDays();
		
		} else if($type == "month"){
			return getAllMonths("3");
		
		} else if($type == "year"){
			$valuesarray = array();
			// If birthday years are to be returned
			if($valueset == "bd"){
				$startyr = date("Y") - 18;
				$endyr = $startyr - 100;
				for($i=$startyr; $i>$endyr; $i--){
					$valuesarray[$i]	= $i;
				}
			// If value set is normal but showing years backwards current first
			} else if($valueset == "nbc"){
				$startyr = date("Y");
				$endyr = $startyr - 100;
				for($i=$startyr; $i>$endyr; $i--){
					$valuesarray[$i]	= $i;
				}
			// If value set it normal but showing years backwards old years first
			} else if($valueset == "nbo"){
				$endyr = date("Y") + 1;
				$startyr = $endyr - 100;
				
				for($i=$startyr; $i<$endyr; $i++){
					$valuesarray[$i]	= $i;
				}
			// If value set it normal but showing years ahead
			} else if($valueset == "na"){
				$startyr = date("Y");
				$endyr = $startyr + 100;
				
				for($i=$startyr; $i<$endyr; $i++){
					$valuesarray[$i]	= $i;
				}
			}
			
			return $valuesarray;
		}
	}
	
	
?>
