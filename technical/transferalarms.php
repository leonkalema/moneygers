<?php
include_once "../include/commonfunctions.php"; 
session_start();

openDatabaseConnection();

if(isset($_GET['id']) || isset($_GET['action'])){
	$id = $_GET['id'];
	$action = $_GET['action'];
}

if($action == 'edit') {
	$alarm = getRowAsArray("SELECT * FROM alarms WHERE id='".$id."'");
}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	mysql_query("DELETE FROM alarms WHERE id = '".$_GET['id']."'");
}

if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	if(trim($formvalues['edit']) != ""){
		mysql_query("UPDATE alarms SET alarmid='".$formvalues['alarmid']."', assignment='".$formvalues['assignment']."', startdate=".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']).", enddate=".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']).", expirydate=".changeDateFromPageCombosToMySQLFormat($formvalues['expiry_day'], $formvalues['expiry_month'], $formvalues['expiry_year'])." WHERE id = '".trim($formvalues['edit'])."'") or die("Error: ".mysql_error());
	} else {
		mysql_query("INSERT INTO alarms (alarmid, assignment, startdate, enddate, expirydate) 
			VALUES ('".$formvalues['alarmid']."', '".$formvalues['assignment']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']).", ".changeDateFromPageCombosToMySQLFormat($formvalues['end_day'], $formvalues['end_month'], $formvalues['end_year']).",".changeDateFromPageCombosToMySQLFormat($formvalues['expiry_day'], $formvalues['expiry_month'], $formvalues['expiry_year'])." )") or die("Error: ".mysql_error());
	}
	
	forwardToPage("managealarminstallations.php");
}

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Alarm Installations            <?php } else {?>            Add Alarm Installations          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>

</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td width="896" height="7" colspan="2"></td>
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
        <td class="headings"><a href="managealarminstallations.php">Manage Alarm Installations </a> &gt; <?php if($action == 'edit') {?>
          Edit Alarm Installations
            <?php } else {?>
            Create Alarm Installations
          <?php } ?> </td>
      </tr>
      <tr>
        <td>
		<form action="alarminstallations.php" method="post">
		<table width="100%" border="0">
          <tr>
            <td width="31%" align="right"><font class="redtext">*</font> is a required field </td>
            <td colspan="3">&nbsp;</td>
          </tr>
		 <?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){?>
		  <tr>
            <td width="31%"> </td>
            <td colspan="3"><font class="redtext"><b><?php echo $_SESSION['errors'];?></b></font></td>
          </tr>
		 <?php 
		 	$_SESSION['errors'] = "";
		 } ?>
          <tr>
            <td height="24" align="right" class="label2">Alarm ID: <font class="redtext">*</font></td>
            <td>&nbsp;
				<input name="alarmid" type="text" id="alarmid"  value="<?php echo $alarm['alarmid']; ?>" size="10">			</td>
            <td>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/searchforpage.php?area=alarmid&value=','alarmid_search','alarmid','Searching...'); return false; ">Check Availability</a></td>
            <td><div id="alarmid_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
          </tr>
          <tr>
            <td align="right" class="label2">Assignment:<font class="redtext">*</font></td>
            <td width="39%" colspan="2">&nbsp;
			<?php if (isset($_GET['id'])) { ?>
			<input type="text" name="assignment" id="assignment" value="<?php echo $alarm['assignment']; ?>" readonly=""> 
				<?php 	} else {?>
				<select id="assignment" name="assignment">
				<?php
					echo generateSelectOptions(getCallSigns());
					}
				?>
				</select>	
              <!--input type="text" name="assignment" id="assignment" value="<?php echo $alarm['assignment']; ?>"-->			 </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Start Date:<font class="redtext">*</font></td>
            <td colspan="3">&nbsp;
			<?php if(isset($_GET['a'])){ echo date("d-M-Y",strtotime($alarm['startdate']));} else {?>
               Day:
           <select id="start_day" name="start_day">
<?php 
if(isset($alarm['startdate']) && trim($alarm['startdate']) != ""){
	$date = date("d", strtotime($alarm['startdate']));
} else {
	$date = "";
}
echo generateSelectOptions(getTime('day',''), $date);?>
</select>
               &nbsp;Month:
<select id="start_month" name="start_month">
 <?php 
 if(isset($alarm['startdate']) && trim($alarm['startdate']) != ""){
	$date =  date("F", strtotime($alarm['startdate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('month',''),$date);?> 
</select>
&nbsp;Year:
<select id="start_year" name="start_year">
 <?php 
  if(isset($alarm['startdate']) && trim($alarm['startdate']) != ""){
	$date = date("Y", strtotime($alarm['startdate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php }?>			</td>
          </tr>
          <tr>
            <td align="right" class="label">End Date:</td>
            <td colspan="3">&nbsp;
			  <?php if(isset($_GET['a'])){ echo date("d-M-Y",strtotime($alarm['enddate']));} else {?>
             Day:
                 <select id="end_day" name="end_day">
<?php 
if(isset($alarm['enddate']) && trim($alarm['enddate']) != ""){
	$date = date("d", strtotime($alarm['enddate']));
} else {
	$date = "";
}

echo generateSelectOptions(getTime('day',''), $date);?>
</select>
&nbsp;Month:
<select id="end_month" name="end_month">
 <?php 
 if(isset($alarm['enddate']) && trim($alarm['enddate']) != ""){
	$date = date("F", strtotime($alarm['enddate']));
} else {
	$date = "";
}

 echo generateSelectOptions(getTime('month',''), $date);?> 
</select>
&nbsp;Year:
<select id="end_year" name="end_year">
 <?php 
  if(isset($alarm['enddate']) && trim($alarm['enddate']) != ""){
	$date = date("Y", strtotime($alarm['enddate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php }?>			  </td>
          </tr>
          <tr>
            <td align="right" class="label">Expiry Date:</td>
            <td colspan="3">&nbsp;			 
			  <?php if(isset($_GET['a'])){ echo date("d-M-Y",strtotime($alarm['expirydate']));} else {?>
             Day:
                 <select id="expiry_day" name="expiry_day">
<?php 
if(isset($alarm['expirydate']) && trim($alarm['expirydate']) != ""){
	$date = date("d", strtotime($alarm['expirydate']));
} else {
	$date = "";
}

echo generateSelectOptions(getTime('day',''), $date);?>
</select>
&nbsp;Month:
<select id="expiry_month" name="expiry_month">
 <?php 
 if(isset($alarm['expirydate']) && trim($alarm['expirydate']) != ""){
	$date = date("F", strtotime($alarm['expirydate']));
} else {
	$date = "";
}

 echo generateSelectOptions(getTime('month',''), $date);?> 
</select>
&nbsp;Year:
<select id="expiry_year" name="expiry_year">
 <?php 
  if(isset($alarm['expirydate']) && trim($alarm['expirydate']) != ""){
	$date = date("Y", strtotime($alarm['expirydate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php }?>			  </td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
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