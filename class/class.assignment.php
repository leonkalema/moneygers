<?php
##################################################################
#### SmartGuard Assignment class
##################################################################
include_once "../include/commonfunctions.php";
class Assignment {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $client;
	var $name;
	var $place;
	var $region;
	var $code;
	var $assignmenttype;
	var $effectivedate;
	var $starttime;
	var $endtime;
	var $enddate;
	var $frequency;
	var $daysofweek;
	var $daysofmonth;
	var $description;
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
	function getClient() {
		return $this->client;
	}
	function getName() {
		return $this->name;
	}
	function getPlace() {
		return $this->place;
	}
	function getRegion() {
		return $this->region;
	}
	function getCode() {
		return $this->code;
	}
	function getAssignmentType() {
		return $this->assignmenttype;
	}
	function getEffectiveDate() {
		return $this->effectivedate;
	}
	function getStartTime() {
		return $this->starttime;
	}
	function getEndTime() {
		return $this->endtime;
	}
	function getEndDate() {
		return $this->enddate;
	}
	function getFrequency() {
		return $this->frequency;
	}
	function getDaysOfWeek() {
		return $this->daysofweek;
	}
	function getDaysOfMonth() {
		return $this->daysofmonth;
	}
	function getDescription() {
		return $this->description;
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
	
	# Function to save a new assignment to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO assignments (name, client, place, code, region, assignmenttype, effectivedate, starttime, endtime, enddate, frequency, daysofweek, daysofmonth, description, createdby, datecreated) 
			VALUES ('".$this->name."', '".$this->client."', '".$this->place."', '".$this->code."', '".$this->region."', '".$this->assignmenttype."', ".changeDateFromPageToMySQLFormat($this->effectivedate).", '".$this->starttime."', '".$this->endtime."', ".changeDateFromPageToMySQLFormat($this->enddate).", '".$this->frequency."', '".getListFromArray($this->daysofweek)."', '".getListFromArray($this->daysofmonth)."','".$this->description."', '".$this->createdby."', NOW())";
		echo $query;
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
	
	#Update an assignment in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE assignments SET name='".$this->name."', client='".$this->client."', place='".$this->place."', code='".$this->code."', region='".$this->region."', assignmenttype='".$this->assignmenttype."', effectivedate=".changeDateFromPageToMySQLFormat($this->effectivedate).", starttime='".$this->starttime."', endtime='".$this->endtime."', enddate=".changeDateFromPageToMySQLFormat($this->enddate).", frequency='".$this->frequency."', daysofweek='".getListFromArray($this->daysofweek)."', daysofmonth='".getListFromArray($this->daysofmonth)."', description='".$this->description."',  lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get an assignment from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM assignments WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->client = $array['client'];
		$this->place = $array['place'];
		$this->code = $array['code'];
		$this->region = $array['region'];
		$this->assignmenttype = $array['assignmenttype'];
		$this->effectivedate = $array['effectivedate'];
		$this->starttime = $array['starttime'];
		$this->endtime = $array['endtime'];
		$this->enddate = $array['enddate'];
		$this->frequency = $array['frequency'];
		$this->daysofweek = $array['daysofweek'];
		$this->daysofmonth = $array['daysofmonth'];
		$this->description = $array['description'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];

	}
	
	# Get an assignment from the database
	function getAllAssignments(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM assignments ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$regions = array();
		# Create an array of all the users returned
		while($region = mysql_fetch_assoc($result)) {
			$regions[] = $region;
		}
		return $regions;
	}
	
	# Delete an assignment from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM assignments WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
	

}
?>