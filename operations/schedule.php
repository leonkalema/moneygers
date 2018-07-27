<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();

//Get all the known statuses in the db
$statusarr = getAllScheduleStatus();

//Merge all passed values
if(isset($_POST['saveschedule'])){
	$formvalues = array_merge($_POST);
	
	//GO through all the schedule items and pick today's items
	$todaystr = "";
	foreach($formvalues['todayloc'] as $key => $value){
		if($todaystr != ""){ $todaystr .= ","; }
		//If the checkbox is checked, save the previous value
		if(isset($formvalues['check_'.$key])){ 
			$value = $formvalues['check_'.$key];
		}
		
		//Update the guard's status if it is different from what he had before
		$statustype = getRowAsArray("SELECT id, status FROM guardstatus WHERE status='".$value."'");
		$dutyarray = getRowAsArray("SELECT id FROM guardstatus WHERE status LIKE '%Duty%'");
		$prevstatusarr = getRowAsArray("SELECT status FROM guards WHERE guardid='".$key."'");
		
		//Check if the guard is on sold leave and add a value in the bonuses section
		$issoldleave = "";
		//Check sold leaves mark for all those leave applications that were sold
		$scheduleresparray = isOnLeave($line['guardid']);
		if($scheduleresparray[0] && $scheduleresparray[3] == "Y"){
			$issoldleave = "Y";
		}
		
		if($statustype['id'] != "" && $prevstatusarr['status'] != $statustype['id']){
			mysql_query("UPDATE guards SET status='".$statustype['id']."', statusstartdate = NOW() WHERE guardid='".$key."'");
		//The guard is on duty
		} else if(trim($value) != "" && !in_array($value, $statusarr) && $prevstatusarr['status'] != $dutyarray['id']){
			mysql_query("UPDATE guards SET status='".$dutyarray['id']."', statusstartdate = NOW() WHERE guardid='".$key."'");
			
			//First check whether the user is saving more than once before inserting a new bonus
			if(!hasSoldLeave($key, date("d-M-Y"))){
				//Get the guard's rate
				$guard = getRowAsArray("SELECT rate FROM guards WHERE guardid='".$key."'");
				//Save an activity in the guard finance table for bonus due to his sold leave
				mysql_query("INSERT INTO guardfinance (amount, type, date, reason, category, approved) VALUES ('".$guard['rate']."', 'Bonus', NOW(), 'Sold leave on Normal Duty', 'Sold Leave', 'Y')");
				//Update the guard's financial status with the new status id
				$guarddetails = getRowAsArray("SELECT financialstatus FROM guards WHERE guardid = '".$key."'");
				if(trim($guarddetails['financialstatus']) != ""){
					$guarddetails['financialstatus'] .= ",";
				}
				
				mysql_query("UPDATE guards SET guardfinance ='".$guarddetails['financialstatus'].mysql_insert_id()."' WHERE guardid = '".$key."'");
				
			}
		}
		$todaystr .= $key."=".$value;
	}
		
	$todayOTstr = "";
	foreach($formvalues['todayOT'] as $key => $value){
		if($todayOTstr != ""){ $todayOTstr .= ","; }
		$todayOTstr .= $key."=".$value;
		//First check whether the user is saving more than once before inserting a new bonus
		if(!hasSoldLeave($key, date("d-M-Y"))){
			
			//Get the guard's rate
			$guard = getRowAsArray("SELECT rate FROM guards WHERE guardid='".$key."'");
			//Save an activity in the guard finance table for bonus due to his sold leave
			mysql_query("INSERT INTO guardfinance (amount, type, date, reason, category, approved) VALUES ('".$guard['rate']."', 'Bonus', NOW(), 'Sold leave on Overtime Duty', 'Sold Leave', 'Y')");
			//Update the guard's financial status with the new status id
			$guarddetails = getRowAsArray("SELECT financialstatus FROM guards WHERE guardid = '".$key."'");
			if(trim($guarddetails['financialstatus']) != ""){
				$guarddetails['financialstatus'] .= ",";
			}
			
			mysql_query("UPDATE guards SET guardfinance ='".$guarddetails['financialstatus'].mysql_insert_id()."' WHERE guardid = '".$key."'");
				
		}
	}
	
	$yestOTstr = "";
	foreach($formvalues['yesterdayOT'] as $key => $value){
		if($yestOTstr != ""){ $yestOTstr .= ","; }
		$yestOTstr .= $key."=".$value;
	}
	
	//Update today's schedule if the schedule is already there.
	if($formvalues['todayid'] != ""){
		mysql_query("UPDATE guardschedule SET schedule = '".$todaystr."', overtimeentry = '".$todayOTstr."' WHERE id = '".$formvalues['todayid']."'");
	
	//Insert a new schedule into the DB if it is not already there.
	} else if($formvalues['todayid'] == ""){
		mysql_query("INSERT INTO guardschedule (schedule, overtimeentry, dateentered) VALUES ('".$todaystr."', '".$todayOTstr."', '".date("Y-m-d",strtotime("now"))."')");
	}
	//Update yesterday's OT schedule
	mysql_query("UPDATE guardschedule SET overtimeentry = '".$yestOTstr."' WHERE id = '".$formvalues['yestid']."'");
	
	if(mysql_error() == ""){
		$msg = "The schedule was saved successfully.";
	} else {
		$msg = "There were problems saving your schedule. Please contact the administrator.";
	}
}

if(isset($_GET['d'])){
	$viewdate = decryptValue($_GET['d']);
	$viewyesterday = (date("d",strtotime($viewdate))-1)."-".date("M",strtotime($viewdate))."-".date("Y",strtotime($viewdate));
} else {
	$viewdate = date("d-M-Y",strtotime("now"));
	$viewyesterday = date("d-M-Y",strtotime("yesterday"));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Guard Schedule For <?php echo $viewdate;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><a href="schedulecalendar.php">Schedule Calendar</a> &gt; <a href="../operations/">Weekly Schedule</a> |  <?php if(isset($_GET['d'])){ echo decryptValue($_GET['d']);} else {
		echo "Today's";
	}?> Schedule <?php 
	if(!isset($_GET['d'])){
		echo "[".date("d-M-Y",strtotime("now"))."]";?> 
		
		<?php if(userHasRight($_SESSION['userid'], "144")){?> 
		
		<?php if(isset($_GET['a']) and $_GET['a'] == "edit"){
			echo "[ <a href='schedule.php'>View</a> ]";
		} else {
			if(userHasRight($_SESSION['userid'], "35") ){
				echo "[ <a href='schedule.php?a=edit'>Edit</a> ]";
			}
		}?> 
		
		<?php } 
		} //To close the if to check whether you are viewing today.
		?></td>
      </tr>
      <tr>
        <td><form action="schedule.php" method="post" name="guardschedule" id="guardschedule"><table width="100%" border="0">
          
          <tr>
            <td colspan="2" align="center" class="redtext"><?php if(isset($msg) && $msg != ""){ echo $msg;
			$msg = "";
			}?></td>
            </tr>
			
          <tr>
            <td valign="top" class="contenttableborder"><input type="button" name="cancel2" id="cancel2" value="<< Back" onClick="javascript:document.location.href='../core/dashboard.php'">
              <input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Financial Report','print')"><?php if(!isset($_GET['d'])){ ?>
              <b> [ Export &gt;&gt; <a href="#"   onClick="openPopWindow(600,350,'Guard Schedule','msword')" title="Export report to MS Word"><img src="../images/mswordimg.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="#"   onClick="openPopWindow(600,350,'Guard Schedule','msexcel')" title="Export report to MS Excel"><img src="../images/msexcelimg.gif" width="16" height="16" border="0"></a> ] 
              <?php }?>
              </b></td>
            <td valign="top" class="contenttableborder"><?php if(!isset($_GET['d']) && $_GET['a'] == "edit"){ ?><input type="submit" name="saveschedule" id="Button" value="Save Changes"><?php }?></td>
          </tr>
			
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2"><div id="printresults_div" style="width:97%; height:600; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; ">
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold"><td>Ser</td><td><a href="schedule.php?a=order&va=id&ty=<?php if($_GET['ty'] == "desc"){ echo "asc";} else { echo "desc";}?>" style="color:#FFFFFF">ID<?php if(isset($_GET['ty']) && $_GET['va'] == "id"){
					if($_GET['ty'] == "desc"){ echo " &nbsp;&nbsp; <img src='../images/ascarrow.gif' border='0'>";} else { echo " &nbsp;&nbsp; <img src='../images/descarrow.gif' border='0'>";}
					}?></a></td><td><a href="schedule.php?a=order&va=name&ty=<?php if($_GET['ty'] == "desc"){ echo "asc";} else { echo "desc";}?>" style="color:#FFFFFF">Name<?php if(isset($_GET['ty']) && $_GET['va'] == "name"){
					if($_GET['ty'] == "desc"){ echo " &nbsp;&nbsp; <img src='../images/ascarrow.gif' border='0'>";} else { echo " &nbsp;&nbsp; <img src='../images/descarrow.gif' border='0'>";}
					}?></a></td><td><?php if(isset($_GET['d'])){ echo $viewdate;} else {
		echo "Today's";
	}?> Loc</td>
				<td>24</td><td>OT 24</td><td>OT Col</td>
				</tr>
                  <?php
				  		//Multi-dimensional Array to track how many guards are 
						//assigned to each assignment
						$assgntrackarr = array();
						$assignedguards = array();
						$orderstr = " ORDER BY  g.datecreated DESC";
						
						if($_GET['a'] == "order"){
							if($_GET['va'] == "id"){
								$orderstr = " ORDER BY  g.guardid";
							} else if($_GET['va'] == "name"){
								$orderstr = " ORDER BY  p.firstname";
							}
							
							
							if($_GET['ty'] == "desc"){
								$orderstr .= " DESC";
							} else {
								$orderstr .= " ASC";
							}
						}
						
				   		$query = "SELECT g.id, g.guardid, p.firstname, p.lastname FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived <> 'Y'".$orderstr;
						//Get today's schedules by date and guard
						$todayarr = getRowAsArray("SELECT id, schedule, overtimeentry FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime($viewdate))."'");
						if(count($todayarr) > 0){
							$todayrawarr = split(",",$todayarr['schedule']);
							$todayOTrawarr = split(",",$todayarr['overtimeentry']);
							
							for($k=0;$k<count($todayrawarr);$k++){
								$guardvaluearr = split("=",$todayrawarr[$k]);
								$todaydata[$guardvaluearr[0]] = $guardvaluearr[1];
							}
							
							for($k=0;$k<count($todayOTrawarr);$k++){
								$guardvaluearr = split("=",$todayOTrawarr[$k]);
								$todayOTdata[$guardvaluearr[0]] = $guardvaluearr[1];
							}
						}
						
						//get yesterday's schedule
						$yestarr = getRowAsArray("SELECT id, schedule, overtimeentry FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime($viewyesterday))."'");
						if(count($yestarr) > 0){
							$yestrawarr = split(",",$yestarr['schedule']);
							$yestOTrawarr = split(",",$yestarr['overtimeentry']);
							
							for($k=0;$k<count($yestrawarr);$k++){
								$guardvaluearr = split("=",$yestrawarr[$k]);
								$yestdata[$guardvaluearr[0]] = $guardvaluearr[1];
							}
							
							for($k=0;$k<count($yestOTrawarr);$k++){
								$guardvaluearr = split("=",$yestOTrawarr[$k]);
								$yestOTdata[$guardvaluearr[0]] = $guardvaluearr[1];
							}
						}
						
						$result = mysql_query($query);
				   		$i = 0;
						while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		if(($i%2)==0) {
				    			$rowclass = "padding-bottom:2px;color:#FFFFFF;";
				  			} else {
				     			$rowclass = "background-color:#000800;color:#FFFFFF;";
				  			}
							
							$row = "<tr style = \"";
							$issold = "";
							//Check sold leaves mark for all those leave applications that were sold
							$scheduleresparray = isOnLeave($line['guardid']);
							if($scheduleresparray[0] && $scheduleresparray[3] == "Y"){
								$issold = "Y";
							}
							
							//Check for over assignment
							//If it is not in already shown assignments and it is not a mere
							//guard status
							$check = "";
							if(in_array($todaydata[$line['guardid']],$assgntrackarr)){
								array_push($assignedguards[$todaydata[$line['guardid']]], $line['guardid']);
							}
							
							if(!in_array($todaydata[$line['guardid']],$assgntrackarr) && !in_array($todaydata[$line['guardid']], $statusarr)){
								array_push($assgntrackarr,$todaydata[$line['guardid']]);
								$assignedguards[$todaydata[$line['guardid']]] = array($line['guardid']);
							}
							
							//Get the number of assigned guards
							$assignmentdetails = getRowAsArray("SELECT assignedguards FROM assignments WHERE callsign = '".$todaydata[$line['guardid']]."'");
												
							if(count($assignedguards[$todaydata[$line['guardid']]]) > $assignmentdetails['assignedguards'] && trim($todaydata[$line['guardid']]) != ""){
								$row .= "";
							} else if($issold == "Y"){
								$row .= "";
							} else {
								$row .= $rowclass;
							}
							
							
							$row .= "\"><td height=\"30\">".($i+1)."</td><td>".$line['guardid']."</td><td>".$line['firstname']." ".$line['lastname'];
							//If the guard sold his leave
							if($issold == "Y"){
								$row .= "<br><b>(ON SOLD LEAVE)</b>";
							}
							//If the guard is overassigned
							if(count($assignedguards[$todaydata[$line['guardid']]]) > $assignmentdetails['assignedguards'] && trim($todaydata[$line['guardid']]) != ""){
								$row .= "<br><b>(OVER ASSIGNED)</b>";
							}
							$row .= "</td><td>";
							
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								//If the guard is on leave automatically select the leave option
								$leavearray = isOnLeave($line['guardid']);
								if($leavearray[0] && $todaydata[$line['guardid']] == ""){
									$todaydata[$line['guardid']] = "Leave";
								}
								
								$row .= "<table><tr><td width=\"1\"><input type=\"checkbox\" id=\"check_".$line['guardid']."\" name=\"check_".$line['guardid']."\" value=\"".$yestdata[$line['guardid']]."\" ";
								//Check if the current schedule and previous are the same 
								//or a new schedule
								if(($todaydata[$line['guardid']] == $yestdata[$line['guardid']]) || !isset($todaydata[$line['guardid']]) || ($todaydata[$line['guardid']] == "")){
									$row .= "checked";
								}
								$row .= "></td><td> Same as 24</td></tr>";
								$row .= "<tr><td colspan=\"2\"><select id=\"todayloc\" name=\"todayloc[".$line['guardid']."]\" onclick=\"uncheckOption('check_".$line['guardid']."')\">";
								
								$row .= generateSelectOptions(getAllGuardStatus(),  $todaydata[$line['guardid']]);
                				$row .= "</select></td></tr></table>";
							} else {
								$row .= $todaydata[$line['guardid']];
							}
							$row .= "</td><td>".$yestdata[$line['guardid']]."</td><td>";
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								$row .= "<select id=\"yesterdayOT\" name=\"yesterdayOT[".$line['guardid']."]\">";
								$row .= generateSelectOptions(getAllGuardStatus(),  $yestOTdata[$line['guardid']]);
								$row .= "</select>";
							} else {
								$row .= $yestOTdata[$line['guardid']];
							}
							
							$row .= "</td><td nowrap>";
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
							$row .= "<select id=\"todayOT\" name=\"todayOT[".$line['guardid']."]\">";
							$row .= generateSelectOptions(getAllGuardStatus(),  $todayOTdata[$line['guardid']]);
							$row .= "</select>";
							} else {
								$row .= $todayOTdata[$line['guardid']];
							}
							
							$row .= "</td></tr>";
					  
					  		echo $row;
				   			$i++;
						}
				   ?>
                </table>
			</div>
			</td>
			</tr>
			<tr><td colspan="2"><input type="hidden" name="todayid" value="<?php echo $todayarr['id'];?>"><input type="hidden" name="yestid" value="<?php echo $yestarr['id'];?>"></td></tr>
			<tr><td width="38%">&nbsp;</td>
			  <td width="62%">&nbsp;</td>
			</tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>