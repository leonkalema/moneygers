<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$today=date("Y-m-d");

if(isset($_GET['mobile']) || isset($_GET['action']) ){
	$mobile = $_GET['mobile'];
	$action = $_GET['action'];
	
	if(isset($_GET['action'])) {
		if(isset($_GET['logdate'])){
			$logdate = $_GET['logdate'];
		}else{
			$logdate = $today;
		}
		$logs = "SELECT * FROM logbook WHERE  mobile = '$mobile' AND logdate= '$logdate' ORDER BY id";
	}
}else{
	$mobile = $_POST['serialno'];
	$logs = "SELECT * FROM logbook WHERE  mobile = '$mobile' AND logdate = '$today' ORDER BY id";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Fuel Distribution:</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td width="599" colspan="2"><?php include "../core/header.php";?></td>
  </tr>
  <tr> 
    <td height="7" colspan="4"></td>
  </tr>
  <tr> 
    <td align="center" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings"><a href="../transport/index.php"> Select Mobile</a> &gt; Manage Vehicle Log for ( <?php echo $mobile; ?> )</td>
      </tr>
	  
	  <tr>
		  <td><form name="form1" method="post" action="processvehiclelog.php">
		  <table width="100%" border="0">
			  <tr>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
				<td align="center" class="label">DAILY VEHICLE LOG BOOK </td>
			  </tr>
	  	<tr>
	    <td align="left">Fields marked with <font class="redtext">*</font> are required </td>
	    </tr>
	  <tr>
         <?php
		if($_SESSION['error'] != '') {
		 ?> 
              <td align="center" class="redtext"><?php echo $_SESSION['error']; ?></td>
            <?php $_SESSION['error'] = "";  
		} ?>
	</tr>
	<?php
		if (howManyRows($logs)==0){
			echo "Add log information for vehicle ";
			echo $mobile;
		}else {
			echo "Manage log information for vehicle ";
			echo $mobile;
			
			$log_query=mysql_query($logs);
			while ($rows=mysql_fetch_array($log_query, MYSQL_ASSOC)){
				$ar[] = $rows;
			}
			
			foreach ($ar as $log){
				//$logdate=$log['logdate'];
				//echo "<br>Time out = ".$log['timeout'];
			}
		}
	?>
	<tr>
        <td colspan="4">
          <div>
		  <table align="center" border="0" width="98%" class="contenttableborder">
            <tr>
              <td width="15%" align="right" class="label"><!--Date: <font class="redtext">*</font--></td>
			  <td align="left" class="label"><!--input name="logdate" id="logdate" type="text" value="<?php echo date("Y-m-d");?>" readonly=""--></td>
			  <td colspan="2" align="left" class="label">&nbsp;</td>
			  <td colspan="2" align="left" class="label">GAUGE READING:</td>
            </tr>
            <tr>
              <td align="right" class="label">Mobile: </td>
              <td valign="top"><?php echo $mobile; ?><input type="hidden" name="mobile" id="mobile" value="<?php echo $mobile; ?>" /></td>
			  <td colspan="2">&nbsp;</td>
			  <td width="15%" class="label" align="right">Morning: <font class="redtext">*</font></td>
              <td width="22%" align="left"><?php if(isset($action) && $action == "view"){ 
			  $levelarray = getAllTankLevels();
			  echo $levelarray[$log['fuelmorning']]; } else { ?><select name="fuelmorning" id="fuelmorning"/>
			  <?php 
			  if(isset($log['fuelmorning']) && $log['fuelmorning'] != ""){ 
				 $level =  $log['fuelmorning'];
			  } else { 
				 $level =  "";
			  }
			  echo generateSelectOptions(getAllTankLevels(), $level);?>
			 </select><?php }?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">&nbsp;</td>
              <td>&nbsp;</td>
			  <td colspan="2">&nbsp;</td>
			  <td width="15%" class="label" align="right">Evening: </td>
              <td width="22%" align="left"><?php if(isset($action) && $action == "view"){ 
			  
			  echo $levelarray[$log['fuelevening']]; } else {?><select name="fuelevening" id="fuelevening"/>
			  <?php 
			  if(isset($log['fuelevening']) && $log['fuelevening'] != ""){ 
				 $level =  $log['fuelevening'];
			  } else { 
				 $level =  "";
			  }
			  echo generateSelectOptions(getAllTankLevels(), $level);?>
			  </select><?php } ?></td>
            </tr>
			
          <tr>
		   <td colspan="8">&nbsp; </td>
		  </tr>
           
            <tr>
              <td width="15%" align="right"  class="subheadingtxt">Shift:</td>
              <td colspan="3" class="subheadingtxt"><?php if(isset($action) && $action == "view"){ echo $log['shift']; } else {?><select id="shift" name="shift">
                <?php echo generateSelectOptions(getAllServiceTypes(), $log['shift']);?>
              </select><?php } ?></td>
              <td colspan="5" class="subheadingtxt">Quick Response Force (QRF) <a name="qrf" id="qrf"></a><br>
                <span style="font-size:10px">(enter guard ID only)</span> </td>
              </tr>
            <tr>
              <td align="right" nowrap class="label">Driver:</td>
              <td width="24%"><?php if(isset($action) && $action == "view"){ echo getGuardNameById($log['driver']); } else {?>
			  <select id="driver" name="driver">
                <?php echo generateSelectOptions(getAllDrivers(), $log['driver']);?>
              </select><?php } ?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2" rowspan="2" valign="top"><table width="100%" border="0">
                <tr>
                  <td colspan="2"><table width="100%" border="0" id="qrfguards">
                    <?php
					if(isset($log['qrfguards']) && (trim($log['qrfguards']) != "" || trim($log['qrfguards']) != "<>") || (isset($action) && $action == "view" && trim($log['qrfguards']) != "")){
						//Extract all entered guards
						$guards = split("<>", trim($log['qrfguards'],"<>"));
						//Display all entered guards
						for($i=0;$i<count($guards);$i++){ ?>
							<tr>
                      <td width="21%" align="right"><b>Guard: </b></td>
                      <td width="79%"><?php if(isset($action) && $action == "view"){
					  echo $guards[$i];
					  } else {?><input type="text" name="qrfguard[]" id="qrfguard[]<?php echo $i;?>" value="<?php echo $guards[$i];?>"><?php } ?></td>
                    </tr>
						<?php }
					
					} else { 
					?>
					<tr>
                      <td width="21%" align="right"><b>Guard: </b></td>
                      <td width="79%"><input type="text" name="qrfguard[]" id="qrfguard[]0"></td>
                    </tr>
					<?php } ?>
                  </table></td>
                  </tr>
                <?php if($action != "view"){?>
                <tr>
                  <td colspan="2"><img src="../images/bullet.gif">&nbsp;<a href="#qrf" onClick="addRowToResponseTable('qrfguards', 'qrfguard')">Add Guard</a> | <a href="#qrf" onClick="removeRow('qrfguards')">Remove Guard </a></td>
                  </tr>
				  <?php }?>
              </table></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Car <br>
Commander:</td>
              <td><?php if(isset($action) && $action == "view"){ echo getGuardNameById($log['carcommander']); } else {?>
				  <select id="carcommander" name="carcommander">
					<?php echo generateSelectOptions(getAllCommanders(), $log['carcommander']);?>
				  </select><?php } ?>			  </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td colspan="8">&nbsp;</td>
             </tr>
</table>
		   </div></td>
<tr>
	<td colspan="8"><a name="anchorvehiclelog" id="anchorvehiclelog"></a></td>
</tr>
<tr>
  <td colspan="8">
  <div><table align="center" width="98%" border="0" cellspacing="1"  class="contenttableborder"  id="vehiclelog">
  	<tr>
		<td colspan="9" class="subheadingtxt">Enter Vehicle log book information</a> (Time in 24Hrs) </td>
	</tr>
	<tr>
		<td colspan="9"></td>
	</tr>
	  <tr align="center" class="tabheadings">
		<td colspan="3" valign="top">TIME</td>
		<td width="11%" rowspan="2" valign="top">FROM</td>
		<td width="10%" rowspan="2" valign="top">TO</td>
		<td colspan="2" valign="top">ODOMETER READING </td>
		<td width="8%" rowspan="2" valign="top">KM <br>
		  TRVLD </td>
		<td width="33%" rowspan="2" valign="top">REASON</td>
	  </tr>
	  <tr class="tabheadings">
		<td width="1%" align="center" valign="top">&nbsp;</td>
		<td width="5%" align="center" valign="top">OUT</td>
		<td width="5%" align="center" valign="top">IN</td>
		<td width="10%" align="center" valign="top">START</td>
		<td width="13%" align="center" valign="top">END</td>
		</tr>
	<?php 
	
	//if (howManyRows($logs) != 0){
	
	$i=0;
	foreach ($ar as $log){
	if ($log['timein'] != ""){
	?>
	<tr>
		<td><?php echo $i+1; ?>.</td>
		<td><?php echo $log['timeout']; ?></td>
		<td><?php echo $log['timein']; ?></td>
		<td><?php echo $log['placefrom']; ?></td>
		<td><?php echo $log['placeto']; ?></td>
		<td><?php echo $log['odometerstart']; ?></td>
		<td><?php echo $log['odometerend']; ?></td>
		<td align="center"><?php echo ($log['odometerend']-$log['odometerstart']); ?></td>
		<td><?php echo $log['reason']; ?>
		  <input type="hidden" name="recordid[]" value="<?php echo $log['id']; ?>" /></td>
	 </tr>
		<?php 
		$i++;
		}
	  }?> 
	
	 </table></div></td>
	 </tr>
	 
	 <tr>
	 <td colspan="8">
	<div>
		 <table width="98%" align="left" cellpadding="3" cellspacing="0">
		 <tr align="center">
			<td>&nbsp;</td>
		 </tr>
		 <?php if($action != "view"){ ?>
		 <tr>
		   <td colspan="8">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorvehiclelog" onClick="addRowToVehicleLogTable('vehiclelog')">Add Record</a>   | <a href="#anchorvehiclelog" onClick="removeRow('vehiclelog')">Remove Record</a></td>
		  </tr>
		 <?php } ?>
		  <tr>
			<td colspan="8" align="left" class="label">&nbsp;</td>
			</tr>
		  <tr>
			<td colspan="8" align="left" class="label">General Vehicle Condition and Comments:</td>
			</tr>
		  <tr>
			<td colspan="8" align="left">
			<?php if(isset($action) && $action == "view"){ echo "<div style='width:500px'>".$log['conditionsandcomments']."</div>"; } else {?><textarea rows="5" cols="80" name="conditionsandcomments"><?php echo $log['conditionsandcomments']; ?></textarea><?php } ?></td>
		  </tr>
		  </table>
	  </div>	  </td>
	  <tr>
	  <td><table align="center" width="98%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td colspan="4" align="left" class="subheadingtxt">Handing over: </td>
          <td colspan="4" align="left" class="subheadingtxt">Receiving:</td>
        </tr>
        <tr>
          <td colspan="4" align="left" class="label" valign="baseline"><table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td width="38%" class="label">Driver:</td>
                <td width="62%">
				<?php if(isset($action) && $action == "view"){ echo getGuardNameById($log['driver']); } else {?><select id="handoverdriver" name="handoverdriver">
                    <?php echo generateSelectOptions(getAllDrivers(), $log['driver']);?>
                 </select> <?php } ?>               
				</td>
              </tr>
              <tr>
                <td class="label">Car Commander:</td>
                <td><?php if(isset($action) && $action == "view"){ echo getGuardNameById($log['carcommander']); } else {?>
                  <select id="handovercarcommander" name="handovercarcommander">
                    <?php echo generateSelectOptions(getAllCommanders(), $log['carcommander']);?>
                  </select>
                  <?php } ?></td>
              </tr>
              <tr>
                <td class="label">Received By: </td>
                <td><?php if(isset($action) && $action == "view"){ echo $log["receivedby"];} else {?><input type="text" name="receivedby" value="<?php echo $_SESSION['names']; ?>"/><?php } ?></td>
              </tr>
          </table></td>
          <td colspan="4"  align="right" class="label"><table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td width="34%" class="label">Driver:</td>
                <td width="66%"><?php if(isset($action) && $action == "view"){ echo getGuardNameById($log['receivingdriver']); } else {?>
                  <select id="receivingdriver" name="receivingdriver">
                    <?php echo generateSelectOptions(getAllDrivers(), $log['receivingdriver']);?>
                  </select><?php } ?></td></tr>
              <tr>
                <td class="label">Car Commander: </td>
                <td><?php if(isset($action) && $action == "view"){ echo getGuardNameById($log['receivingcarcommander']); } else {?><select id="receivingcarcommander" name="receivingcarcommander">
                  <?php echo generateSelectOptions(getAllCommanders(), $log['receivingcarcommander']);?>
                </select><?php } ?></td>
              </tr>
              <tr>
                <td class="label">Time: </td>
                <td><?php if(isset($action) && $action == "view"){ echo $log['timereceived']; } else {?>
                  <input type="text" name="timereceived" size="5" maxlength="5" value="<?php echo $log['timereceived']; ?>" />
                  <?php } ?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="8" align="left" class="label">&nbsp;</td>
        </tr>
      </table></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">&nbsp;&nbsp;
<?php if($action != "view"){?><input type="submit" name="submit" id="submit" value="Save"><?php } ?>

</td>
  </tr>
</table>
   </form></td>
</tr>
</table></td>
</tr>
<?php //} ?>
<tr>
<td colspan="2" align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
</tr>
<tr> 
<td colspan="2" align="left" valign="top">&nbsp;</td>
</tr>
</table>
</body>
</html>
