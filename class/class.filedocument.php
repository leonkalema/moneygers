<?php
##################################################################
#### SmartGuard Personnel file document class
##################################################################
include_once "../include/commonfunctions..php";
class FileDocument{
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $personalfileid;
	var $documentname;
	var $issued;
	var $dateissued;
	var $firstrenewal;
	var $secondrenewal;
	var $thirdrenewal;
	var $datecreated;
	var $lastupdatedate;
	var $error_msg;
	
	################################################################
	## Functions to get the values of the different class variables
	################################################################
	
	function getID() {
		return $this->id;
	}
	function getPersonalFileID(){
	    return $this->personalfileid;
	}
	function getDocumentName(){
	    return $this->documentname;
	}
	function  issued(){
	    return $this->issued;
	}
	function getDateIssued(){
	    return $this->dateissued;
	}
	function getFirstRenewal(){
	    return $this->firstrenewal;
	}
	function getSecondRenewal(){
	    return $this->secondrenewal;
	}
	function getThirdRenewal(){
	    return $this->thirdrenewal;
	}
	function getDateCreated(){
	    return $this->datecreated;
	}
	function getLastUpdateDate(){
	    return $this->lastupdatedate;
	}
	
	#####################################################################
	
	# Function to save a new personnel file document to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO filedocuments  (personalfileid, documentname, issued, dateissued, firstrenewal, secondrenewal, thirdrenewal,datecreated ) 
			VALUES ('".$this->personalfileid."', '".$this->documentname."', '".$this->issued."', '".$this->dateissued."', '".$this->firstrenewal."', '".$this->secondrenewal."', '".$this->thirdrenewal."', NOW())";
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
		$query = "UPDATE filedocuments SET personalfileid='".$this->personalfileid."',documentname='".$this->documentname."', issued='".$this->issued."', dateissued='".$this->dateissued."', firstrenewal='".$this->firstrenewal."', secondrenewal = '".$this->secondrenewal."', thirdrenewal = '".$this->thirdrenewal."' WHERE id ='".$id."'";
		echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a personnel file document from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM filedocuments WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->personalfileid = $array['personalfileid'];
		$this->documentname = $array['documentname'];
		$this->dateissued = $array['dateissued'];
		$this->firstrenewal = $array['firstrenewal'];
		$this->secondrenewal = $array['secondrenewal'];
		$this->thirdrenewal = $array['thirdrenewal'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->datecreated = $array['datecreated'];
		$this->error_msg = $array['error_msg'];
		if (trim($array['issued']) == "") {
		   $this->issued = "N";
		}

	}
	
	# Get all personnel file documents in the database
	function getAllFileDocuments(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM filedocuments ORDER BY name ASC";
		#echo $query;
		$result = mysql_query($query);
		$filedocuments = array();
		# Create an array of all the personnel file documents returned
		while($filedocument = mysql_fetch_assoc($result)) {
			$filedocuments[] = $filedocument;
		}
		return $filedocuments;
	}
	
	# Delete a personnel file document from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM filedocuments WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>

	
	
		
		
	