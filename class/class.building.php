<?php

class building{
	
	var $buildingId;
	var $buildingName;
	var $clientId;
	
	function set_building(){
		$query = "insert into buildings(buildingName,clientId) values ('".mysql_real_escape_string($this->buildingName)."','$this->clientId')";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return mysql_insert_id();
		else
			die("Error ".mysql_error());
	}
	
	function get_building(){
		$query = "select * from buildings as b,clients as c where c.id = b.clientId and b.clientId = $this->clientId";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return $result;
		else
			die("Error ".mysql_error());
		
	}
	
	function update_building(){
		$query = "update buildings set buildingname = '".mysql_real_escape_string($this->buildingName)."' where buildingid=$this->buildingId";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return true;
		else
			die("Error ".mysql_error());
	}
	
	function get_building_rooms(){
		$query = "select * from buildings as b,rooms as r where b.buildingid=$this->buildingId and r.buildingid = b.buildingid";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return $result;
		else
			die("Error ".mysql_error());
		
	}
	
	function get_building_client(){
		$query = "select * from buildings as b,clients as c where c.id = b.clientid and b.buildingid=$this->buildingId";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return mysql_fetch_array($result);
		else
			die("Error ".mysql_error());
		
	}
	
}

?>