<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();


//Set edit mode for the loan
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues'])){
		$formvalues = $_SESSION['formvalues'];
	}
	
	//loan details from guard table
	$formvalues = getRowAsArray("SELECT * FROM guardclaims WHERE id = '".$id."'");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Guard Claim<?php } else if($action == "view"){?>View Guard Claim <?php } else { ?>Create Guard Claim<?php } ?></title>
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
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "200")){?><a href="../finance/manageguardclaims.php">Manage Guard Claims</a> &gt; <?php }  if($action == 'edit') {?>
          Edit Guard Claim
          <?php } else {?>Create Guard Claim<?php } ?></td>
      </tr>
      <tr>
        <td><form action="processguardclaim.php" method="post" name="guardclaim" id="guardclaim" onSubmit=" return isNotNullOrEmptyString('guardid', 'Please enter the guard ID or search and pick from list.') && isNotNullOrEmptyString('amount', 'Please enter the guard claim amount.') && isNotNullOrEmptyString('reason', 'Please enter the reason for the claim.') && isNotNullOrEmptyString('claim_day', 'please select the day of the claim.') && isNotNullOrEmptyString('claim_month', 'please select the month of the claim.') && isNotNullOrEmptyString('claim_year', 'please select the year of the claim.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
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
            <tr>
              <td align="right" class="label" valign="top" width="20%">Guard ID:<font class="redtext">*</font></td>
              <td width="80%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="28%" valign="top"><input type="text" name="guardid" id="guardid" value="<?php echo $formvalues['guardid'];?>"></td>
                  <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guardid','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                  <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                </tr>
              </table></td>
             </tr><tr>
              <td align="right" class="label">Claim Amount:<font class="redtext">*</font> </td>
              <td><input name="amount" type="text" id="amount" value="<?php echo commify($formvalues['amount']);?>"></td>
             </tr>
                   
             <tr>
               <td align="right" class="label">Reason<font class="redtext">*</font> </td>
               <td nowrap><textarea name="reason" rows="4" id="reason"><?php echo $formvalues['reason'];?></textarea></td>
             </tr>
             <tr>
               <td align="right" class="label">Date of Claim:<font class="redtext">*</font> </td>
               <td class="label">Day:
                 
                 <select id="claim_day" name="claim_day">
                   <?php 
				if(isset($formvalues['datecreated']) && $formvalues['datecreated'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($formvalues['datecreated']));
						} else { 
							$date =  "";
						}
						
				echo generateSelectOptions(getTime('day',''), $date);?>
                 </select>
                 &nbsp;Month:

<select id="claim_month" name="claim_month">
  <?php 
  if(isset($formvalues['datecreated']) && $formvalues['datecreated'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($formvalues['datecreated']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:

<select id="claim_year" name="claim_year">
  <?php 
  if(isset($formvalues['datecreated']) && $formvalues['datecreated'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($formvalues['datecreated']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
             </tr>
             <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo decryptValue($_GET['id']);
			  } ?>"></td>
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
