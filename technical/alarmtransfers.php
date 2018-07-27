<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();


// Transferring alarms or viewing transfered alarms
//else if(isset($_POST['transfered']) || (isset($_GET['a']) && $_GET['a'] == "transfered")){
//else //if( (isset($_GET['a']) && $_GET['a'] == "transfered")){
	if(isset($_POST)){
	print_r($_POST['alarmid']);
		for($i=0;$i<count($_POST['alarmid']);$i++){
			$query = "SELECT * FROM alarms WHERE id = '".$_POST['alarmid'][$i]."'";
			//mysql_query($query);
		}
	}
	
	//$query = "SELECT * FROM alarms WHERE status = 'transfered' ORDER BY lastupdated DESC";
	
}
else {
// Viewing all active alarms;
$query = "SELECT * FROM alarms WHERE status = 'active' ORDER BY id DESC";

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Alarm Installations</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">
		<?php 
		if(isset($_POST['serviced']) || (isset($_GET['a']) && $_GET['a'] == "serviced")){ 
			echo "Serviced Alarms"; 
		}else if(isset($_POST['decommissioned']) || (isset($_GET['a']) && $_GET['a'] == "decommissioned")){ 
			echo "Decommissioned Alarms"; 
		}else if(isset($_POST['transfered']) || (isset($_GET['a']) && $_GET['a'] == "transfered")){ 
			echo "Transfered Alarms"; 
		}else {
			echo "Manage Alarm Installations"; 
		}
		?>
		</td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="managealarminstallations.php">
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
           <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
		  <tr><?php if(userHasRight($_SESSION['userid'], "152")){?>
            <td width="12%"><span class="label">
              <input name="newalarminstallation" type="button" id="newalarminstallation" onClick="javascript:document.location.href='../technical/alarminstallations.php'" value="Add Alarm">
            </span></td>
			<?php } ?>
			<td width="74%">
			<span class="label"> 
			  <?php if(isset($_POST['serviced']) || (isset($_GET['a']) && $_GET['a'] == "serviced")){
			   	echo " <a href=\"../technical/managealarminstallations.php\" title=\"Displays all alarms.\">New Alarms</a>&nbsp;";
			   } else if(isset($_POST['decommissioned']) || (isset($_GET['a']) && $_GET['a'] == "decommissioned")){
			   	echo " <a href=\"../technical/managealarminstallations.php\" title=\"Displays all alarms.\">New Alarms</a>&nbsp;";
				} else if(isset($_POST['transfered']) || (isset($_GET['a']) && $_GET['a'] == "transfered")){
			   	echo " <a href=\"../technical/managealarminstallations.php\" title=\"Displays all alarms.\">New Alarms</a>&nbsp;";
				} else{ ?>
			   <?php //if(userHasRight($_SESSION['userid'], "147")){?>
			   <a href="../technical/managealarminstallations.php?a=serviced" title="Displays alarms that have been serviced.">Serviced Alarms</a>&nbsp;<?php //} ?>
			   <?php //if(userHasRight($_SESSION['userid'], "149")){?>
			   <a href="../technical/managealarminstallations.php?a=decommissioned" title="Displays alarms that have been decommissioned.">Decommissioned Alarms</a> &nbsp;<?php //} ?>
			   <?php //if(userHasRight($_SESSION['userid'], "148")){?>
			   <a href="../technical/managealarminstallations.php?a=transfered" title="Displays alarms that have been transfered.">Transfered Alarms</a> <?php //} ?> 
			    
				<?php } ?>
            </span></td>
            </tr>
			<tr>
            <td colspan="2"></td>
          </tr>
          		  
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td colspan=\"2\">There are no ".$_GET['a']." alarms to display.</td></tr>";
				echo "<tr><td><input type=\"button\" name=\"cancel\" id=\"cancel\" value=\"<< Back\" onClick=\"javascript:history.go(-1);\"></td></tr>";
		   	} else { 
			?>
          <tr>
            <td colspan="2"><div style="padding:4px;width:720px;height:320px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			    <?php if(userHasRight($_SESSION['userid'], "152")){?>
				<td width="3%">&nbsp;</td>
                <td width="4%">Edit</td>
				<td width="6%">Delete</td><?php } ?>
				<td width="13%">Alarm ID</td>
                <td width="17%">Assignment</td>
                <td width="20%">Start Date</td>
                <td width="18%">End Date</td>
                <td width="19%">Expiry Date</td>	
              </tr>
			  <?php
			  $result = mysql_query($query);
			  $i = 0;
			  while($line = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php if(userHasRight($_SESSION['userid'], "152")){?>
			  <td><input type="checkbox" name="alarmid[]" id="alarmid[]<?php echo $line['id']; ?>" value="<?php echo $line['id']; ?>"></td>
                <td><a href="../technical/alarminstallations.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify alarm installations information.">Edit</a></td>
                <td><a href="#" onClick="javascript:deleteEntity('../technical/alarminstallations.php?id=<?php echo $line['id']; ?>&action=delete', 'alarminstallations', '<?php echo $line['alarmid']; ?>')" class="normaltxtlink" title="Delete this Alarm.">Delete</a></td><?php } ?>
                
                <td><?php echo $line['alarmid']; ?></td>
				<!--td><?php echo $line['assignment']; ?></td-->
				<td><?php 
					if(isset($_POST['transfered']) ){ ?>
						<?php if (isset($_GET['id'])) { ?>
			<select id="<?php echo $line['assignment']; ?>" name="<?php echo $line['assignment']; ?>" > 
			<option value="<?php echo $line['assignment']; ?>" selected><?php echo $line['assignment']; ?></option>
			</select>
				<?php 	} ?>
						<select id="assignment" name="assignment">
						<?php
							echo generateSelectOptions(getCallSigns());
							//}
						?>
						</select>	
							<?php } else  
							 echo $line['assignment']; ?> </td>
				<td><?php echo date("d-M-Y",strtotime($line['startdate'])); ?></td>
				<td><?php echo date("d-M-Y",strtotime($line['enddate'])); ?></td>
				<td><?php echo date("d-M-Y",strtotime($line['expirydate'])); ?></td>
              </tr>
			  <?php 
			  	$i++;
			  } ?>
            </table></div></td>
          </tr>			
			<?php } ?>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			<td colspan="2">
			  <?php 
			   if( !(isset($_GET['a']) && $_GET['a'] == "serviced" || $_GET['a'] == "decommissioned" || $_GET['a'] == "transfered") ){?>			   
				   <?php if(userHasRight($_SESSION['userid'], "147")){?>
				   <input name="serviced" type="submit" id="serviced" value="Service Alarms"> <?php } ?>
				   <?php if(userHasRight($_SESSION['userid'], "149")){?>
				   <input name="decommissioned" type="submit" id="decommissioned" value="Decommission Alarms"> <?php } ?>
				   <?php if(userHasRight($_SESSION['userid'], "148")){?>
				   <input name="transfered" type="submit" id="transfered" onClick="javascript:document.location.href='../technical/alarmtransfers.php'" value="Transfer Alarms"> <?php } ?>
			   <?php } ?>			   </td>
			</tr>
        </table>
		</form>
        </td>
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
