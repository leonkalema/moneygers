<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if($_GET['type'] == "msword" || $_GET['type'] == "msexcel"){
$downloadtime = date("d-m-y-Hi")."Hrs";

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
	ini_set('zlib.output_compression', 'Off');

if($_GET['type'] == "msword"){
	$filename = "SmartGuardDownload-".$downloadtime.".doc";
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/vnd.ms-word");

} else if($_GET['type'] == "msexcel"){
	$filename = "SmartGuardDownload-".$downloadtime.".xls";
	header("Content-type: application/vnd.ms-excel");

}

# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment;filename=".$filename);
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
$formvalues = $_SESSION['formvalues'];
$viewdate = $_SESSION['viewdate'];

?><table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr><td>DATE: <?php 
	echo "<b>".$viewdate."</b>";?></td></tr>
				<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold"><td>Ser</td><td>Code</td><td>1st Time</td><td>2nd Time</td>
				<td>3rd Time</td><td>4th Time</td><td>5th Time</td><td>6th Time</td><td>Guard's Name</td>
				</tr>
                  <?php
				   		$query = "SELECT g.id, g.guardid, p.firstname, p.lastname FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived <> 'Y' ORDER BY  g.datecreated DESC";
						//Get today's schedules by date and guard
						$todayarr = getRowAsArray("SELECT id, schedule, overtimeentry, sitrepchecks FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime($viewdate))."'");
						if(count($todayarr) > 0){
							$todayrawarr = split(",",$todayarr['schedule']);
							$todayOTrawarr = split(",",$todayarr['overtimeentry']);
							$todaySitreprawarr = split(",",$todayarr['sitrepchecks']);
							
							for($k=0;$k<count($todayrawarr);$k++){
								$guardvaluearr = split("=",$todayrawarr[$k]);
								$todaydata[$guardvaluearr[0]] = $guardvaluearr[1];
							}
							
							for($k=0;$k<count($todayOTrawarr);$k++){
								$guardvaluearr = split("=",$todayOTrawarr[$k]);
								$todayOTdata[$guardvaluearr[0]] = $guardvaluearr[1];
							}
							
							for($k=0;$k<count($todaySitreprawarr);$k++){
								$guardvaluearr = split("=",$todaySitreprawarr[$k]);
								$todaySitrepdata[$guardvaluearr[0]] = $guardvaluearr[1];
							}
						}
						
						$result = mysql_query($query);
				   		$i = 0;
						while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		if(($i%2)==0) {
				    			$rowclass = "background-color:#FFFFFF";
				  			} else {
				     			$rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				  			}
							
							//Determine the guard's status or assignment at the set date
							$guardstatus = "";
							if(isset($todaydata[$line['guardid']]) && trim($todaydata[$line['guardid']]) != ""){
								$guardstatus = $todaydata[$line['guardid']];
							
							} else if(isset($todayOTdata[$line['guardid']]) && trim($todayOTdata[$line['guardid']]) != ""){
								$guardstatus = $todayOTdata[$line['guardid']];
							}
							
							//Get all guard statuses
							$statusarr = getAllScheduleStatus();
							
							//Show only the active guards
							if(!in_array($guardstatus, $statusarr) && $guardstatus != ""){
							
							//Generate array for sitrep checks for guard in question
							$sitrepData = split("-",$todaySitrepdata[$line['guardid']]);
							
							//Serial number and assignment code
							$row = "<tr style = \"".$rowclass."\"><td height=\"30\">".($i+1)."</td><td>".$guardstatus;
							$row .= "</td><td>";
							
							//First sirep check
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								$row .= "<input type=\"checkbox\" id=\"check_1_".$line['guardid']."\" name=\"check_1_".$line['guardid']."\" value=\"".$guardstatus."\" ";
								if($sitrepData[0] == "Y"){
									$row .= "checked";
								}
								$row .= ">";
							} else {
								$row .= $sitrepData[0];
							}
							$row .= "</td><td>";
							
							//Second sitrep check
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								$row .= "<input type=\"checkbox\" id=\"check_2_".$line['guardid']."\" name=\"check_2_".$line['guardid']."\" value=\"".$guardstatus."\" ";
								if($sitrepData[1] == "Y"){
									$row .= "checked";
								}
								$row .= ">";
							} else {
								$row .= $sitrepData[1];
							}
							$row .= "</td><td>";
							
							//Third sitrep check
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								$row .= "<input type=\"checkbox\" id=\"check_3_".$line['guardid']."\" name=\"check_3_".$line['guardid']."\" value=\"".$guardstatus."\" ";
								if($sitrepData[2] == "Y"){
									$row .= "checked";
								}
								$row .= ">";
							} else {
								$row .= $sitrepData[2];
							}
							
							$row .= "</td><td>";
							
							//Fourth sitrep check
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								$row .= "<input type=\"checkbox\" id=\"check_4_".$line['guardid']."\" name=\"check_4_".$line['guardid']."\" value=\"".$guardstatus."\" ";
								if($sitrepData[3] == "Y"){
									$row .= "checked";
								}
								$row .= ">";
							} else {
								$row .= $sitrepData[3];
							}
							$row .= "</td><td>";
							
							//Fifth sitrep check
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								$row .= "<input type=\"checkbox\" id=\"check_5_".$line['guardid']."\" name=\"check_5_".$line['guardid']."\" value=\"".$guardstatus."\" ";
								if($sitrepData[4] == "Y"){
									$row .= "checked";
								}
								$row .= ">";
							} else {
								$row .= $sitrepData[4];
							}
							$row .= "</td><td>";
							
							//Sixth sitrep check
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
								$row .= "<input type=\"checkbox\" id=\"check_6_".$line['guardid']."\" name=\"check_6_".$line['guardid']."\" value=\"".$guardstatus."\" ";
								if($sitrepData[5] == "Y"){
									$row .= "checked";
								}
								$row .= ">";
							} else {
								$row .= $sitrepData[5];
							}
							$row .= "</td><td>".$line['firstname']." ".$line['lastname']."</td></tr>";
					  
					  		echo $row;
				   			$i++;
							}
						}
				   ?>
                </table></td></tr>
                </table>
 <?php } ?>