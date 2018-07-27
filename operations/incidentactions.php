<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();
// If you are saving the actions
if(isset($_POST['SaveActions'])){
	$formvalues = array_merge($_POST);
	$id = $formvalues['assignment'];
	$idstring = "";
	$oldidstring = "";
	$fullidstring = "";
	
	//Update the old actions
	if(isset($formvalues['actionid']) && trim($formvalues['actionid']) != ""){
		for($i=0;$i<count($formvalues['actionid']);$i++){
			mysql_query("UPDATE incidentactions SET details = '".$formvalues['action'][$i]."' WHERE id = '".$formvalues['actionid'][$i]."'");
			if($oldidstring == ""){
				$oldidstring = $formvalues['actionid'][$i];
			} else {
				$oldidstring .= ",".$formvalues['actionid'][$i];
			}
		}
	}
	
	//Save the new actions too
	for($i=0;$i<count($formvalues['action']);$i++){
		if(!isset($formvalues['actionid'][$i])){
			mysql_query("INSERT INTO incidentactions (details, date_of_entry) VALUES ('".$formvalues['action'][$i]."', now())");
			//Update the id string in the incident table
			if($idstring == ""){
				$idstring = mysql_insert_id();
			} else {
				$idstring .= ",".mysql_insert_id();
			}
		}
	}
	
	//Update the id string in the incidents table
	$incident = getRowAsArray("SELECT actiontaken FROM incidents WHERE assignment = '".$formvalues['assignment']."'");
	if($oldidstring == ""){
		if(trim($incident['actiontaken']) != "" && $idstring == ""){
			$fullidstring = $incident['actiontaken'].",".$idstring;
		} else {
			$fullidstring = $idstring;
		}
	} else if($oldidstring != "" && $idstring != ""){
		$fullidstring = $oldidstring.",".$idstring;
	} else if($oldidstring != ""){
		$fullidstring = $oldidstring;
	}else if($idstring != ""){
		$fullidstring = $idstring;
	}
	mysql_query("UPDATE incidents SET actiontaken = '".$fullidstring."' WHERE assignment = '".$formvalues['assignment']."'");
	
	if(mysql_error() == ""){
		$_SESSION['msg'] = "Your actions have been successfully added";
	} else {
		$_SESSION['msg'] = "There were problems saving your actions. Please contact your administrator.";
	}
}

// First time you come from the index page
if(isset($_GET['id'])){
	$id = decryptValue($_GET['id']);
}
$data = getRowAsArray("SELECT assignment, actiontaken FROM incidents WHERE assignment='".$id."'");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Actions on Incidents</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="../operations/manageincidents.php">Manage Incidents</a> &gt; Edit Incident Actions </td>
      </tr>
      <tr>
        <td><form action="incidentactions.php" method="post" name="incidentactions" id="incidentactions"><table width="98%" border="0">
          <tr>
            <td height="15" colspan="2"><font class="redtext">*</font> is a required field </td>
            </tr>
          <tr>
            <td width="11%" height="15">&nbsp;</td>
            <td width="89%" class="redtext"><?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			}?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="label">Assignment:</td>
            <td><?php 
			$client = getRowAsArray("SELECT client FROM assignments WHERE callsign = '".$data['assignment']."'");
			echo $data['assignment']." (at ".$client['client'].")";?>
              <input type="hidden" name="assignment" id="assignment" value="<?php echo $data['assignment'];?>"></td>
          </tr>
			 <tr><td height="10" colspan="3" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" id="incidentactiontable">
			 <?php 
			 if(trim($data['actiontaken']) != ""){
			 	$array = split(",",$data['actiontaken']);
			 	for($i=0;$i<count($array);$i++){
			 		$action = getRowAsArray("SELECT * FROM incidentactions WHERE id='".$array[$i]."'");
					echo "<tr><td width=\"11%\" height=\"25\" align=\"right\" class=\"label\" nowrap>";
              		echo "Action (".($i+1)."): </td><td width=\"1%\"><textarea name=\"action[]\" id=\"action[]".($i+1)."\">".$action['details']."</textarea><input type=\"hidden\" name=\"actionid[]\" id=\"actionid[]".($i+1)."\" value=\"".$action['id']."\"></td><td width=\"88%\" valign=\"top\"><b>&nbsp;&nbsp;&nbsp;Date Entered:</b> ";
					if(trim($action['date_of_entry']) != "0000-00-00 00:00:00"){
						$date = date("d-M-Y",strtotime($action['date_of_entry']));
					} else {
						$date = "Unknown";
					}
					echo $date." </td></tr>";			 
			 	}
			 } else {
			 ?>
          <tr>
            <td width="11%" height="25" align="right" class="label">
              Action (1): </td>
            <td><textarea name="action[]" id="action[]1"></textarea></td><td>&nbsp;</td></tr>
			<?php } ?></table></td></tr>
          <tr>
            <td height="20">&nbsp;</td>
            <td height="20" nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick= "addRowToIncidentActionTable()" >Add Action</a> | <a href="#" onClick="removeRow('incidentactiontable')">Remove Action</a> </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">&nbsp;&nbsp;
                <?php 
			if(!(isset($_GET['d']) && $_GET['d'] == "view")){ ?><input type="submit" name="SaveActions" id="SaveActions" value="Save"><?php } ?></td>
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