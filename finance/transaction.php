<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['t'])){
	$type = decryptValue($_GET['t']);
} else {
	$type = "outflow";
}

//Set edit mode for the inspection
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	// details from the transaction table
	$data = getRowAsArray("SELECT * FROM transactions WHERE id = '".$id."'");
}

//Saving the transaction values
if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	
	if(trim($formvalues['id']) != ""){
		mysql_query("UPDATE transactions SET date_of_entry=".changeDateFromPageCombosToMySQLFormat($formvalues['transaction_day'], $formvalues['transaction_month'], $formvalues['transaction_year']).", particulars='".$formvalues['particulars']."', amount='".implode("",explode(",",$formvalues['amount']))."', receivedby='".$formvalues['receivedby']."', passedby='".$formvalues['passedby']."', paymentform='".$formvalues['paymentform']."', account = '".$formvalues['account']."' WHERE id='".$formvalues['id']."'");
		
	} else {
		mysql_query("INSERT INTO transactions (date_of_entry, particulars, amount, receivedby, passedby, paymentform, type, account) VALUES (".changeDateFromPageCombosToMySQLFormat($formvalues['transaction_day'], $formvalues['transaction_month'], $formvalues['transaction_year']).",'".$formvalues['particulars']."', '".implode("",explode(",",$formvalues['amount']))."', '".$formvalues['receivedby']."', '".$formvalues['passedby']."', '".$formvalues['paymentform']."', '".$formvalues['type']."', '".$formvalues['account']."')");
	}
	
	//Show appropriate message
	if(mysql_error() == ""){
		$_SESSION['msg'] = "Your transaction has been successfully updated";
	} else {
		$_SESSION['msg'] = "There were problems saving the transaction. Please contact your administrator.";
	}
	
	forwardToPage("managetransactions.php?t=".encryptValue($formvalues['type']));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($type == 'outflow') {?>Ledger Entries<?php } else {?>Transactions<?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
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
        <td class="headings"><a href="managetransactions.php?t=<?php echo $_GET['t'];?>">Manage <?php if($type == 'outflow') { echo "Ledger Entries"; } else { echo "Transactions"; } ?></a> &gt; Add <?php if($type == 'outflow') { echo "Ledger Entry"; } else { echo "Transaction"; } ?> </td>
      </tr>
      <tr>
        <td><form action="transaction.php" method="post" name="transaction" id="transaction" onSubmit=" return isNotNullOrEmptyString('transaction_day', 'Please select the day.') && isNotNullOrEmptyString('transaction_month', 'Please select the month.') && isNotNullOrEmptyString('transaction_year', 'Please select the year.') && isNotNullOrEmptyString('particulars', 'Please enter the particulars.') && isNotNullOrEmptyString('amount', 'Please enter the amount.') && isNotNullOrEmptyString('receivedby', 'Please specify who received the payment.') <?php if($type == "outflow"){ ?>&& isNotNullOrEmptyString('passedby', 'Please specify who passed the payment.') <?php } ?>&& isNotNullOrEmptyString('paymentform', 'Please select the payment form.')<?php if($type == "inflow"){ ?> && isNotNullOrEmptyString('account', 'Please select the account.')<?php } ?>;"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr width="50%">
            <td width="26%" align="right" class="label"><font class="redtext">*</font> is a required field </td>
            <td width="74%"><input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
              <input type="hidden" name="type" id="type" value="<?php echo $type; ?>">         </td>
          </tr>
		
          <tr>
            <td align="right" class="label">Date:<font class="redtext">*</font></td>
            <td class="label">Day:
              <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($data['date_of_entry']) != "0000-00-00 00:00:00"){
					echo "<b>".date("d", strtotime($data['date_of_entry']))."</b>";
				}
			} else {?>
              <select id="transaction_day" name="transaction_day">
                <?php 
				if(isset($data['date_of_entry']) && $data['date_of_entry'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($data['date_of_entry']));
						} else { 
							$date =  "";
						}
						
				echo generateSelectOptions(getTime('day',''), $date);?>
              </select>
              <?php } ?>
&nbsp;Month:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($data['date_of_entry']) != "0000-00-00 00:00:00"){
					echo "<b>".date("F", strtotime($data['date_of_entry']))."</b>";
				}
			} else {?>
<select id="transaction_month" name="transaction_month">
  <?php 
  if(isset($data['date_of_entry']) && $data['date_of_entry'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($data['date_of_entry']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
<?php } ?>
&nbsp;Year:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($data['date_of_entry']) != "0000-00-00 00:00:00"){
					echo "<b>".date("Y", strtotime($data['date_of_entry']))."</b>";
				}
			} else {?>
<select id="transaction_year" name="transaction_year">
  <?php 
  if(isset($data['date_of_entry']) && $data['date_of_entry'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($data['date_of_entry']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Particulars:<font class="redtext">*</font></td>
            <td><textarea name="particulars" id="particulars"><?php echo $data['particulars']; ?></textarea></td>
          </tr>
          <tr>
            <td align="right" class="label">Amount:<font class="redtext">*</font></td>
            <td><input type="text" name="amount" id="amount" value="<?php echo commify($data['amount']); ?>"></td>
          </tr>
          <tr>
		  <td align="right" class="label">Received By:<font class="redtext">*</font> </td>
            <td><input type="text" name="receivedby" id="receivedby" value="<?php echo $data['receivedby']; ?>"></td>
         </tr>
		 <?php if($type == "outflow"){ ?>
          <tr>
            <td align="right" class="label">Passed By:<font class="redtext">*</font> </td>
            <td><input type="text" name="passedby" id="passedby" value="<?php echo $data['passedby']; ?>"></td>
          </tr>
		  <?php } ?>
          <tr>
            <td align="right" class="label">Payment  Form:<font class="redtext">*</font></td>
            <td><select id="paymentform" name="paymentform">
              <?php 
				echo generateSelectOptions(getAllPaymentForms(), $data['paymentform']);?>
            </select></td>
          </tr>
          <tr>
            <td align="right" class="label">Account:<font class="redtext">*</font></td>
            <td><select name="account" id="account">
                      <?php 
					  echo generateSelectOptions(getAllAccounts($type), $data['account']); ?>
                    </select></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  
		  <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save"></td>
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
