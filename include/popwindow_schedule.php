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

?><table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr style="font-family: tahoma;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold"><td>Ser</td><td>ID</td><td>Name</td><td>Today's Loc</td>
				<td>24</td><td>OT 24</td><td>OT Col</td>
				</tr>
                  <?php
				   		$query = "SELECT g.id, g.guardid, p.firstname, p.lastname FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived <> 'Y' ORDER BY  g.datecreated DESC";
						//Get today's schedules by date and guard
						$todayarr = getRowAsArray("SELECT id, schedule, overtimeentry FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime("now"))."'");
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
						$yestarr = getRowAsArray("SELECT id, schedule, overtimeentry FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime("yesterday"))."'");
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
				    			$rowclass = "background-color:#FFFFFF";
				  			} else {
				     			$rowclass = "background-color:#CCCCCC; padding-bottom:2px";
				  			}
							
							$row = "<tr style = \"".$rowclass."\"><td height=\"30\">".($i+1)."</td><td>".$line['guardid']."</td><td>".$line['firstname']." ".$line['lastname']."</td><td>";
							
							if(isset($_GET['a']) && $_GET['a'] == "edit"){
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
							
							$row .= "</td><td>";
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
 <?php } ?>