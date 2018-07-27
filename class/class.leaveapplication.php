<?php
##################################################################
#### SmartGuard leaveApplication class
##################################################################
include_once "../include/commonfunctions.php";
class LeaveApplication {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $guardid;
	var $leavestartdate;
	var $leaveenddate;
	var $leavetype;
	var $reason= "";
	var $verifiedby= "";
	var $dateverified;
	var $employmentdate;
	var $daysentitledperyear= "";
	var $totaldaysaccumulated= "";
	var $payrollclerkapproved;
	var $operationsapproved;
	var $dateofoperations;
	var $humanresourceapproved;
	var $dateofpayrollclerkapproval;
	var $dateofhumanresourceapproval;
	var $advancetaken= "";
	var $travelallowances= "";
	var $loantaken= "";
	var $totalpaymentapproved= "";
	var $uniformreturned;
	var $dateuniformreturned= "";
	var $commenceson= "";
	var $terminateson= "";
	var $isapproved;
	var $approvalmessage= "";
	var $dateapproved;
	var $status;
	var $datecreated;
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
	function getLeaveStartDate() {
		return $this->leavestartdate;
	}
	function getLeaveEndDate() {
		return $this->leaveenddate;
	}
	function getLeaveType() {
		return $this->leavetype;
	}
	function getReason() {
		return $this->reason;
	}
	function getVerifiedBy() {
		return $this->verifiedby;
	}
	function getDateVerified() {
		return $this->dateverified;
	}
	function getEmploymentDate() {
		return $this->employmentdate;
	}
	function getDaysEntitledPerYear() {
		return $this->daysentitledperyear;
	}
	function getTotalDaysaccumulated() {
		return $this->totaldaysaccumulated;
	}
	function payrollClerkApproved() {
		return $this->payrollclerkapproved;
	}
	function operationsApproved() {
		return $this->operationsapproved;
	}
	function getDateOfOperations() {
		return $this->dateofoperations;
	}
	function humanResourceApproved(){
	    return $this->humanresourceapproved;
	}
    function getDateOfPayrollClerkApproval(){
        return $this->dateofpayrollclerkapproval;
    }
	function getDateOfHumanResourceApproval(){
	    return $this->dateofhumanresourceapproval;
	}
    function getAdvanceTaken(){
        return $this->advancetaken;
    }
    function getTravelAllowances(){
        return $this->travelallowances;
    }
    function getLoanTaken(){
        return $this->loantaken;
    }
    function getTotalPaymentApproved(){
        return $this->totalpaymentapproved;
    }
    function uniformReturned(){
        return $this->uniformreturned;
    }
    function getDateUniformReturned(){
        return $this->dateuniformreturned;
    }
    function  getCommencesOn(){
        return $this->commenceson;
    }
    function getTerminatesOn(){
        return $this->terminateson;
    }
    function getApprovalMessage(){
        return $this->approvalmessage;
    }
    function getDateApproved(){
        return $this->dateapproved;
    }
	function getStatus(){
	    return $this->status;
	}
    function getDateCreated(){
        return $this->datecreated;
    }
    function getLastUpdateDate(){
        return $this->lastupdatedate;
    }		
	
	
	#####################################################################
	
	# Function to save a new leave application to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO leaveapplications(guardid, leavestartdate, leaveenddate, leavetype, reason, verifiedby, dateverified, employmentdate, daysentitledperyear, totaldaysaccumulated, payrollclerkapproved, operationsapproved, dateofoperations, humanresourceapproved, dateofpayrollclerkapproval, dateofhumanresourceapproval, advancetaken, travelallowances, loantaken, totalpaymentapproved, 
		uniformreturned, dateuniformreturned, commenceson, terminateson, approvalmessage, dateapproved, status, lastupdatedate , datecreated ) 
			VALUES ('".$this->guardid."', ".changeDateFromPageToMySQLFormat($this->leavestartdate).", ".changeDateFromPageToMySQLFormat($this->leaveenddate).", '".$this->leavetype."', '".$this->reason."',  '".$this->verifiedby."', ".changeDateFromPageToMySQLFormat($this->dateverified).", ".changeDateFromPageToMySQLFormat($this->employmentdate).", '".$this->daysentitledperyear."', '".$this->totaldaysaccumulated."', '".$this->payrollclerkapproved."', '".$this->operationsapproved."', ".changeDateFromPageToMySQLFormat($this->dateofoperations).", '".$this->humanresourceapproved."', ".changeDateFromPageToMySQLFormat($this->dateofpayrollclerkapproval).", ".changeDateFromPageToMySQLFormat($this->dateofhumanresourceapproval).", '".$this->advancetaken."', '".$this->travelallowances."', '".$this->loantaken."', '".$this->totalpaymentapproved."', 
			'".$this->uniformreturned."', ".changeDateFromPageToMySQLFormat($this->dateuniformreturned).", ".changeDateFromPageToMySQLFormat($this->commenceson).", ".changeDateFromPageToMySQLFormat($this->terminateson).", '".$this->approvalmessage."', '".$this->dateapproved."', '".$this->status."' , '".$this->lastupdatedate."', NOW())";
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
	
	#Update a leave application in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE leaveapplications SET guardid='".$this->guardid."', leavestartdate=".changeDateFromPageToMySQLFormat($this->leavestartdate).", leaveenddate=".changeDateFromPageToMySQLFormat($this->leaveenddate).", leavetype='".$this->leavetype."', reason='".$this->reason."', verifiedby='".$this->verifiedby."',  dateverified=".changeDateFromPageToMySQLFormat($this->dateverified).", employmentdate=".changeDateFromPageToMySQLFormat($this->employmentdate).", daysentitledperyear='".$this->daysentitledperyear."', totaldaysaccumulated = '".$this->totaldaysaccumulated."', payrollclerkapproved='".$this->payrollclerkapproved."', operationsapproved='".$this->operationsapproved."', dateofoperations=".changeDateFromPageToMySQLFormat($this->dateofoperations).", humanresourceapproved='".$this->humanresourceapproved."', 
dateofpayrollclerkapproval=".changeDateFromPageToMySQLFormat($this->dateofpayrollclerkapproval).", dateofhumanresourceapproval=".changeDateFromPageToMySQLFormat($this->dateofhumanresourceapproval).", advancetaken='".$this->advancetaken."', travelallowances='".$this->travelallowances."', loantaken='" .$this->loantaken."', totalpaymentapproved='".$this->totalpaymentapproved."', uniformreturned='".$this->uniformreturned."', dateuniformreturned=".changeDateFromPageToMySQLFormat($this->dateuniformreturned).", commenceson=".changeDateFromPageToMySQLFormat($this->commenceson).", terminateson=".changeDateFromPageToMySQLFormat($this->terminateson).", approvalmessage='".$this->approvalmessage."', dateapproved=".changeDateFromPageToMySQLFormat($this->dateapproved).", status='".$this->status."', datecreated='".$this->datecreated."', lastupdatedate='".$this->lastupdatedate."'  WHERE id ='".$id."'";
		echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a leave application from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM leaveapplications WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->guardid = $array['guardid'];
		$this->leavestartdate= $array['leavestartdate'];
		$this->leaveenddate= $array['leaveenddate'];
		$this->leavetype= $array['leavetype'];
		$this->reason= $array['reason'];
		$this->verifiedby= $array['verifiedby'];
		$this->dateverified= $array['dateverified'];
		$this->employmentdate= $array['employmentdate'];
		$this->daysentitledperyear= $array['daysentitledperyear'];
		$this->totaldaysaccumulated= $array['totaldaysaccumulated'];
		$this->payrollclerkapproved = $array['payrollclerkapproved'];
		$this->operationsapproved= $array['operationsapproved'];
		$this->dateofoperations = $array['dateofoperations'];
		$this->humanresourceapproved = $array['humanresourceapproved'];
		$this->dateofpayrollclerkapproval = $array['dateofpayrollclerkapproval'];
		$this->dateofhumanresourceapproval = $array['dateofhumanresourceapproval'];
		$this->advancetaken = $array['advancetaken'];
		$this->travelallowances = $array['travelallowances'];
		$this->loantaken = $array['loantaken'];
		$this->totalpaymentapproved = $array['totalpaymentapproved'];
		$this->uniformreturned = $array['uniformreturned'];
        $this->dateuniformreturned = $array['dateuniformreturned'];
		$this->commenceson = $array['commenceson'];
		$this->terminateson = $array['terminateson'];
		$this->approvalmessage = $array['approvalmessage'];
		$this->dateapproved = $array['dateapproved'];
		$this->status= $array['status'];
		$this->datecreated = $array['datecreated'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];
		if (trim($array['payrollclerkapproved']) == "") {
		   $this->payrollclerkapproved = "N";
		}
		if (trim($array['operationsapproved']) == "") {
		   $this->operationsapproved = "N";
		}
		if (trim($array['humanresourceapproved']) == "") {
		   $this->humanresourceapproved = "N";
		}
		if (trim($array['uniformreturned']) == "") {
		   $this->uniformreturned = "N";
		    }
		}
	
	# Get all leave Applications in the database
	function getAllLeaveApplications(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM leaveapplications ORDER BY guardid ASC";
		#echo $query;
		$result = mysql_query($query);
		$leaveapplications = array();
		# Create an array of all leave applications  returned
		while($leaveapplication = mysql_fetch_assoc($result)) {
			$leaveapplications[] = $leaveapplication;
		}
		return $leaveapplications;
	}
	
	# Delete a leave Application from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM leaveapplications WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
		

}
?>