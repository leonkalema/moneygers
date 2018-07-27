<?php
##################################################################
#### SmartGuard Place class
##################################################################
include_once "../include/commonfunctions.php";
class Place {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $name;
	var $telephone;
	var $village;
	var $subcounty;
	var $county;
	var $parish;
	var $town;
	var $district;
	var $plotnumber;
	var $lc1chairman;
	var $lc1telephone;
	var $lc2chairman;
	var $lc2telephone;
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
	function getTelephone() {
		return $this->telephone;
	}
	function getVillage() {
		return $this->village;
	}
	function getSubcounty() {
		return $this->subcounty;
	}
	function getCounty() {
		return $this->county;
	}
	function getParish() {
		return $this->parish;
	}
	function getTown() {
		return $this->town;
	}
	function getDistrict() {
		return $this->district;
	}
	function getPlotNumber() {
		return $this->plotnumber;
	}
	function getLc1Chairman() {
		return $this->lc1chairman;
	}
	function getLc1Telephone() {
		return $this->lcltelephone;
	}
	function getLc2Chairman() {
		return $this->lc2chairman;
	}
	function getLc2telephone() {
		return $this->lc2telephone;
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
	
	# Function to save a new place to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO places (name, telephone, village, subcounty, county, parish, town, district, plotnumber, lc1chairman, lc1telephone, lc2chairman, lc2telephone, createdby, datecreated) 
			VALUES ('".$this->name."', '".$this->telephone."', '".$this->village."', '".$this->subcounty."', '".$this->county."', '".$this->parish."', '".$this->town."', '".$this->district."', '".$this->plotnumber."', '".$this->lc1chairman."', '".$this->lc1telephone."', '".$this->lc2chairman."', '".$this->lc2telephone."', '".$this->createdby."', NOW())";
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
	
	#Update a place in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE places SET name='".$this->name."', telephone='".$this->telephone."', village='".$this->village."', subcounty='".$this->subcounty."', county='".$this->county."', parish='".$this->parish."', town='".$this->town."', district='".$this->district."', plotnumber='".$this->plotnumber."', lc1chairman='".$this->lc1chairman."', lc1telephone='".$this->lc1telephone."', lc2chairman='".$this->lc2chairman."', lc2telephone='".$this->lc2telephone."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		#echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a place from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM places WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->telephone = $array['telephone'];
		$this->village = $array['village'];
		$this->subcounty = $array['subcounty'];
		$this->county = $array['county'];
		$this->parish = $array['parish'];
		$this->town = $array['town'];
		$this->district = $array['district'];
		$this->plotnumber = $array['plotnumber'];
		$this->lc1chairman = $array['lc1chairman'];
		$this->lc1telephone = $array['lc1telephone'];
		$this->lc2chairman = $array['lc2chairman'];
		$this->lc2telephone = $array['lc2telephone'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];
	}
	
	# Get all places in the database
	function getAllPlaces(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM places ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$places = array();
		# Create an array of all the places returned
		while($place = mysql_fetch_assoc($result)) {
			$places[] = $place;
		}
		return $places;
	}
	
	# Delete a place from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM places WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>
