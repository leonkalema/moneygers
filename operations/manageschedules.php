<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
//today's date
$today=date("Y-m-d");

//Get all the known statuses in the db
$statusarr = getAllScheduleStatus();

//Go through the schedule table organising data for display
$scheduleresult = mysql_query("SELECT id, schedule, overtimeentry, dateentered FROM guardschedule WHERE dateentered <> '$today' ORDER BY dateentered DESC") or die(mysql_error());
$displayarr = array();

//Overrall counter
$k=0;
while($line = mysql_fetch_array($scheduleresult, MYSQL_ASSOC)){
	$guardassignarr = split(",",$line['schedule']);
	$guardOTarr = split(",",$line['overtimeentry']);
	$activeguards = array();
	$assignments  = array();
	$leave = array();
	$rest = array();
	$sick = array();
	$police = array();
	$other = array();

	for($i=0;$i<count($guardassignarr);$i++){
		//Pick guardid and assignment
		$assgnarr = split("=",$guardassignarr[$i]);
		
		//These are the active assignments.
		if(!in_array($assgnarr[1],$statusarr)){
			if(!in_array($assgnarr[1],$assignments)){array_push($assignments,$assgnarr[1]);}
			if(!in_array($assgnarr[0],$activeguards)){array_push($activeguards,$assgnarr[0]);}
		}
		if($assgnarr[1] == "Leave"){
			if(!in_array($assgnarr[0],$leave)){array_push($leave,$assgnarr[0]);}
		}
		if($assgnarr[1] == "Rest"){
			if(!in_array($assgnarr[0],$rest)){array_push($rest,$assgnarr[0]);}
		}
		if($assgnarr[1] == "Sick"){
			if(!in_array($assgnarr[0],$sick)){array_push($sick,$assgnarr[0]);}
		}
		if($assgnarr[1] == "Police Custody"){
			if(!in_array($assgnarr[0],$police)){array_push($police,$assgnarr[0]);}
		}
	}
	//Populate the array you are going to use to display the items
	array_push($displayarr, array($line['id'], date("d-M-Y",strtotime($line['dateentered'])), $activeguards, $assignments, $leave, $rest, $sick, $police));
	$k++;
}
$_SESSION['displayarray'] = $displayarr;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Previous Guard Schedules</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Previous Schedules (Before <?php echo date("d-M-Y",strtotime("now"));?>) </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="label">
              <input name="newschedule" type="button" id="newschedule" onClick="javascript:document.location.href='../operations/schedule.php'" value="View Today's Schedule">
            </span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          
			<?php
			
			if($k == 0){          			
				echo "<tr><td>There are no previous schedules to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td>Date</td>
                 <td>Active Guards </td>
				 <td>Assignments</td>
				 <td>On Leave</td>
                 <td>Resting</td>
				 <td>Sick</td>
				 <td>Police Custody</td>
              </tr>
			  <?php 
			  for($i=0;$i<$k;$i++) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <td><?php echo $displayarr[$i][1]; ?></td>
                <td><?php 
				if(count($displayarr[$i][2]) > 0){
				echo "<a href=\"javascript:showHideSlowLayer('scheduledetails.php?area=guards&count=".$i."','guard_".$displayarr[$i][0]."_show','','Loading...')\">".count($displayarr[$i][2])."</a>"; ?><div id="guard_<?php echo $displayarr[$i][0];?>_show" style="height:0px; visibility:hidden"></div><?php } else {
				echo "0";
				}?></td>
                <td><?php  
				if(count($displayarr[$i][3]) > 0){
				echo "<a href=\"javascript:showHideSlowLayer('scheduledetails.php?area=assign&count=".$i."','assign_".$displayarr[$i][0]."_show','','Loading...')\">".count($displayarr[$i][3])."</a>"; ?><div id="assign_<?php echo $displayarr[$i][0];?>_show" style="height:0px; visibility:hidden"></div><?php } else {
				echo "0";
				}?></td>
                <td><?php  
				if(count($displayarr[$i][4]) > 0){
				echo "<a href=\"javascript:showHideSlowLayer('scheduledetails.php?area=leave&count=".$i."','leave_".$displayarr[$i][0]."_show','','Loading...')\">".count($displayarr[$i][4])."</a>"; ?><div id="leave_<?php echo $displayarr[$i][0];?>_show" style="height:0px; visibility:hidden"></div><?php } else {
				echo "0";
				}?></td>
				<td><?php  
				if(count($displayarr[$i][5]) > 0){
				echo "<a href=\"javascript:showHideSlowLayer('scheduledetails.php?area=rest&count=".$i."','rest_".$displayarr[$i][0]."_show','','Loading...')\">".count($displayarr[$i][5])."</a>"; ?><div id="rest_<?php echo $displayarr[$i][0];?>_show" style="height:0px; visibility:hidden"></div><?php } else {
				echo "0";
				}?></td>
				<td><?php  
				if(count($displayarr[$i][6]) > 0){
				echo "<a href=\"javascript:showHideSlowLayer('scheduledetails.php?area=sick&count=".$i."','sick_".$displayarr[$i][0]."_show','','Loading...')\">".count($displayarr[$i][6])."</a>"; ?><div id="sick_<?php echo $displayarr[$i][0];?>_show" style="height:0px; visibility:hidden"></div><?php } else {
				echo "0";
				}?></td>
				<td><?php 
				if(count($displayarr[$i][7]) > 0){
				 echo "<a href=\"javascript:showHideSlowLayer('scheduledetails.php?area=police&count=".$i."','police_".$displayarr[$i][0]."_show','','Loading...')\">".count($displayarr[$i][7])."</a>"; ?><div id="police_<?php echo $displayarr[$i][0];?>_show" style="height:0px; visibility:hidden"></div><?php } else {
				echo "0";
				}?></td>
              </tr>
			  <?php 
			  } ?>
            </table></div></td>
          </tr>			
			<?php } ?>

<tr><td>&nbsp;</td>
</tr>

        </table>
        </td>
      </tr>
    </table></td>
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
