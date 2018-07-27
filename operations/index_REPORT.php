<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();

//Merge all passed values
if(isset($_POST)){
	$formvalues = array_merge($_POST);
}

//Add the selected assignments to the list shown in the schedules
if(isset($_POST['selectValues']) && $_POST['selectValues'] != ""){
	//Add selected callsigns to the list of callsigns
	if(count($formvalues['callsign']) > 0){
		for($i=0;$i<count($formvalues['callsign']);$i++){
			//Ensure that the callsign was not already added and the max number of six
			// is not exceeded.
			if(isset($_SESSION['selectedCallSigns']) && (!in_array($formvalues['callsign'][$i],$_SESSION['selectedCallSigns'])) && (count($_SESSION['selectedCallSigns']) < 6)){
				array_push($_SESSION['selectedCallSigns'],$formvalues['callsign'][$i]);
				//echo "THe ".$i."th Call Sign: ".$formvalues['callsign'][$i];
			} else if(!isset($_SESSION['selectedCallSigns'])){
				$_SESSION['selectedCallSigns'] = array();
				array_push($_SESSION['selectedCallSigns'],$formvalues['callsign'][$i]);
			}
		}
	}
}

//The person decides to generate a new schedule
if(isset($_GET['a']) && $_GET['a'] == "new"){
	$_SESSION['selectedCallSigns'] = array();
	$_SESSION['weekending'] = "";
	
	if(isset($_GET['d']) && $_GET['d'] == "back"){
		$_SESSION['returnURL'] = "";
		forwardToPage("../core/dashboard.php");
	}
}

//The last sunday of the week
if(isset($formvalues['weekending']) && $formvalues['weekending'] != ""){
	$_SESSION['weekending'] = $formvalues['weekending'];
}
$datestring = $_SESSION['weekending'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Generate Client Schedule</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
        <td class="headings">Generate Client Schedule</td>
      </tr>
      <tr>
        <td><form action="index_REPORT.php" method="post" name="guardschedule" id="guardschedule"><table width="100%" border="0">
          
          <tr>
            <td colspan="2" align="center" class="redtext"><?php if(isset($_GET['msg']) && $_GET['msg'] != ""){ echo $_GET['msg'];}?></td>
            </tr>
			
          <tr>
            <td colspan="2" valign="top"><b>Instructions:</b><br>
              1. Search for call sign using the client's name (enter all/part of the name).<br>
2. Select the assignments whose schedule you want to view.<br>
3. Select the week ending whose schedule you want to view.<br>
4. Generate the schedule. </td>
            </tr>
          <tr>
            <td width="57%" valign="top" class="contenttableborder"><table width="90%" border="0" cellpadding="2" cellspacing="0">
              <tr>
                <td colspan="2" class="label">1. Search for Assignment (Call Sign): </td>
                </tr>
              <tr>
                <td width="49%">Enter Client Name: </td>
                <td width="51%" nowrap><input name="clientname" id="clientname" type="text" size="15" onClick="this.select()">
                  &nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_clients&value=','client_search','clientname','Searching...'); return false; ">Search</a>&nbsp;</td>
              </tr>
              
            </table></td>
            <td width="43%" valign="top" class="contenttableborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><span class="label">2. Select Assignments: </span></td>
              </tr>
              <tr>
                <td><div id="client_search" style="width:250px; height:0px; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div>
                  <input type="submit" name="SelectAssignment" id="SelectAssignment" value="Select" onClick="showSelectedValue('selectValues','YES')">
                  <input type="hidden" name="selectValues" id="selectValues" value="<?php if($_POST['selectValues'] == "YES"){ echo "";}?>"></td>
              </tr>
            </table></td>
          </tr>
		
          <tr>
            <td height="24" class="contenttableborder"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap class="label">3. Selected Assignments: <br>
                  (Max 6) </td>
                <td valign="top"><?php 
				if(isset($_SESSION['selectedCallSigns']) && count($_SESSION['selectedCallSigns'])>0){
					echo implode(", ",$_SESSION['selectedCallSigns']);
					//Set return URL to get back to in case you have saved
					$_SESSION['returnURL'] = "../operations/";
				} else {
					echo "None";
				}
				?></td>
              </tr>
              <tr>
                <td nowrap class="label">Generate for Week Ending:<br>
                  (Max 6) </td>
                <td><select name="weekending" id="weekending">
                    <option value="">&lt;Select One&gt;</option>
                    <?php
					for($j=-1;$j<6;$j++){
						$str = "+ ".$j;
						$datestr = "next sunday ".$str." week";
						echo "<option value=\"".date("d-M-Y",strtotime($datestr))."\"";
						if($datestring == date("d-M-Y",strtotime($datestr))){ echo "selected";}
						echo ">".date("d-M-Y",strtotime($datestr))."</option>";
					}?>
                </select></td>
              </tr>
            </table></td>
            <td height="24" class="contenttableborder" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="label">4. Generate Schedule: </td>
              </tr>
              <tr>
                <td height="45" valign="bottom"><input type="<?php if(isset($_POST['weekending']) || isset($_SESSION['returnURL'])){ echo "submit";} else { echo "button";} ?>" name="ViewSchedule" id="ViewSchedule" value="Generate Schedule &gt;&gt;"></td>
              </tr>
            </table></td>
          </tr>
			<tr>
			  <td colspan="2">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="index_REPORT.php?a=new">Generate New Schedule</a>&nbsp;| <a href="index_REPORT.php?a=new&d=back">Back to Dashboard</a> </td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2"><div id="printresults_div" style="<?php
			 if(count($_SESSION['selectedCallSigns'])>0 && $datestring != ""){
			 echo "visibility:visible";
			 } else {
			  echo "height:0px; visibility:hidden";
			 }
			 ?>">
			  <table cellpadding="2" cellspacing="0" border="1" bordercolor="#CCCCCC">
                <tr>
                  <td colspan="10" align="center"><?php echo "Week Ending: ".$datestring; ?></td>
                </tr>
                <tr>
                  <td align="center"><b>Assignment</b></td>
                  <td align="center" valign="top" bgcolor="#DEDEDE"><b>M</b></td>
                  <td align="center" valign="top" bgcolor="#DEDEDE"><b>T</b></td>
                  <td align="center" valign="top" bgcolor="#DEDEDE"><b>W</b></td>
                  <td align="center" valign="top" bgcolor="#DEDEDE"><b>T</b></td>
                  <td align="center" valign="top" bgcolor="#DEDEDE"><b>F</b></td>
                  <td align="center" valign="top" bgcolor="#DEDEDE"><b>S</b></td>
                  <td align="center" valign="top" bgcolor="#DEDEDE"><b>Su</b></td>
                </tr>
				<?php 
				
				for($k=0;$k<count($_SESSION['selectedCallSigns']);$k++){
					$assignment = getRowAsArray("SELECT * FROM assignments WHERE callsign = '".$_SESSION['selectedCallSigns'][$k]."'");
					
					$exception_array = split(",",$assignment['exception']);
					
				?>
                <tr>
                  <td><?php echo $assignment['callsign']." <a href=\"../core/assignment.php?action=edit&id=".encryptValue($assignment['id'])."\">Edit</a><br>(".$assignment['client'].")";?></td>
                  <td valign="top" nowrap  bgcolor="#DEDEDE"><?php 
				$monday = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($datestring)), date("d",strtotime($datestring))-6, date("Y",strtotime($datestring))));
				
				if(in_array($monday, $exception_array) || ($monday < date("Y-m-d",strtotime($assignment['startdate'])) || $monday > date("Y-m-d",strtotime($assignment['enddate'])))){
					echo "&nbsp;";
				} else {
					echo $assignment['callsign'];
				}?></td>
                  <td valign="top" nowrap bgcolor="#DEDEDE"><?php 
				$tuesday = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($datestring)), date("d",strtotime($datestring))-5, date("Y",strtotime($datestring))));
				if(in_array($tuesday, $exception_array) || ($tuesday < date("Y-m-d",strtotime($assignment['startdate'])) || $tuesday > date("Y-m-d",strtotime($assignment['enddate'])))){
					echo "&nbsp;";
				} else {
					echo $assignment['callsign'];
				}?></td>
                  <td valign="top" nowrap bgcolor="#DEDEDE"><?php 
				$wednesday = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($datestring)), date("d",strtotime($datestring))-4, date("Y",strtotime($datestring))));
				if(in_array($wednesday, $exception_array) || ($wednesday < date("Y-m-d",strtotime($assignment['startdate'])) || $wednesday > date("Y-m-d",strtotime($assignment['enddate'])))){
					echo "&nbsp;";
				} else {
					echo $assignment['callsign'];
				}?></td>
                  <td valign="top" nowrap bgcolor="#DEDEDE"><?php 
				$thursday = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($datestring)), date("d",strtotime($datestring))-3, date("Y",strtotime($datestring))));
				if(in_array($thursday, $exception_array) || ($thursday < date("Y-m-d",strtotime($assignment['startdate'])) || $thursday > date("Y-m-d",strtotime($assignment['enddate'])))){
					echo "&nbsp;";
				} else {
					echo $assignment['callsign'];
				}?></td>
                  <td valign="top" nowrap bgcolor="#DEDEDE"><?php 
				$friday = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($datestring)), date("d",strtotime($datestring))-2, date("Y",strtotime($datestring))));
				if(in_array($friday, $exception_array) || ($friday < date("Y-m-d",strtotime($assignment['startdate'])) || $friday > date("Y-m-d",strtotime($assignment['enddate'])))){
					echo "&nbsp;";
				} else {
					echo $assignment['callsign'];
				}?></td>
                  <td valign="top" nowrap bgcolor="#DEDEDE"><?php 
				$saturday = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($datestring)), date("d",strtotime($datestring))-1, date("Y",strtotime($datestring))));
				if(in_array($saturday, $exception_array) || ($saturday < date("Y-m-d",strtotime($assignment['startdate'])) || $saturday > date("Y-m-d",strtotime($assignment['enddate'])))){
					echo "&nbsp;";
				} else {
					echo $assignment['callsign'];
				}
				?></td>
                  <td valign="top" nowrap bgcolor="#DEDEDE"><?php 
				$sunday = date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($datestring)), date("d",strtotime($datestring)), date("Y",strtotime($datestring))));
				if(in_array($sunday, $exception_array) || ($sunday < date("Y-m-d",strtotime($assignment['startdate'])) || $sunday > date("Y-m-d",strtotime($assignment['enddate'])))){
					echo "&nbsp;";
				} else {
					echo $assignment['callsign'];
				}?></td>
                </tr>
				<?php } 
				$_SESSION['returnURL']="";
				?>
              </table>
			  </div>
			</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td>&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:window.location.href='../core/dashboard.php';">
                <input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')"></td>
			</tr>
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