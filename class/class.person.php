<?php
##################################################################
#### SmartGuard Person class
##################################################################
include_once "../include/commonfunctions.php";
class Person {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $firstname = "";
	var $lastname= "";
	var $othernames = "";
	var $birthlastname = "";
	var $nationality;
	var $occupation;
	var $employer;
	var $tribe= "";
	var $dateofbirth= "";
	var $birthplaceid;
	var $isalive = 'Y';
	var $addressid;
	var $homeid;
	var $workplaceid;
	var $datecreated;
	var $createdby;
	var $lastupdatedby;
	var $lastupdatedate;
	var $error_msg;
	
	################################################################
	## Functions to get the values of the different class variables
	################################################################
	function getID() {
		return $this->id;
	}
	function getFirstName() {
		return $this->firstname;
	}
	function getLastName() {
		return $this->lastname;
	}
	function getOtherNames() {
		return $this->othernames;
	}
	function getBirthLastname() {
		return $this->birthlastname;
	}
	function getNationality() {
		return $this->nationality;
	}
	function getOccupation() {
		return $this->occupation;
	}
	function getEmployer() {
		return $this->employer;
	}
	function getTribe() {
		return $this->tribe;
	}
	function getDateOfBirth() {
		return $this->dateofbirth;
	}
	function getBirthPlaceId() {
		return $this->birthplaceid;
	}
	function isAlive() {
		return $this->isalive;
	}
	function getAddressId() {
		return $this->addressid;
	}
	function getWorkPlaceId() {
		return $this->workplaceid;
	}
	function getHomeId() {
		return $this->homeid;
	}
	function getCreatedBy() {
		return $this->createdby;
	}
	function getDateCreated() {
		return $this->datecreated;
	}
	function getLastUpdateDate() {
		return $this->lastupdatedate;
	}
	function getLastUpdatedBy() {
		return $this->lastupdateby;
	}
	
	#####################################################################
	
	# Function to save a new person to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO persons (firstname, lastname, othernames, birthlastname, nationality, tribe, occupation, employer, dateofbirth, birthplaceid, isalive, addressid, homeid, workplaceid, createdby, datecreated) 
			VALUES ('".$this->firstname."', '".$this->lastname."', '".$this->othernames."', '".$this->birthlastname."', '".$this->nationality."', '".$this->tribe."', '".$this->occupation."', '".$this->employer."', ".changeDateFromPageToMySQLFormat($this->dateofbirth).", '".$this->birthplaceid."', '".$this->isalive."', '".$this->addressid."',  '".$this->homeid."', '".$this->workplaceid."', '".$this->createdby."', NOW())";
		#echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving the activities to the database
		if (mysql_error() == "") {
			# no errors occured, so return the last inserted id
			$this->id = mysql_insert_id();
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}
	}
	
	#Update a person in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE persons SET firstname='".$this->firstname."', lastname='".$this->lastname."', othernames='".$this->othernames."', birthlastname='".$this->birthlastname."', nationality='".$this->nationality."', occupation='".$this->occupation."', employer='".$this->employer."', tribe='".$this->tribe."', dateofbirth=".changeDateFromPageToMySQLFormat($this->dateofbirth).", birthplaceid='".$this->birthplaceid."', isalive='".$this->isalive."', addressid='".$this->addressid."', workplaceid='".$this->workplaceid."', homeid='".$this->homeid."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		#echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a person from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM persons WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->firstname = $array['firstname'];
		$this->lastname = $array['lastname'];
		$this->othernames = $array['othernames'];
		$this->birthlastname = $array['birthlastname'];
		$this->nationality = $array['nationality'];
		$this->occupation = $array['occupation'];
		$this->employer = $array['employer'];
		$this->tribe = $array['tribe'];
		$this->dateofbirth = $array['dateofbirth'];
		$this->birthplaceid = $array['birthplaceid'];
		$this->addressid = $array['addressid'];
		$this->homeid = $array['homeid'];
		$this->workplaceid = $array['workplaceid'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];
		if (trim($array['isalive']) == "") {
		   $this->isalive = "N";
		}

	}
	
	# Get all persons in the database
	function getAllPersons(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM persons ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$persons = array();
		# Create an array of all the persons returned
		while($person = mysql_fetch_assoc($result)) {
			$persons[] = $person;
		}
		return $persons;
	}
	
	# Delete a person from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM persons WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>