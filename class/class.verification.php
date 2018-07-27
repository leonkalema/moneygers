<?php
##################################################################
#### SmartGuard Verification class
##################################################################
include_once "../include/commonfunctions.php";
class Verification {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $name;
	var $type;
	var $physicaladdress;
	var $telephone;
	var $isapproved;
	var $dateapproved;
	var $datesubmitted;
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
	function getType() {
		return $this->type;
	}
	function getPhysicalAddress() {
		return $this->physicaladdress;
	}
	function getTelephone() {
		return $this->telephone;
	}
	function isApproved() {
		return $this->isapproved;
	}
	function getDateApproved() {
		return $this->dateapproved;
	}
	function getDateSubmitted() {
		return $this->datesubmitted;
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
	
	# Function to save a new verification to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO verifications (name, type, physicaladdress, telephone, isapproved, dateapproved, datesubmitted, createdby, datecreated) 
			VALUES ('".$this->name."', '".$this->type."', '".$this->physicaladdress."', '".$this->telephone."', '".$this->isapproved."', '".$this->dateapproved."', '".$this->datesubmitted."', '".$this->createdby."', NOW())";
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
	
	#Update a verification in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE verifications SET name='".$this->name."', type='".$this->type."', physicaladdress='".$this->physicaladdress."', telephone='".$this->telephone."', isapproved='".$this->isapproved."', dateapproved='".$this->dateapproved."', datesubmitted='".$this->datesubmitted."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a verification from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM verifications WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->type = $array['type'];
		$this->physicaladdress = $array['physicaladdress'];
		$this->telephone = $array['telephone'];
		$this->dateapproved = $array['dateapproved'];
		$this->datesubmitted = $array['datesubmitted'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];
		if (trim($array['isapproved']) == "") {
		   $this->isapproved = "N";
		}
		
	}
	
	# Get all verifications in the database
	function getAllVerifications(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM verifications ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$verifications = array();
		# Create an array of all the verifications returned
		while($verification = mysql_fetch_assoc($result)) {
			$verifications[] = $verification;
		}
		return $verifications;
	}
	
	# Delete a verification from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM verifications WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>
