<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['a'])){
	$action = decryptValue($_GET['a']);
	$id = decryptValue($_GET['id']);
	
	if($action != "view"){
		$alarmdetails = getRowAsArray("SELECT assignment, alarmid FROM  alarms WHERE id='".$id."'");
		
		$assignmentdetails = getRowAsArray("SELECT callsign AS prevassignment, region AS prevlocation,  client AS prevclient FROM  assignments WHERE callsign='".$alarmdetails['assignment']."'");
		$formvalues = array_merge($alarmdetails, $assignmentdetails);
	}
} else {
	$action = "transfer";
}

if(isset($_POST['SaveChanges'])){
	$formvalues = array_merge($_POST);
	$alarmdetails = getRowAsArray("SELECT * FROM  alarms WHERE id='".$formvalues['alarmid']."'");
	
	//Save changes in the changes table
	mysql_query("INSERT INTO alarmactions SET alarmid='".$formvalues['alarmid']."', prevassignment='".$formvalues['prevassignment']."', prevlocation='".$formvalues['prevlocation']."', prevclient='".$formvalues['prevclient']."', newassignment='".$formvalues['assignment']."', newlocation='".$formvalues['region']."', newclient='".$formvalues['client']."', action='transfer', date_of_entry=NOW()");
	
	//Update the alarm row in the DB
	mysql_query("UPDATE alarms SET assignment ='".$formvalues['assignment']."', status='transfered' WHERE id='".$formvalues['alarmid']."'");
	
	//Re-direct back to transfered alarms on the manage page
	forwardToPage("../technical/managealarminstallations.php?a=transfered");
}

//View details of the alarm transfer
if($action == "view"){
	$formvalues = getRowAsArray("SELECT * FROM  alarmactions WHERE id='".$id."'");	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Alarm Installations</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><a href="managealarminstallations.php">Manage Alarm Installations</a>  &gt; 
		<?php 
		if($action == "transfer"){
			echo "Transfer Alarm ".$alarmdetails['alarmid'];
		} else if($action == "decommission"){
			echo "Decommission Alarm ".$alarmdetails['alarmid'];
		} else {
			echo "Details";
		}
		?>
		</td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="alarmtransfer.php" onSubmit="return isNotNullOrEmptyString('assignment', 'Please select the assignment you are transfering to.') &&  isNotNullOrEmptyString('region', 'Please select the region you are trsanfering to.') && isNotNullOrEmptyString('client', 'Please enter the name of the client you are transfering to.')">
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
           <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
		  <tr>
            <td width="12%">FROM:</td>
			
			<td width="74%"><input type="hidden" name="alarmid" id="alarmid" value="<?php echo $formvalues['alarmid'];?>"></td>
            </tr>
		  <tr>
		    <td align="right"><b>Assignment:</b></td>
		    <td><?php echo $formvalues['prevassignment'];?>
		      <input type="hidden" name="prevassignment" id="prevassignment" value="<?php echo $formvalues['prevassignment'];?>"></td>
		    </tr>
		  <tr>
		    <td align="right"><b>Location:</b></td>
		    <td>region <b><?php 
			$region = getRowAsArray("SELECT code, description FROM regions WHERE code = '".$formvalues['prevlocation']."'");
			echo $formvalues['prevlocation'];?></b> (<?php echo $region['description'];?>)
		      <input type="hidden" name="prevlocation" id="prevlocation" value="<?php echo $formvalues['prevlocation'];?>"></td>
		    </tr>
		  <tr>
		    <td align="right"><b>Client:</b></td>
		    <td><?php echo $formvalues['prevclient'];?>
		      <input type="hidden" name="prevclient" id="prevclient" value="<?php echo $formvalues['prevclient'];?>"></td>
		    </tr>
		  <tr>
		    <td colspan="2"><hr color="#CCCCCC"></td>
		    </tr>
		  <tr>
		    <td>TO:</td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		    <td align="right"><b>Assignment:</b> <font class="redtext">*</font></td>
		    <td><?php if($action == "view"){
				echo $formvalues['newassignment'];
			} else {?><select id="assignment" name="assignment">
              <?php
					echo generateSelectOptions(getCallSigns(), $formvalues['assignment']);
		
				?>
            </select><?php } ?></td>
		    </tr>
		  <tr>
		    <td align="right"><b>Location:</b> <font class="redtext">*</font></td>
		    <td><?php if($action == "view"){ 
			$region = getRowAsArray("SELECT code, description FROM regions WHERE code = '".$formvalues['prevlocation']."'");
			echo "region <b>".$formvalues['newlocation']."</b> (".$region['description'].")";} else {?><select id="region" name="region">
                <?php echo generateSelectOptions(getAllRegions(), $formvalues['region']);?>
              </select><?php } ?></td>
		    </tr>
		  <tr>
		    <td align="right"><b>Client:</b> <font class="redtext">*</font></td>
		    <td><?php if($action == "view"){ echo $formvalues['newclient'];} else {?><input name="client" id="client" type="text" value="<?php echo $formvalues['client'];?>"><?php } ?></td>
		    </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
		      <?php if($action != "view"){?><input type="submit" name="SaveChanges" id="SaveChanges" value="Save Changes"><?php } ?></td>
		    </tr>
			<tr>
            <td colspan="2"></td>
          </tr>
        </table>
		</form>
        </td>
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
