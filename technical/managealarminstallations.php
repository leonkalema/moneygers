<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();


//Re-commission alarms that were decommissioned
if(isset($_POST['recommissioned'])){
	for($i=0;$i<count($_POST['alarmid']);$i++){
		$servicequery = "UPDATE alarms SET status = 'active', lastupdated = now() WHERE id = '".$_POST['alarmid'][$i]."'";
		mysql_query($servicequery);
	}
}

// Servicing alarms or viewing serviced alarms
if(isset($_POST['serviced']) || (isset($_GET['a']) && $_GET['a'] == "serviced")){
	
	if(isset($_POST)){
		for($i=0;$i<count($_POST['alarmid']);$i++){
			$servicequery = "UPDATE alarms SET status = 'serviced', lastupdated = now() WHERE id = '".$_POST['alarmid'][$i]."'";
			mysql_query($servicequery);
		}
	}
	
// Decommissioning alarms or viewing decommissioned alarms
} else if(isset($_POST['decommissioned']) || (isset($_GET['a']) && $_GET['a'] == "decommissioned")){
	if(isset($_POST)){
		for($i=0;$i<count($_POST['alarmid']);$i++){
			$servicequery = "UPDATE alarms SET status = 'decommissioned', lastupdated = now() WHERE id = '".$_POST['alarmid'][$i]."'";
			mysql_query($servicequery);
		}
	}
	
	$query = "SELECT * FROM alarms WHERE status = 'decommissioned' ORDER BY lastupdated DESC";
	$_GET['a'] = "decommissioned";
	
// Get all alarms marked to be transfered
}else if(isset($_POST['transfer'])) {
		$trans=array();
		for($i=0;$i<count($_POST['alarmid']);$i++){
			$query = "SELECT * FROM alarms WHERE id = '".$_POST['alarmid'][$i]."'";
			$query2 = getRowAsArray($query);
			array_push($trans,$query2);
		}

// viewing transfered alarms
}else if ((isset($_GET['a']) && $_GET['a'] == "transfered")){
	$query = "SELECT * FROM alarmactions WHERE isactive = 'Y' ORDER BY date_of_entry DESC";
}

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchalarm'] = trim($_GET['v']);
	$_SESSION['searchtype'] = trim($_GET['type']);
	$_SESSION['searchcategory'] = trim($_GET['c']);
	
	$searchvalues = $_SESSION['searchalarm'];
	// Scan through the search values separated by a space
	$searchvalue = explode(" ",trim($searchvalues));
	
	if(trim($_SESSION['searchcategory']) != ""){
		$wherestr = " AND status = '".trim($_SESSION['searchcategory'])."'";
		$_GET['a'] = $_SESSION['searchcategory'];
	} else {
		$wherestr = " AND status <> 'transfered' AND status <> 'decommissioned'";
		$_GET['a'] = "";
	}
	
	//If the user wants to search all the alarms
	if($_SESSION['searchtype'] == "ID"){
		$whereclause = "alarmid LIKE '%".$_SESSION['searchalarm']."%'".$wherestr;
	} else {
		$whereclause = "assignment LIKE '%".$_SESSION['searchalarm']."%'".$wherestr;
	}
	
	$query = "SELECT * FROM alarms WHERE ".$whereclause." ORDER BY lastupdated DESC";
	
}

// Viewing all active alarms;
if(!isset($query)) {
	$query = "SELECT * FROM alarms WHERE status <> 'transfered' AND status <> 'decommissioned' ORDER BY lastupdated DESC";
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
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
            <td colspan="2">&nbsp;</td>
          </tr>
		  <tr>
            <td width="12%"><span class="label">
              <?php if(userHasRight($_SESSION['userid'], "152")){?><input name="newalarminstallation" type="button" id="newalarminstallation" onClick="javascript:document.location.href='../technical/alarminstallations.php'" value="Add Alarm">
            <?php } ?></span></td>
			
			<td><?php 
			  if(!isset($_GET['a']) || trim($_GET['a']) == ""){
			  	echo "<span class=\"label\">New Alarms</span>";
			  } else {
			  	echo "<a href=\"../technical/managealarminstallations.php\">New Alarms</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "decommissioned"){
			  	echo "<span class=\"label\">Decommissioned Alarms</span>";
			  } else {
			  	echo "<a href=\"../technical/managealarminstallations.php?a=decommissioned\">Decommissioned Alarms</a>";
			  }
			  ?> | <?php 
			  if(isset($_GET['a']) && $_GET['a'] == "transfered"){
			  	echo "<span class=\"label\">Alarm Transfers</span>";
			  } else {
			  	echo "<a href=\"../technical/managealarminstallations.php?a=transfered\">Alarm Transfers</a>";
			  }
			  ?></td>
			  
            </tr>
			<tr>
            <td colspan="2"></td>
          </tr>
          	<tr>
            <td colspan="2"><form action="" method="post" name="searchguards">
		        <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                  <tr>
                    <td>Search  Alarms:</td>
                    <td><input name="searchalarm" id="searchalarm" type="text" size="20" value="<?php if(isset($_SESSION['searchalarm'])){ echo $_SESSION['searchalarm'];}?>">                      &nbsp;</td>
                    <td>Search By:
                      <select name="type" id="type">
                          <option value="">&lt;Select&gt;</option>
						  <option value="ID" <?php if($_SESSION['searchtype'] == "ID"){ echo "selected";}?>>Alarm ID</option>
						  <option value="assignment" <?php if($_SESSION['searchtype'] == "assignment"){ echo "selected";}?>>Assignment</option>
                      </select></td>
                    <td><input type="button" name="Button" value="Search Alarms" onClick="pickFormItemTypeAndDirect('searchalarm', '../technical/managealarminstallations.php?a=search&c=<?php echo $_GET['a'];?>&v=', 'Please enter the alarm ID or assignment and select the alarm type you want to search.')"></td>
                  </tr>
                </table>
		    </form></td>
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
            <td colspan="2"><div style="padding:4px;width:720px;height:270px;overflow: auto">
			<table width="90%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
             
			  <tr class="tabheadings">
			    <?php if(userHasRight($_SESSION['userid'], "152")){
				if($_GET['a'] != "transfered"){
				?>
				<td width="3%">&nbsp;</td>
				<?php }
				if(!isset($_GET['a'])){
				?>
                <td width="4%">Edit</td>
				<td width="6%">Delete</td>
				<td width="6%">Transfer</td><?php }
				
				} ?>
				<td width="15%">Alarm ID</td>
				<?php if(isset($_GET['a']) && $_GET['a'] == "transfered"){?>
                <td width="17%">Previous Assignment</td>
                <td width="10%">New Assignment</td>
				<td width="10%">Previous Location</td>
				<td width="10%">New Location</td>
				<td width="20%">Previous Client</td>
				<td width="20%">New Client</td>
				<?php } else {?>
				<td width="17%">Assignment</td>
                <td width="20%">Start Date</td>
                <td width="18%">End Date</td>
                <td width="19%">Free Trial Expiry Date</td>	
				<?php if(!isset($_GET['a'])){ ?>
				<td width="19%">Serviced</td>	
				<?php }
				
				} ?>
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
			  <?php if(userHasRight($_SESSION['userid'], "152")){
			  
			  if($_GET['a'] != "transfered"){?><td><input type="checkbox" name="alarmid[]" id="alarmid[]<?php echo $line['id']; ?>" value="<?php echo $line['id']; ?>"></td><?php } 
			  
			  if(!isset($_GET['a'])){
			  ?>
                <td><a href="../technical/alarminstallations.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify alarm installations information.">Edit</a></td>
                <td><a href="#" onClick="javascript:deleteEntity('../technical/alarminstallations.php?id=<?php echo encryptValue($line['id']); ?>&action=delete', 'alarminstallations', '<?php echo $line['alarmid']; ?>')" class="normaltxtlink" title="Delete this Alarm.">Delete</a></td>
				<td><a href="../technical/alarmtransfer.php?id=<?php echo encryptValue($line['id']); ?>&a=<?php echo encryptValue("transfer");?>" class="normaltxtlink" title="Transfer this Alarm.">Transfer</a></td>
				<?php }
				
				} ?>
                
                <td><a <?php if(isset($_GET['a']) && $_GET['a'] == "transfered"){
					echo "href=\"../technical/alarmtransfer.php?a=".encryptValue("view")."&id=".encryptValue($line['id'])."\" class=\"normaltxtlink\" title=\"View alarm transfer information.\"";
				
				} else {
						echo "href=\"../technical/alarminstallations.php?action=view&id=".encryptValue($line['id'])."\" class=\"normaltxtlink\" title=\"View alarm installations information.\"";
				}?>><?php echo $line['alarmid']; ?></a></td>
				
				<?php if(isset($_GET['a']) && $_GET['a'] == "transfered"){?>
                <td width="17%"><?php echo $line['prevassignment'];?></td>
                <td width="10%"><?php echo $line['newassignment'];?></td>
				<td width="10%"><?php echo $line['prevlocation'];?></td>
				<td width="10%"><?php echo $line['newlocation'];?></td>
				<td width="20%"><?php echo $line['prevclient'];?></td>
				<td width="20%"><?php echo $line['newclient'];?></td>
				<?php } else {?>
				<td><?php echo $line['assignment']; ?></td>
				<td><?php 
				if($line['startdate'] != "0000-00-00"){
					echo date("d-M-Y",strtotime($line['startdate']));
				}
				 ?></td>
				<td><?php 
				if($line['enddate'] != "0000-00-00"){
					echo date("d-M-Y",strtotime($line['enddate']));
				}
				?></td>
				<td><?php 
				if($line['expirydate'] != "0000-00-00"){
					echo date("d-M-Y",strtotime($line['expirydate']));
				}
				 ?></td>
				 <?php if(!isset($_GET['a'])){ ?>
				 <td><?php 
				if($line['status'] == "serviced"){
					echo "Serviced";
				}
				 ?></td>
				<?php }
				
				} ?>
              </tr> 
			  <?php 
			  	$i++;
			  } ?>
            </table>
            </div></td>
          </tr>			
			<?php } ?>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			<td colspan="2">
					   
				   <?php if(userHasRight($_SESSION['userid'], "145") && !isset($_GET['a'])){?>
			      <input name="serviced" type="submit" id="serviced" value="Mark as Serviced"> 
			      
			      <input name="decommissioned" type="submit" id="decommissioned" value="Decommission"> 
			      <?php } 
				  
				  //Re-commission those alarms you want to re-use
				  if(isset($_GET['a']) && $_GET['a'] == "decommissioned"){ ?>
				  <input name="recommissioned" type="submit" id="recommissioned" value="Re-commission">
				  <?php } ?></td>
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
