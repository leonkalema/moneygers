<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$action = $_GET['action'];
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM actions WHERE id = '".$id."'");
}
if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	if(trim($formvalues['edit']) != ""){
		$id = decryptValue($formvalues['edit']);
		mysql_query("UPDATE actions SET name = '".$formvalues['name']."' WHERE id='".$id."'");
	} else {
		mysql_query("INSERT INTO actions (name) VALUES ('".$formvalues['name']."')");
	}
	
	forwardToPage("managedisciplineactions.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>
          Edit 
            <?php } else {?>
            Create
          <?php } ?> Discipline Action</title>
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
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "132")){?><a href="managedisciplineactions.php">Manage Discipline Action</a> &gt; <?php } ?> <?php if($action == 'edit') {?>
          Edit Discipline Action
            <?php } else {?>
            Create Discipline Action
          <?php } ?> </td>
      </tr> 
      <tr>
        <td><form action="adddisciplineaction.php" method="post" name="group" id="group" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the user right.');"><table width="100%" border="0">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td><input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
              <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
              <input type="hidden" name="createdby" id="createdby" value="<?php echo $_SESSION['userid']; ?>"></td>
          </tr>
		
          <tr>
            <td height="30" align="right" class="label2">Disciplinary Action  :<font class="redtext">*</font></td>
            <td>
              &nbsp;
              <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>">
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


