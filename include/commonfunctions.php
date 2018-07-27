<?php
	include_once 'constants.php';
	include_once 'checkboxes.php';
	include_once 'dropdowns.php';
	session_start();
	
	# add mysql query
	function executeQuery($query) {
		openDatabaseConnection();		
		# save transaction details
		$result = mysql_query($query) or die("Invalid query: " . mysql_error());
		return $result;
	}

	# open a connection to the database
	function openDatabaseConnection() {
		# open connection to MySQL database
		$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)
			or die("Could not connect to the SQL database server help");
		mysql_select_db(MYSQL_DATABASE) or die("Could not connect to the SQL database server");
	}

	# Return an array containing the data for a row from the speicifed table
	# and the specified id.
	function getRowAsArray($query) {
		openDatabaseConnection();
		$result = mysql_query($query) or die("Invalid query: " . mysql_error());
		# turn the result into an array
		return mysql_fetch_assoc($result);
	}
	
	/*
	 * Return whether or not the username already exists.
	 */
	 function hasUsername($formvalues) {
		openDatabaseConnection();		
		$usernamequery = "SELECT * FROM employee WHERE (username='".$formvalues['username']."' OR emailaddress='".$formvalues['emailaddress']."')";
		$usernameresult = mysql_query($usernamequery);
		# handle the query execution error gracefully
		if (mysql_error() != "") {
			# database errors occured
			$error_msg = "A system error occured, please try again";
		}else {
			if (mysql_num_rows($usernameresult) == 0) {
				$error_msg = "";
			}else{
				$error_msg = "The username <b>'".$formvalues['username']."'</b> or email address <b>'".$formvalues['emailaddress']."'</b> is already in use, please select another one.";
			}
		}
		return $error_msg;
	 }

	# function to check whether a user trying to access a page is an admin user
	function isAdminUser($userstatus) {
		if ($userstatus == 'Y') {	
			return true;
		}
		return false;
	}
	
	function hasChangedPassword($userstatus) {
		if ($userstatus == 'Y') {	
			return true;
		}
		return false;
	}


	# function to generate jvascript code to forward the user to the specified page.
	function forwardToPage($page) {
		echo "<script language=\"javascript\" type=\"text/javascript\">
			document.location.href = \"".$page."\"</script>";
	}
	
	# function to check whether a user is logged in
	function isLoggedIn($userid) {
		if (trim($userid) == "") {
			return false;
		}
		return true;
	}
	
	
	# Function to transform a date from MySQL database Format (yyyy-mm-dd) to the format displayed on pages(mm/dd/yyyy).
	# If the date from the database is NULL, it is transformed to an empty string for display on the pages 
	function changeMySQLDateToPageFormat($mysqldate) {		
		if($mysqldate == NULL) {
			$pagedate = "";
		} else {
			$pagedate = date("m/d/Y", strtotime($mysqldate));
		}
		return $pagedate;	
	}
	# Function to transform a date from the format displayed on pages(mm/dd/yyyy) to the MySQL database date format (yyyy-mm-dd).
	# If the date from the database is an empty string, it is transformed to a NULL value. Note that single quotation marks are added to
	# the non-empty date. 
	function changeDateFromPageToMySQLFormat($pagedate) {	
		if (trim($pagedate)== "") {
			$mysqldate = "NULL";
		} else {
			$mysqldate = date("Y-m-d", strtotime($pagedate));
		}		
		return $mysqldate;	
	}
	
	# Function to collect date values from day, month and year drop downs and save as one date	
	function changeDateFromPageCombosToMySQLFormat($day, $month, $year) {	
		$pagedate = $day."-".$month."-".$year;
		//There is no day, month or year selected
		if (trim($day)== "" || trim($month)== "" || trim($year)== "") {
			$mysqldate = "0000-00-00";
		} else {
			$mysqldate = "'".date("Y-m-d", strtotime($pagedate))."'";
		}		
		return $mysqldate;	
	}
	
	# Function to collect date values from month and year drop downs and save as one date	
	function changeShortDateFromPageCombosToMySQLFormat($month, $year) {	
		$pagedate = $month."-".$year;
		//There is no month or year selected
		if (trim($month)== "" || trim($year)== "") {
			$mysqldate = "0000-00-00";
		} else {
			$mysqldate = "'".date("Y-m-d", strtotime($pagedate))."'";
		}		
		return $mysqldate;	
	}
	
	# Returns Yes and No from the binary Y and N
	function changeBinaryToPageValues($binary) {
		if (trim($binary) == "Y") {
			return "Yes";
		}
		return "No";
	}
	
	# Returns Y and N from the pagevalues Yes and No
	function changePageValuesToBinary($pagevalue) {
		if (trim($pagevalue) == "Yes") {
			return "Y";
		}
		return "N";
	}


	# Function to obtain a comma delimited string from an array
	function getListFromArray($array){
		$arraystring = "";
		foreach($array as $value) {
			$arraystring .= ",".$value;
		}
		
		$arraystring = substr($arraystring,1);
		return $arraystring;
	}


	#Function to obtain an array from a comma delimited list
	function getArrayFromList($string) {
		$i = 0;
		#remove all leading and trailing spaces
		$string = trim($string);
		#find the first ocurrence of a comma
		$pos = strpos($string, ",");
		while(!($pos === false)) {
			#set the new starting position
			$firstpos = $pos + 1;
			#if the string is in the second position, set the first array value
			$lastpos = $pos;
			$array[$i] = substr($string, 0, $lastpos);		
			#reduce the string to start from the new starting position. $firstpos
			$string = substr($string, $firstpos);		
			$string = trim($string);
			#locate the first occurence of a comma in the string
			$pos = strpos($string, ",");
			$i++;
	
		}
		$array[$i] = $string;
		return $array;
	}

// Returns the number of rows in a query to the database
function howManyRows($query){
	$result = mysql_query($query);
	return mysql_num_rows($result);
}

// Function to save addresses from the passed information
function saveAddress($formvalues, $prefix){
	
		if(isset($formvalues[$prefix.'addressupdateid'])){
			$query = "UPDATE places SET name = '".$formvalues[$prefix.'name']."', telephone = '".$formvalues[$prefix.'tel']."', village =  '".$formvalues[$prefix.'village']."', subcounty = '".$formvalues[$prefix.'subcounty']."', county = '".$formvalues[$prefix.'county']."', parish = '".$formvalues[$prefix.'parish']."', town = '".$formvalues[$prefix.'town']."', district = '".$formvalues[$prefix.'district']."', plotnumber = '".$formvalues[$prefix.'plotno']."', lc1chairman = '".$formvalues[$prefix.'lc1cm']."', lc1telephone = '".$formvalues[$prefix.'lc1tel']."', lc2chairman = '".$formvalues[$prefix.'lc2cm']."', lc2telephone = '".$formvalues[$prefix.'lc2tel']."', lastupdatedby = ".$_SESSION['userid'].", lastupdatedate = now() WHERE id = '".$formvalues[$prefix.'addressupdateid']."'";
			
		} else {
			$query = "INSERT INTO places (name, telephone, village, subcounty, county, parish, town, district, plotnumber, lc1chairman, lc1telephone, lc2chairman, lc2telephone, createdby, datecreated) VALUES ('".$formvalues[$prefix.'name']."', '".$formvalues[$prefix.'tel']."', '".$formvalues[$prefix.'village']."', '".$formvalues[$prefix.'subcounty']."', '".$formvalues[$prefix.'county']."', '".$formvalues[$prefix.'parish']."', '".$formvalues[$prefix.'town']."', '".$formvalues[$prefix.'district']."', '".$formvalues[$prefix.'plotno']."', '".$formvalues[$prefix.'lc1cm']."', '".$formvalues[$prefix.'lc1tel']."', '".$formvalues[$prefix.'lc2cm']."', '".$formvalues[$prefix.'lc2tel']."', ".$_SESSION['userid'].", NOW())";
		
		}
		
		$result = mysql_query($query);
		$addressid = "";
		# check if any errors have occured during the saving the activities to the database
		if (mysql_error() == "") {
			# no errors occured, so return the last inserted id
			$addressid = mysql_insert_id();
			
			if(isset($formvalues[$prefix.'addressupdateid'])){
				$addressid = $formvalues[$prefix.'addressupdateid'];
			}
		} else {
			# add the error message to the string
			$_SESSION['error'] = "ERROR: Couldnot insert address for ".$formvalues[$prefix.'village'].". Please try again. DETAILS: ".mysql_error();
		}
		return $addressid;
	
}

// Function to save a person's data from the passed information
function savePerson($formvalues, $prefix){
	if($formvalues[$prefix.'firstname'] != ""){
		if(isset($formvalues[$prefix.'personupdateid'])){
			$query = "UPDATE persons  SET firstname = '".ucfirst($formvalues[$prefix.'firstname'])."', lastname = '".ucfirst($formvalues[$prefix.'lastname'])."', othernames = '".ucfirst($formvalues[$prefix.'othernames'])."', birthlastname = '".$formvalues[$prefix.'birthlastname']."', nationality = '".$formvalues[$prefix.'nationality']."', tribe = '".$formvalues[$prefix.'tribe']."', occupation = '".$formvalues[$prefix.'occupation']."', employer = '".$formvalues[$prefix.'employer']."', dateofbirth = ".changeDateFromPageCombosToMySQLFormat($formvalues[$prefix.'bday'], $formvalues[$prefix.'bmonth'], $formvalues[$prefix.'byear']).", birthplaceid = '".$formvalues[$prefix.'bplaceid']."', isalive = '".$formvalues[$prefix.'alive']."', addressid = '".$formvalues[$prefix.'addressid']."', homeid = '".$formvalues[$prefix.'homeaddressid']."', workplaceid = '".$formvalues[$prefix.'workaddressid']."', lastupdatedby = ".$_SESSION['userid'].", lastupdatedate = now() WHERE id = '".$formvalues[$prefix.'personupdateid']."'";
		
		} else {
			$query = "INSERT INTO persons (firstname, lastname, othernames, birthlastname, nationality, tribe, occupation, employer, dateofbirth, birthplaceid, isalive, addressid, homeid, workplaceid, createdby, datecreated) VALUES ('".$formvalues[$prefix.'firstname']."', '".$formvalues[$prefix.'lastname']."', '".$formvalues[$prefix.'othernames']."', '".$formvalues[$prefix.'birthlastname']."', '".$formvalues[$prefix.'nationality']."', '".$formvalues[$prefix.'tribe']."', '".$formvalues[$prefix.'occupation']."', '".$formvalues[$prefix.'employer']."', ".changeDateFromPageCombosToMySQLFormat($formvalues[$prefix.'bday'], $formvalues[$prefix.'bmonth'], $formvalues[$prefix.'byear']).", '".$formvalues[$prefix.'bplaceid']."', '".$formvalues[$prefix.'alive']."', '".$formvalues[$prefix.'addressid']."',  '".$formvalues[$prefix.'homeaddressid']."', '".$formvalues[$prefix.'workaddressid']."', ".$_SESSION['userid'].", NOW())";
		
		}
		
		$result = mysql_query($query);
		$addressid = "";
		# check if any errors have occured during the saving the activities to the database
		if (mysql_error() == "") {
			# no errors occured, so return the last inserted id
			$addressid = mysql_insert_id();
			
			if(isset($formvalues[$prefix.'personupdateid'])){
				$addressid = $formvalues[$prefix.'personupdateid'];
			}
		} else {
			# add the error message to the string
			$_SESSION['error'] = "ERROR: Couldnot insert person named ".$formvalues[$prefix.'firstname']." ".$formvalues[$prefix.'lastname'].". Please try again. DETAILS: ".mysql_error();
		}
		return $addressid;
	}
}

// Retturns the right value whether the person is alive or not
function isAlive($formvalues, $prefix){
	$value = "";
	if(isset($formvalues[$prefix.'isalive'])){
		$value = "Y";
	}
	
	if(isset($formvalues[$prefix.'isdead'])){
		$value = "N";
	}
	
	return $value;
}

// Function to save all children
// pointer array is used to determine the longest array to use when looping through all passed name values
function saveAllChildren($formvalues, $pointerarray){
	//echo "Number of children: ".count($pointerarray);
	$idarray = array();
	for($i=0; $i<count($formvalues[$pointerarray]); $i++){
		if($formvalues['childfname'][$i] != ""){
			
			if(isset($formvalues['childupdateid'][$i])){
				$query = "UPDATE children SET firstname = '".$formvalues['childfname'][$i]."', lastname = '".$formvalues['childlname'][$i]."', othernames = '".$formvalues['childoname'][$i]."',gender = '".$formvalues['childgender'][$i]."', age = '".$formvalues['childage'][$i]."', lastupdatedby = ".$_SESSION['userid'].", lastupdatedate = now() WHERE id = '".$formvalues['childupdateid'][$i]."'";
				
			} else {
				$query = "INSERT INTO children (firstname, lastname, othernames,gender, age, createdby, date_of_entry) VALUES ('".$formvalues['childfname'][$i]."', '".$formvalues['childlname'][$i]."', '".$formvalues['childoname'][$i]."', '".$formvalues['childgender'][$i]."', '".$formvalues['childage'][$i]."', ".$_SESSION['userid'].", NOW())";
			}
			
			$result = mysql_query($query);
			$childid = "";
			# check if any errors have occured during the saving the activities to the database
			if (mysql_error() == "") {
				# no errors occured, so return the last inserted id
				$childid = mysql_insert_id();
				
				if(isset($formvalues['childupdateid'][$i])){
					$childid = $formvalues['childupdateid'][$i];
				}
			} else {
				# add the error message to the string
				$_SESSION['errors'] = "ERROR: Couldnot insert children details. Please try again. DETAILS: ".mysql_error();
			}
	    	$idarray[$i] = $childid;
		}
	}
	
	return $idarray;
}

// Function to save all schools/qalifications of a given type
function saveAllSchools($formvalues, $type){
	$idarray = array();
	
	// Using the longest posible array
	for($i=0; $i<count($formvalues[$type."schname"]); $i++){
		if($formvalues[$type.'schname'][$i] != ""){
			
			if(isset($formvalues[$type."schupdateid"][$i])){
				$query = "UPDATE schools SET schoolname = '".$formvalues[$type.'schname'][$i]."', type = '".$type."', yearjoined = '".$formvalues[$type.'schstart'][$i]."', yearleft = '".$formvalues[$type.'schend'][$i]."', lastupdatedby = ".$_SESSION['userid'].", lastupdatedate = now() WHERE id = '".$formvalues[$type."schupdateid"][$i]."'";
			
			} else {
				$query = "INSERT INTO schools (schoolname, type, yearjoined, yearleft, createdby, date_of_entry) VALUES ('".$formvalues[$type.'schname'][$i]."', '".$type."', '".$formvalues[$type.'schstart'][$i]."', '".$formvalues[$type.'schend'][$i]."', ".$_SESSION['userid'].", NOW())";
			}
			
			$result = mysql_query($query);
			$schoolid = "";
			# check if any errors have occured during the saving the activities to the database
			if (mysql_error() == "") {
				# no errors occured, so return the last inserted id
				$schoolid = mysql_insert_id();
				
				if(isset($formvalues[$type."schupdateid"][$i])){
					$schoolid = $formvalues[$type."schupdateid"][$i];
				}
			} else {
				# add the error message to the string
				$_SESSION['error'] = "ERROR: Couldnot insert the details for ".$type.". Please try again. DETAILS: ".	mysql_error();
			}
	    	$idarray[$i] = $schoolid;
		}
	}
	
	return $idarray;
}

// Function to save all documents
function saveAllDocuments($formvalues){
	$idarray = array();
	
	// Using the longest posible array
	for($i=0; $i<count($formvalues["documentname"]); $i++){
		if($formvalues['documentname'][$i] != ""){
			
			if(isset($formvalues["documentupdateid"][$i])){
				$query = "UPDATE guarddocuments SET documentname = '".$formvalues['documentname'][$i]."', referencenumber = '".$formvalues['referencenumber'][$i]."', addedby = ".$_SESSION['userid'].", lastupdated = now() WHERE id = '".$formvalues["documentupdateid"][$i]."'";
			
			} else {
				$query = "INSERT INTO guarddocuments (documentname, referencenumber, addedby, date_of_entry) VALUES ('".$formvalues['documentname'][$i]."','".$formvalues['referencenumber'][$i]."', ".$_SESSION['userid'].", NOW())";
			}
			
			$result = mysql_query($query);
			$schoolid = "";
			# check if any errors have occured during the saving the activities to the database
			if (mysql_error() == "") {
				# no errors occured, so return the last inserted id
				$document_id = mysql_insert_id();
				
				if(isset($formvalues["documentupdateid"][$i])){
					$document_id = $formvalues["documentupdateid"][$i];
				}
			} else {
				# add the error message to the string
				$_SESSION['error'] = "ERROR: Couldnot insert the details documents Please try again. DETAILS: ".	mysql_error();
			}
	    	$idarray[$i] = $document_id;
		}
	}
	
	return $idarray;
}


// Function to return all the experience ids 
function saveAllExperiences($formvalues, $experiencearray){
	$idstring = "";
	for($i=0; $i<count($experiencearray); $i++){
		if(isset($formvalues[substr($experiencearray[$i],0,-1)])){
			$startdatestring = $formvalues[$experiencearray[$i]."startmonth"]."-".$formvalues[$experiencearray[$i]."startyr"];
			$enddatestring = $formvalues[$experiencearray[$i]."endmonth"]."-".$formvalues[$experiencearray[$i]."endyr"];
			// convert dates into mysql format
			$startdatestring = str_replace("-"," ",$startdatestring);
			$enddatestring = str_replace("-"," ",$enddatestring);
			
			$startdate = date("Y-m-d h:i:s", strtotime($startdatestring));
			$enddate = date("Y-m-d h:i:s", strtotime($enddatestring));
			
			if(isset($formvalues[$experiencearray[$i]."updateid"])){
			$query = "UPDATE experiences SET type = '".$experiencearray[$i]."', startdate = '".$startdate."', enddate = '".$enddate."' WHERE id = '".$formvalues[$experiencearray[$i]."updateid"]."'"; 
			} else {
				$query = "INSERT INTO experiences (type, startdate, enddate, createdby, date_of_entry) VALUES ('".$experiencearray[$i]."', '".$startdate."', '".$enddate."', ".$_SESSION['userid'].", NOW())";
			}
			
			$result = mysql_query($query);
			# check if any errors have occured during the saving the activities to the database
			if (mysql_error() == "") {
				# no errors occured, so return the last inserted id
				$id = mysql_insert_id();
				if(isset($formvalues[$experiencearray[$i]."updateid"])){
					$id = $formvalues[$experiencearray[$i]."updateid"];
				}
				if($idstring == ""){
					$idstring  = $id;
				} else {
					$idstring  .= ",".$id;
				}
			} else {
				# add the error message to the string
				$_SESSION['errors'] = "ERROR: Couldnot insert the details for experiences. Please try again. DETAILS: ".	mysql_error();
			}
	    	mysql_free_result($result);
		}
	}
	return $idstring;
}

// Function to return all the uniform ids 
function saveAllUniforms($formvalues, $uniformsarray){
	$idstring = "";
	for($i=0; $i<count($uniformsarray); $i++){
		if(isset($formvalues[substr($uniformsarray[$i],0,-1)])){
			$number = $formvalues[$uniformsarray[$i]."number"];
			
			if(isset($formvalues[$uniformsarray[$i]."updateid"])){
				$query = "UPDATE uniform SET uniformtype = '".$uniformsarray[$i]."', number = '".$number."'  WHERE id = '".$formvalues[$uniformsarray[$i]."updateid"]."'";
			} else {
				$query = "INSERT INTO uniform SET uniformtype = '".$uniformsarray[$i]."', number = '".$number."', createdby = ".$_SESSION['userid'].", date_of_entry = NOW() ";
			}
			
			$result = mysql_query($query);
			# check if any errors have occured during the saving the activities to the database
			if (mysql_error() == "") {
				# no errors occured, so return the last inserted id
				$id = mysql_insert_id();
				if(isset($formvalues[$uniformsarray[$i]."updateid"])){
					$id = $formvalues[$uniformsarray[$i]."updateid"];
				}
				if($idstring == ""){
					$idstring  = $id;
				} else {
					$idstring  .= ",".$id;
				}
			} else {
				# add the error message to the string
				$_SESSION['errors'] = "ERROR: Couldnot insert the details for uniforms. Please try again. DETAILS: ".	mysql_error();
			}
	    	mysql_free_result($query);
		}
	}
	return $idstring;
}


// Function to save all previous employers and return their ids
function saveAllEmployers($formvalues, $type){
	$idstring = "";
	$pointerarray = $type."name";

	for($i=0; $i<count($formvalues[$pointerarray]); $i++){
		if(isset($formvalues[$pointerarray][$i])){
			
			if(isset($formvalues[$type.'updateid'][$i])){
				$query = "UPDATE ".$type."s SET name = '".$formvalues[$type.'name'][$i]."', telephone = '".$formvalues[$type.'tel'][$i]."', physicaladdress = '".$formvalues[$type.'physicaladd'][$i]."', ";
			
				if($type == "employer"){
					$query .= "position = '".$formvalues['position'][$i]."', startdate = '".$formvalues['startemployment'][$i]."', enddate = '".$formvalues['endemployment'][$i]."', ";
				}
				$query .= "lastupdatedby = ".$_SESSION['userid'].", lastupdatedate = now() WHERE id = '".$formvalues[$type.'updateid'][$i]."'";
				
			} else {
				$query = "INSERT INTO ".$type."s (name, telephone, physicaladdress, ";
			
				if($type == "employer"){
					$query .= "position, startdate, enddate, ";
				}
				$query .= "createdby, date_of_entry) VALUES ('".$formvalues[$type.'name'][$i]."', '".$formvalues[$type.'tel'][$i]."', '".$formvalues[$type.'physicaladd'][$i]."', ";
			
				if($type == "employer"){
					$query .= "'".$formvalues['position'][$i]."', '".$formvalues['startemployment'][$i]."', '".$formvalues['endemployment'][$i]."', ";
				}
				$query .= $_SESSION['userid'].", NOW())";
			}
			
			$result = mysql_query($query);
			$id = "";
			# check if any errors have occured during the saving the activities to the database
			if (mysql_error() == "") {
				# no errors occured, so return the last inserted id
				$id = mysql_insert_id();
				
				if(isset($formvalues[$type.'updateid'][$i])){
					$id = $formvalues[$type.'updateid'][$i];
				}
				if($idstring == ""){
					$idstring  = $id;
				} else {
					$idstring  .= ",".$id;
				}
			} else {
				# add the error message to the string
				$_SESSION['errors'] = "ERROR: Couldnot insert the details for previous ".$type."s. Please try again. DETAILS: ".	mysql_error();
			}
		}
	}
	return $idstring;
}

//To save the landlord details as a referee
function saveLandLord($formvalues){
	if(isset($formvalues['landlord_updateid'])){
		$query = "UPDATE referees SET name = '".$formvalues['landlord_name']."', telephone = '".$formvalues['landlord_tel']."', physicaladdress = '".$formvalues['landlord_physicaladd']."', lastupdatedby = ".$_SESSION['userid'].", lastupdatedate = now() WHERE id = '".$formvalues['landlord_updateid']."'";
		
	} else {
		$query = "INSERT INTO referees (name, telephone, physicaladdress, createdby, date_of_entry) VALUES ('".$formvalues['landlord_name']."', '".$formvalues['landlord_tel']."', '".$formvalues['landlord_physicaladd']."', '".$_SESSION['userid']."', now())";
	}
	
	$result = mysql_query($query);
	$id = "";
	# check if any errors have occured during the saving the activities to the database
	if (mysql_error() == "") {
		# no errors occured, so return the last inserted id
		$id = mysql_insert_id();
		if(isset($formvalues['landlord_updateid'])){
			$id = $formvalues['landlord_updateid'];
		}
	} else {
		# add the error message to the string
		$_SESSION['error'] = "ERROR: Couldnot insert the details for previous ".$type."s. Please try again. DETAILS: ".	mysql_error();
	}
	
	return $id;
}

// Function to upload a photo to a specified directory
function uploadPhoto($tempname, $imagesrc, $actualsize, $maxfilesize, $error, $uploaddir){
	// Create a directory for the photo, if the directory doesn't exist
	// Note that the default mode 0777 gives the widest possible access.
	mkdir(str_replace('/',DIRECTORY_SEPARATOR,$uploaddir),null,true);
	
	// Array of allowed extensions
	$extensions = array(".jpeg", ".gif", ".jpg");
	// This checks the size or the image and extension. Returns an Error if the image is greater than 2MB 
	if($tempname != ""){
		// and not good file extension	
		$filename_extension = strtolower(getFileNameExtension($imagesrc));
	
		if (($error > 0) || ($actualsize > $maxfilesize) || (!in_array($filename_extension, $extensions) && $filename_extension != "")) {
		
			if($error > 0) { $_SESSION['error'] = "There was an error uploading your photo file. Please try again.";}
		
			if($actualsize > $maxfilesize) { $_SESSION['error'] = "The size of your photo exceeds 2MB. Please upload a photo with a size less than 2MB.";}
		
			if(!in_array($filename_extension, $extensions) && $filename_extension != "") { $_SESSION['errors'] = "The file type you have uploaded is not allowed. Please use JPEG or GIF formats";}
		
			$_SESSION['formvalues'] = $formvalues; 
	
		}  else {
			// CLEAN THE FILE NAME: Replace White Spaces in file name, then strip file_name of slashes and quotes
			$file_name = str_replace("'","",stripslashes(str_replace(" ","_",$imagesrc)));
        	//Generate a unique System File Name
			$systemName = time().$file_name; 
		
        	// is_uploaded_file and move_uploaded_file added at version 4.0.3
       	 	if (is_uploaded_file($tempname)) {
            	if (!move_uploaded_file($tempname, $uploaddir.$systemName)){
               		$_SESSION['error'] = 'ERROR: Could not move file to destination directory';
            	}
         	} else {
            	$_SESSION['error'] =  'WARNING: The photo you are uploading was already uploaded. Filename: '.$imagesrc;
         	}

		 	return $uploaddir.$systemName;
		}
	} else {
		return "";
	}
	
}

//For uploading files
function uploadfile($userfile,$userfile_name,$userfile_size,$maxfilesize,$userfile_error,$folder)
{
	// Create a directory for the photo, if the directory doesn't exist
	// Note that the default mode 0777 gives the widest possible access.
	mkdir(str_replace('/',DIRECTORY_SEPARATOR,$folder),null,true);
	
	// Array of allowed extensions
	$extensions = array(".doc", ".pdf", ".xls");
	// This checks the size or the image and extension. Returns an Error if the file
	// is greater than the set max file size 
	if($userfile != ""){
		// and not good file extension	
		$filename_extension = strtolower(getFileNameExtension($userfile_name));
	
		if (($userfile_error > 0) || ($userfile_size > $maxfilesize) || (!in_array($filename_extension, $extensions) && $filename_extension != "")) {
		
			if($userfile_error > 0) { $_SESSION['error'] = "There was an error uploading your photo file. Please try again.";}
		
			if($actualsize > $maxfilesize) { $_SESSION['error'] = "The size of your photo exceeds the maximum file size. Please upload a photo with a size less than the maximum file size stated on the form.";}
		
			if(!in_array($filename_extension, $extensions) && $filename_extension != "") { $_SESSION['errors'] = "The file type you have uploaded is not allowed. Please use DOC, PDF or XLS formats";}
		
			$_SESSION['formvalues'] = $formvalues; 
	
		}  else {
			// CLEAN THE FILE NAME: Replace White Spaces in file name, then strip file_name
			// of slashes and quotes
			$file_name = str_replace("'","",stripslashes(str_replace(" ","_",$userfile_name)));
        	//Generate a unique System File Name
			$systemName = time().$file_name; 
		
        	// is_uploaded_file and move_uploaded_file added at version 4.0.3
       	 	if (is_uploaded_file($userfile)) {
            	if (!move_uploaded_file($userfile, $folder.$systemName)){
               		$_SESSION['error'] = 'ERROR: Could not move file to destination directory';
            	}
         	} else {
            	$_SESSION['error'] =  'WARNING: The file you are uploading was already uploaded. Filename: '.$userfile_name;
         	}

		 	return $folder.$systemName;
		}
	} else {
		return "";
	}
}

// Function to return an extension
function getFileNameExtension($imagename){
	// Return last position of the period in the file name
	$periodpos = strrpos($imagename, ".");
	return substr($imagename, $periodpos, strlen($imagename));
}

// function to return a list of rights\
function showRightsList($selected_array){
	$right_count = 0;
	foreach(getAllRights() as $key => $value) {
		
		$optionsHTML .= "<br /><INPUT type='checkbox' name='rights[]' id='rights".$right_count."' value='".$key."'";
		if(in_array($key, $selected_array)){
			$optionsHTML .= " checked";
		}
		$optionsHTML .= "> ".$value;
		
		$right_count++;
	}
	
	return $optionsHTML;
}

// Function to authenticate the user
function authenticateUser($id,$usergroup){
	openDatabaseConnection();
	if(howManyRows("SELECT * FROM users WHERE id = '".$id."' AND usergroup = '".$usergroup."'") == 0){
		forwardToPage('../core/logout.php');
	}
}

//Creates a comma delimited string of a number
function commify ($str) { 
   $n = strlen($str); 
   if ($n <= 3) { 
      $return=$str;
   }else { 
       $pre=substr($str,0,$n-3); 
       $post=substr($str,$n-3,3); 
       $pre=number_format($pre); 
       $return="$pre,$post"; 
   }
   return($return); 
}

//Function to get the number of leave days for the guard
function getGuardLeaveDays($guardid,$startdate,$enddate){
	$result = mysql_query("SELECT * FROM guardschedule");
	$leavedays = 0;
	
	//Put all data into arrays if they are in between those dates specified
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
		if((strtotime($line['dateentered']) >= strtotime(trim($startdate,"'"))) && (strtotime($line['dateentered']) <= strtotime(trim($enddate,"'")))){
			$schedulearray = split(",",$line['schedule']);
			//Get all known guard statuses
			$statusarr = getAllScheduleStatus();
			
			for($i=0;$i<count($schedulearray);$i++){
				$assgnarr = split("=",$schedulearray[$i]);
				if($assgnarr[1] == "Leave" && $assgnarr[0] == $guardid){
					$leavedays++;
				}
			}
		}
	}
	return $leavedays;
}


//Get all vehicle mobile numbers
function getVehicleLog(){
	$result = mysql_query("SELECT mobile FROM logbook");
	$logbookarr = array();
	$counter = 0;
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
		$logbookarr[$counter] = $line['mobile'];
		$counter++;
	}
	return $logbookarr;
}

// function to get the total amount of money the guard is to be paid
function getGuardCharge($guardid,$startdate,$enddate){
	$result = mysql_query("SELECT * FROM guardschedule");
	$scheduledays = 0;
	
	//Put all data into arrays if they are in between those dates specified
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
		//Set payment dates if they are not set
		if(trim($startdate) == ""){
			$datearray = getRowAsArray("SELECT lastpaymentdate, dateofemployment FROM guards WHERE guardid='".$guardid."'");
			if($datearray['lastpaymentdate'] != ""){
				$startdate = $datearray['lastpaymentdate'];
			} else {
				$startdate = $datearray['dateofemployment'];
			}
		}
		
		//Give it the current date if it has not been set yet
		if(trim($enddate) == ""){
			$enddate = date("d-M-Y");
		}
		
		if((strtotime($line['dateentered']) >= strtotime(trim($startdate,"'"))) && (strtotime($line['dateentered']) <= strtotime(trim($enddate,"'")))){
			$schedulearray = split(",",$line['schedule']);
			//Get all known guard statuses
			$statusarr = getAllScheduleStatus();
			
			for($i=0;$i<count($schedulearray);$i++){
				$assgnarr = split("=",$schedulearray[$i]);
				if(!in_array($assgnarr[1],$statusarr) && $assgnarr[0] == $guardid && $assgnarr[1] != ""){
					$scheduledays++;
				}
			}
		}
	}
	
	//Return the amount to be paid to the guard for regular work done
	$guard = getRowAsArray("SELECT rate FROM guards WHERE guardid='".$guardid."'");
	
	return $scheduledays*$guard['rate'];
}
//Function used to read out number in words e.g 24 twenty four as out put
function num2words($num, $c=0) {
   $ZERO = 'zero';
   $MINUS = 'minus';
   $lowName = array(
         /* zero is shown as "" since it is never used in combined forms */
         /* 0 .. 19 */
         "", "One", "Two", "Three", "Four", "Five",
         "Six", "Seven", "Eight", "Nine", "Ten",
         "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen",
         "Sixteen", "Seventeen", "Eighteen", "Nineteen");
  
   $tys = array(
         /* 0, 10, 20, 30 ... 90 */
         "", "", "Twenty", "Thirty", "Forty", "Fifty",
         "Sixty", "Seventy", "Eighty", "Ninety");
  
   $groupName = array(
         /* We only need up to a quintillion, since a long is about 9 * 10 ^ 18 */
         /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
         "", "Hundred", "Thousand", "Million", "Billion",
         "Trillion", "Quadrillion", "Quintillion");
  
   $divisor = array(
         /* How many of this group is needed to form one of the succeeding group. */
         /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
         100, 10, 1000, 1000, 1000, 1000, 1000, 1000) ;
  
   $num = str_replace(",","",$num);
   $num = number_format($num,2,'.','');
   $cents = substr($num,strlen($num)-2,strlen($num)-1);
   $num = (int)$num;
  
   $s = "";
  
   if ( $num == 0 ) $s = $ZERO;
   $negative = ($num < 0 );
   if ( $negative ) $num = -$num;
   // Work least significant digit to most, right to left.
   // until high order part is all 0s.
   for ( $i=0; $num>0; $i++ ) {
       $remdr = (int)($num % $divisor[$i]);
       $num = $num / $divisor[$i];
       // check for 1100 .. 1999, 2100..2999, ... 5200..5999
       // but not 1000..1099,  2000..2099, ...
       // Special case written as fifty-nine hundred.
       // e.g. thousands digit is 1..5 and hundreds digit is 1..9
       // Only when no further higher order.
       if ( $i == 1 /* doing hundreds */ && 1 <= $num && $num <= 5 ){
           if ( $remdr > 0 ){
               $remdr = ($num * 10);
               $num = 0;
           } // end if
       } // end if
       if ( $remdr == 0 ){
           continue;
       }
       $t = "";
       if ( $remdr < 20 ){
           $t = $lowName[$remdr];
       }
       else if ( $remdr < 100 ){
           $units = (int)$remdr % 10;
           $tens = (int)$remdr / 10;
           $t = $tys [$tens];
           if ( $units != 0 ){
               $t .= "-" . $lowName[$units];
           }
       }else {
           $t = num2words($remdr, 0);
       }
       $s = $t." ".$groupName[$i]." ".$s;
       $num = (int)$num;
   } // end for
   $s = trim($s);
   if ( $negative ){
       $s = $MINUS . " " . $s;
   }
  
   if ($c == 1) $s .= " and $cents/100";
  
   return $s;
}

//Gets the difference between two dates in number of days
function getDayDifference($startdate,$forcestart,$enddate,$forceend){
	//Get the dates within the assignment days
	if(strtotime($forcestart) > strtotime($startdate) && ($forcestart != "" || $forcestart != "0000-00-00" || $forcestart != "0000-00-00 00:00:00")){
		$startdate = $forcestart;
	}
	if(strtotime($forceend) < strtotime($enddate) && ($forceend != "" || $forceend != "0000-00-00" || $forceend != "0000-00-00 00:00:00")){
		$enddate = $forceend;
	}
	
	$start_array = localtime(strtotime($startdate),true);
	$end_array = localtime(strtotime($enddate), true);
	
	//Use days of the year to get the difference in days
	if($start_array['tm_year'] == $end_array['tm_year']){
		$diff = $end_array['tm_yday'] - $start_array['tm_yday'];
	} else {
		//Get the year and determine the days to the end of the year
		$date_array = split("-",$startdate);
		$temp_end_array = localtime(strtotime("31-Dec-".$date_array[0]),true);
		// Diff days = days from start of new year + remaining days from previous year
		$diff = $end_array['tm_yday'] + ($temp_end_array['tm_yday']-$start_array['tm_yday']);
	}
	return array($diff,$startdate,$enddate);
}

//Gets the difference between two times in hours
function getHourDifference($starttime,$endtime){
	$start_array = split(":",$starttime);
	$end_array = split(":",$endtime);
	
	//Use the array elements to get the time in hours
	$diff = ($end_array[0] - $start_array[0]) + ($end_array[1] - $start_array[1])/60;
	
	return $diff;
}



//Function to get the guard overtime pay
function getGuardOvertimePay($guardid,$startdate,$enddate){
	$result = mysql_query("SELECT * FROM guardschedule");
	$scheduledays = 0;
	
	//Put all data into arrays if they are in between those dates specified
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
		//Set payment dates if they are not set
		if(trim($startdate) == ""){
			$datearray = getRowAsArray("SELECT lastpaymentdate, dateofemployment FROM guards WHERE guardid='".$guardid."'");
			if($datearray['lastpaymentdate'] != ""){
				$startdate = $datearray['lastpaymentdate'];
			} else {
				$startdate = $datearray['dateofemployment'];
			}
		}
		
		//Give it the current date if it has not been set yet
		if(trim($enddate) == ""){
			$enddate = date("d-M-Y");
		}
		
		if((strtotime($line['dateentered']) >= strtotime(trim($startdate,"'"))) && (strtotime($line['dateentered']) <= strtotime(trim($enddate,"'")))){
			$schedulearray = split(",",$line['overtimeentry']);
			//Get all known guard statuses
			$statusarr = getAllScheduleStatus();
			
			for($i=0;$i<count($schedulearray);$i++){
				$assgnarr = split("=",$schedulearray[$i]);
				if(!in_array($assgnarr[1],$statusarr) && $assgnarr[0] == $guardid && $assgnarr[1] != ""){
					$scheduledays++;
				}
			}
		}
	}
	
	//Return the amount to be paid to the guard for overtime work done
	$guard = getRowAsArray("SELECT overtimerate FROM guards WHERE guardid='".$guardid."'");
	
	return $scheduledays*$guard['overtimerate'];
}

//Function to get the additions or subtractions on each guard
function getGuardFinance($idstring,$startdate,$enddate,$type){
	$finance_array = split(",",$idstring);
	$totalamount = 0;
	for($k=0;$k<count($finance_array);$k++){
		$finance_details = getRowAsArray("SELECT * FROM guardfinance WHERE id='".$finance_array[$k]."' AND approved='Y'");
		if($type == $finance_details['type']){
			if(($startdate != "" && $startdate != "0000-00-00 00:00:00") && date("d-M-Y",strtotime($startdate)) < date("d-M-Y",strtotime($finance_details['date'])) && date("d-M-Y",strtotime($enddate)) > date("d-M-Y",strtotime($finance_details['date']))){
				$totalamount += $finance_details['amount'];
			} else {
				$totalamount += $finance_details['amount'];
			}
		}
	}
	return $totalamount;
}

//Function to generate the amount of PAYE tax to be paid by a guard given his total income
function generatePAYEAmount($income,$type){
	$totaltax = 0;
	$taxresult = mysql_query("SELECT id,fixedtax,lowerlevel,upperlevel,percentagetax FROM payeranges WHERE type = '".$type."'");
	
	//Go through the tax db table adding all charges to the income
	while($line = mysql_fetch_array($taxresult, MYSQL_ASSOC)){
		if($line['lowerlevel'] < $income){
			if((trim($line['upperlevel']) != "") && ($line['upperlevel'] > $income)){
				$totaltax += $line['fixedtax'] + ($line['percentagetax']/100)*($income - $line['lowerlevel']);
			} else if($line['upperlevel'] == "0" || $line['upperlevel'] == ""){
				$totaltax += $line['fixedtax'] + ($line['percentagetax']/100)*($income - $line['lowerlevel']);
			}
		}
	}
	
	return $totaltax;
}

//Function to get Paye data given the ranges and guard information
function getPAYEData($multidguardarray,$lowerlevel,$upperlevel){
	$resultsarray = array(0,0,0);
	for($i=0;$i<count($multidguardarray);$i++){
		//Get the number of employees in this range
		// Add one if the amount earned is in that range
		if($lowerlevel < $multidguardarray[$i][1] && ($upperlevel > $multidguardarray[$i][1] || ($upperlevel == "" || $upperlevel == "0"))){
			$resultsarray[0] += 1;
			$resultsarray[1] += $multidguardarray[$i][1];
			$resultsarray[2] += $multidguardarray[$i][2];
		}
	}
	
	return $resultsarray;
}

//create file_put_contents for old servers
if(!function_exists('file_put_contents')) {
	function file_put_contents($filename, $data, $file_append = false) {
		$fp = fopen($filename, (!$file_append ? 'w+' : 'a+'));
		if(!$fp) {
			trigger_error('file_put_contents cannot write in file.', E_USER_ERROR);
			return;
		}
		
		fputs($fp, $data);
		fclose($fp);
	}
}

//Function to determine whether the system expirydate is not yet exceeded
function checkMode(){
	$counter = 0;
	$buffer = array();
	$filename = "../images/280682.txt";
	//Open the file
	$handle = fopen($filename,"r+");
	//Read the file contents into an array
	if($handle) {
    	while (!feof($handle)) {
        	$buffer[$counter] = fgets($handle, 4096);
        	$counter++;
    	}
    	//fclose($handle);
	}
	//print_r(buffer);
	//Check the date and registration credentials of the user
	if(count($buffer) > 0){
		//First line  = has logged on before
		//Second line = when was the start date of the application counting
		//Third line = what is the duration of the application 
		
		//First time you logon
		//if(!(strstr($buffer[0], "N") === FALSE)){
			$yesstr = base64_encode("Y");
			$startdate = base64_encode(SATR);
			$date_duration = base64_encode(SINGLE_COUNT);
			$input_str = $yesstr."\n".$startdate."\n".$date_duration;
			error_reporting(E_ALL);
			if (is_writable($filename)) {
				if (file_put_contents($filename, $input_str) === FALSE) {
        			$_SESSION['errors'] = "Failed to update your registration status. Please contact your administrator.";
   				}
			}
		//}
		
		//Subsequent logins
		//echo "<br>First: ".base64_decode($buffer[0]).", Second: ".base64_decode($buffer[1]).", Third: ".base64_decode($buffer[2]);
		//echo "<br>End Time: ".date("d-M-Y",mktime(0, 0, 0, date("m",strtotime(base64_decode($buffer[1]))), (date("d",strtotime(base64_decode($buffer[1]))) + base64_decode($buffer[2])), date("Y",strtotime(base64_decode($buffer[1])))));
		//echo "<br>Now: ".date("d-M-Y",mktime());
		
		if(base64_decode($buffer[0]) == "Y"){
			//Check whether the user has exceeded the allowed duration
			echo date("m",strtotime(base64_decode($buffer[1]))).", ".(date("d",strtotime(base64_decode($buffer[1])))).", ".date("Y",strtotime(base64_decode($buffer[1])))."<br/>";
			
			exit(base64_decode($buffer[1])." ".base64_decode($buffer[1])." ".base64_decode($buffer[2])."heio".base64_encode(1095)."<br />");
			
			
			
			if(mktime() > mktime(0, 0, 0, date("m",strtotime(base64_decode($buffer[1]))), (date("d",strtotime(base64_decode($buffer[1]))) + base64_decode($buffer[2])), date("Y",strtotime(base64_decode($buffer[1]))))){
				$_SESSION['errors'] = "Your licence has expired. Please renew your licence to login.";
			}
		}
	}
	
	//Close the file handle
	fclose($handle);
	
	//Direct to the appropriate URL
	if(isset($_SESSION['errors']) && $_SESSION['errors'] != "" || count($buffer) == 0){
		if(count($buffer) == 0){
			$_SESSION['errors'] = "Failed to update your registration status. Please contact your administrator.";
		}
		forwardToPage('../core/login.php');
		exit;
	}
}

//Function to return an array of guards that are occupied for a passed dates
function isOccupiedGuard($guardid){
	$result = mysql_query("SELECT assignedguard,relievers,commander,starttime,endtime,startdate,enddate,exception,lastpaymentdate FROM assignments WHERE isactive='Y'");
	
	//Go through all assignments and pick all those where the 
	//guard worked from the last period he/she was paid to to today
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
		$enddate = $line['enddate'];
		//The end date is today
		if($enddate != "" && $enddate != "0000-00-00"){
			$enddate = date("Y-m-d",strtotime($enddate));
		} else {
			$enddate = date("Y-m-d",strtotime("now"));
		}
		
		//If there is no end date specified then the guard is still busy.
		if($enddate == "0000-00-00"){
			return true;
			break;
		}
		
		if($enddate > date("Y-m-d")){
			//Look through all the assignments and pick where the guard was assigned
			$assigned_array = split(",",$line['assignedguard']);
			if(in_array($guardid,$assigned_array)){
				return true;
				break;
			}
		
			$reliever_array = split(",",$line['relievers']);
			if(in_array($guardid,$reliever_array)){
				return true;
				break;
			}
		
			$commander_array = split(",",$line['commander']);
			if(in_array($guardid,$commander_array)){
				return true;
				break;
			}
		}
		
	}
	
	return false;
}

//function to get guardname by id
function getGuardNameById($id){
	$query=mysql_query("SELECT concat(p.firstname,' ', p.lastname,' ', p.othernames) as guardname FROM persons p, guards g WHERE g.personid=p.id AND g.guardid='".$id."' ");
	$name=mysql_result($query,"guardname");
	
	return $name;
}

//function to get guardname by id
function getNameById($id){
	$query=mysql_query("SELECT concat(firstname,' ',lastname) as name FROM users WHERE id='".$id."' ");
	$name=mysql_result($query,"name");
	
	return $name;
}

//function to get jobtitle by id
function getJobTitleById($id){
	$query=mysql_query("SELECT jobtitle FROM jobtitles WHERE id='".$id."' ");
	$title=mysql_result($query,"jobtitle");
	
	return $title;
}

//function to get the supplier name by id
function getSupplierById($id){
	$suppierarr = getRowAsArray("SELECT suppliername FROM suppliers WHERE id='".$id."' ");
	
	return $suppierarr['suppliername'];
}


//function to get the department name by id
function getDepartmentById($id){
	$suppierarr = getRowAsArray("SELECT departmentname FROM department WHERE id='".$id."' ");
	
	return $suppierarr['departmentname'];
}

//Function to determine if the user has rights to view/edit a given section of the application
function  userHasRight($userid, $rightid){
	openDatabaseConnection();
	$groupdata = getRowAsArray("SELECT g.rights FROM users u, groups g WHERE u.usergroup = g.id AND u.id = '".$userid."'");
	
	//Check whether the passed id is included in the user's rights list
	if(in_array($rightid,split(",",$groupdata['rights']))){
		return true;
	} else {
		return false;
	}
}

	
	// Get current webpage URL
	function selfURL() {
    	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
    	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	}
	function strleft($s1, $s2) {
    	return substr($s1, 0, strpos($s1, $s2));
	}
	
	//Get rid of script tags in $_REQUEST variables
	function convertValues($var){
		//Change the script tages < and > to special characeters &lt; and &gt; 
		$var = htmlspecialchars($var);
		$cleanvar = $var;
		return $cleanvar;
	}

// Function to convert an array of values passed by removing the HTML Special characters
	function convertGroupValues($array){
		foreach($array as $i => $value){
			$newvalue = convertValues($value);
			$array[$i] = $newvalue;
		}
		
		return $array;
	}
		
//Function that encrypts the entered values
	function encryptValue($val){
		$num = strlen($val);
		$numIndex = $num-1;
		$val1="";
	
		//Reverse the order of characters
		for($x=0;$x<strlen($val);$x++){
			$val1.= substr($val,$numIndex,1);
			$numIndex--;
		}
	
		//Encode the reversed value
		$val1 = base64_encode($val1);
		return $val1;
	}

	//Function that decrypts the entered values
	function decryptValue($dval){
	
		//Decode value
		$dval = base64_decode($dval);
	
		$dnum = strlen($dval);
		$dnumIndex1 = $dnum-1;
		$dval1 = "";
	
		//Reverse the order of characters
		for($x=0;$x<strlen($dval);$x++){
			$dval1.= substr($dval,$dnumIndex1,1);
			$dnumIndex1--;
		}
		return $dval1;
	}

	//Clean all the $_REQUEST variables
	if(count($_GET)>0){
	$_GET = convertGroupValues($_GET);
	}
	if(count($_POST)>0){
	//$_POST = convertGroupValues($_POST);
	}
	
//Function to set and show the system generated messages
function generateSystemReminders(){
	remindAboutGuardsPastLeave();
	remindAboutContractsAboutToExpire();
	remindAboutDBbackup();
	remindAboutGuardsGoingOnLeave();
	remindAboutLongServiceGuards();
}

//Remind about those who have overstayed their leave
function remindAboutGuardsPastLeave(){
	$guards_on_leave = array();
	$leave_end_dates = array();
	$lastschedule = array();
	
	$leaveresult = mysql_query("SELECT * FROM leaveapplications WHERE isactive = 'Y'");
	
	while($line = mysql_fetch_array($leaveresult,MYSQL_ASSOC)){
		//Check for those who are on leave
		if(($line['leavetype'] == "Annual" && $line['gmapproved'] == "Y") || ($line['leavetype'] == "Pass Leave" && $line['humanresourceapproved'] == "Y" && $line['payrollclerkapproved'] == "Y") || ($line['humanresourceapproved'] == "Y" && $line['operationsapproved'] == "Y"  && $line['payrollclerkapproved'] == "Y")){
		
			if((strtotime($line['leavestartdate']) < strtotime("now")) && (strtotime($line['leaveenddate']) < strtotime("now"))){
				
				array_push($guards_on_leave, $line['guardid']);
				array_push($leave_end_dates, $line['leaveenddate']);
			}
		}
	}
	
	//If they are still on leave after the leave end date, show a message on the dashboard
	//First, pick the last entered row in the schedule and determine the current status of 
	//the guard
	$scheduleresult = mysql_query("SELECT * FROM guardschedule");
	
	//Looks for the last entered schedule	
	if(mysql_data_seek($scheduleresult, (mysql_num_rows($scheduleresult) - 1))){
		$lastschedule = mysql_fetch_assoc($scheduleresult);
		$schedulearray_normal = split(",",$lastschedule["schedule"]);
		$schedulearray_overtime = split(",",$lastschedule["overtimeentry"]);
		
		//Go through those on leave to check for those not yet reported
		for($i=0;$i<count($guards_on_leave);$i++){
			$ispresent = "";
			
			//Check the normal schedule for their current status
			for($k=0;$k<count($schedulearray_normal);$k++){
				$guardstatus = split("=",$schedulearray_normal[$k]);
				if($guards_on_leave[$i] == $guardstatus[0] && $guardstatus[1] == "Leave"){
					$ispresent = "FALSE";
				}
			}
			
			//Also check the overtime schedule in case the guard just worked overtime
			for($j=0;$j<count($schedulearray_overtime);$j++){
				$guardstatus = split("=",$schedulearray_overtime[$j]);
				if($guards_on_leave[$i] == $guardstatus[0] && $guardstatus[1] == "Leave"){
					$ispresent = "FALSE";
				}
			}
			
			//If the guard is not yet back and no message was recorded to the same effect,
			// record a new msg
			$guardname_array = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$guards_on_leave[$i]."'");
			if($ispresent == "FALSE" && (howManyRows("SELECT * FROM messages WHERE reason = 'STILL ON LEAVE' AND details LIKE '%".$guardname_array["firstname"]." ".$guardname_array["lastname"]."%' AND details LIKE '%".date("d-M-Y",strtotime($leave_end_dates[$i]))."%'") == 0)){
				
				mysql_query("INSERT INTO messages (reason, details, sentby, sentto, date) VALUES ('STILL ON LEAVE', '".$guardname_array["firstname"]." ".$guardname_array["lastname"]." is still on leave. His authorised leave ended on ".date("d-M-Y",strtotime($leave_end_dates[$i])).".', '', '1,80,81,84,85', NOW())");
			}
		}
	}
}

function remindAboutContractsAboutToExpire(){
	//query to return guards whose contracts are due to expire. Display reminder 
	//14 days before the end of contract.
	$query1=mysql_query("SELECT id,guardid, contractstartdate,contractenddate, current_date() as today, date_sub(contractenddate, interval 14 day) as warningdate, datediff(contractenddate, current_date()) as diff FROM guards WHERE contractenddate > contractstartdate");	
					
	while($contracts = mysql_fetch_array($query1,MYSQL_ASSOC)){ 
		if($contracts['today'] >= $contracts['warningdate'] && $contracts['diff'] <= 14 && $contracts['diff'] > 0){
			$guards_duecontractend = getGuardNameById($contracts['guardid']);
			//Put a reminder to be seen by all concerned parties on their dashboards 
			$reason = "Contract for ". $guards_duecontractend." expires in ".$contracts['diff']." Days.";
			$details = "<a href=\"../hr/index.php?id=".encryptValue($contracts['id'])."\"> Update contract</a>";
			$sql_details=mysql_query("SELECT * FROM messages WHERE reason = '".$reason."' ") or die (mysql_error());
			//Check if this has already been inserted in the messages table, so that we do not replicate the reminder each time the dashboard is refreshed.
			if(mysql_num_rows($sql_details)==0){
				mysql_query("INSERT INTO messages (reason,details,sentby,sentto,date) VALUES ('".$reason."','".$details."','','1,84,85',now())") or die (mysql_error());
			}
									
		}else if($contracts['diff'] < 0){
			$guards_duecontractend = getGuardNameById($contracts['guardid']);
			$reason = "Contract for ".$guards_duecontractend." has expired!";
			$details = "<a href=\"../hr/index.php?id=".encryptValue($contracts['id'])."\"> Update contract</a>";
			$sql_details=mysql_query("SELECT * FROM messages WHERE reason = '".$reason."' ") or die (mysql_error());
			//Check if this has already been inserted in the messages table, so that we do not replicate the reminder each time the dashboard is refreshed.
			$sql_details=mysql_query("SELECT * FROM messages WHERE reason = '".$reason."' ") or die (mysql_error());
			if(mysql_num_rows($sql_details)==0){
				mysql_query("INSERT INTO messages (reason,details,sentby,sentto,date) VALUES ('".$reason."','".$details."','','1,84,85',now())") or die (mysql_error());
			}
		}
			
	}
}

//Function to remind the adminsitrator to backup the database 
function remindAboutDBbackup(){
	if((date("d-M-Y",strtotime("now")) == date("d-M-Y",strtotime("this Wednesday"))) && (howManyRows("SELECT * FROM messages WHERE reason = 'BACKUP DATABASE' AND details LIKE '%".date("d-M-Y",strtotime("next Friday"))."%'") == 0)){
				
		mysql_query("INSERT INTO messages (reason, details, sentby, sentto, date) VALUES ('BACKUP DATABASE', 'Please backup the DB for week ending ".date("d-M-Y",strtotime("next Friday")).".', '', '1', NOW())");
	}
}

//Function to remind the HR about guards going on leave in the running month (if any)
function remindAboutGuardsGoingOnLeave(){
	$guards_on_leave = array();
	$start_date = date("01-M-Y",strtotime("now"));
	$end_date = cal_days_in_month(CAL_GREGORIAN, date("m",strtotime("now")), date("Y",strtotime("now")))."-".date("M-Y",strtotime("now"));
	
	$leaveresult = mysql_query("SELECT * FROM leaveapplications WHERE isactive = 'Y'");
	
	while($line = mysql_fetch_array($leaveresult,MYSQL_ASSOC)){
		//Check for those who are on leave
		if(($line['leavetype'] == "Annual" && $line['gmapproved'] == "Y") || ($line['leavetype'] == "Pass Leave" && $line['humanresourceapproved'] == "Y" && $line['payrollclerkapproved'] == "Y") || ($line['humanresourceapproved'] == "Y" && $line['operationsapproved'] == "Y"  && $line['payrollclerkapproved'] == "Y")){
		
			if((strtotime($start_date) <= strtotime($line['leavestartdate'])) && (strtotime($line['leavestartdate']) < strtotime($end_date))){
				
				array_push($guards_on_leave, $line['guardid']);
			}
		}
	}
	
	
	
	if((count($guards_on_leave) > 0) && (howManyRows("SELECT * FROM messages WHERE reason = 'GUARDS DUE FOR LEAVE' AND details LIKE '%".$start_date."%'") == 0)){
		
		mysql_query("INSERT INTO messages (reason, details, sentby, sentto, date) VALUES ('GUARDS DUE FOR LEAVE', '<a href=\"../hr/manageleave.php?a=sactive\">Guards List</a> starting ".$start_date.".', '', '1', NOW())");
	}
}

//Function to remind about guards due for long term service awards
function remindAboutLongServiceGuards(){
	$longserviceguards = array();
	
	$query=mysql_query("SELECT id,guardid, dateofemployment FROM guards WHERE isarchived = 'N'");	
					
	while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
		//Look for the long serving guards
		if((date("Y",strtotime("now")) - date("Y",strtotime($row['dateofemployment']))) >= 10){
			array_push($longserviceguards,$row['guardid']);
		}
	} 
	
	//Set the remider if there are such guards
	if((count($longserviceguards) > 0) && (howManyRows("SELECT * FROM messages WHERE reason = 'LONG SERVICE AWARD' AND details LIKE '%".date("Y",strtotime("now"))."%'") == 0)){
		
		mysql_query("INSERT INTO messages (reason, details, sentby, sentto, date) VALUES ('LONG SERVICE AWARD', '<a href=\"../hr/manageguards.php?a=lsearch&y=".encryptValue(date("Y",strtotime("now")))."\">Guards List</a> for ".date("Y",strtotime("now")).".', '', '1,84,85', NOW())");
	}
}

//Function to determine whether a guard is on leave
//Returns array with first value - TRUE or FALSE, second value - the leave start date
//third value - the leave end date and last value - whether the leave is sold or used
function isOnLeave($guardid){
	$resultarray = getRowAsArray("SELECT * FROM leaveapplications WHERE leaveenddate > '".date("Y-m-d H:i:s", strtotime("now"))."' AND leavestartdate < '".date("Y-m-d H:i:s", strtotime("now"))."' AND isactive='Y' AND guardid='".$guardid."'");
	
	$response = array(FALSE,"","");
	
	//Check for only those that were approved
	if($resultarray['leavetype'] == "Annual" && $resultarray['gmapproved'] == "Y"){
		$response = array(TRUE, $resultarray['leavestartdate'], $resultarray['leaveenddate'], $resultarray['sold']);
		
	} else if($resultarray['leavetype'] == "Pass Leave" && $resultarray['humanresourceapproved'] == "Y" && $resultarray['payrollclerkapproved'] == "Y"){
		$response = array(TRUE, $resultarray['leavestartdate'], $resultarray['leaveenddate'], $resultarray['sold']);
		
	} else if($resultarray['humanresourceapproved'] == "Y" && $resultarray['payrollclerkapproved'] == "Y" && $row['operationsapproved'] == "Y"){
		$response = array(TRUE, $resultarray['leavestartdate'], $resultarray['leaveenddate'], $resultarray['sold']);
	}
	
	return $response;
}


//Function to check whether a guard has a sold leave on a given date registered already
function hasSoldLeave($guardid, $date){
	$guardstatus = getRowAsArray("SELECT financialstatus FROM guards WHERE guardid = '".$guardid."'");
	
	$response = FALSE;
	
	if(trim($guardstatus['financialstatus']) == ""){
		$guardstatusarray = split(",", $guardstatus['financialstatus']);
		for($i=0;$i<count($guardstatusarray); $i++){
			$guardfinance = getRowAsArray("SELECT * FROM guardfinance WHERE id='".$guardstatusarray[$i]."'");
			
			if(date("d-M-Y",strtotime($guardfinance['date'])) == date("d-M-Y",strtotime($date)) && $guardfinance['category'] == "Sold Leave"){
				$response = TRUE;
			}
		}
	}
	
	return $response;
}
?>