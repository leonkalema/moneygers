<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$action = $_GET['action'];
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM rights WHERE id = '".$id."'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>
          Edit User Right
            <?php } else {?>
            Create User Right
          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "130")){?><a href="managerights.php">Manage User Rights</a> &gt; <?php } ?> <?php if($action == 'edit') {?>
          Edit User Right
            <?php } else {?>
            Create User Right
          <?php } ?> </td>
      </tr> 
      <tr>
        <td><form action="processright.php" method="post" name="group" id="group" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the user right.');"><table width="100%" border="0">
          <tr>
            <td align="right" class="label"><font class="redtext">*</font> is a required field </td>
            <td><input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
              <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
              <input type="hidden" name="createdby" id="createdby" value="<?php echo $_SESSION['userid']; ?>"></td>
          </tr>
		
          <tr>
            <td height="30" align="right" class="label2">Right Name :<font class="redtext">*</font></td>
            <td>
              &nbsp;
              <input name="name" type="text" id="name" value="<?php echo $data['rightname']; ?>" size="30">
              &nbsp;&nbsp;&nbsp;</td>
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


