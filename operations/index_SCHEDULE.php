<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') { echo "Edit Schedule"; } else {echo "Register Schedule"; } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><?php if(isset($_GET['a'])){ echo "Manage Schedules";} else { echo "<a href=\"../operations/?a=mng\">Manage Schedules</a> &gt; Generate New Schedule";} ?> </td>
      </tr>
      <tr>
        <td><form action="processoperations.php" method="post" name="guardschedule" id="guardschedule"><table width="100%" border="0">
          
          <tr>
            <td colspan="2" align="center" class="redtext"><?php if(isset($_GET['msg']) && $_GET['msg'] != ""){ echo $_GET['msg'];}?></td>
            </tr>
			<?php
			if(!(isset($_GET['a']) && $_GET['a'] == "mng")){ ?>
          <tr>
            <td width="50%" class="contenttableborder"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td colspan="2" class="label">TIP: To double check the assignment call sign, search below to show all the client's call signs: </td>
                </tr>
              <tr>
                <td>Enter Client Name: </td>
                <td><input name="clientname" id="clientname" type="text" size="15" onClick="this.select()">
                  &nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_clients&value=','client_search','clientname','Searching...'); return false; ">Search</a>&nbsp;</td>
              </tr>
              
            </table></td>
            <td width="50%" valign="top" class="contenttableborder"><div id="client_search" style="width:250; height:60; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
          </tr>
		
          <tr>
            <td height="24">&nbsp;</td>
            <td><input type="hidden" name="callsignlist" id="callsignlist" value=""></td>
          </tr><?php }
			if(isset($_GET['a']) && $_GET['a'] == "mng"){
			$q = mysql_query("SELECT callsign, scheduleunit,  relievers, exception FROM assignments WHERE servicetype <> 'Overtime' ORDER BY datecreated, scheduleunit ASC");
			$schedule_array = array();
			$reliever_array = array();
			// Group all assignments according to their schedule units with 
			// corresponding overtime and reliever information
			while($line=mysql_fetch_array($q,MYSQL_ASSOC)){
				if(array_key_exists($line['scheduleunit'],$schedule_array)){
					$schedule_array[$line['scheduleunit']] .= ",".$line['callsign'];
					
					if(trim($line['relievers']) != "" && $reliever_array[$line['scheduleunit']] != ""){
						//Add reliever to the list of relievers if they dont already exist
						$rel_ar = split(",",$reliever_array[$line['scheduleunit']]);
						if(!in_array($line['relievers'],$rel_ar)){
							$reliever_array[$line['scheduleunit']] .= ",".$line['relievers'];
						}
						
						
					} else if(trim($line['relievers']) != ""){
						$reliever_array[$line['scheduleunit']] = $line['relievers'];
					}
				} else {
					$schedule_array[$line['scheduleunit']] = $line['callsign'];
					
					if(trim($line['relievers']) != ""){
						$reliever_array[$line['scheduleunit']] = $line['relievers'];
					}
				}
			}
			
			// get overtime information
			$q_overtime = mysql_query("SELECT callsign, scheduleunit, exception FROM assignments WHERE servicetype = 'Overtime' ORDER BY datecreated, scheduleunit ASC");
			$overtime_array = array();
			while($line1=mysql_fetch_array($q_overtime,MYSQL_ASSOC)){
				if(array_key_exists($line1['scheduleunit'],$overtime_array)){
					$overtime_array[$line1['scheduleunit']] .= ",".$line1['callsign'];
				} else {
					$overtime_array[$line1['scheduleunit']] = $line1['callsign'];
				}
			}
			?>
			<tr><td colspan="2"><input type="button" name="newschedule" value="Generate Schedule &gt;&gt;" onClick="javascript:document.location.href='../operations'"></td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2"><div style="padding:4px;width:650px;height:420px;overflow: auto">
			<table width="100%">
				<tr class="tabheadings"><td>Schedule ID</td><td>Included Call Signs</td><td>Call Signs With Overtime</td><td>Schedule Reliever(s)</td></tr>
				<?php $j = 0;
			 // Show the last added first while preserving the array value 
			 // keys corresponding to the previous values
			 $schedule_array = array_reverse($schedule_array, true); 
			 //Display the schedule summarised
			  foreach($schedule_array as $i => $value){
			      if(($j%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                <td><a href="../operations/scheduledetails.php?a=mng&id=<?php echo $i; ?>&callsigns=<?php echo $value; ?>&ovtime=<?php echo $overtime_array[$i]; ?>&reliever=<?php  echo $reliever_array[$i]; ?>" class="normaltxtlink"><?php echo $i;?></a></td>
                <td><?php echo $value; ?></td>
                <td><?php echo $overtime_array[$i]; ?></td>
				<td><?php  echo $reliever_array[$i]; ?></td>
              </tr>
			  <?php 
			  $j++;
			  } ?>
			</table>
			</div>
			</td>
			</tr>
			
			<?php } else { ?>
          <tr>
            <td colspan="2">
			
			<table cellpadding="2" cellspacing="0" border="1" bordercolor="#CCCCCC">
              <tr>
                <td colspan="9"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><a href="#" onClick="showNextWeek('weekviewed', 's','')"><img src="../images/leftbullet.gif" width="5" height="11" border="0"></a></td>
                    <td align="center"><div id="weekending"><b>Week Ending <?php 
					
					if(isset($_GET['cw']) && trim($_GET['cw']) != ""){
					  		if(substr(trim($_GET['cw']),0,1) ==  "a"){
								$str = "+ ".substr(trim($_GET['cw']),2);
							} else if(substr(trim($_GET['cw']),0,1) ==  "s"){
								$str = "- ".substr(trim($_GET['cw']),2);
							}
					  	} else {
							$str = "+ 0";
						}
					$datestr = "next sunday ".$str." week";
					echo date("d-M-Y",strtotime($datestr)); ?></b></div>
                      <input type="hidden" name="weekviewed" id="weekviewed" value="<?php					 						if(isset($_GET['cw']) && trim($_GET['cw']) != ""){
					  		echo $_GET['cw'];
					  	} else {
							echo "a 0";
						}?>">                    </td>
                    <td align="right"><a href="#" onClick="showNextWeek('weekviewed', 'a','')"><img src="../images/bullet.gif" border="0"></a></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td align="center"><b>Assignment</b></td>
                <td align="center"><b>Guard(s)*</b></td>
                <td align="center" valign="top" bgcolor="#DEDEDE"><b>M</b></td>
                <td align="center" valign="top" bgcolor="#DEDEDE"><b>T</b></td>
                <td align="center" valign="top" bgcolor="#DEDEDE"><b>W</b></td>
                <td align="center" valign="top" bgcolor="#DEDEDE"><b>T</b></td>
                <td align="center" valign="top" bgcolor="#DEDEDE"><b>F</b></td>
                <td align="center" valign="top" bgcolor="#DEDEDE"><b>S</b></td>
                <td align="center" valign="top" bgcolor="#DEDEDE"><b>Su</b></td>
              </tr>
              <tr>
                <td><input name="assignment_1" id="assignment_1" type="text" size="4"  onChange="setWeekAssignments(this)" onClick="this.select()"></td>
                <td>*
                  <input name="guard_1" id="guard_1" type="text" size="6"></td>
                <td valign="top" nowrap  bgcolor="#FFCC66"><input name="assignment_1_m"  id="assignment_1_m" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_1_t"  id="assignment_1_t" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_1_w"  id="assignment_1_w" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_1_th"  id="assignment_1_th" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_1_f" id="assignment_1_f" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE" id="assignment_1_s"><input name="assignment_1_s"  id="assignment_1_s" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_1_su"  id="assignment_1_su" type="text" size="4" onClick="this.select()"></td>
              </tr>
              <tr>
                <td><input name="assignment_2" id="assignment_2" type="text" size="4"onChange="setWeekAssignments(this)" onClick="this.select()"></td>
                <td>*
                  <input name="guard_2" id="guard_2" type="text" size="6"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_2_m"  id="assignment_2_m" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap   bgcolor="#FFCC66"><input name="assignment_2_t"  id="assignment_2_t" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_2_w"  id="assignment_2_w" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_2_th"  id="assignment_2_th" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_2_f"  id="assignment_2_f" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name ="assignment_2_s" id="assignment_2_s" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  id="assignment_2_su" name="assignment_2_su" type="text" size="4" onClick="this.select()"></td>
              </tr>
              <tr>
                <td><input name="assignment_3" id="assignment_3" type="text" size="4"onChange="setWeekAssignments(this)" onClick="this.select()"></td>
                <td>*
                  <input name="guard_3" id="guard_3" type="text" size="6"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  id="assignment_3_m" name="assignment_3_m" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_3_t" id="assignment_3_t" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap   bgcolor="#FFCC66" ><input id="assignment_3_w" name="assignment_3_w" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  id="assignment_3_th" name="assignment_3_th" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_3_f" id="assignment_3_f" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_3_s" id="assignment_3_s" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_3_su" id="assignment_3_su" type="text" size="4" onClick="this.select()"></td>
              </tr>
              <tr>
                <td><input name="assignment_4" id="assignment_4" type="text" size="4"onChange="setWeekAssignments(this)" onClick="this.select()"></td>
                <td>*
                  <input name="guard_4" id="guard_4" type="text" size="6"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_4_m" id="assignment_4_m" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_4_t" id="assignment_4_t" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_4_w" id="assignment_4_w" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap   bgcolor="#FFCC66"><input  id="assignment_4_th" name="assignment_4_th" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_4_f" id="assignment_4_f" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_4_s" id="assignment_4_s" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_4_su" id="assignment_4_su" type="text" size="4" onClick="this.select()"></td>
              </tr>
              <tr>
                <td><input name="assignment_5" id="assignment_5" type="text" size="4"onChange="setWeekAssignments(this)" onClick="this.select()"></td>
                <td>*
                  <input name="guard_5" id="guard_5" type="text" size="6"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_5_m" id="assignment_5_m" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_5_t" id="assignment_5_t" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_5_w" id="assignment_5_w" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_5_th" id="assignment_5_th" type="text" size="4" onClick="this.select()"></td>
                <td  valign="top" nowrap   bgcolor="#FFCC66"><input id="assignment_5_f" name="assignment_5_f" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_5_s" id="assignment_5_s" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_5_su" id="assignment_5_su" type="text" size="4" onClick="this.select()"></td>
              </tr>
              <tr>
                <td><input name="assignment_6" id="assignment_6" type="text" size="4"onChange="setWeekAssignments(this)" onClick="this.select()"></td>
                <td>*
                  <input name="guard_6" id="guard_6" type="text" size="6"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_6_m" id="assignment_6_m" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_6_t" id="assignment_6_t" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignment_6_w" id="assignment_6_w" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_6_th" id="assignment_6_th" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_6_f" id="assignment_6_f" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap   bgcolor="#FFCC66"><input  id="assignment_6_s" name="assignment_6_s" type="text" size="4" onClick="this.select()"></td>
                <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignment_6_su" id="assignment_6_su" type="text" size="4" onClick="this.select()"></td>
              </tr>
              <tr>
                <td><b>Reliever</b></td>
                <td>*
                  <input name="gdreliever_1" id="gdreliever_1" type="text" size="6"onChange="setWeekAssignments(this)"></td>
                <td  valign="top" nowrap>&nbsp;</td>
                <td  valign="top" nowrap>&nbsp;</td>
                <td  valign="top" nowrap>&nbsp;</td>
                <td  valign="top" nowrap>&nbsp;</td>
                <td  valign="top" nowrap>&nbsp;</td>
                <td valign="top" nowrap>&nbsp;</td>
                <td valign="top"   bgcolor="#FFCC66"><input name="gdreliever_1_su" id="gdreliever_1_su" type="text" size="4" onClick="this.select()"></td>
              </tr>
            </table></td>
            </tr>
          <tr>
            <td colspan="2">*Separate more than one guard id with commas e.g. B001,H073,H238 </td>
            </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;
              <input type="checkbox" name="showovertime" id="showovertime" value="Y" onClick="showRelatedInfoWithHeight(this,'overtime')">              &nbsp;<b>Show Overtime Schedule</b></td>
          </tr>
          <tr>
            <td colspan="2"><div id="overtime" style="height:0px; visibility:hidden">
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td><table cellpadding="2" cellspacing="0" border="1" bordercolor="#CCCCCC">
                      <tr>
                        <td colspan="9"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td><a href="#" onClick="showNextWeek('weekviewed', 's')"><img src="../images/leftbullet.gif" width="5" height="11" border="0"></a></td>
                              <td align="center"><div id="div"><b>Overtime for Week Ending
                                <?php 
					
					if(isset($_GET['cw']) && trim($_GET['cw']) != ""){
					  		if(substr(trim($_GET['cw']),0,1) ==  "a"){
								$str = "+ ".substr(trim($_GET['cw']),2);
							} else if(substr(trim($_GET['cw']),0,1) ==  "s"){
								$str = "- ".substr(trim($_GET['cw']),2);
							}
					  	} else {
							$str = "+ 0";
						}
					$datestr = "next sunday ".$str." week";
					echo date("d-M-Y",strtotime($datestr));?>
                                </b></div>
                                  <input type="hidden" name="weekviewed2" id="weekviewed2" value="<?php					 						if(isset($_GET['cw']) && trim($_GET['cw']) != ""){
					  		echo $_GET['cw'];
					  	} else {
							echo "a 0";
						}?>">                              </td>
                              <td align="right"><a href="#" onClick="showNextWeek('weekviewed', 'a')"><img src="../images/bullet.gif" border="0"></a></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="center"><b>Assignment</b></td>
                        <td align="center"><b>Guard(s)*</b></td>
                        <td align="center" valign="top" bgcolor="#DEDEDE"><b>M</b></td>
                        <td align="center" valign="top" bgcolor="#DEDEDE"><b>T</b></td>
                        <td align="center" valign="top" bgcolor="#DEDEDE"><b>W</b></td>
                        <td align="center" valign="top" bgcolor="#DEDEDE"><b>T</b></td>
                        <td align="center" valign="top" bgcolor="#DEDEDE"><b>F</b></td>
                        <td align="center" valign="top" bgcolor="#DEDEDE"><b>S</b></td>
                        <td align="center" valign="top" bgcolor="#DEDEDE"><b>Su</b></td>
                      </tr>
                      <tr>
                        <td><input name="assignmento1" id="assignmento1" type="text" size="4"  onChange="setWeekAssignments(this)"></td>
                        <td>*
                          <input name="guardo1" id="guardo1" type="text" size="6"></td>
                        <td valign="top" nowrap  bgcolor="#FFCC66"><input name="assignmento1_m"  id="assignmento1_m" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento1_t"  id="assignmento1_t" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento1_w"  id="assignmento1_w" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento1_th"  id="assignmento1_th" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento1_f" id="assignmento1_f" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE" id="assignment_1_s"><input name="assignmento1_s"  id="assignmento1_s" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento1_su"  id="assignmento1_su" type="text" size="4" onClick="this.select()"></td>
                      </tr>
                      <tr>
                        <td><input name="assignmento2" id="assignmento2" type="text" size="4"onChange="setWeekAssignments(this)"></td>
                        <td>*
                          <input name="guardo2" id="guardo2" type="text" size="6"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento2_m"  id="assignmento2_m" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap   bgcolor="#FFCC66"><input name="assignmento2_t"  id="assignmento2_t" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento2_w"  id="assignmento2_w" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento2_th"  id="assignmento2_th" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento2_f"  id="assignmento2_f" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name ="assignmento2_s" id="assignmento2_s" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  id="assignmento2_su" name="assignmento2_su" type="text" size="4" onClick="this.select()"></td>
                      </tr>
                      <tr>
                        <td><input name="assignmento3" id="assignmento3" type="text" size="4"onChange="setWeekAssignments(this)"></td>
                        <td>*
                          <input name="guardo3" id="guardo3" type="text" size="6"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  id="assignmento3_m" name="assignmento3_m" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento3_t" id="assignmento3_t" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap   bgcolor="#FFCC66" ><input id="assignmento3_w" name="assignmento3_w" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  id="assignmento3_th" name="assignmento3_th" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento3_f" id="assignmento3_f" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento3_s" id="assignmento3_s" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento3_su" id="assignmento3_su" type="text" size="4" onClick="this.select()"></td>
                      </tr>
                      <tr>
                        <td><input name="assignmento4" id="assignmento4" type="text" size="4"onChange="setWeekAssignments(this)"></td>
                        <td>*
                          <input name="guardo4" id="guardo4" type="text" size="6"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento4_m" id="assignmento4_m" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento4_t" id="assignmento4_t" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento4_w" id="assignmento4_w" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap   bgcolor="#FFCC66"><input  id="assignmento4_th" name="assignmento4_th" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento4_f" id="assignmento4_f" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento4_s" id="assignmento4_s" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento4_su" id="assignmento4_su" type="text" size="4" onClick="this.select()"></td>
                      </tr>
                      <tr>
                        <td><input name="assignmento5" id="assignmento5" type="text" size="4"onChange="setWeekAssignments(this)"></td>
                        <td>*
                          <input name="guardo5" id="guardo5" type="text" size="6"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento5_m" id="assignmento5_m" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento5_t" id="assignmento5_t" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento5_w" id="assignmento5_w" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento5_th" id="assignmento5_th" type="text" size="4" onClick="this.select()"></td>
                        <td  valign="top" nowrap   bgcolor="#FFCC66"><input id="assignmento5_f" name="assignmento5_f" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento5_s" id="assignmento5_s" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento5_su" id="assignmento5_su" type="text" size="4" onClick="this.select()"></td>
                      </tr>
                      <tr>
                        <td><input name="assignmento6" id="assignmento6" type="text" size="4"onChange="setWeekAssignments(this)"></td>
                        <td>*
                          <input name="guardo6" id="guardo6" type="text" size="6"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento6_m" id="assignmento6_m" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento6_t" id="assignmento6_t" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input name="assignmento6_w" id="assignmento6_w" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento6_th" id="assignmento6_th" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento6_f" id="assignmento6_f" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap   bgcolor="#FFCC66"><input  id="assignmento6_s" name="assignmento6_s" type="text" size="4" onClick="this.select()"></td>
                        <td valign="top" nowrap bgcolor="#DEDEDE"><input  name="assignmento6_su" id="assignmento6_su" type="text" size="4" onClick="this.select()"></td>
                      </tr>
                      <tr>
                        <td><b>Reliever</b></td>
                        <td>*
                          <input name="gdrelievero1" id="gdrelievero1" type="text" size="6"onChange="setWeekAssignments(this)"></td>
                        <td  valign="top" nowrap>&nbsp;</td>
                        <td  valign="top" nowrap>&nbsp;</td>
                        <td  valign="top" nowrap>&nbsp;</td>
                        <td  valign="top" nowrap>&nbsp;</td>
                        <td  valign="top" nowrap>&nbsp;</td>
                        <td valign="top" nowrap>&nbsp;</td>
                        <td valign="top"   bgcolor="#FFCC66"><input name="gdrelievero1_su" id="gdrelievero1_su" type="text" size="4" onClick="this.select()"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td>*Separate more than one guard id with commas e.g. B001,H073,H238 </td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <?php } 
		  
		  if(!(isset($_GET['a']) && $_GET['a'] == "mng")){
		  ?>
          
          <tr>
            <td colspan="2" class="label">&nbsp;
              <input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:history.go(-1);">
              <input type="submit" name="saveandnew" id="saveandnew" value="Save &amp; New">
               <input type="submit" name="save" id="save" value="Save"></td>
            </tr>
			<?php } ?>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright">&copy;Solutions 
      For Business Limited</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>