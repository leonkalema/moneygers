<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

// First time you come from the index page
if(isset($_GET['id'])){
	$id = decryptValue($_GET['id']);
	
	if(isset($_GET['a'])){
		$action = $_GET['a'];
	}
}
$data = getRowAsArray("SELECT callsign, replacementids, client FROM assignments WHERE callsign='".$id."'");

if(!userHasRight($_SESSION['userid'], "94")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You do not have permission to post replacement";
	forwardToPage($url);
}

if(isset($_POST['SaveReplacement'])){
	$formvalues = array_merge($_POST);
	$id = $formvalues['assignment'];
	$idstring = "";
	$oldidstring = "";
	$fullidstring = "";
	
	//Update the old actions
	if(isset($formvalues['id']) && count($formvalues['id']) != 0){
		for($i=0;$i<count($formvalues['id']);$i++){
			$guardprevschedule = getRowAsArray("SELECT guardid, date FROM assignmentreplacements WHERE id = '".$formvalues['id'][$i]."'");
			$guardprevstatus = getRowAsArray("SELECT id FROM guardstatustrack WHERE guard = '".$formvalues['guardid'][$i]."' AND status = 'Busy' AND date_started = '".$guardprevschedule['date']."'");
			//Update the guard's status to the new set date in the guard status track
			//If it is not available, then the status should be added to the guard status track table
			if(count($guardprevstatus) > 0){
				mysql_query("UPDATE guardstatustrack SET date_started = ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", dateended = ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i])." WHERE id = '".$guardprevstatus['id']."'");
			} else {
				mysql_query("INSERT INTO guardstatustrack (guard, status, notes, date_started, dateended, date_of_entry) VALUES ('".$formvalues['guardid'][$i]."', 'Busy', 'Set By System', ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", NOW())");
			}
			
			
			mysql_query("UPDATE assignmentreplacements SET guardid = '".$formvalues['guardid'][$i]."', date = ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i])." WHERE id = '".$formvalues['id'][$i]."'");
			
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
		mysql_query("INSERT INTO assignmentreplacements (guardid, date) VALUES ('".$formvalues['newguardid']."',".changeDateFromPageCombosToMySQLFormat($formvalues['newday'],$formvalues['newmonth'],$formvalues['newyear']).")");
		
		$idstring = mysql_insert_id();
		
		//Set the guard status for that day
		mysql_query("INSERT INTO guardstatustrack (guard, status, notes, date_started, dateended, date_of_entry) VALUES ('".$formvalues['guardid'][$i]."', 'Busy', 'Set By System', ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", NOW())");
		
	}
	
	//Update the id string in the assignments table
	$assignment = getRowAsArray("SELECT replacementids FROM assignments WHERE callsign = '".$id."'");
	if($oldidstring == ""){
		if(trim($assignment['replacementids']) != "" && $idstring == ""){
			$fullidstring = $assignment['replacementids'].",".$idstring;
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
	//Delete all the removed replacements
	$oldarray = split(",",$assignment['replacementids']);
	$newarray = split(",",$fullidstring);
	for($i=0;$i<count($oldarray);$i++){
		if(!in_array($oldarray[$i],$newarray)){
			mysql_query("DELETE FROM assignmentreplacements WHERE id = '".$oldarray[$i]."'");
		}
	}
	
	mysql_query("UPDATE assignments SET replacementids = '".$fullidstring."' WHERE callsign = '".$id."'");
	
	if(mysql_error() == ""){
		$_SESSION['msg'] = "The replacements have been successfully updated";
	} else {
		$_SESSION['msg'] = "There were problems saving your replacements. Please contact your administrator.";
	}
}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Assignment Replacements</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
        <td class="headings"><a href="../core/manageassignments.php">Manage Assignments</a> &gt; <?php if($action == "view"){ echo "View"; } else { echo "Add";}?> Replacements for <?php echo $data['callsign']." (".$data['client'].")"; ?></td>
      </tr>
      <tr>
        <td><form action="../core/assignmentreplacements.php" method="post" name="form1" id="form1" onSubmit="return isNotNullOrEmptyString('guardid', 'Please enter the ID of the replacement guard.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="18%" align="right">&nbsp;</td>
            <td width="82%" class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
			<tr>
			  <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2"><tr><td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2" id="replacementtable" >
                <?php 
			 if(trim($data['replacementids']) != ""){
			 	$array = split(",",$data['replacementids']);
			 	for($i=0;$i<count($array);$i++){
			 		$replacement_row = getRowAsArray("SELECT * FROM assignmentreplacements WHERE id='".$array[$i]."'"); 
					if(($i%2)==0) {
				     $rowclass = "evenrow";
				  	} else {
				     $rowclass = "oddrow";
				  	}
					?>
					<tr class="<?php echo $rowclass; ?>"><td colspan="2"><input type="hidden" name="id[]" id="id[]<?php echo ($i+1);?>" value="<?php echo $replacement_row['id'];?>"></td></tr>
					<tr class="<?php echo $rowclass; ?>">
					<td align="right" class="label" width="1%">Guard:<font class="redtext">*</font></td>
					<td width="99%"><?php if($action == "view"){ echo $replacement_row['guardid'];} else {?>
					<table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
					<td width="28%" valign="top"><input type="text" name="guardid[]" id="guardid[]<?php echo ($i+1);?>" value="<?php echo $replacement_row['guardid'];?>" /></td>
                    <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif" />&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&type=active&a=assignments&value=','guardname_search<?php echo ($i+1);?>','guardid[]<?php echo ($i+1);?>','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                    <td width="49%"><div id="guardname_search<?php echo ($i+1);?>" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td></tr>
					</table><?php } ?>					</td></tr>
					
					<tr class="<?php echo $rowclass; ?>"><td align="right" class="label">Date:<font class="redtext">*</font></td><td class="label"><?php if($action == "view"){ echo date("d-M-Y",strtotime($replacement_row['date']));} else {?>
					  Day: 
					      <select id="day[]<?php echo ($i+1);?>" name="day[]">";
                     <?php
					 if(isset($replacement_row['date']) && trim($replacement_row['date']) != ""){
	$date = date("d", strtotime($replacement_row['date']));
} else {
	$date = "";
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);
					 ?>
                     </select>&nbsp;Month: <select id="month[]<?php echo ($i+1);?>" name="month[]">
                      <?php 
				   if(isset($replacement_row['date']) && trim($replacement_row['date']) != ""){
	$date = date("F", strtotime($replacement_row['date']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
                    </select>
                    &nbsp;Year:
                    <select id="year[]<?php echo ($i+1);?>" name="year[]">
                      <?php 
				    if(isset($replacement_row['date']) && trim($replacement_row['date']) != ""){
	$date = date("Y", strtotime($replacement_row['date']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
                    </select>
                    <?php } ?></td>
                </tr>
                		 
			 	<?php } ?>
				</table></td></tr>
				<?php
			 } 
			 
			 if(!(isset($action) && $action == "view")){
			 ?><tr>
                  <td align="right" class="label">&nbsp;</td>
                  <td nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick= "showHideLayer('addreplacement')" >Post Replacement</a>  | <a href="#" onClick="removeMultRows('replacementtable',3)">Remove Replacement</a>&nbsp;</td>
                </tr>
				
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><hr color="#CCCCCC"></td>
                </tr>
				<tr>
                  <td colspan="2"><div id="addreplacement" style="height:0px; visibility:hidden"><table width="100%">
                <tr>
                  <td colspan="2" class="label"><font class="redtext">*</font> is a required field</td>
                  </tr>
                <tr>
                  <td align="right" class="label">Guard:<font class="redtext">*</font></td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="28%" valign="top"><input type="text" name="newguardid" id="newguardid" value="" /></td>
                        <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif" />&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&type=active&a=assignments&value=','guardname_search','newguardid','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
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
                </table>
                  </div>
              </table></td>
			  </tr>
			<?php } ?>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			    &nbsp;&nbsp;
                <?php 
			if(!(isset($action) && $action == "view")){ ?>
                <input type="submit" name="SaveReplacement" id="SaveReplacement" value="Save">
                <?php } ?>
                <input type="hidden" name="assignment" id="assignment" value="<?php echo $id;?>"></td>
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
