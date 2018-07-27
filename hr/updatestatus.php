<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$leave=array();
//Set edit mode for the leave
if(isset($_GET['id'])){
	$id = $_GET['id'];

	$current_guardstate = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames, g.status FROM guards g, persons p WHERE g.id = '".$id."'");
	$current_statedetails = getRowAsArray("SELECT * FROM guardstatus WHERE id = '".$current_guardstate['status']."'");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Update Guard Status</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
<script type="text/javascript">
filePath = '../images/';
</script>
<script  language="javascript" src="../javascript/swazzcalendar.js" type="text/javascript"> </script>
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
        <td class="headings">Update Status of <?php echo $current_statedetails['firstname']." ".$current_statedetails['lastname']." ".$current_statedetails['othernames'];?> </td>
      </tr>
      <tr>
        <td><form action="processleave.php" method="post" name="leave" id="leave" onSubmit=" return isNotNullOrEmptyString('', 'Please enter a name for the assignment.') && isNotNullOrEmptyString('', 'Please select a region for the assignment.') && isNotNullOrEmptyString('', 'Please enter a code for the assignment.') && isNotNullOrEmptyString('', 'Please select a type for the assignment.') && isNotNullOrEmptyString('', 'Please enter an effective date for the assignment.') && isNotNullOrEmptyString('', 'Please enter an end date for the assignment.') && isNotNullOrEmptyString('', 'Please select a start time for the assignment.') && isNotNullOrEmptyString('', 'Please select an end time for the assignment.') && isNotNullOrEmptyString('', 'Please select a frequency for the assignment.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td height="30" align="right" class="label"><font class="redtext">*</font> is a required field </td>
            <td><input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
              <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
              <input type="hidden" name="createdby" id="createdby" value="<?php echo $_SESSION['userid']; ?>">
              <input type="hidden" name="lastupdatedby" id="lastupdatedby" value="<?php echo $_SESSION['userid']; ?>"></td>
          </tr>
            <tr>
              <td align="right" class="label" valign="top">Status:<font class="redtext">*</font></td>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><div id="guardtribe_show">
                    <select id="status" name="status">
                        <?php echo generateSelectOptions(getAllGuardStatus(), $current_statedetails['state']);?>
                      </select>
                  </div></td>
                  <td colspan="2">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=guardstatus','guardstatus_add','','Loading...'); return false;">Add Status </a> | <a href="#" onClick="setDiv('../include/showlist.php?area=guardstatus','guardstatus_show','','Loading...'); return false;">Refresh List </a> </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="2%">&nbsp;</td>
                  <td width="85%"><div id="guardtribe_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
                </tr>
              </table></td>
             </tr>
            <tr>
              <td align="right" class="label"> Notes:</td>
              <td><textarea name="notes" rows="4" id="notes"><?php echo $current_statedetails['notes'];?></textarea></td>
             </tr><tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			<input type="submit" name="submit" id="submit" value="Update">
			<input type="hidden" name="guardid" id="guardid" value="<?php 
			  echo $_GET['i']; ?>">			</td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
