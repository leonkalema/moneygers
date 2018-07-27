<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['SaveOvertime'])){
	$formvalues = array_merge($_POST);
	$id = $formvalues['assignment'];
	$idstring = "";
	$oldidstring = "";
	$fullidstring = "";
	
	//Update the old actions
	if(isset($formvalues['id']) && count($formvalues['id']) != 0){
		for($i=0;$i<count($formvalues['id']);$i++){
			mysql_query("UPDATE assignmentovertime SET guardid = '".$formvalues['guardid'][$i]."', date = ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", duration = '".$formvalues['duration'][$i]."' WHERE id = '".$formvalues['id'][$i]."'");
			
			if($oldidstring == ""){
				$oldidstring = $formvalues['id'][$i];
			} else {
				$oldidstring .= ",".$formvalues['id'][$i];
			}
		}
	}
	
	//Save the new actions too
	if(trim($formvalues['newguardid']) != ""){
		//Insert new overtime
		mysql_query("INSERT INTO assignmentovertime (guardid, date, duration) VALUES ('".$formvalues['newguardid']."',".changeDateFromPageCombosToMySQLFormat($formvalues['newday'],$formvalues['newmonth'],$formvalues['newyear']).",'".$formvalues['newduration']."')");
		
		$idstring = mysql_insert_id();
		
	}
	
	//Update the id string in the assignments table
	$assignment = getRowAsArray("SELECT overtimeids FROM assignments WHERE callsign = '".$id."'");
	if($oldidstring == ""){
		if(trim($assignment['overtimeids']) != "" && $idstring == ""){
			$fullidstring = $assignment['overtimeids'].",".$idstring;
		} else {
			$fullidstring = $idstring;
		}
	} else if($oldidstring != "" && $idstring != ""){
		$fullidstring = $oldidstring.",".$idstring;
	} else if($oldidstring != ""){
		$fullidstring = $oldidstring;
	}else if($idstring != ""){
		$fullidstring = $idstring;
	}
	mysql_query("UPDATE assignments SET overtimeids = '".$fullidstring."' WHERE callsign = '".$id."'");
	
	if(mysql_error() == ""){
		$_SESSION['msg'] = "Your overtime has been successfully added";
	} else {
		$_SESSION['msg'] = "There were problems saving your overtime. Please contact your administrator.";
	}
}

// First time you come from the index page
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
$data = getRowAsArray("SELECT callsign, overtimeids, client FROM assignments WHERE callsign='".$id."'");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Incident<?php } else if($action == "view") {?>View Incident<?php } else { ?> Register Incident <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
        <td class="headings"><a href="../finance/manageguardfinance.php">Manage Guard Finances</a> &gt; Add Overtime for <?php echo $data['callsign']." (".$data['client'].")"; ?></td>
      </tr>
      <tr>
        <td><form action="../core/assignmentovertime.php" method="post" name="form1" id="form1" onSubmit=" return isNotNullOrEmptyString('guardid', 'Please enter the ID of the guard who worked overtime.') && isNotNullOrEmptyString('duration', 'Please specify the duration of the overtime.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="18%" align="right">&nbsp;</td>
            <td width="82%" class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
			<tr>
			  <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2"><tr><td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2" id="overtimetable" >
                <?php 
			 if(trim($data['overtimeids']) != ""){
			 	// Show the last added first in the newly created array from the string
				$array = array_reverse(split(",",$data['overtimeids']));
			 	for($i=0;$i<count($array);$i++){
			 		$overtime_row = getRowAsArray("SELECT * FROM assignmentovertime WHERE id='".$array[$i]."'"); 
					if(($i%2)==0) {
				     $rowclass = "evenrow";
				  	} else {
				     $rowclass = "oddrow";
				  	}
					?>
					<tr class="<?php echo $rowclass; ?>"><td colspan="2"><input type="hidden" name="id[]" id="id[]<?php echo ($i+1);?>" value="<?php echo $overtime_row['id'];?>"></td></tr>
					<tr class="<?php echo $rowclass; ?>">
					<td align="right" class="label">Guard:<font class="redtext">*</font></td>
					<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
					<td width="28%" valign="top"><input type="text" name="guardid[]" id="guardid[]<?php echo ($i+1);?>" value="<?php echo $overtime_row['guardid'];?>" /></td>
                    <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif" />&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&amp;value=','guardname_search<?php echo ($i+1);?>','guardid[]<?php echo ($i+1);?>','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                    <td width="49%"><div id="guardname_search<?php echo ($i+1);?>" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td></tr>
					</table>
					</td></tr>
					
					<tr class="<?php echo $rowclass; ?>"><td align="right" class="label">Date:<font class="redtext">*</font></td><td>Day: <select id="day[]<?php echo ($i+1);?>" name="day[]">";
                     <?php
					 if(isset($overtime_row['date']) && trim($overtime_row['date']) != ""){
	$date = date("d", strtotime($overtime_row['date']));
} else {
	$date = "";
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);
					 ?>
                     </select>&nbsp;Month: <select id="month[]<?php echo ($i+1);?>" name="month[]">
                      <?php 
				   if(isset($overtime_row['date']) && trim($overtime_row['date']) != ""){
	$date = date("F", strtotime($overtime_row['date']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
                    </select>
                    &nbsp;Year:
                    <select id="year[]<?php echo ($i+1);?>" name="year[]">
                      <?php 
				    if(isset($overtime_row['date']) && trim($overtime_row['date']) != ""){
	$date = date("Y", strtotime($overtime_row['date']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
                    </select></td>
                </tr>
                <tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label">Duration (Hrs):<font class="redtext">*</font></td>
                  <td><select id="duration[]<?php echo ($i+1);?>" name="duration[]">
                      <option>&lt;Select One&gt;</option>
                      <?php 
					  for($k=1;$k<13;$k++){
					  	echo "<option value=\"".$k."\"";
						if($k == $overtime_row['duration']){ echo "selected";}
						echo ">".$k."</option>";
					  }
					  ?>
                  </select></td>
                </tr>		 
			 	<?php } ?>
				</table></td></tr>
				<?php
			 } 
			 ?><tr>
                  <td align="right" class="label">&nbsp;</td>
                  <td nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick= "showHideLayer('addovertime')" >Add Overtime</a>  | <a href="#" onClick="removeMultRows('overtimetable',4)">Remove Overtime</a>&nbsp;</td>
                </tr>
				
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><hr color="#CCCCCC"></td>
                </tr>
				<tr>
                  <td colspan="2"><div id="addovertime" style="height:0px; visibility:hidden"><table width="100%">
                <tr>
                  <td colspan="2" class="label"><font class="redtext">*</font> is a required field</td>
                  </tr>
                <tr>
                  <td align="right" class="label">Guard:<font class="redtext">*</font></td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="28%" valign="top"><input type="text" name="newguardid" id="newguardid" value="" /></td>
                        <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif" />&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&amp;value=','guardname_search','newguardid','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                        <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                      </tr>
					  
                  </table></td>
                </tr>
                <tr>
                  <td align="right" class="label">Date:<font class="redtext">*</font></td>
                  <td class="label">Day:
                    <select id="newday" name="newday">
                        <?php 
					   if(isset($assignment_array['date']) && trim($assignment_array['date']) != ""){
	$date = date("d", strtotime($assignment_array['date']));
} else {
	$date = date("d", strtotime("now"));
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);?>
                      </select>
                    &nbsp;Month:
                    <select id="newmonth" name="newmonth">
                      <?php 
				   if(isset($assignment_array['date']) && trim($assignment_array['date']) != ""){
	$date = date("F", strtotime($assignment_array['date']));
} else {
	$date = date("F", strtotime("now"));
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
                    </select>
                    &nbsp;Year:
                    <select id="newyear" name="newyear">
                      <?php 
				    if(isset($assignment_array['date']) && trim($assignment_array['date']) != ""){
	$date = date("Y", strtotime($assignment_array['date']));
} else {
	$date = date("Y", strtotime("now"));
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" class="label">Duration (Hrs):<font class="redtext">*</font></td>
                  <td><select id="newduration" name="newduration">
                      <option selected="selected">&lt;Select One&gt;</option>
                      <?php 
					  for($k=1;$k<13;$k++){
					  	echo "<option value=\"".$k."\">".$k."</option>";
					  }
					  ?>
                  </select></td>
                </tr></table></div>
              </table></td>
			  </tr>
			
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			    &nbsp;&nbsp;
                <?php 
			if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?>
                <input type="submit" name="SaveOvertime" id="SaveOvertime" value="Save">
                <?php } ?>
                <input type="hidden" name="assignment" id="assignment" value="<?php echo $id;?>"></td>
			  </tr>
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
