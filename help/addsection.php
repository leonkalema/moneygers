<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$action = $_GET['action'];
$id = $_GET['id'];

if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	//If editing the section
	if($formvalues['edit'] != ""){
		mysql_query("UPDATE helpsection SET step='".$formvalues['step']."', details='".$formvalues['details']."' WHERE id = '".$formvalues['edit']."'");
	
	//Insert new section
	} else {
		mysql_query("INSERT INTO helpsection (step, details) VALUES ('".$formvalues['step']."','".$formvalues['details']."')");
	}
	
	//Set appropriate help and forward to the page list.
	if(mysql_error() != ""){
		$_SESSION['msg'] = "There were problems saving your help section data. Please contact the admin.";
	} else {
		$_SESSION['msg'] = "The section help was successfully saved.";
	}
	forwardToPage("managesection.php");
}

if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM helpsection WHERE id = '".$id."'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>
          Edit Help Section
            <?php } else {?>
            Create Help Section
          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><a href="../help/managesection.php">Manage Help Sections </a> &gt; <?php if($action == 'edit') {?>
          Edit Help Section
            <?php } else {?>
            Create Help Section
          <?php } ?> </td>
      </tr> 
      <tr>
        <td><form action="addsection.php" method="post" name="group" id="group" onSubmit=" return isNotNullOrEmptyString('step', 'Please enter the section step.') && isNotNullOrEmptyString('details', 'Please enter the section details.');"><table width="100%" border="0">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
		
          <tr>
            <td height="30" align="right" class="label2">Step:<font class="redtext">*</font></td>
            <td><input name="step" type="text" id="step" value="<?php echo $data['step']; ?>" size="3"></td>
          </tr>
          <tr>
            <td height="30" align="right" class="label2">Details:<font class="redtext">*</font></td>
            <td><input name="details" type="text" id="details" value="<?php echo $data['details']; ?>" size="50">             </td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
	if($action == "edit"){
		echo $id; 
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


