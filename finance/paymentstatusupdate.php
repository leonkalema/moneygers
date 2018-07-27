<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

//Set mode for payment status
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	// Assignment details the db table
	$data = getRowAsArray("SELECT id,client,callsign,lastpaymentdate,amountdue FROM assignments WHERE id = '".$id."'");
}

//Save the updated data and return the the managing of status
if(isset($_POST['SavePaymentStatus'])){
	$formvalues = array_merge($_POST);
	mysql_query("UPDATE assignments SET lastpaymentdate = ".changeDateFromPageCombosToMySQLFormat($formvalues['pay_day'], $formvalues['pay_month'], $formvalues['pay_year']).", amountdue = '".implode("",split(",",$formvalues['amountdue']))."' WHERE id='".$formvalues['assignmentId']."'");
	forwardToPage("../finance/paymentstatus.php");
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Payment Status</title>
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
        <td class="headings"><a href="../finance/paymentstatus.php">Manage Payment Status</a> &gt; Payment Status for <?php echo $data['client'];?></td>
      </tr>
      <tr>
        <td><form action="../finance/paymentstatusupdate.php" method="post" name="form1" id="form1" onSubmit=" return isNotNullOrEmptyString('pay_day', 'Please select the last pay day.') && isNotNullOrEmptyString('pay_month', 'Please select the last pay month.') && isNotNullOrEmptyString('pay_year', 'Please select the last pay year.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td colspan="2"><font class="redtext">*</font> is a required field              </td>
            </tr>
			<?php 
			if(isset($_GET['msg']) && trim($_GET['msg']) == ""){ ?>
				<tr><td colspan="2"><font class="redtext"><b><?php echo $_GET['msg'];?></b></font></td></tr>
			<?php }?>
            <tr>
              <td align="right" valign="top"><span  class="label">Client:</span></td>
              <td valign="top" nowrap><?php echo $data['client'];?></td>
            </tr>
            <tr>
            <td width="16%" align="right" nowrap class="label">Assignment Call Sign:</td>
            <td valign="top" nowrap><?php echo $data['callsign'];?></td>
            </tr>
            <tr>
              <td align="right" class="label">Last Payment Date:</td>
              <td colspan="2">Day:
                <select id="pay_day" name="pay_day">
                  <?php 
					   if(isset($data['lastpaymentdate']) && trim($data['lastpaymentdate']) != "0000-00-00 00:00:00"){
	$date = date("d", strtotime($data['lastpaymentdate']));
} else {
	$date = "";
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);?>
                </select>
&nbsp;Month:
<select id="pay_month" name="pay_month">
  <?php 
				   if(isset($data['lastpaymentdate']) && trim($data['lastpaymentdate']) != "0000-00-00 00:00:00"){
	$date = date("F", strtotime($data['lastpaymentdate']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:
<select id="pay_year" name="pay_year">
  <?php 
				    if(isset($data['lastpaymentdate']) && trim($data['lastpaymentdate']) != "0000-00-00 00:00:00"){
	$date = date("Y", strtotime($data['lastpaymentdate']));
} else {
	$date = "";
}
				   echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
            </tr>
            <tr>
              <td align="right" class="label">Amount Due: </td>
              <td colspan="2"><input type="text" name="amountdue" id="amountdue" value="<?php echo $data['amountdue'];?>">
                Shs</td>
            </tr>
            <tr>
              <td align="right" class="label">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
          
		  <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			<?php
		  //Do not give option to save if the user is just viewing
		  if(!(isset($_GET['a']) && $_GET['a'] == "view")){
		?><input type="submit" name="SavePaymentStatus" id="SavePaymentStatus" value="Save">
			<?php } ?>
			<input type="hidden" name="assignmentId" id="assignmentId" value="<?php echo $id;?>"></td>
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
