<?php
include_once "../include/commonfunctions.php"; 
session_start();

openDatabaseConnection();

if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['action'];
}

if($action == 'edit') {
	$vehicleservice = getRowAsArray("SELECT * FROM vehicleservice WHERE id='".$id."'");
}


if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
		// format service date into mysql date format.
		$servicedate = changeDateFromPageCombosToMySQLFormat($formvalues['start_day'], $formvalues['start_month'], $formvalues['start_year']);
		
	if(trim($formvalues['edit']) != ""){		
		mysql_query("UPDATE vehicleservice SET servicedate = ".$servicedate.", vehicleregno = '".$formvalues['vehicleregno']."', partserviced = '".$formvalues['partserviced']."', petrostation = '".$formvalues['petrostation']."' WHERE id='".$formvalues['edit']."'");
	} else {
		mysql_query("INSERT INTO vehicleservice SET servicedate = ".$servicedate.", vehicleregno = '".$formvalues['vehicleregno']."', partserviced = '".$formvalues['partserviced']."', servicedone = '".$formvalues['servicedone']."' ") or die (mysql_error());
	}
	
	forwardToPage("managevehicleservice.php");
}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Vehicle Service            <?php } else {?>            Add Service Report         <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>

</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><a href="managevehicleservice.php">Manage Vehicle Service </a> &gt; <?php if($action == 'edit') {?>
          Edit Vehicle Service
            <?php } else {?>
            Add Service Report
          <?php } ?> </td>
      </tr>
      <tr>
        <td>
		<form action="vehicleservice.php" method="post">
		<table width="100%" border="0">
          <tr>
            <td width="31%" align="right"><font class="redtext">*</font> is a required field </td>
            <td colspan="2">&nbsp;</td>
          </tr>
		 <?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){?>
		  <tr>
            <td width="31%"> </td>
            <td colspan="2"><font class="redtext"><b><?php echo $_SESSION['errors'];?></b></font></td>
          </tr>
		 <?php 
		 	$_SESSION['errors'] = "";
		 } ?>
          <tr>
            <td height="24" align="right" class="label2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="24" align="right" class="label2">Service Date: <font class="redtext">*</font></td>
            <td colspan="2">&nbsp;
				<?php if(isset($_GET['a'])){ echo date("d-M-Y",strtotime($vehicleservice['servicedate']));} else {?>
               Day:
           <select id="start_day" name="start_day">
<?php 
if(isset($vehicleservice['servicedate']) && trim($vehicleservice['servicedate']) != ""){
	$date = date("d", strtotime($vehicleservice['servicedate']));
} else {
	$date = "";
}
echo generateSelectOptions(getTime('day',''), $date);?>
</select>
               &nbsp;Month:
<select id="start_month" name="start_month">
 <?php 
 if(isset($vehicleservice['servicedate']) && trim($vehicleservice['servicedate']) != ""){
	$date =  date("F", strtotime($vehicleservice['servicedate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('month',''),$date);?> 
</select>
&nbsp;Year:
<select id="start_year" name="start_year">
 <?php 
  if(isset($vehicleservice['servicedate']) && trim($vehicleservice['servicedate']) != ""){
	$date = date("Y", strtotime($vehicleservice['servicedate']));
} else {
	$date = "";
}
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php }?> </td>
            </tr>
          <tr>
            <td align="right" class="label2">Vehicle Reg No:<font class="redtext">*</font></td>
            <td width="39%">&nbsp;
				<?php if (isset($_GET['id'])) { ?>
					<input type="text" name="vehicleregno" value="<?php echo $vehicleservice['vehicleregno']; ?>" readonly=""> 
				<?php 	} else {?>
				<select id="vehicleregno" name="vehicleregno">
				<?php
					echo generateSelectOptions(getSerialNumbers());
					}
				?>
				</select>
			</td>
            <td width="30%">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Part Serviced / Replaced:<font class="redtext">*</font></td>
            <td colspan="2">&nbsp;
              <input type="text" name="partserviced" id="partserviced" value="<?php echo $vehicleservice['partserviced']; ?>"></td>
          </tr>
          
          <tr>
            <td align="right" class="label">Service Done: <font class="redtext">*</font></td>
            <td colspan="2">&nbsp; 
				<textarea name="servicedone" id="servicedone" rows="5" cols="50"><?php echo $vehicleservice['servicedone']; ?></textarea>			</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2">&nbsp;
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
    <td colspan="2" align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>