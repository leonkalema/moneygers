<?php

	class connection{
		var $link;
		function connection()
		{
			//die("Here");
			$this->link = mysql_connect( "localhost", "root", "" );
			if ( ! $this->link )
			die( "Couldn't connect to MySQL" );
			mysql_select_db( "cleaning", $this->link )
			or die ( "Couldn't open 'cleaning': ".mysql_error() );
		}
	}
	
	class inspection{
		//Attributes
		var $link;
		var $inspectionId; 
		var $inspectionId2; 
		var $buildingId;
		var $roomId;
		var $inspectorID;
		var $itemID;
		var $passed;
		var $comments;
		var $today;
		var $missed;
		var $method;
		var $standard;
		var $surface;
		var $faultId;
		var $failedId;
		var $dust;
		var $marks;
		var $floors;
		
		//Methods
		function add_inspection(){
			
			$query = "insert into inspection(date,buildingID,roomID,inspectorID,comments) values('$this->today','$this->buildingId','$this->roomId','$this->inspectorID','".mysql_real_escape_string($this->comments)."')";
			//die($query);
			
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$this->inspectionId = mysql_insert_id($this->link);
				
				return $this->inspectionId;
			}
		}
		
		function add_comments(){
			$query = "update inspection set comments='".mysql_real_escape_string($this->comments)."' where inspectionid=$this->inspectionId";
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return true;
			}
		}
		
		function add_inspection2(){
			$query = "insert into inspection2(inspectionId,itemId,passed) values('$this->inspectionId','$this->itemID','$this->passed')";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$this->inspectionId2 =  mysql_insert_id($this->link);
				$this->set_fault();
				if($this->passed == 0)
					$this->set_failed();
			}
		}
		function item_count(){
			$query = "select count(itemID) as items from inspection2 as i2 , inspection as i where i2.inspectionId = i.inspectionId and i.inspectionId = $this->inspectionId";
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$count = mysql_fetch_array($result);
				return $count['items'];
			}
		}
		
		function passed_items_count(){
			$query = "select count(itemID) as passed from inspection2 as i2 , inspection as i where i2.inspectionId = i.inspectionId and i.inspectionId = $this->inspectionId and passed=1";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$count = mysql_fetch_array($result);
				return $count['passed'];
			}
		}
		function get_inspection(){
			$query = "select * from inspectors as ip, inspection as i,rooms as r,buildings as b,clients as c where c.id = b.clientid and ip.inspectorid = i.inspectorid and b.buildingid = i.buildingid and b.buildingid = r.buildingid group by i.inspectionId";
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return $result;
			}
		}
		
		function get_inspection_id(){
			$query = "select * from items as it,inspection2 as i2,fault as f where i2.inspectionid = $this->inspectionId and i2.inspectionId2 = f.inspectionId2 and it.itemid = i2.itemid";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				//die("here".mysql_num_rows($result));
				return $result;
			}
		}
		
		function get_inspection_id_2(){
			$query = "select * from failed where inspectionid2 = $this->inspectionId2";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				//die("here".mysql_num_rows($result));
				return mysql_fetch_array($result);
			}
		}
		
		function get_inspection_id_3(){
			$query = "select * from clients as c, inspectors as ip, inspection as i,rooms as r,buildings as b where i.inspectionid = $this->inspectionId and c.id = b.clientid and ip.inspectorid = i.inspectorid and b.buildingid = i.buildingid and b.buildingid = r.buildingid group by i.inspectionId";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				//die("here".mysql_num_rows($result));
				return mysql_fetch_array($result);
			}
		}
		
		function update_inspection(){
			$query = "update inspection set comments='".mysql_real_escape_string($this->comments)."' where inspectionid=$this->inspectionId";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return true;
			}
		}
		
		function update_inspection_2(){
			$query = "update inspection2 set passed=$this->passed where inspectionId2=$this->inspectionId2";
			//echo $query."<br>";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				//$this->inspectionId2 =  mysql_insert_id($this->link);
				$this->set_fault_2();
				if($this->passed == 0)
					$this->set_failed_2();
				return true;
			}
		}
		
		function set_fault(){
			//die($this->missed.$this->method.$this->standard.$this->surface);
			$query = "insert into fault(inspectionID2,missed,method,standard,surface) values('$this->inspectionId2','$this->missed','$this->method','$this->standard','$this->surface')";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$this->faultId = mysql_insert_id($this->link);
				return $this->faultId;
			}
		}
		
		function set_fault_2(){
			//die($this->missed.$this->method.$this->standard.$this->surface);
			
			$query = "update fault set missed='$this->missed',method='$this->method',standard='$this->standard',surface='$this->surface' where inspectionID2=$this->inspectionId2";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return true;
			}
		}
		
		function delete_inspection(){
			$query = "delete from inspection where inspectionid=$this->inspectionId";
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return true;
			}
		}
		
		function set_failed(){
			//echo "Dust ".$this->dust." marks ".$this->marks." floors ".$this->floors;
			$query = "insert into failed(inspectionID2,dust,marks,floors) values('$this->inspectionId2','$this->dust','$this->marks','$this->floors')";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$this->failedId = mysql_insert_id($this->link);
				//die($this->failedId." is the id");
				return $this->failedId;
				
			}
		}
		
		function set_failed_2(){
			//echo "Dust ".$this->dust." marks ".$this->marks." floors ".$this->floors;
			$query = "update failed set dust='$this->dust',marks='$this->marks',floors='$this->floors' where inspectionid2=$this->inspectionId2";
			//echo $query;
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return true;
			} 
		}
		
		function get_failed(){
			$query = "select * from failed as f,inspection2 as i,items as it where f.inspectionid2=$this->inspectionId2 and i.inspectionid2 = f.inspectionid2 and it.itemid = i.itemid group by f.inspectionid2";
			//echo $query;
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return $result;
			} 
		}
	}
	
	class utilities{
		var $link;
		var $table;
		var $filter;
		var $rname;
		var $id;
		var $startDate;
		var $endDate;
		var $searchString;
		var $column;
		
		
		function search(){
			if(isset($this->startDate) && $this->startDate != 0 && isset($this->endDate) && $this->endDate != 0)
				$query = "select * from inspectors as ip, inspection as i,rooms as r,buildings as b,clients as c where c.id = b.clientid and i.date<=".$this->endDate." and i.date>=".$this->startDate." and ip.inspectorid = i.inspectorid and b.buildingid = i.buildingid and b.buildingid = r.buildingid group by i.inspectionId";
			else
				$query = "select * from inspectors as ip, inspection as i,rooms as r,buildings as b,clients as c where c.id = b.clientid and $this->column like '%".mysql_real_escape_string($this->searchString)."%' and ip.inspectorid = i.inspectorid and b.buildingid = i.buildingid and b.buildingid = r.buildingid group by i.inspectionId";
			//die($query);	
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error. ".mysql_error());
			else
				return $result;
		}
		
		function search2(){
			if(isset($this->startDate) && $this->startDate != 0 && isset($this->endDate) && $this->endDate != 0)
				$query = "select * from supervision as s,inspectors as i,buildings as b,clients as c where c.id = b.clientid and s.date<=".$this->endDate." and s.date>=".$this->startDate." and s.supervisorid = i.inspectorid and s.buildingId = b.buildingId order by s.date asc";
			else
				$query = "select * from supervision as s,inspectors as i,buildings as b,clients as c where c.id = b.clientid and $this->column like '%".mysql_real_escape_string($this->searchString)."%' and s.supervisorid = i.inspectorid and s.buildingId = b.buildingId order by s.date asc";
			//die($query);	
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error. ".mysql_error());
			else
				return $result;
		}
		
		function delete(){
			$query = "delete from $this->table where $this->rname = $this->id";
			//die($query);
			$result = mysql_query( $query, $this->link );
			return true;
		}
		
		function write_option_list()
		{
			$result = mysql_query( "SELECT * FROM $this->table order by $this->filter asc", $this->link );
			if ( ! $result )
			{
				print "failed to open $this->table<p>";
				return false;
			}
			while ( $a_row = mysql_fetch_row( $result ) ){
			print "<option value=\"$a_row[0]\"";
			print ">$a_row[1]\n";
			}
		}
		
		function write_option_list_2()
		{
			//die("Here");
			$result = mysql_query( "SELECT * FROM $this->table where buildingID =$this->id order by $this->filter asc", $this->link );
			if ( ! $result )
			{
			print "failed to open $this->table<p>";
			return false;
			}
			while ( $a_row = mysql_fetch_row( $result ) ){
			print "<option value=\"$a_row[0]\"";
			print ">$a_row[1]\n";
			}
		
		}
		
		function write_option_list_3()
		{
			//die("Here");
			$result = mysql_query( "SELECT * FROM $this->table where clientId =$this->id order by $this->filter asc", $this->link );
			if ( ! $result )
			{
			print "failed to open $this->table<p>";
			return false;
			}
			while ( $a_row = mysql_fetch_row( $result ) ){
			
			print "<option value=\"$a_row[0]\"";
			print ">$a_row[1]\n";
			}
		
		}
	}
	
	class item{
		var $link;
		var $itemId;
		var $itemName;
		var $inspectionId;
		
		//Methods
		function get_items(){
			$query = "select * from items where inspectionId=$this->inspectionId";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: in get_items ".mysql_error());
			else{
				return $result;
			}
		}
		
		function set_item(){
			$query = "insert into items(itemname,inspectionid) values('$this->itemName','".mysql_real_escape_string($this->inspectionId)."')";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$this->itemId = mysql_insert_id($this->link);
				return $this->itemId;
			}
		}
	}
	
	class supervision{
		var $link;
		var $supervisionId;
		var $supervisorId;
		var $general;
		var $staff;
		var $attendance;
		var $duties;
		var $requests;
		var $materials;
		var $challenges;
		var $conclusion;
		var $today;
		var $buildingId;
		
		function set_supervision(){
			
			$query = "insert into supervision(supervisorId,general,staff,attendance,duties,requests,materials,challenges,conclusion,date,buildingId) values('$this->supervisorId','".mysql_real_escape_string($this->general)."','".mysql_real_escape_string($this->staff)."','".mysql_real_escape_string($this->attendance)."','".mysql_real_escape_string($this->duties)."','".mysql_real_escape_string($this->requests)."','".mysql_real_escape_string($this->materials)."','".mysql_real_escape_string($this->challenges)."','".mysql_real_escape_string($this->conclusion)."','$this->today','$this->buildingId')";
			//die($query);
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				$this->supervisionId = mysql_insert_id($this->link);
				
				return $this->supervisionId;
			}
		}
		
		function get_supervision(){
			//die($this->today." building ".$this->buildingId." room ".$this->roomId." inspector ".$this->inspectorID." item ".$this->itemID." passed ".$this->passed." ".$this->comments);
			$query = "select * from supervision as s,inspectors as i,buildings as b,clients as c where c.id = b.clientid and s.supervisorid = i.inspectorid and s.buildingId = b.buildingId order by s.date asc";
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return $result;
			}
		}
		
		function get_supervision_id(){
			//die($this->today." building ".$this->buildingId." room ".$this->roomId." inspector ".$this->inspectorID." item ".$this->itemID." passed ".$this->passed." ".$this->comments);
			$query = "select * from clients as c,supervision as s,inspectors as i,buildings as b where s.supervisorid = i.inspectorid and s.supervisionid=$this->supervisionId and b.buildingId = s.buildingId and c.id = b.clientid";
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return mysql_fetch_array($result);
			}
		}
		
		function update_supervision(){
			//die($this->today." building ".$this->buildingId." room ".$this->roomId." inspector ".$this->inspectorID." item ".$this->itemID." passed ".$this->passed." ".$this->comments);
			$query = "update supervision set general = '".mysql_real_escape_string($this->general)."', staff = '".mysql_real_escape_string($this->staff)."', attendance = '".mysql_real_escape_string($this->attendance)."',duties = '".mysql_real_escape_string($this->duties)."', requests = '".mysql_real_escape_string($this->requests)."',materials = '".mysql_real_escape_string($this->materials)."',challenges = '".mysql_real_escape_string($this->challenges)."',conclusion = '".mysql_real_escape_string($this->conclusion)."', date = '$this->today' where supervisionId = '$this->supervisionId'";
			//die($query);
			
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return true;
			}
		}
		
		function delete_supervision(){
			$query = "delete from supervision where supervisionid = $this->supervisionId";
			$result = mysql_query($query,$this->link);
			if(!$result)
				die("Error: ".mysql_error());
			else{
				return true;
			}
		}
	}
	
	function encrypt($string, $key) {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }
  return base64_encode($result);
}
function decrypt($string, $key) {
  $result = '';
  $string = base64_decode($string);
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }
  return $result;
}
	
?>