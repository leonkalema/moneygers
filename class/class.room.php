<?php

class room{
	var $buildingId;
	var $roomId;
	var $roomName;
	//var $link;
	
	function set_room(){
		$query = "insert into rooms(roomname,buildingid) values('".mysql_real_escape_string($this->roomName)."',$this->buildingId)";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return mysql_insert_id();
		else
			die("Error: ".mysql_error());
	}
	
	function get_room(){
		$query = "select * from rooms as r,buildings as b where r.buildingId = $this->buildingId and b.buildingId = r.buildingId";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return $result;
		else
			die("Error ".mysql_error());
		
	}
	
	function update_room(){
		$query = "update rooms set roomname = '".mysql_real_escape_string($this->roomName)."' where roomId=$this->roomId";
		//die($query);
		$result = mysql_query($query);
		if($result)
			return true;
		else
			die("Error ".mysql_error());
	}
	
	function get_room_count(){
		$query = "select count(r.roomid) as sum from rooms as r,buildings as b where r.buildingId = $this->buildingId and b.buildingId = r.buildingId";
		//echo $query;
		//die($query);
		$result = mysql_query($query);
		//die($result);
		if($result)
			return mysql_fetch_array($result);
		else
			die("Error ".mysql_error());
		
	}
}

?>