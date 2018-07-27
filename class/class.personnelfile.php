<?php
##################################################################
#### SmartGuard User Personnel File class
##################################################################
include_once "../include/commonfunctions.php";
class Personnel {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $name = "";
	var $types = "";
	var $notes = "";
	var $action;
	var $day;
	var $month;
	var $year;
		
	################################################################
	## Functions to get the values of the different class variables
	################################################################
	function getID() { 
		return $this->id;
	}
	function getName() {
		return $this->guard;
	}
	function getType() {
		return $this->type; 
	}
	function getNotes() {
		return $this->notes;
	}
	function getAction() {
		return $this->actiontaken;
	}
	function getDay() {
		return $this->day;
	}
	function getMonth() {
		return $this->month;
	}
	function getYear() {
		return $this->year;
	}
	
	#####################################################################

	# Function to save a new user group to the database
	function create() {
		openDatabaseConnection();
		$dates='".$this->day."'.'-'.'".$this->month."'.'-'.'".$this->year."';
		$query = "INSERT INTO personnel (guard, type, notes, actiontaken, date) 
			VALUES ('".$this->guard."', '".$this->type."', '".$this->notes."', '".$this->actiontaken."', '".$dates."'";
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
		$query = "UPDATE personnel SET guard='".$this->guard."', types='".$this->type."',  notes='".$this->notes."', actiontaken = '".$this->actiontaken."', date='".$dates."' WHERE id ='".$id."'";
		echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a personnel file from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM personnel WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->name = $array['guard'];
		$this->type = $array['type'];
		$this->notes = $array['notes'];
		$this->action = $array['actiontaken'];
		$this->dates = $array['date'];
		
			}
	
	# Get a user group from the database
	function getAllPersonnels(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM personnel ORDER BY guard ASC";
		#echo $query;
		$result = mysql_query($query);
		$personnel = array();
		# Create an array of all the users returned
		while($personnel = mysql_fetch_assoc($result)) {
			$personnel[] = $personnel;
		}
		return $personnel;
	}
	
	# Delete a group from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;

		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM personnel WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>