<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['id']) && !userHasRight($_SESSION['userid'], "67")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You donot have permission to edit Leave details";
	forwardToPage($url);
}

$leave=array();
//Set edit mode for the leave
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues'])){
		$formvalues = $_SESSION['formvalues'];
	}
	
	//Leave details from guard table
	$formvalues = getRowAsArray("SELECT * FROM leaveapplications WHERE id = '".$id."'");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Leave Application<?php } else if($action == "view"){?>View Leave Application <?php } else { ?>Create Leave Application<?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "65")){?><a href="../hr/manageleave.php">Manage Leave</a> &gt; <?php } ?><?php if($action == 'edit') {?>
          Edit Leave Application
          <?php } else {?>Create Leave Application <?php } ?></td>
      </tr>
      <tr>
        <td><form action="processleave.php" method="post" name="leave" id="leave" onSubmit=" return isNotNullOrEmptyString('guardid', 'Please enter the ID of the guard or enter part of the name and search, then select from the database results.') && isNotNullOrEmptyString('leavetype', 'Please select the leave type for which the guard is registering.') && isNotNullOrEmptyString('start_day', 'Please select the start day of the leave application.') && isNotNullOrEmptyString('start_month', 'Please select the start month of the leave application.') && isNotNullOrEmptyString('start_year', 'Please select the start year of the leave application.') && isNotNullOrEmptyString('end_day', 'Please select the end day of the leave application.') && isNotNullOrEmptyString('end_month', 'Please select the end month of the leave application.') && isNotNullOrEmptyString('end_year', 'Please select the end year of the leave application.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
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
              <td align="right" class="label" valign="top" width="1%">Guard:<font class="redtext">*</font></td>
              <td width="99%"><?php if($action == "view"){
			  echo $formvalues['guardid'];
			  
			  $line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$formvalues['guardid']."'");
				echo " (". $line['firstname']." ".$line['lastname']." ".$line['othernames'].")"; 
			  } else {?><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="28%" valign="top"><input type="text" name="guardid" id="guardid" value="<?php echo $formvalues['guardid'];?>"></td>
                  <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guardid','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                  <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-size: 10px; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                </tr>
              </table><?php } ?></td>
             </tr>
            <tr>
            <td align="right" nowrap class="label">Leave Type:<font class="redtext">*</font></td>
            <td><?php 
			if($action == "view"){
				echo $formvalues['leavetype'];
			} else {
			?>
              <select id="leavetype" name="leavetype">
               <?php echo generateSelectOptions(getAllLeaveTypes(), $formvalues['leavetype']);?>
                  </select> <?php } ?> </td>
		       <tr>
              <td align="right" class="label">Reason:</td>
              <td><?php if($action == "view"){ echo "<div style=\"width:150px\">".$formvalues['reason']."</div>"; } else {?><textarea name="reason" rows="4" id="reason"><?php echo $formvalues['reason'];?></textarea><?php } ?></td>
             </tr>
             <tr>
             <td align="right" class="label">Start Date:<font class="redtext">*</font></td>
             <td colspan="3" class="label"><?php if($action == "view"){ echo date("d-M-Y",strtotime($formvalues['leavestartdate'])); } else {?>
               Day:
           <select id="start_day" name="start_day">
<?php 
if(isset($formvalues['leavestartdate']) && trim($formvalues['leavestartdate']) != "0000-00-00 00:00:00"){
	$date = date("d", strtotime($formvalues['leavestartdate']));
} else {
	$date = "";
}
echo generateSelectOptions(getTime('day',''), $date);?>
</select>
               &nbsp;Month:
<select id="start_month" name="start_month">
 <?php 
 if(isset($formvalues['leavestartdate']) && trim($formvalues['leavestartdate ']) != "0000-00-00 00:00:00"){
	$date = date("F", strtotime($formvalues['leavestartdate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('month',''), $date);?> 
</select>
&nbsp;Year:
<select id="start_year" name="start_year">
 <?php 
  if(isset($formvalues['leavestartdate']) && trim($formvalues['leavestartdate ']) != "0000-00-00 00:00:00"){
	$date = date("Y", strtotime($formvalues['leavestartdate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">End Date:<font class="redtext">*</font> </td>
           <td colspan="3" class="label"><?php if($action == "view"){ echo date("d-M-Y",strtotime($formvalues['leaveenddate'])); } else {?>
             Day:
                 <select id="end_day" name="end_day">
<?php 
if(isset($formvalues['leaveenddate']) && trim($formvalues['leaveenddate ']) != "0000-00-00 00:00:00"){
	$date = date("d", strtotime($formvalues['leaveenddate']));
} else {
	$date = "";
}
echo generateSelectOptions(getTime('day',''), $date);?>
</select>
&nbsp;Month:
<select id="end_month" name="end_month">
<?php 
if(isset($formvalues['leaveenddate']) && trim($formvalues['leaveenddate ']) != "0000-00-00 00:00:00"){
	$date = date("F", strtotime($formvalues['leaveenddate']));
} else {
	$date = "";
}
echo generateSelectOptions(getTime('month',''), $date);?> 
</select>
&nbsp;Year:
<select id="end_year" name="end_year">
 <?php 
  if(isset($formvalues['leaveenddate']) && trim($formvalues['leaveenddate ']) != "0000-00-00 00:00:00"){
	$date = date("Y", strtotime($formvalues['leaveenddate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
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
			<input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>">			<?php } ?></td>
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
