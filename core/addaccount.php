<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$action = $_GET['action'];
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM accounts WHERE id = '".$id."'");
}
if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	if(trim($formvalues['edit']) != ""){
		$editid = decryptValue($formvalues['edit']);
		mysql_query("UPDATE accounts SET accountname = '".$formvalues['name']."',  type = '".$formvalues['accounttype']."' WHERE id='".$editid."'");
	} else {
		mysql_query("INSERT INTO accounts SET accountname ='".$formvalues['name']."',  type = '".$formvalues['accounttype']."'") or die(mysql_error());
	}
	
	forwardToPage("manageaccounts.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit             <?php } else {?>            Create          <?php } ?> Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td><?php include "../core/header.php";?></td>
  </tr> <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "164")){?><a href="manageaccounts.php">Manage Accounts</a> &gt; <?php } ?> <?php if($action == 'edit') {?>
          Edit 
            <?php } else {?>
            Create
          <?php } ?> Account </td>
      </tr> 
      <tr>
        <td><form action="addaccount.php" method="post" name="account" id="account" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter the account name.') && isNotNullOrEmptyString('accounttype', 'Please select the account type.');"><table width="100%" border="0">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
		
          <tr>
            <td height="30" align="right" class="label2">Account Name:<font class="redtext">*</font></td>
            <td>
              <input type="text" name="name" id="name" value="<?php echo $data['accountname']; ?>">
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td height="30" align="right" class="label2">Type:<font class="redtext">*</font></td>
            <td><select name="accounttype" id="accounttype">
                      <option value="">&lt;Select One&gt;</option>
					  <option value="outflow" <?php if($data['type'] == "outflow"){ echo "selected";}?>>Out Flow</option>
					  <option value="inflow" <?php if($data['type'] == "inflow"){ echo "selected";}?>>In Flow</option>
                    </select></td>
          </tr>
          <tr>
            <td  align="right" class="label2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
	if($action == "edit"){
		echo $_GET['id']; 
	}
	?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>


