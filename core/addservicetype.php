<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$action = $_GET['action'];
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM servicetypes WHERE id = '".$id."'");
}
if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	if(trim($formvalues['edit']) != ""){
		$editid = decryptValue($formvalues['edit']);
		mysql_query("UPDATE servicetypes SET type='".$formvalues['name']."', starttime='".$formvalues['starttime']."', endtime='".$formvalues['endtime']."' WHERE id='".$editid."'");
	
	} else {
		mysql_query("INSERT INTO servicetypes (type, starttime, endtime) VALUES ('".$formvalues['name']."', '".$formvalues['starttime']."', '".$formvalues['endtime']."')");
	}
	
	forwardToPage("manageservicetypes.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Service Type            <?php } else {?>            Create Service Type          <?php } ?></title>
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
        <td class="headings"><a href="manageservicetypes.php">Manage Service Types</a> &gt; <?php if($action == 'edit') {?>
          Edit Service Type
            <?php } else {?>
            Create Service Type
          <?php } ?> </td>
      </tr> 
      <tr>
        <td><form action="addservicetype.php" method="post" name="group" id="group" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the service type.');"><table width="100%" border="0">
          <tr>
            <td colspan="2" class="label"><font class="redtext">*</font> is a required field </td>
            </tr>
		
          <tr>
            <td height="30" align="right" class="label2" width="1%" nowrap>Service Type:<font class="redtext">*</font></td>
            <td><input type="text" name="name" id="name" value="<?php echo $data['type']; ?>">
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td height="30" align="right" class="label2">Start Time:</td>
            <td><select id="starttime" name="starttime">
                <?php echo generateSelectOptions(getAllTime(), $data['starttime']);?>
              </select></td>
          </tr>
          <tr>
            <td height="30" align="right" class="label2">End Time: </td>
            <td><select id="endtime" name="endtime">
              <?php echo generateSelectOptions(getAllTime(),$data['endtime']);?>
            </select></td>
          </tr>
          <tr>
            <td align="right" class="label2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
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


