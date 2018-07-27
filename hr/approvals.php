<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$leave=array();
//Set edit mode for the leave
if(isset($_GET['id']) || isset($_GET['t'])){
	$id = decryptValue($_GET['id']);
	$leavetype = decryptValue($_GET['ty']);
	$type = $_GET['t'];
	$_SESSION['type'] = $type;
	
	if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues'])){
		$formvalues = $_SESSION['formvalues'];
	}
	
	//Leave details from guard table
	$formvalues = getRowAsArray("SELECT * FROM leaveapplications WHERE id = '".$id."'");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Approve Leave Application</title>
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
        <td class="headings"><a href="../hr/manageleave.php">Manage Leave</a> &gt; Approve Leave Application for <?php 
		$line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$formvalues['guardid']."'");
		echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];
		?> from <?php echo date("d-M-Y",strtotime($formvalues['leavestartdate']));?> to <?php echo date("d-M-Y",strtotime($formvalues['leaveenddate']));?> </td>
      </tr>
      <tr>
        <td><form action="processleave.php" method="post" name="leave" id="leave"><table width="100%" border="0" cellpadding="2" cellspacing="2">
		<?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){ ?>
		<tr>
            <td height="30" align="right">&nbsp;</td>
            <td class="redtext"><b><?php echo $_SESSION['errors'];
			$_SESSION['errors'] = "";
			?></b></td>
          </tr>
		<?php } ?>
          <tr>
            <td height="30" colspan="2" class="label"><font class="redtext">*</font> is a required field </td>
            </tr>
		<?php if($type != "gm"){
		//Only Finance and HR need to approve pass leave
		if($leavetype != "Pass Leave"){
		?>
		<tr>
            <td colspan="2" align="right" class="label"><hr></td>
            </tr>
          <tr>
            <td class="label">OPERATIONS:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Operations Approval:<font class="redtext">*</font> </td>
            <td><?php if($type != "operations"){ echo $formvalues['operationsapproved']; } else {?>
              <select id="operationsapproved" name="operationsapproved">
                <option value="">&lt;Select&gt;</option>
                <option value="Y" <?php if($formvalues['operationsapproved'] == "Y"){ echo "selected";}?>>Accept</option>
                <option value="N" <?php if($formvalues['operationsapproved'] == "N"){ echo "selected";}?>>Reject</option>
              </select>
              <?php } 
			  $userdata = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$formvalues['whooperationapproved']."'");
			 if($formvalues['operationsapproved'] == "Y"){
			 	echo " [ Approved on: ".date("d-M-Y",strtotime($formvalues['dateofoperationsapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 } else if($formvalues['operationsapproved'] == "N"){
			 	echo " [ Rejected on: ".date("d-M-Y",strtotime($formvalues['dateofoperationsapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 }
			  ?></td>
          </tr>
          <tr>
            <td align="right" nowrap class="label">Operations Approval Notes:<font class="redtext">*</font> </td>
            <td><?php if($type != "operations"){ echo "<div style=\"width:150px\">".$formvalues['operationsapprovalmsg']."</div>"; } else {?>
              <textarea name="operationsapprovalmsg" id="operationsapprovalmsg" rows="4"><?php echo $formvalues['operationsapprovalmsg'];?></textarea>
              <?php } ?></td>
          </tr>
		  <?php } ?>
          <tr>
            <td colspan="2" align="right" class="label"><hr></td>
            </tr>
          <tr>
            <td class="label">HUMAN RESOURCE: </td>
            <td><input type="hidden" name="guardid" value="<?php echo $formvalues['guardid'];?>"></td>
          </tr>
          <tr>
            <td align="right" class="label">Days Entitled Per Year:</td>
            <td><?php 
			$line = getRowAsArray("SELECT leavedays FROM guards WHERE guardid = '".$formvalues['guardid']."'");
			if($type != "hr"){ echo $line['leavedays']; } else {?>
              <input type="text" name="leavedays" id="leavedays" value="<?php echo $line['leavedays'];?>">
<?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Days Accumulated: </td>
            <td><?php 
			$dayresult = mysql_query("SELECT leavestartdate, leaveenddate FROM leaveapplications WHERE status <> 'isarchived' AND guardid = '".$formvalues['guardid']."' AND payrollclerkapproved = 'Y' AND operationsapproved = 'Y' AND humanresourceapproved = 'Y'") or die(mysql_error());
			$totaldays = 0;
			while($line = mysql_fetch_array($dayresult,MYSQL_ASSOC)){
				$days_array = getDayDifference(date("d-M-Y",strtotime($line['leavestartdate'])),"",date("d-M-Y",strtotime($line['leaveenddate'])),"");
				$totaldays += $days_array[0];
			}
			echo $totaldays;
			?></td>
          </tr>
          <tr>
            <td align="right" class="label">Uniform Returned: </td>
            <td><?php if($type != "hr"){ echo $formvalues['uniformreturned']; } else {?>
              <input type="checkbox" name="uniformreturned" value="Y" <?php if($formvalues['uniformreturned'] == "Y"){ echo "checked";}?>><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">HR Approval:<font class="redtext">*</font></td>
            <td><?php if($type != "hr"){ echo $formvalues['humanresourceapproved']; } else {?>
              <select id="humanresourceapproved" name="humanresourceapproved">
                <option value="">&lt;Select&gt;</option>
                <option value="Y" <?php if($formvalues['humanresourceapproved'] == "Y"){ echo "selected";}?>>Accept</option>
                <option value="N" <?php if($formvalues['humanresourceapproved'] == "N"){ echo "selected";}?>>Reject</option>
              </select>
              <?php }
			  $userdata = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$formvalues['whohrapproved']."'");
			 if($formvalues['humanresourceapproved'] == "Y"){
			 	echo " [ Approved on: ".date("d-M-Y",strtotime($formvalues['dateofhrapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 } else if($formvalues['humanresourceapproved'] == "N"){
			 	echo " [ Rejected on: ".date("d-M-Y",strtotime($formvalues['dateofhrapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 }
			   ?></td>
          </tr>
          <tr>
            <td align="right" class="label">HR Approval Notes:<font class="redtext">*</font> </td>
            <td><?php if($type != "hr"){ echo "<div style=\"width:150px\">".$formvalues['hrapprovalmsg']."</div>"; } else {?>
              <textarea name="hrapprovalmsg" rows="4"><?php echo $formvalues['hrapprovalmsg'];?></textarea><?php } ?></td>
          </tr>
         
            <tr>
              <td colspan="2" align="right" valign="top" nowrap class="label"><hr></td>
              </tr>
            <tr>
              <td valign="top" nowrap class="label">FINANCE:</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="1%" align="right" valign="top" nowrap class="label">Advance Taken:</td>
              <td width="99%" class="label"><?php if($type != "finance"){
			  echo "Shs ".number_format($formvalues['advancetaken']);
			  } else {?>
Shs
                <input type="text" name="advancetaken" id="advancetaken" value="<?php echo number_format($formvalues['advancetaken']);?>"><?php } ?></td>
            </tr>
            <tr>
            <td align="right" nowrap class="label">Travel Allowances:</td>
            <td class="label"><?php 
			if($type != "finance"){
				echo "Shs ".number_format($formvalues['travelallowances']);
			} else {
			?>
Shs
              <input type="text" name="travelallowances" id="travelallowances" value="<?php echo number_format($formvalues['travelallowances']);?>"><?php } ?> </td>
		       <tr>
              <td align="right" class="label">Staff Debt Taken:</td>
              <td class="label"><?php if($type != "finance"){ echo "Shs ".number_format($formvalues['loantaken']); } else {?>
Shs
                <input type="text" name="loantaken" id="loantaken" value="<?php echo number_format($formvalues['loantaken']);?>"><?php } ?></td>
             </tr>
             <tr>
             <td align="right" class="label">Finance Approval:<font class="redtext">*</font></td>
             <td colspan="3"><?php if($type != "finance"){ echo $formvalues['payrollclerkapproved']; } else {?><select id="payrollclerkapproved" name="payrollclerkapproved">
			 <option value="">&lt;Select&gt;</option>
			 <option value="Y" <?php if($formvalues['payrollclerkapproved'] == "Y"){ echo "selected";}?>>Accept</option>
			 <option value="N" <?php if($formvalues['payrollclerkapproved'] == "N"){ echo "selected";}?>>Reject</option>
			 </select><?php } 
			 $userdata = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$formvalues['whofinanceapproved']."'");
			 if($formvalues['payrollclerkapproved'] == "Y"){
			 	echo " [ Approved on: ".date("d-M-Y",strtotime($formvalues['dateoffinanceapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 } else if($formvalues['payrollclerkapproved'] == "N"){
			 	echo " [ Rejected on: ".date("d-M-Y",strtotime($formvalues['dateoffinanceapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 }
			 ?></td>
          </tr>
          <tr>
            <td align="right" nowrap class="label">Finance Approval Notes:<font class="redtext">*</font> </td>
            <td colspan="3"><?php if($type != "finance"){ echo "<div style=\"width:150px\">".$formvalues['financeapprovalmsg']."</div>"; } else {?>
             <textarea name="financeapprovalmsg" rows="4"><?php echo $formvalues['financeapprovalmsg'];?></textarea>
             <?php } ?></td>
          </tr>
          <?php } else { ?>
		  <tr>
		    <td class="label">GENERAL MANAGER: </td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		  <td align="right" class="label" width="1%">GM Approval:<font class="redtext">*</font></td>
            <td width="99%"><?php if($_GET['p'] == "view"){ 
				if(trim($formvalues['gmapproved']) != ""){
					echo $formvalues['gmapproved'];
				} else {
					echo "NONE";
				}
				
			} else if($_GET['p'] == "edit"){?>
              <select id="gmapproved" name="gmapproved">
                <option value="">&lt;Select&gt;</option>
                <option value="Y" <?php if($formvalues['gmapproved'] == "Y"){ echo "selected";}?>>Accept</option>
                <option value="N" <?php if($formvalues['gmapproved'] == "N"){ echo "selected";}?>>Reject</option>
              </select>
              <?php } 
			  $userdata = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$formvalues['whogmapproved']."'");
			 if($formvalues['gmapproved'] == "Y"){
			 	echo " [ Approved on: ".date("d-M-Y",strtotime($formvalues['dateofgmapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 } else if($formvalues['gmapproved'] == "N"){
			 	echo " [ Rejected on: ".date("d-M-Y",strtotime($formvalues['dateofgmapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 }
			  ?></td>
          </tr>
          <tr>
            <td align="right" nowrap class="label">GM Approval Notes: </td>
            <td><?php if($_GET['p'] == "view"){ 
				if(trim($formvalues['gmapprovalmsg']) != ""){
					echo "<div style=\"width:150px\">".$formvalues['gmapprovalmsg']."</div>";
				} else {
					echo "NONE";
				}
				
			} else if($_GET['p'] == "edit"){?>
              <textarea name="gmapprovalmsg" rows="4"><?php echo $formvalues['gmapprovalmsg'];?></textarea>
              <?php } ?></td>
		  </tr>
		  <?php } ?>
		  <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <?php if($_GET['p'] != "view"){ ?>
			<input type="submit" name="submit" id="submit" value="Save">
			<input type="hidden" name="approval" id="approval" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>">			<?php } ?></td>
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
