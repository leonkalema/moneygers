<?php
##################################################################
#### SmartGuard User Group class
##################################################################
include_once "../include/commonfunctions.php";
class Group {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $name = "";
	var $rights = "";
	var $description = "";
	var $isactive;
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
	function isActive() {
		return $this->isactive;
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
	
	# Function to save a new user group to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO groups (name, description,rights,isactive, createdby, datecreated) 
			VALUES ('".$this->name."', '".$this->description."', '".$this->rights."', '".$this->isactive."', '".$this->createdby."', NOW())";
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
	
	#Update a user group in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE groups SET name='".$this->name."', description='".$this->description."',  isactive='".$this->isactive."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a user group from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM groups WHERE id = '".$id."'";
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
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];
		if (trim($array['isactive']) == "") {
		   $this->active = "N";
		}

	}
	
	# Get a user group from the database
	function getAllGroups(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM groups ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$groups = array();
		# Create an array of all the users returned
		while($group = mysql_fetch_assoc($result)) {
			$groups[] = $group;
		}
		return $groups;
	}
	
	# Delete a group from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM groups WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>