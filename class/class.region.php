<?php
##################################################################
#### SmartGuard Region class
##################################################################
include_once "../include/commonfunctions.php";
class Region {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $name = "";
	var $description = "";
	var $areascovered = "";
	var $code;
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
	function getName() {
		return $this->name;
	}
	function getDescription() {
		return $this->description;
	}
	function getAreasCovered() {
		return $this->areascovered;
	}
	function getCode() {
		return $this->code;
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
	
	# Function to save a new user to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO regions (name, description, code, createdby, datecreated) 
			VALUES ('".$this->name."', '".$this->description."', '".$this->code."', '".$this->createdby."', NOW())";
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
	
	#Update a region in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE regions SET name='".$this->name."', description='".$this->description."', areascovered='".$this->areascovered."', code='".$this->code."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a region from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM regions WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->description = $array['description'];
		$this->areascovered = $array['areascovered'];
		$this->code = $array['code'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];

	}
	
	# Get regions from the database
	function getAllRegions(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM regions ORDER BY code ASC";
		#echo $query;
		$result = mysql_query($query);
		$regions = array();
		# Create an array of all the users returned
		while($region = mysql_fetch_assoc($result)) {
			$regions[] = $region;
		}
		return $regions;
	}
	
	# Added by Ismael on 16th Jan 2008
	# Get searchable regions from the database
	function getSearchableRegions($where){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM regions ".$where." ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$regions = array();
		# Create an array of all the users returned
		while($region = mysql_fetch_array($result)) {
			$regions[] = $region;
		}
		return $regions;
	}
	
	# Delete a region from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM regions WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
	

}
?>