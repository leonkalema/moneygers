<?php
##################################################################
#### SmartGuard User class
##################################################################
include_once "../include/commonfunctions.php";
class User {
	#############################################################
	###Class variables
	#############################################################
	var $id;
	var $firstname = "";
	var $lastname = "";
	var $username = "";
	var $email = "";
	var $password = "";
	var $telephonenumber = "";
	var $address = "";
	var $isactive;
	var $datecreated;
	var $createdby;
	var $lastupdatedby;
	var $lastupdatedate;
	var $error_msg;
	var $group;
	
	################################################################
	## Functions to get the values of the different class variables
	################################################################
	function getID() {
		return $this->id;
	}
	function getFirstName() {
		return $this->firstname;
	}
	function getLastName() {
		return $this->lastname;
	}
	function getUserName() {
		return $this->username;
	}
	function getPassword() {
		return $this->password;
	}
	function getEmail() {
		return $this->email;
	}
	function getTelephoneNumber() {
		return $this->telephonenumber;
	}
	function getAddress() {
		return $this->address;
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
	
	function getGroup() {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$array = getRowAsArray("SELECT groupid FROM usergroups WHERE userid = '".$id."'");
		$group = $array['groupid'];
		return $this->group;
	}
	#####################################################################
	
	# Function to save a new user to the database
	function create() {
		openDatabaseConnection();
		$query = "INSERT INTO users (firstname, lastname, username, email, password, telephonenumber, address, isactive, createdby, datecreated) 
			VALUES ('".$this->firstname."', '".$this->lastname."', '".$this->username."', '".$this->email."', SHA('".$this->password."'), '".$this->telephonenumber."', '".$this->address."', '".$this->isactive."', '".$this->createdby."', NOW())";
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
		#save the users groups
		$groupquery = "INSERT INTO usergroups (userid, groupid, datecreated) VALUES ";
		foreach($this->groups as $groupid) {
			$groupquery .= "('".$this->id."', '".$groupid."', NOW()),";
		}
		# remove the last comma
		$groupquery = substr($groupquery, 0, -1);
		 #echo "<br><br>".$groupquery."<br><br>";
		mysql_query($groupquery);
		# check if any errors have occured during the saving of the task to the database
		if (mysql_error() == "") {
			# no errors occured, so return the last inserted id
			# $this->id = mysql_insert_id();
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}
	}
	
	#Update a user in the database
	function edit($id) {
		if(!(intval($id) > 0)) {
			$id = $this->id;
		}
		openDatabaseConnection();
		$query = "UPDATE users SET firstname='".$this->firstname."', lastname='".$this->lastname."', username='".$this->username."', email='".$this->email."', telephonenumber='".$this->telephonenumber."', address='".$this->address."', isactive='".$this->isactive."', lastupdatedby = '".$this->lastupdatedby."' WHERE id ='".$id."'";
		$result = mysql_query($query);
		# check if any errors have occured during the saving of the activitys to the database
		if (mysql_error() == "") {
		} else {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}
		#remove all user group records for this user
		$deletequery = "DELETE FROM usergroups WHERE userid='".$id."'";
    	mysql_query($deletequery);
		# check if any errors have occured during the saving of the task to the database
		if (!(mysql_error() == "")) {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

		#save the users groups
		$groupquery = "INSERT INTO usergroups (userid, groupid, datecreated) VALUES ";
		foreach($this->groups as $groupid) {
			$groupquery .= "('".$this->id."', '".$groupid."', NOW()),";
		}
		# remove the last comma
		$groupquery = substr($groupquery, 0, -1);
		# echo "<br><br>".groupquery."<br><br>";
		mysql_query($groupquery);
		# check if any errors have occured during the saving of the task to the database
		if (!(mysql_error() == "")) {
			# add the error message to the string
			$this->error_msg = mysql_error();
		}

	}
	
	# Get a user from the database
	function get($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM users WHERE id = '".$id."'";
		#echo $query;
		$querydata = getRowAsArray($query);
		# Get values from the array and assign them to the variables in the class.
		$this->processArray($querydata);
	}
	
	# Process an array to set the values of the array keys to the class variables
	function processArray($array) {
		$this->id = $array['id'];
		$this->firstname = $array['firstname'];
		$this->lastname = $array['lastname'];
		$this->username = $array['username'];
		$this->email = $array['email'];
		$this->password = $array['password'];
		$this->telephonenumber = $array['telephonenumber'];
		$this->address = $array['address'];
		$this->isactive = $array['isactive'];
		$this->datecreated = $array['datecreated'];
		$this->createdby = $array['createdby'];
		$this->lastupdatedby = $array['lastupdatedby'];
		$this->lastupdatedate = $array['lastupdatedate'];
		$this->error_msg = $array['error_msg'];
		$this->groups = $array['groups'];
		if (trim($array['isactive']) == "") {
		   $this->isactive = "N";
		}

	}
	
	# Get a all users from the database
	function getAllUsers(){
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT *, CONCAT(firstname, \" \", lastname) as `name` FROM users ORDER BY firstname ASC";
		#echo $query;
		$result = mysql_query($query);
		$users = array();
		# Create an array of all the users returned
		while($user = mysql_fetch_assoc($result)) {
			$users[] = $user;
		}
		return $users;
	}
	
	# delete a user from the database
	function delete($id){
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "DELETE FROM users WHERE id = '".$id."'";
		#echo $query;
		$result = mysql_query($query);
	}
	
	#Get the group names of the user
	function getGroupNames($id) {
		if(intval($id) < 0) {
			$id = $this->id;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT ug.groupid, g.name FROM usergroups ug, groups g WHERE ug.userid = '".$id."' AND g.id=ug.groupid";
		$result = mysql_query($query);
		while($group = mysql_fetch_assoc($result)) {
			$this->groups[] = $group['groupid'];
			$groups[$group['groupid']] = $group['name'];
		}
		return $groups;
	
	}

	# Verify whether a user with a provided username exists
	function userNameExists($username){
		if($username=="") {
			$username = $this->username;
		}
		# Open database connection
		openDatabaseConnection();
		$query = "SELECT * FROM users WHERE username = '".$username."'";
		#echo $query;
		$result= mysql_query($query);
		if(mysql_num_rows($result) == 0) {
			return false;
		} else {
			return true;
		}
	}

}
?>