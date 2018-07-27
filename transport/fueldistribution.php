<?php
include_once "../include/commonfunctions.php"; 
session_start();

openDatabaseConnection();

if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['action'];
}

if($action == 'edit') {
	$id = decryptValue($_GET['id']);
	$fuel = getRowAsArray("SELECT * FROM fueldistribution WHERE id='".$id."'");
}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	$id = decryptValue($_GET['id']);
	mysql_query("DELETE FROM fueldistribution WHERE id = '".$id."'");

	forwardToPage("managefueldistribution.php");
}

if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	
	if(trim($formvalues['edit']) != ""){
		$id = decryptValue($formvalues['edit']);
		
		mysql_query("UPDATE fueldistribution SET date = ".changeDateFromPageCombosToMySQLFormat($formvalues['fuel_day'], $formvalues['fuel_month'], $formvalues['fuel_year']).", vehicleregno = '".$formvalues['vehicleregno']."', mileage = '".$formvalues['mileage']."', litresreceived = '".$formvalues['litresreceived']."', costperlitre = '".implode("",split(",",$formvalues['costperlitre']))."', petrostation = '".$formvalues['petrostation']."' WHERE id='".$id."'");
	} else {
		mysql_query("INSERT INTO fueldistribution SET date = ".changeDateFromPageCombosToMySQLFormat($formvalues['fuel_day'], $formvalues['fuel_month'], $formvalues['fuel_year']).", vehicleregno = '".$formvalues['vehicleregno']."', mileage = '".$formvalues['mileage']."', litresreceived = '".$formvalues['litresreceived']."', costperlitre = '".implode("",split(",",$formvalues['costperlitre']))."', petrostation = '".$formvalues['petrostation']."' ");
	}
	
	forwardToPage("managefueldistribution.php");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Fuel Distribution            <?php } else {?>            Add Fuel Distribution          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>

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
        <td class="headings"><a href="managefueldistribution.php">Manage Fuel Distribution </a> &gt; <?php if($action == 'edit') {?>
          Edit Fuel Distribution
            <?php } else {?>
            Add Fuel Distribution
          <?php } ?> </td>
      </tr>
      <tr>
        <td>
		<form action="fueldistribution.php" method="post" onSubmit="return isNotNullOrEmptyString('fuel_day', 'Please select the day of fueling.') && isNotNullOrEmptyString('fuel_month', 'Please select the month of fueling.') && isNotNullOrEmptyString('fuel_year', 'Please select the year of fueling.') && isNotNullOrEmptyString('vehicleregno', 'Please select the vehicle registration number.') && isNotNullOrEmptyString('mileage', 'Please enter the mileage reading at the time of receiving the fuel.') && isNotNullOrEmptyString('litresreceived', 'Please enter the number of litres of fuel received.') && isNotNullOrEmptyString('costperlitre', 'Please enter the cost per litre of fuel received.') && isNotNullOrEmptyString('petrostation', 'Please enter the petrol station where the fuel was received.')">
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
            <td height="24" align="right" class="label2">Date: </td>
            <td colspan="2">Day:
                    
                    <select id="fuel_day" name="fuel_day">
                      <?php 
					if(isset($fuel['date']) && $fuel['date'] != "0000-00-00"){ 
							$date =  date("d", strtotime($fuel['date']));
						} else { 
							$date =  "";
						}
					echo generateSelectOptions(getTime('day',''),  $date);?>
                    </select>
                    &nbsp;Month:

<select id="fuel_month" name="fuel_month">
  <?php 
  if(isset($fuel['date']) && $fuel['date'] != "0000-00-00"){ 
							$date =  date("F", strtotime($fuel['date']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:

<select id="fuel_year" name="fuel_year">
  <?php 
  if(isset($fuel['date']) && $fuel['date'] != "0000-00-00"){ 
	$date =  date("Y", strtotime($fuel['date']));
} else { 
	$date =  "";
}
						
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
            </tr>
          <tr>
            <td align="right" class="label2">Vehicle Reg No:<font class="redtext">*</font></td>
            <td width="39%">&nbsp;
				<?php if (isset($_GET['id'])) { ?>
					<input type="text" id="vehicleregno" name="vehicleregno" value="<?php echo $fuel['vehicleregno']; ?>" readonly=""> 
				<?php 	} else {?>
				<select id="vehicleregno" name="vehicleregno">
				<?php
					echo generateSelectOptions(getSerialNumbers());
					}
				?>
				</select>			  </td>
            <td width="30%">&nbsp;</div></td>
          </tr>
		  <tr>
            <td align="right" class="label2">Mileage Reading:<font class="redtext">*</font></td>
            <td width="39%">&nbsp;
              <input type="text" name="mileage" id="mileage" value="<?php echo $fuel['mileage']; ?>">			</td>
            <td width="30%">&nbsp;</div></td>
          </tr>
          <tr>
            <td align="right" class="label">Number of litres:<font class="redtext">*</font></td>
            <td colspan="2">&nbsp;
              <input name="litresreceived" type="text" id="litresreceived" value="<?php echo $fuel['litresreceived']; ?>" maxlength="4"></td>
          </tr>
          
          <tr>
            <td align="right" class="label">Cost per Liter :<font class="redtext">*</font></td>
            <td colspan="2">&nbsp;
              <input name="costperlitre" type="text" id="costperlitre" value="<?php echo commify($fuel['costperlitre']); ?>" size="10">
              Shs</td>
          </tr>
          <tr>
            <td align="right" class="label">Petro Station: <font class="redtext">*</font></td>
            <td colspan="2">&nbsp; <input type="text" name="petrostation" id="petrostation" value="<?php echo $fuel['petrostation']; ?>">			</td>
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