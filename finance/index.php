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
			mysql_query("UPDATE guardfinance SET amount = '".implode("",explode(",",$formvalues['amount'][$i]))."', type='".$savetype."', date = ".changeDateFromPageCombosToMySQLFormat($formvalues['day'][$i],$formvalues['month'][$i],$formvalues['year'][$i]).", reason = '".$formvalues['reason'][$i]."', approved = '".$approved."', category = '".$formvalues['category'][$i]."' WHERE id = '".$formvalues['id'][$i]."'");
			
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
		mysql_query("INSERT INTO guardfinance (amount, date, reason, approved, type, category) VALUES ('".implode("",explode(",",$formvalues['newamount']))."',".changeDateFromPageCombosToMySQLFormat($formvalues['newday'],$formvalues['newmonth'],$formvalues['newyear']).",'".$formvalues['newreason']."', '".$approved."', '".$savetype."', '".$formvalues['newcategory']."')");
		
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

// Save the last updated date
if($_SESSION['type'] == "date" && isset($_POST['SaveStatus'])){
	$formvalues = array_merge($_POST);
	$id = $formvalues['guard'];
	mysql_query("UPDATE guards SET lastpaymentdate = ".changeDateFromPageCombosToMySQLFormat($formvalues['newday'],$formvalues['newmonth'],$formvalues['newyear'])." WHERE guardid = '".$id."'");
	
	forwardToPage("manageguardfinance.php");
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
<title>Moneyge My Company - <?php if($_SESSION['type'] == 'add') {?>Manage Guard Bonuses<?php } else if($_SESSION['type'] == 'subtract') {?>Manage Guard Deductions<?php } else if($_SESSION['type'] == 'date') {?>Change Last Payment Date<?php } ?></title>
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
        <td class="headings"><a href="../finance/manageguardfinance.php">Manage Guard Finances</a> &gt; <?php if($_SESSION['type'] == 'add') {?>Manage Guard Bonuses<?php } else if($_SESSION['type'] == 'subtract') {?>Manage Guard Deductions<?php } else if($_SESSION['type'] == 'date'){ ?>Update Last Payment Date <?php } ?> for <?php echo $data['guardid']." (".$data['firstname']." ".$data['lastname']." ".$data['othernames'].")"; ?></td>
      </tr>
      <tr>
        <td><form action="../finance/index.php" method="post" name="form1" id="form1"> <!-- onSubmit=" return isNotNullOrEmptyString('newamount', 'Please enter the new amount .') && isNotNullOrEmptyString('newday', 'Please select the day.') && isNotNullOrEmptyString('newmonth', 'Please select the month.') && isNotNullOrEmptyString('newyear', 'Please select the year.') && isNotNullOrEmptyString('newreason', 'Please enter the reason.') && isNotNullOrEmptyString('newcategory', 'Please select the category.');"--><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="18%" align="right">&nbsp;</td>
            <td width="82%" class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
		  <tr>
            <td width="18%">&nbsp;</td>
            <td width="82%">&nbsp;</td>
          </tr>
		  <?php if($_SESSION['type'] == "date"){ ?>
		  <tr>
            <td width="18%" align="right" class="label">Last Payment Date: </td>
            <td width="82%" class="label">
              Day:
              <select id="newday" name="newday">
                <?php 
					   if(isset($data['lastpaymentdate']) && trim($data['lastpaymentdate']) != ""){
	$date = date("d", strtotime($data['lastpaymentdate']));
} else {
	$date = date("d", strtotime("now"));
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);?>
              </select>
&nbsp;Month:
<select id="newmonth" name="newmonth">
  <?php 
				   if(isset($data['lastpaymentdate']) && trim($data['lastpaymentdate']) != ""){
	$date = date("F", strtotime($data['lastpaymentdate']));
} else {
	$date = date("F", strtotime("now"));
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:
<select id="newyear" name="newyear">
  <?php 
				    if(isset($data['lastpaymentdate']) && trim($data['lastpaymentdate']) != ""){
	$date = date("Y", strtotime($data['lastpaymentdate']));
} else {
	$date = date("Y", strtotime("now"));
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
          </tr>
		  <?php } else { ?>
			<tr>
			  <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2"><tr><td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="2" id="statustable" >
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
					<tr class="<?php echo $rowclass; ?>"><td height="26" colspan="4"><input type="hidden" name="id[]" id="id[]<?php echo ($counter+1);?>" value="<?php echo $status_row['id'];?>"></td></tr>
					<tr class="<?php echo $rowclass; ?>">
					<td align="right" class="label" width="9%">Amount:<font class="redtext">*</font></td>
					<td width="40%" class="label"><input type="text" name="amount[]" id="amount[]<?php echo ($counter+1);?>" value="<?php echo number_format($status_row['amount']);?>" /> Shs</td>
					<td width="1%"><input type="checkbox" name="approved[]" id="approved[]<?php echo ($counter+1);?>" value="Y" <?php if($status_row['approved'] == "Y"){ echo "checked";}?>></td>
					<td width="50%"><b class="label">Is Approved</b> </td>
					</tr>
					
					<tr class="<?php echo $rowclass; ?>"><td align="right" class="label">Date:<font class="redtext">*</font></td><td colspan="3" class="label">Day: 
					  <select id="day[]<?php echo ($counter+1);?>" name="day[]">  <?php
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
                  <td colspan="3"><textarea name="reason[]" id="reason[]<?php echo ($counter+1);?>" rows="4"><?php echo $status_row['reason'];?></textarea></td>
                </tr>
				<tr class="<?php echo $rowclass; ?>">
                  <td align="right" class="label">Category:<font class="redtext">*</font></td>
                  <td colspan="3"><select id="category[]<?php echo ($counter+1);?>" name="category[]">
                    <?php 
					   echo generateSelectOptions(getAllFinanceCategories($_SESSION['type']), $status_row['category']);?>
                  </select></td>
                </tr>		 
			 	<?php 
					$counter++;
					// Save all those which are not of this type
					} else { array_push($_SESSION['exceptids'],$array[$i]);}
				
				} ?>
				</table></td></tr>
				<?php
			 } 
			 ?><tr>
                  <td align="right" class="label"><input type="hidden" name="Add"></td>
                  <td nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#Add" onClick= "showHideLayer('addstatus')" >Add <?php if($_SESSION['type'] == 'add') { echo "Bonus";} else { echo "Deduction";}?></a>  | <a href="#" onClick="removeMultRows('statustable',4)">Remove 
                    <?php if($_SESSION['type'] == 'add') { echo "Bonus";} else { echo "Deduction";}?></a>
                  &nbsp;</td>
                </tr>
				
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><hr color="#CCCCCC"></td>
                </tr>
				<tr>
                  <td colspan="2"><div id="addstatus" style="height:0px; visibility:hidden"><table width="100%">
                <tr>
                  <td colspan="4" class="label"><font class="redtext">*</font> is a required field</td>
                  </tr>
                <tr>
                  <td width="21%" align="right" class="label">Amount:<font class="redtext">*</font></td>
                  <td width="39%"><input type="text" name="newamount" id="newamount" value="" /></td>
                  <td width="3%"><input type="checkbox" name="newapproved" value="Y"></td>
                  <td width="37%"> <b class="label">Is Approved </b></td>
                </tr>
                <tr>
                  <td align="right" class="label">Date:<font class="redtext">*</font></td>
                  <td colspan="3" class="label">Day:
                    <select id="newday" name="newday">
                        <?php 
					   if(isset($status_array['date']) && trim($status_array['date']) != ""){
	$date = date("d", strtotime($status_array['date']));
} else {
	$date = date("d", strtotime("now"));
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);?>
                      </select>
                    &nbsp;Month:
                    <select id="newmonth" name="newmonth">
                      <?php 
				   if(isset($status_array['date']) && trim($status_array['date']) != ""){
	$date = date("F", strtotime($status_array['date']));
} else {
	$date = date("F", strtotime("now"));
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
                    </select>
                    &nbsp;Year:
                    <select id="newyear" name="newyear">
                      <?php 
				    if(isset($status_array['date']) && trim($status_array['date']) != ""){
	$date = date("Y", strtotime($status_array['date']));
} else {
	$date = date("Y", strtotime("now"));
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" class="label">Reason:<font class="redtext">*</font></td>
                  <td colspan="3"><textarea name="newreason" id="newreason" rows="4"></textarea></td>
                </tr>
                <tr>
                  <td align="right" class="label">Category:<font class="redtext">*</font></td>
                  <td colspan="3"><select id="newcategory" name="newcategory">
                    <?php echo generateSelectOptions(getAllFinanceCategories($_SESSION['type']), "");?>
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
                
                <input type="submit" name="SaveStatus" id="SaveStatus" value="Save">
                
                <input type="hidden" name="guard" id="guard" value="<?php echo $id;?>"></td>
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
    <td colspan="2" align="center" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
