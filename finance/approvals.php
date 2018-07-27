<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$loan=array();
//Set edit mode for the loan
if(isset($_GET['id']) || isset($_GET['t'])){
	$id = decryptValue($_GET['id']);
	//echo $id;
	$type = $_GET['t'];
	$_SESSION['type'] = $type;
	
	if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues'])){
		$formvalues = $_SESSION['formvalues'];
	}
	
	//Loan details from guard table
	$formvalues = getRowAsArray("SELECT * FROM loanapplications WHERE id = '".$id."'");
}
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
        <td class="headings"><a href="../finance/manageguardloans.php">Manage Staff Debts</a> &gt; Approve Staff Debt Application for <?php 
		$line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$formvalues['guardid']."'");
		echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];
		?></td>
      </tr>
      <tr>
        <td><form action="processloan.php" method="post" name="loan" id="loan" onSubmit=" return isNotNullOrEmptyString('repayinstallment', 'Please enter repayment installment.');"><table width="100%" align="left" cellpadding="2" cellspacing="2">
		<?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){ ?>
		<tr>
            <td width="3%" height="30" align="right">&nbsp;</td>
            <td width="97%" class="redtext"><b><?php echo $_SESSION['errors'];
			$_SESSION['errors'] = "";
			?></b></td>
          </tr>
		<?php } ?>
          <tr>
            <td height="30" colspan="2" class="label"><font class="redtext">*</font> is a requirled field </td>
           </tr>
		
         
            <tr>
              <td colspan="2" align="right" valign="top" nowrap class="label"><hr></td>
              </tr>
            <tr>
              <td colspan="2" valign="top" nowrap class="label">GENERAL MANAGER :</td>
              </tr>
             <tr>
               <td width="10%" align="right" class="label">Staff Debt Amount:&nbsp;</td>
               <td width="90%" colspan="3"><?php echo commify($formvalues['loanamount']); ?></td>
             </tr>
             <tr>
               <td align="right" nowrap class="label">Repayment Installment: <font class="redtext">*</font></td>
               <td colspan="3"><?php if($type != "gm"){ echo "<div style=\"width:150px\">".$formvalues['repayinstallment']."</div>"; } else {?>
                 <input name="repayinstallment" type="text" value="<?php echo $formvalues['repayinstallment'];?>">
             <?php } ?></td>
             </tr>
             <tr>
             <td align="right" class="label">GM Approval: <font class="redtext">*</font></td>
             <td colspan="3"><?php if($type != "gm"){ echo $formvalues['gmapproved']; } else {?><select id="gmapproved" name="gmapproved">
			 <option value="">&lt;Select&gt;</option>
			 <option value="Y" <?php if($formvalues['gmapproved'] == "Y"){ echo "selected";}?>>Accepted</option>
			 <option value="N" <?php if($formvalues['gmapproved'] == "N"){ echo "selected";}?>>Rejected</option>
			 </select><?php } 
			 $userdata = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$formvalues['whogmapproved']."'");
			 if($formvalues['gmapproved'] == "Y"){
			 	echo " [ Approved on: ".date("d-M-Y",strtotime($formvalues['dateofgmapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 } else if($formvalues['gmapproved'] == "N"){
			 	echo " [ Rejected on: ".date("d-M-Y",strtotime($formvalues['dateofgmapproval']))." By: ".$userdata['firstname']." ".$userdata['lastname']." ]";
			 }
			 ?></td>
          </tr>
          <tr>
            <td align="right" nowrap class="label">Approval Notes: <font class="redtext">*</font> </td>
            <td colspan="3"><?php if($type != "gm"){ echo "<div style=\"width:150px\">".$formvalues['gmapprovalmsg']."</div>"; } else {?>
             <textarea name="gmapprovalmsg" rows="4"><?php echo $formvalues['gmapprovalmsg'];?></textarea>
             <?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <?php if($action != "view"){ ?>
			<input type="submit" name="submit" id="submit" value="Save">
			<input type="hidden" name="approval" id="approval" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>"><?php } ?></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?> </a></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
