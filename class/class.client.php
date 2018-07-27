<?php
##################################################################
#### SmartGuard Client class
##################################################################
include_once "../include/commonfunctions.php";
class Client {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $name = "";
	var $plotno = "";
	var $boxno = "";
	var $floorno = "";
	var $contname = "";
	var $contposition = "";
	var $contphone = "";
	var $genphone = "";
	var $fax = "";
	var $email= "";
	var $billingtype= "";
	var $bank= "";
	var $accountnumber= "";
	var $isactive;
	var $expirydate= "";
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
	function getBuildingId() {
		return $this->buildingId;
	}
	function getName() {
		return $this->name;
	}
	function getPlotno() {
		return $this->plotno;
	}
	function getBoxno() {
		return $this->boxno;
	}
	function getFloorno() {
		return $this->floorno;
	}
	function getGenphone() {
		return $this->genphone;
	}
	function getContname() {
		return $this->contname;
	}
	function getContposition() {
		return $this->contposition;
	}
	function getContphone() {
		return $this->contphone;
	}
	function getFax() {
		return $this->fax;
	}
	function getEmail() {
		return $this->email;
	}
	function getBillingType() {
		return $this->billingtype;
	}
	function getBank() {
		return $this->bank;
	}
	function getAccountNumber() {
		return $this->accountnumber;
	}
	function isActive() {
		return $this->isactive;
	}
	function getExpiryDate() {
		return $this->expirydate;
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
	
	# Function to save a new client to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO clients (name, plotno, boxno, floorno, genphone, contphone, fax, email, billingtype, bank, accountnumber, isactive, expirydate, createdby, datecreated) 
			VALUES ('".$this->name."', '".$this->plotno."', '".$this->boxno."', '".$this->floorno."', '".$this->genphone."', '".$this->contphone."', '".$this->fax."', '".$this->email."', '".$this->billingtype."', '".$this->bank."', '".$this->accountnumber."', '".$this->isactive."', ".changeDateFromPageToMySQLFormat($this->expirydate).", '".$this->createdby."', NOW())";
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
	
	#Update a client in the database
	function edit($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE clients SET name='".$this->name."', plotno='".$this->plotno."', boxno='".$this->boxno."', floorno='".$this->floorno."', genphone='".$this->genphone."', contphone='".$this->contphone."', fax='".$this->fax."', email='".$this->email."', billingtype='".$this->billingtype."',  bank='".$this->bank."', accountnumber='".$this->accountnumber."', isactive='".$this->isactive."', expirydate=".changeDateFromPageToMySQLFormat($this->expirydate).", lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		echo $query;
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a user client from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM clients WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->plotno = $array['plotno'];
		$this->boxno = $array['boxno'];
		$this->floorno = $array['floorno'];
		$this->genphone = $array['genphone'];
		$this->contname = $array['contname'];
		$this->contposition = $array['contposition'];
		$this->contphone = $array['contphone'];
		$this->fax = $array['fax'];
		$this->email= $array['email'];
		$this->billingtype= $array['billingtype'];
		$this->bank= $array['bank'];
		$this->accountnumber= $array['accountnumber'];
		$this->expirydate= $array['expirydate'];
		$this->phone = $array['phone'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];
		if (trim($array['activity']) == 'Y') {
		   $this->active = "Y";
		} 
		else {
			$this->active = "N";
		}

	}
	
	
	
	# Get all clients in the database
	function getAllClients(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM clients ORDER BY id DESC";
		#echo $query;
		$result = mysql_query($query);
		$clients = array();
		# Create an array of all the clients returned
		while($client = mysql_fetch_assoc($result)) {
			$clients[] = $client;
		}
		return $clients;
	}
	
	# Added by Ismael on 16th January 2008
	# Get Searchable clients in the database
	function getSearchableClients($where){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM clients ".$where." ORDER BY id DESC";
		#echo $query;
		$result = mysql_query($query);
		$clients = array();
		# Create an array of all the clients returned
		while($client = mysql_fetch_assoc($result)) {
			$clients[] = $client;
		}
		return $clients;
	}
	
	# Delete a client from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM clients WHERE id = '".$id."'";
		$query2= "DELETE FROM assignments where client = '$id'";
		#echo $query;
		$result = mysql_query($query);
		$result2= mysql_query($query2);
	}
		

}
?>