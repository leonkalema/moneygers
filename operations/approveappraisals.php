<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();


// Dont go into this "kavuyo" if you want to save the last updated date
if(isset($_POST['SaveStatus']) && $_SESSION['type'] != "date"){
	$formvalues = array_merge($_POST);
	$id = $formvalues['guard'];
	$idstring = "";
	$oldidstring = "";
	$fullidstring = "";
	
	if($_SESSION['type'] == "add"){
		$savetype = "Bonus";
	} else {
		$savetype = "Deduction";
	}
	
	//Update the old actions
	if(isset($formvalues['id']) && count($formvalues['id']) != 0){
		for($i=0;$i<count($formvalues['id']);$i++){
			if(isset($formvalues['approved'][$i]) && $formvalues['approved'][$i] == "Y"){
				$approved = "Y";
			} else { 
				$approved = "N";
			} 
			mysql_query("UPDATE guardfinance SET amount = '".implode("",explode(",",$formvalues['amount'][$i]))."', type='".$savetype."', date = ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", reason = '".$formvalues['reason'][$i]."', approved = '".$approved."' WHERE id = '".$formvalues['id'][$i]."'");
			
			if($oldidstring == ""){
				$oldidstring = $formvalues['id'][$i];
			} else {
				$oldidstring .= ",".$formvalues['id'][$i];
			}
		}
	}
	
	//Save the new status too
	if(trim($formvalues['newamount']) != ""){
		if(isset($formvalues['newapproved']) && $formvalues['newapproved'] == "Y"){
			$approved = "Y";
		} else { 
			$approved = "N";
		}
		//Insert new overtime
		mysql_query("INSERT INTO guardfinance (amount, date, reason, approved, type) VALUES ('".implode("",explode(",",$formvalues['newamount']))."',".changeDateFromPageCombosToMySQLFormat($formvalues['newday'],$formvalues['newmonth'],$formvalues['newyear']).",'".$formvalues['newreason']."', '".$approved."', '".$savetype."')");
		
		$idstring = mysql_insert_id();
	}
	
	//Update the id string in the guards table
	$guardstatus = getRowAsArray("SELECT financialstatus FROM guards WHERE guardid = '".$id."'");
	if($oldidstring == ""){
		if(trim($guardstatus['financialstatus']) != "" && $idstring == ""){
			$fullidstring = $guardstatus['financialstatus'].",".$idstring;
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
	if(count($_SESSION['exceptids']) > 0){
		
		if($fullidstring != ""){
			$fullidstring .= ",".implode(",",array_unique($_SESSION['exceptids']));
		} else {
			$fullidstring = implode(",",array_unique($_SESSION['exceptids']));
		}
	}
	
	mysql_query("UPDATE guards SET financialstatus = '".$fullidstring."' WHERE guardid = '".$id."'");
	
	if(mysql_error() == ""){
		$_SESSION['msg'] = "The guard's status has been successfully added";
	} else {
		$_SESSION['msg'] = "There were problems saving the guard's status. Please contact your administrator.";
	}
}

// First time you come from the index page
if(isset($_GET['id']) || isset($_GET['a']) || isset($_GET['t'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	$type = $_GET['t'];
	$_SESSION['type'] = $type;
}
$data = getRowAsArray("SELECT g.guardid, g.financialstatus, g.lastpaymentdate, p.firstname,p.lastname,p.othernames  FROM guards g, persons p WHERE g.personid = p.id AND g.guardid='".$id."'");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Approve Staff Debt Application</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
        <td class="headings"><a href="../operations/manageappraisals.php">Manage Guard Bonuses </a> &gt; <?php if($_SESSION['type'] == 'add') {?>Manage Guard Bonuses <?php } ?> for <?php echo $data['guardid']." (".$data['firstname']." ".$data['lastname']." ".$data['othernames'].")"; ?></td>
      </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
      <tr>
        <td><form action="appraisals.php" method="post" name="appraisal" id="appraisal">
		<table width="100%" border="0" cellpadding="2" cellspacing="2" id="statustable" >
                <?php 
			 if(trim($data['financialstatus']) != ""){
			 	// Show the last added first in the newly created array from the string
				$array = array_reverse(split(",",$data['financialstatus']));
				$wherestr = "";
				// Where IDs not of this type are stored and added to the db later
				$_SESSION['exceptids'] = array();
				if($_SESSION['type'] == "add"){
					$wherestr = " AND type = 'Bonus'";
				} else {
					$wherestr = " AND type = 'Deduction'";
				}
			 	$counter = 0;
				for($i=0;$i<count($array);$i++){
			 		$status_row = getRowAsArray("SELECT * FROM guardfinance WHERE id='".$array[$i]."' ".$wherestr); 
					
					if(($counter%2)==0) {
				     $rowclass = "evenrow";
				  	} else {
				     $rowclass = "oddrow";
				  	}
					
					if($status_row['id'] != ""){
					?>
					<tr class="<?php echo $rowclass; ?>"><td height="26" colspan="3"><input type="hidden" name="id[]" id="id[]<?php echo ($counter+1);?>" value="<?php echo $status_row['id'];?>"></td></tr>
					<tr class="<?php echo $rowclass; ?>">
					<td align="right" class="label" width="12%">Amount:<font class="redtext">*</font></td>
					<td width="36%"><input type="text" name="amount[]" id="amount[]<?php echo ($counter+1);?>" value="<?php echo number_format($status_row['amount']);?>" /> Shs</td>
					<td width="52%"></td>
					</tr>
					
					<tr class="<?php echo $rowclass; ?>"><td align="right" class="label">Date:<font class="redtext">*</font></td><td colspan="2">Day: <select id="day[]<?php echo ($counter+1);?>" name="day[]">  <?php
					 if(isset($status_row['date']) && trim($status_row['date']) != ""){
	$date = date("d", strtotime($status_row['date']));
} else {
	$date = "";
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);
					 ?>
                     </select>&nbsp;Month: <select id="month[]<?php echo ($counter+1);?>" name="month[]">
                      <?php 
				   if(isset($status_row['date']) && trim($status_row['date']) != ""){
	$date = date("F", strtotime($status_row['date']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
                    </select>
                    &nbsp;Year:
                    <select id="year[]<?php echo ($counter+1);?>" name="year[]">
                      <?php 
				    if(isset($status_row['date']) && trim($status_row['date']) != ""){
	$date = date("Y", strtotime($status_row['date']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
                    </select></td>
                      </tr>
                <tr class="<?php echo $rowclass; ?>">
                  <td align="right" nowrap class="label">Reason:<font class="redtext">*</font></td>
                  <td colspan="2"><textarea name="reason[]" id="reason[]<?php echo ($counter+1);?>" rows="4"><?php echo $status_row['reason'];?></textarea></td>
                </tr>
               <tr class="<?php echo $rowclass; ?>">
             <td align="right" class="label"> Approval:<font class="redtext">*</font> </td>
             <td colspan="3"><?php if($type != "finance"){ echo $status_row['approved']; } else {?>
			 <select id="approved" name="approved">
			 <option value="">&lt;Select&gt;</option>
			 <option value="Y" <?php if($status_row['approved'] == "Y"){ echo "selected";}?>>Approved</option>
			 <option value="N" <?php if($status_row['approved'] == "N"){ echo "selected";}?>>Rejected</option>
			 </select><?php } 
			 $userdata = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$formvalues['whogmapproved']."'");
			 if($status_row['approved'] == "Y"){
			 	echo " [ Approved on: ".date("d-M-Y",strtotime($status_row['dateofgmapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 } else if($status_row['approved'] == "N"){
			 	echo " [ Rejected on: ".date("d-M-Y",strtotime($status_row['dateofgmapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 }
			 ?></td>
          </tr>
               <tr class="<?php echo $rowclass; ?>">
                 <td align="right" class="label">&nbsp;</td>
                 <td colspan="3">&nbsp;</td>
               </tr>
                <!--<tr class="<?php echo $rowclass; ?>">
                  <td align="right" nowrap class="label">Approved: </td>
                  <td colspan="2"><input type="checkbox" name="approved[]" id="approved[]<?php echo ($counter+1);?>" value="Y" <?php if($status_row['approved'] == "Y"){ echo "checked";}?>></td>
                </tr>	-->	 
			 	<?php 
					$counter++;
					// Save all those which are not of this type
					} else { array_push($_SESSION['exceptids'],$array[$i]);}
				
				}
				
			} ?>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			    &nbsp;&nbsp;
                <?php 
			if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?>
                <input type="submit" name="SaveStatus" id="SaveStatus" value="Save">
                <?php } ?>
                <input type="hidden" name="guard" id="guard" value="<?php echo $id;?>"></td>
			  </tr>
				</table>
        </form></td>
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
