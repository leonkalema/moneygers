<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$assignment=array();
//Set edit mode for the assignment
if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['action'];
	
// Assignment details from guard table
$assignment_array = getRowAsArray("SELECT * FROM assignments WHERE id = '".$id."'");
$assignment_array['equipmenttypes'] = split(",",$assignment_array['equipmenttypes']);
$a=$assignment_array['equipmenttypes'];
	$equip_type=array();
	$num_arr=array();
	for ($i=0; $i<sizeof($a);$i++){
		array_push($equip_type, substr($assignment_array['equipmenttypes'][$i],0,-1) );
		array_push($num_arr, substr($assignment_array['equipmenttypes'][$i],-1) );
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Assignment<?php } else {?>Create Assignment<?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2"><?php include "../core/header.php";?></td>
  </tr>
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "47")){?><a href="manageassignments.php">Manage Assignments</a>&gt;<?php } ?>  <?php if($action == 'edit') {?>Edit Assignment<?php } else if (isset($_GET['a']) && $_GET['a']=='view') {?> View Assignment <?php }else {?>Create Assignment<?php } ?></td>
      </tr>
      <tr>
        <td><form action="processassignment.php" method="post" name="assignment" id="assignment" onSubmit="return isNotNullOrEmptyString('client_name', 'Please enter the name of the client.') && isNotNullOrEmptyString('callsign', 'Please enter the assignment call sign.') && isNotNullOrEmptyString('servicetype', 'Please select the service type for the assignment.') && isNotNullOrEmptyString('directions', 'Please enter the directions to the client\'s location.') && isNotNullOrEmptyString('contactname', 'Please enter the client\'s contact name.') && isNotNullOrEmptyString('contactphone', 'Please enter the client\'s contact phone.') && isNotNullOrEmptyString('emergencyno', 'Please enter the client\'s contact phone number in emergencies.') && isNotNullOrEmptyString('start_day', 'Please select the day of the start date.') && isNotNullOrEmptyString('start_month', 'Please select the month of the start date.') && isNotNullOrEmptyString('start_year', 'Please select the year of the start date.') && isNotNullOrEmptyString('starttime', 'Please select the start time of the assignment.') && isNotNullOrEmptyString('endtime', 'Please select the end time of the assignment.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td colspan="3" class="label">
            <font class="redtext">*</font> is a required field              </td>
          </tr>
			<?php 
			if(isset($_GET['msg']) && trim($_GET['msg']) != ""){ ?>
				<tr><td colspan="3"><font class="redtext"><b><?php echo $_GET['msg'];?></b></font></td></tr>
			<?php }?>
            <tr>
              <td align="right" valign="top"><span  class="label">Client Name:</span><font class="redtext">*</font><br></td>
              <td valign="top" nowrap><?php if(isset($_GET['a'])){ echo $assignment_array['client'];} else {?><input type="text" name="client_name" id="client_name" value="<?php 
			  if(isset($_GET['clientid']) && trim($_GET['clientid']) != ""){
			   $clientid = decryptValue($_GET['clientid']);
			  	$client = getRowAsArray("SELECT name FROM clients WHERE id='$clientid' ");
				echo $client['name'];
			  } else {
			   echo $assignment_array['client'];
			   } ?>">
             &nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_clientname&value=','client_search','client_name','Searching...'); return false; ">Search for Client</a><?php } ?></td><td width="42%"><div id="client_search" style="width:200;  font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
             </tr>
            <tr>
            <td width="15%" align="right" class="label">Call Sign:<font class="redtext">*</font></td>
            <td width="43%" valign="top" nowrap>
              <?php if(isset($_GET['a'])){ echo $assignment_array['callsign'];} else {?>
              <input type="text" name="callsign" id="callsign" value="<?php echo $assignment_array['callsign'];?>">
&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/searchforpage.php?area=callsign&value=','callsign_search','callsign','Searching...'); return false; ">Check Availability</a><?php } ?></td>
            <td><div id="callsign_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
            </tr>
            <tr>
              <td align="right" class="label">Service Type:<font class="redtext">*</font></td>
              <td colspan="3"><?php if(isset($_GET['a'])){ echo $assignment_array['servicetype'];} else {?>
                <select id="servicetype" name="servicetype" onChange="changeTimeDropDowns('servicetype')">
                  <?php echo generateSelectOptions(getAllServiceTypes(), $assignment_array['servicetype']);?>
                </select>
                <?php }?></td>
            </tr>
            <tr>
              <td align="right" class="label">Region Code:</td>
              <td colspan="3"><?php if(isset($_GET['a'])){ echo $assignment_array['region'];} else {?><select id="region" name="region">
                <?php echo generateSelectOptions(getAllRegions(), $assignment_array['region']);?>
              </select><?php } ?></td>
            </tr>
            <tr>
              <td align="right" class="label">Directions to Location:<font class="redtext">*</font></td>
              <td colspan="3"><?php if(isset($_GET['a'])){ 
					echo "<div style=\"width:200px\">".$assignment_array['directions']."</div>";
				} else {?>
  <textarea name="directions" rows="5" id="directions"><?php echo $assignment_array['directions'];?></textarea>
  <?php } ?></td>
            </tr>
            <tr>
              <td align="right" class="label">Contact Details: </td>
              <td colspan="3"><table  border="0" cellpadding="0" class="contenttableborder">
                <tr>
                  <td class="label">Name:<font class="redtext">*</font></td>
                  <td><?php if(isset($_GET['a'])){ 
					echo $assignment_array['contactname'];
				} else {?>
    <input type="text" name="contactname" id="contactname" value="<?php echo $assignment_array['contactname'];?>" />
    <?php } ?></td>
                  <td class="label" >&nbsp;&nbsp;Email:</td>
                  <td ><?php if(isset($_GET['a'])){ 
					echo $assignment_array['contactemail'];
				} else {?>
    <input type="text" name="contactemail" id="contactemail" value="<?php echo $assignment_array['contactemail'];?>" />
    <?php } ?></td>
                </tr>
                <tr>
                  <td class="label">Telephone:<font class="redtext">*</font></td>
                  <td><?php if(isset($_GET['a'])){ 
					echo $assignment_array['contactphone'];
				} else {?>
    <input type="text" name="contactphone" id="contactphone" value="<?php echo $assignment_array['contactphone'];?>" />
    <?php } ?></td>
                  <td class="label">&nbsp;&nbsp;Fax:</td>
                  <td><?php if(isset($_GET['a'])){ 
					echo $assignment_array['contactfax'];
				} else {?>
    <input type="text" name="contactfax" id="contactfax" value="<?php echo $assignment_array['contactfax'];?>" />
    <?php } ?></td>
                </tr>

              </table></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Emergency No.:<font class="redtext">*</font> </td>
              <td colspan="3"><?php if(isset($_GET['a'])){ 
					echo $assignment_array['emergencyno'];
				} else {?>
    <input type="text" name="emergencyno" id="emergencyno" value="<?php echo $assignment_array['emergencyno'];?>" />
    <?php } ?></td>
            </tr>
            

             <tr>
             <td align="right" class="label">Start Date:<font class="redtext">*</font></td>
             <td colspan="3" nowrap class="label"><?php if(isset($_GET['a'])){ echo date("d-M-Y",strtotime($assignment_array['startdate']));} else {?>
               Day:
           <select id="start_day" name="start_day">
				<?php 
				if(isset($assignment_array['startdate']) && trim($assignment_array['startdate']) != ""){
					$date = date("d", strtotime($assignment_array['startdate']));
				} else {
					$date = "";
				}
				echo generateSelectOptions(getTime('day',''), $date);?>
			</select>
               &nbsp;Month:
				<select id="start_month" name="start_month">
				 <?php 
				 if(isset($assignment_array['startdate']) && trim($assignment_array['startdate']) != ""){
					$date =  date("F", strtotime($assignment_array['startdate']));
				} else {
					$date = "";
				}
				 echo generateSelectOptions(getTime('month',''),$date);?> 
				</select>
				&nbsp;Year:
				<select id="start_year" name="start_year">
				 <?php 
				  if(isset($assignment_array['startdate']) && trim($assignment_array['startdate']) != ""){
					$date = date("Y", strtotime($assignment_array['startdate']));
				} else {
					$date = "";
				}
				 echo generateSelectOptions(getTime('year','na'), $date);?>
				</select></th>             <?php }?>             </tr>
          <tr>
            <td align="right" class="label">End Date: </td>
           <td colspan="3" nowrap class="label"><?php if(isset($_GET['a'])){ 
		   if(trim($assignment_array['enddate']) != "" && $assignment_array['enddate'] !="0000-00-00"){
				echo date("d-M-Y",strtotime($assignment_array['enddate']));
			}
			} else {?>
             Day:
                 <select id="end_day" name="end_day">
<?php 
if(isset($assignment_array['enddate']) && trim($assignment_array['enddate']) != "0000-00-00"){
	$date = date("d", strtotime($assignment_array['enddate']));
} else {
	$date = "";
}

echo generateSelectOptions(getTime('day',''), $date);?>
</select>
&nbsp;Month:
<select id="end_month" name="end_month">
 <?php 
 if(isset($assignment_array['enddate']) && trim($assignment_array['enddate']) != "0000-00-00"){
	$date = date("F", strtotime($assignment_array['enddate']));
} else {
	$date = "";
}

 echo generateSelectOptions(getTime('month',''), $date);?> 
</select>
&nbsp;Year:
<select id="end_year" name="end_year">
 <?php 
  if(isset($assignment_array['enddate']) && trim($assignment_array['enddate']) != "0000-00-00"){
	$date = date("Y", strtotime($assignment_array['enddate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php }?></td>
           </tr>
          <tr>
            <td align="right" class="label">Start Time:<font class="redtext">*</font></td>
            <td colspan="3">
              <?php if(isset($_GET['a'])){ echo $assignment_array['starttime'];} else {?>
              <div id="starttime_show"><select id="starttime" name="starttime">
                <?php echo generateSelectOptions(getAllTime(), $assignment_array['starttime']);?>
              </select></div>
              <?php }?>			  </td>
            </tr>
          <tr>
            <td align="right" class="label">End Time:<font class="redtext">*</font> </td>
            <td colspan="3">
              <?php if(isset($_GET['a'])){ echo $assignment_array['endtime'];} else {?>
              <div id="endtime_show"><select id="endtime" name="endtime">
              <?php echo generateSelectOptions(getAllTime(),$assignment_array['endtime']);?>
            </select></div>
            <?php }?>            </td>
            </tr>
          <tr>
            <td colspan="4"><table border="0" cellpadding="2" cellspacing="2" id="exceptiontable">
              <?php
		  if(isset($_GET['id']) && trim($assignment_array['exception']) != ""){
		  	$exception_array = split(",",$assignment_array['exception']);
			
			for($i=0;$i<count($exception_array);$i++){
			   $tablerow = "<tr><td align=\"right\" class=\"label\">Exception(when<br>services aren't<br>needed):</td>".
           	   "<td colspan=\"3\">";
			   if(isset($_GET['a']) && $exception_array[$i] != "0000-00-00"){
			   	$tablerow .= date("d-M-Y", strtotime($exception_array[$i]));
			   } else {
			   $tablerow .= "Day:".
		 "<select id=\"exception_day[]".($i+1)."\" name=\"exception_day[]\">".
           generateSelectOptions(getTime('day',''), date("d", strtotime($exception_array[$i])))."</select> &nbsp;Month: <select id=\"exception_month[]".($i+1)."\" name=\"exception_month[]\">".generateSelectOptions(getTime('month',''), date("F", strtotime($exception_array[$i])))."</select> &nbsp;Year: <select id=\"exception_year[]".($i+1)."\" name=\"exception_year[]\">".generateSelectOptions(getTime('year','na'), date("Y", strtotime($exception_array[$i])))."</select>";
		   		}
		   $tablerow .= "</td></tr>";
		   
		   echo $tablerow;
			}
		  
		  } else {
		  	if(isset($_GET['a'])){
				echo "<tr><td width=\"15%\" align=\"right\" valign=\"top\" class=\"label\" nowrap>&nbsp;</td><td>No assigned guards.</td></tr>";
			} else {
		  
		  ?>
              <tr>
                <td align="right" class="label">Exception (when<br> 
                  services aren't<br> 
                  needed):
                <td colspan="3">Day:
                  <select id="exception_day[]1" name="exception_day[]">
                      <?php 
					   if(isset($assignment_array['exception']) && trim($assignment_array['exception']) != ""){
	$date = date("d", strtotime($assignment_array['exception']));
} else {
	$date = "";
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);?>
                    </select>
                  &nbsp;Month:
                  <select id="exception_month[]1" name="exception_month[]">
                    <?php 
				   if(isset($assignment_array['exception']) && trim($assignment_array['exception']) != ""){
	$date = date("F", strtotime($assignment_array['exception']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
                  </select>
                  &nbsp;Year:
                  <select id="exception_year[]1" name="exception_year[]">
                    <?php 
				    if(isset($assignment_array['exception']) && trim($assignment_array['exception']) != ""){
	$date = date("Y", strtotime($assignment_array['exception']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('year','na'), $date);?>
                  </select></td>
              </tr>
              <?php } 
			  
			  }?>
            </table></td>
            </tr>
         <?php if(!isset($_GET['a'])){ ?>
		  <tr>
            <td><a name="exception"></a></td>
            <td colspan="3"><img src="../images/bullet.gif">&nbsp;<a href="#exception"onClick="addRowToExceptionTable()">Add Exception</a> | <a href="#exception" onClick="removeRow('exceptiontable')">Remove Exception</a></td>
            </tr>
			<?php } ?>
		  
		    <tr>
		      <td align="right" class="label">No. of Assigned Guards:</td>
		      <td><?php if(isset($_GET['a'])){ echo $assignment_array['assignedguards'];} else {?><select name="assignedguards" id="assignedguards">
                <?php  if(isset($_GET['action']) && $_GET['action'] == "edit"){ ?>
                <option value="<?php echo $assignment_array['assignedguards'];?>" selected><?php echo $assignment_array['assignedguards'] ;?></option>
                <?php } 
					for($iq = 0; $iq <= 10; $iq++){
						echo "<option value=".$iq.">".$iq;
					}
				?>
              </select><?php } ?></td>
		      <td valign="top">&nbsp;</td>
		      </tr>
		    <tr>
            <td align="right" class="label"><b>Equipment Required: </b></td>
            <td><!--div id="guardid_search" style="width:250; height:90; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;"-->
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <?php
				$query = "SELECT type FROM equipment GROUP BY type";
				$result = mysql_query($query);
				$shown = 0;
				while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
					if(isset($_GET['a']) && in_array($line['type'],$equip_type)){
					 $a=$assignment_array['equipmenttypes'];
						for ($i=0; $i<count($a);$i++){
						$row = "<tr>
							<td width=\"1%\">-</td>
							<td width=\"99%\">".substr($assignment_array['equipmenttypes'][$i],0,-1)."(".substr($assignment_array['equipmenttypes'][$i],-1).")</td>
							</tr>";		
							echo $row;
							$shown++;
						}break;	
					} else if(!isset($_GET['a'])){
						$row = "<tr>
								<td width=\"1%\">
								<input type=\"checkbox\" name=\"equipmenttypes[]\" value=\"".$line['type']."\"";
						if(isset($assignment_array) && in_array($line['type'],$equip_type)){ $row .= "checked";}
					$row .= "></td>
						<td width=\"9%\">".$line['type']."</td>
							<td width=\"90%\">
							<select name=\"number[]\" id=\"number[]\">";
						if(isset($assignment_array) && in_array($line['type'],$equip_type)){
							$a=$assignment_array['equipmenttypes'];
							for ($i=0; $i<count($a);$i++){ 						
								$row .= "<option value='".$num_arr[$i]."' selected>".$num_arr[$i]."</option>";
							}//break;
						}
							$row .= "<option value=\"1\">1</option>
								<option value=\"2\">2</option>
								<option value=\"3\">3</option>
								<option value=\"4\">4</option>
								<option value=\"5\">5</option>
								<option value=\"6\">6</option>
								<option value=\"7\">7</option>
								<option value=\"8\">8</option>
								<option value=\"9\">9</option>
							</select>
							";//}
						$row .= "</td>
						</tr>";
					echo $row;
					}
				//}break;
			}//close while
		   ?>
              </table>
              <!--/div--></td>
            <td valign="top">&nbsp;</td>
		    </tr>
          <?php if(isset($_GET['id']) && trim($_GET['id']) != ""){ ?>
		    <!--tr>
		      <td align="right" class="label">Overtime:</td>
		      <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <?php 
			 if(trim($assignment_array['overtimeids']) != ""){
			 	// Show the last added first in the newly created array from the string
				$array = array_reverse(split(",",$assignment_array['overtimeids']));
			 	for($i=0;$i<count($array);$i++){
			 		$overtime_row = getRowAsArray("SELECT * FROM assignmentovertime WHERE id='".$array[$i]."'"); 
					if(($i%2)==0) {
				     $rowclass = "evenrow";
				  	} else {
				     $rowclass = "oddrow";
				  	} ?>
				<tr class="<?php echo $rowclass; ?>">
                  <td><?php echo "Guard: ".$overtime_row['guardid']."<br>";
				  echo "Date: ".date("d-M-Y",strtotime($overtime_row['date']))."<br>";
				  echo "Duration: ".$overtime_row['duration']." Hrs<br><hr>";
				  ?></td>
                </tr>			
				<?php }	
				
			 } else {
			 ?>
				<tr>
                  <td><?php echo "There is no overtime on this assignment.";?></td>
                </tr>
				<?php } 
				
				//Do not give option to edit if the user is just viewing
				if(!(isset($_GET['a']) && $_GET['a'] == "view")){
				?>
                <tr>
                  <td>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/assignmentovertime.php?id=<?php echo $assignment_array['callsign'];?>">Edit Overtime</a></td>
                </tr>
				<?php } ?>
              </table></td>
		      </tr-->
			  <?php } ?>
		    <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            </tr>
          
		  <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			<?php
		  //Do not give option to save if the user is just viewing
		  if(!(isset($_GET['a']) && $_GET['a'] == "view")){
		?><input type="submit" name="submit" id="submit" value="Save">
			<?php } ?>
              <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>"> <input type="hidden" name="isovertime" id="isovertime" value="<?php echo $_GET['id']; ?>"></td>
          </tr>
		  
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
