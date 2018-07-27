<?php
##################################################################
#### SmartGuard Guard class
##################################################################
include_once "../include/commonfunctions.php";
class Guard {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $guardid;
	var $personid;
	var $photographid;
	var $fingerprintid;
	var $dateofemployment;
	var $fatherid;
	var $motherid;
	var $spouseid;
	var $nextofkinid;
	var $beneficiaryid;
	var $lc1verificationid;
	var $declarationverificationid;
	var $landlordverificationid;
	var $children = array();
	var $schools = array();
	var $jobs = array();
	var $referees = array();
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
	function getGuardId() {
		return $this->guardid;
	}
	function getPersonId() {
		return $this->personid;
	}
	function getPhotographId() {
		return $this->photographid;
	}
	function getFingerPrintId() {
		return $this->fingerprintid;
	}
	function getDateOfEmployment() {
		return $this->dateofemployment;
	}
	function getFatherId() {
		return $this->fatherid;
	}
	function getMotherId() {
		return $this->motherid;
	}
	function getSpouseId() {
		return $this->spouseid;
	}
	function getNextOfKinId() {
		return $this->nextofkinid;
	}
	function getBeneficiaryId() {
		return $this->beneficiaryid;
	}
	function getLc1VerificationId() {
		return $this->lc1verificationid;
	}
	function getLandlordVerificationId() {
		return $this->landlordverificationid;
	}
	function getSchools() {
		return $this->schools;
	}
	function getChildren() {
		return $this->children;
	}
	function getJobs() {
		return $this->jobs;
	}
	function getReferees() {
		return $this->referees;
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
	
	# Function to save a new guard to the database
	function create() {
		openDatabaseConnection();	
		$query = "INSERT INTO guards(guardid, photographid, personid, fingerprintid, dateofemployment, fatherid, motherid, spouseid, nextofkinid, beneficiaryid, lc1verificationid, declarationverificationid, landlordverificationid, createdby, datecreated) 
			VALUES ('".$this->guardid."', '".$this->photographid."', '".$this->personid."', '".$this->fingerprintid."', ".changeDateFromPageToMySQLFormat($this->dateofemployment).", '".$this->fatherid."', '".$this->motherid."', '".$this->spouseid."', '".$this->nextofkinid."', '".$this->beneficiaryid."', '".$this->lc1verificationid."', '".$this->declarationverificationid."', '".$this->landlordverificationid."', '".$this->createdby."', NOW())";
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

	#Update a guard in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE guards SET guardid='".$this->guardid."', photographid='".$this->photographid."', personid='".$this->personid."', fingerprintid='".$this->fingerprintid."', dateofemployment=".changeDateFromPageToMySQLFormat($this->dateofemployment).", fatherid='".$this->fatherid."', motherid='".$this->motherid."', spouseid='".$this->spouseid."', nextofkinid='".$this->nextofkinid."', beneficiaryid='".$this->beneficiaryid."', lc1verificationid='".$this->lc1verificationid."', declarationverificationid='".$this->declarationverificationid."', landlordverificationid='".$this->landlordverificationid."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		#echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a guard from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM guards WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->guardid = $array['guardid'];
		$this->personid = $array['personid'];
		$this->photographid = $array['photographid'];
		$this->fingerprintid = $array['fingerprintid'];
		$this->dateofemployment = $array['dateofemployment'];
		$this->fatherid = $array['fatherid'];
		$this->motherid = $array['motherid'];
		$this->spouseid = $array['spouseid'];
		$this->nextofkinid = $array['nextofkinid'];
		$this->beneficiaryid = $array['beneficiaryid'];
		$this->lc1verificationid = $array['lc1verificationid'];
		$this->declarationverificationid = $array['declarationverificationid'];
		$this->landlordverificationid = $array['landlordverificationid'];
		$this->datecreated = $array['datecreated'];
		$this->schools = $array['schools'];
		$this->jobs = $array['jobs'];
		$this->children = $array['children'];
		$this->referees = $array['referees'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];

	}
	
	# Delete a guard from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM guards WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}

	# Get a all guards from the database
	function getAllGuards(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT g.id as `theid`, g.*, p.*, CONCAT(p.firstname, \" \", p.lastname) as `name` FROM guards g, persons p WHERE p.id=g.personid ORDER BY g.guardid ASC";
		#echo $query;
		$result = mysql_query($query);
		$guards = array();
		# Create an array of all the users returned
		while($guard = mysql_fetch_assoc($result)) {
			$guards[] = $guard;
		}
		return $guards;
	}
				
}
?>
