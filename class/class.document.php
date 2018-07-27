<?php
##################################################################
#### SmartGuard Document class
##################################################################
include_once "../include/commonfunctions.php";
class Document {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $name;
	var $guardid;
	var $originalfilename;
	var $newfilename;
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
	function getName() {
		return $this->name;
	}
	function getGuardId() {
		return $this->guardid;
	}
	function getOriginalFileName() {
		return $this->originalfilename;
	}
	function getNewFileName() {
		return $this->newfilename;
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
	
	# Function to save a new document to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO documents (name, guardid, originalfilename, newfilename, description, createdby, datecreated) 
			VALUES ('".$this->name."', '".$this->guardid."', '".$this->originalfilename."', '".$this->newfilename."', '".$this->description."', '".$this->createdby."', NOW())";
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
	
	#Update a document in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE documents SET name='".$this->name."',guardid='".$this->guardid."', originalfilename='".$this->originalfilename."', newfilename='".$this->newfilename."', description='".$this->description."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a document from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM documents WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->guardid = $array['guardid'];
		$this->originalfilename = $array['originalfilename'];
		$this->newfilename = $array['newfilename'];
		$this->description = $array['description'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];

	}
	
	# Get all documents in the database
	function getAllDocuments(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM documents ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$documents = array();
		# Create an array of all the documents returned
		while($document = mysql_fetch_assoc($result)) {
			$documents[] = $document;
		}
		return $documents;
	}
	
	# Delete a document from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM documents WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>
