<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();

//Merge all passed values
if(isset($_POST['savesitreps'])){
	$formvalues = array_merge($_POST);
	//print_r($formvalues);
	//GO through all the formvalues and pick the set checkboxes
	$checkstr = "";
	$checkarray = array();
	$checkstr = "";//To store strings that will be saved into the db
	//Collect the checked boxes values
	foreach($formvalues as $key => $value){
		 $keyarray = split("_",$key);
		 if($keyarray[0] == "check"){
		 	//e.g., $checkarray[H311][2] = "Y" 
			//to create a multidimensional array to store the values
			$checkarray[$keyarray[2]][($keyarray[1] - 1)] = "Y";
		 }
	}
	
	//Organize into strings ready for saving into the db
	foreach($checkarray as $key => $value){
		$strtosavearr = array();
		for($i=0;$i<6;$i++){
			if(isset($checkarray[$key][$i]) && $checkarray[$key][$i] == "Y"){
				array_push($strtosavearr,"Y");
			} else {
				array_push($strtosavearr,"");
			}
		}
		
		if($checkstr != ""){
			$checkstr .= ",".$key."=".implode("-",$strtosavearr);
		} else {
			$checkstr = $key."=".implode("-",$strtosavearr);
		}
	}
	
	//Check if this is a new record or it already exists
	if($formvalues["todayid"] != ""){
		mysql_query("UPDATE guardschedule SET sitrepchecks = '".$checkstr."' WHERE id = '".$formvalues['todayid']."'");
	} else {
		mysql_query("INSERT INTO guardschedule (sitrepchecks, dateentered) VALUES ('".$checkstr."', '".date("Y-m-d",strtotime("now"))."')");
	}
	
	if(mysql_error() == ""){
		$msg = "The sitrep checks were saved successfully.";
	} else {
		$msg = "There were problems saving your sitrep checks. Please contact the administrator.";
	}
}

if(isset($_GET['d'])){
	$viewdate = decryptValue($_GET['d']);
	$viewyesterday = (date("d",strtotime($viewdate))-1)."-".date("M",strtotime($viewdate))."-".date("Y",strtotime($viewdate));
} else {
	$viewdate = date("d-M-Y",strtotime("now"));
	$viewyesterday = date("d-M-Y",strtotime("yesterday"));
}

$_SESSION['viewdate'] = $viewdate;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Sitrep Check For <?php echo $viewdate;?></title>
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
        <td class="headings"><a href="sitrepcalendar.php">Sitrep Calendar</a> &gt;
          <?php if(isset($_GET['d'])){ echo decryptValue($_GET['d']);} else {
		echo "Today's";
	}?> Sitrep Checks <?php 
	if(!isset($_GET['d'])){
		echo "[".date("d-M-Y",strtotime("now"))."]";?> 
		
		<?php if(userHasRight($_SESSION['userid'], "144")){?> 
		
		<?php if(isset($_GET['a']) and $_GET['a'] == "edit"){
			echo "[ <a href='sitreps.php'>View</a> ]";
		} else {
			if(userHasRight($_SESSION['userid'], "35") ){
				echo "[ <a href='sitreps.php?a=edit'>Edit</a> ]";
			}
		}?> 
		
		<?php } 
		} //To close the if to check whether you are viewing today.
		?></td>
      </tr>
      <tr>
        <td><form action="sitreps.php" method="post" name="guardsitreps" id="guardsitreps"><table width="100%" border="0">
          
          <tr>
            <td colspan="2" align="center" class="redtext"><?php if(isset($msg) && $msg != ""){ echo $msg;
			$msg = "";
			}?></td>
            </tr>
			
          <tr>
            <td valign="top" class="contenttableborder"><input type="button" name="cancel2" id="cancel2" value="<< Back" onClick="javascript:document.location.href='../core/dashboard.php'">
              <input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Financial Report','print')"><?php if(!isset($_GET['d'])){ ?>
              <b> [ Export &gt;&gt; <a href="#"   onClick="openPopWindow(600,350,'Guard Sitrep','msword')" title="Export report to MS Word"><img src="../images/mswordimg.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;<a href="#"   onClick="openPopWindow(600,350,'Guard Sitrep','msexcel')" title="Export report to MS Excel"><img src="../images/msexcelimg.gif" width="16" height="16" border="0"></a> ] 
              <?php }?>
              </b></td>
            <td valign="top" class="contenttableborder"><?php if(!isset($_GET['d'])){ ?><input type="submit" name="savesitreps" id="Button" value="Save Changes"><?php }?></td>
          </tr>
			
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="2">DATE: <?php 
	echo "<b>".$viewdate."</b>";?></td>
			</tr>
			<tr><td colspan="2"><div id="printresults_div" style="width:730; height:600; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;">
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
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
                </table>
			</div>
			</td>
			</tr>
			<tr><td colspan="2"><input type="hidden" name="todayid" value="<?php echo $todayarr['id'];?>"></td></tr>
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