<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$assignment=array();
//Set edit mode for the incident
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	//echo $id;exit;
	$action = $_GET['a'];
	
	// Incident details from incident table
	$incident = getRowAsArray("SELECT * FROM incidents WHERE id = '".$id."'");	
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Incident<?php } else if($action == "view") {?>View Incident<?php } else { ?> Register Incident <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
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
        <td class="headings"><a href="../operations/manageincidents.php">Manage Incidents</a> &gt; <?php if($action == 'edit') { echo "Edit";} else { echo "Create";} ?> Incident</td>
      </tr>
      <tr>
        <td><form action="processincident.php" method="post" name="form1" id="form1" onSubmit=" return isNotNullOrEmptyString('refno', 'Please enter the incident reference no or leave the default generated.') && isNotNullOrEmptyString('assignment', 'Please enter the assignment call sign.') && isNotNullOrEmptyString('details', 'Please enter the details of the incident.') && isNotNullOrEmptyString('reportedby', 'Please enter the number of the guard who reported this incident.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
            <tr>
            <td align="right" class="label"> Reference Number: <font class="redtext">*</font></td>
            <td><?php if(isset($action) && $action == "view"){ 
					echo $incident['refno']; 
				} else {?>
              <input type="text" name="refno" id="refno" value="<?php 
			  if(isset($id)){
			  	echo $incident['refno'];
			  } else {
			  	echo time();
			  } ?>"> <?php } ?></td>
            </tr>
            
		       <tr>
              <td align="right" class="label" valign="top">Assignment:<font class="redtext">*</font></td>
              <td><?php if(isset($_GET['id']) || (isset($action) && $action == "view")){
			  echo "<input type=\"text\" name=\"assignment\" id=\"assignment\" value=".$incident['assignment']." readonly>";
			  } else {?><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="28%" valign="top"><input type="text" name="assignment" id="assignment" value="<?php echo $incident['assignment'];?>"></td>
                    <td width="23%" valign="top" nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_assignments&value=','assignments_search','assignment','Searching...'); return false; ">Search for Assignment</a>&nbsp;</td>
                    <td width="49%"><div id="assignments_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                  </tr>
                </table><?php } ?></td>
             </tr>
             <tr>
             <td align="right" class="label">Date:<font class="redtext">*</font></td>
             <td colspan="3">Day: <?php if(isset($action) && $action == "view"){ 
					echo date("d", strtotime($incident['date']));
				} else {?>
           <select id="incident_day" name="incident_day">
<?php 
if(isset($incident['date']) && $incident['date'] != "0000-00-00 00:00:00"){
 	$date = date("d", strtotime($incident['date']));
 } else {
 	if(isset($id)){
		$date = "";
	} else {
		$date = date("d", strtotime("now"));
	}
 }
echo generateSelectOptions(getTime('day',''), $date);?>
</select><?php } ?>
               &nbsp;Month:
               <?php if(isset($action) && $action == "view"){ 
					echo date("F", strtotime($incident['date']));
				} else {?>
<select id="incident_month" name="incident_month">
 <?php 
 if(isset($incident['date']) && $incident['date'] != "0000-00-00 00:00:00"){
 	$date = date("F", strtotime($incident['date']));
 } else {
 	if(isset($id)){
		$date = "";
	} else {
		$date = date("F", strtotime("now"));
	}
 }
 echo generateSelectOptions(getTime('month',''), $date);?> 
</select>
<?php } ?>
&nbsp;Year:
<?php if(isset($action) && $action == "view"){ 
					echo date("Y", strtotime($incident['date']));
				} else {?>
<select id="incident_year" name="incident_year">
 <?php 
 if(isset($incident['date']) && $incident['date'] != "0000-00-00 00:00:00"){
 	$date = date("Y", strtotime($incident['date']));
 } else {
 	if(isset($id)){
		$date = "";
	} else {
		$date = date("Y", strtotime("now"));
	}
 }
 echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php } ?></td>
          </tr>
      
			<tr>
			  <td align="right" class="label">Guard Responsible:</td>
			  <td><?php if(isset($action) && $action == "view"){ 
					echo $incident['guardresponsible'];
				} else {?><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="28%" valign="top"><input type="text" name="guardresponsible" id="guardresponsible" value="<?php echo $incident['guardresponsible']; ?>"></td>
                  <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guardresponsible','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                  <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                </tr>
              </table>
			  <?php } ?></td>
			  </tr>
			
		<tr>
		<td align="right" class="label">Details: <font class="redtext">*</font></td>
<td><?php if(isset($action) && $action == "view"){ 
					echo "<div style=\"width:200px\">".$incident['details']."</div>";
				} else {?>
  <textarea name="details" rows="5" id="details"><?php echo $incident['details'];?></textarea>
  <?php } ?></td>
		</tr>
<tr>
  <td class="label" align="right">Reported By: <font class="redtext">*</font></td>
  
  <td valign="top"><?php if(isset($action) && $action == "view"){ 
					$person = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE p.id = g.personid AND g.guardid = '".$incident['reportedby']."'");
				echo $incident['reportedby']." (".$person['firstname']." ".$person['lastname']." ".$person['othernames'].")";
				} else {?>
    <input type="text" name="reportedby" id="reportedby" value="<?php echo $incident['reportedby'];?>" />
    <?php } ?>    <b>Time:</b>
    <?php if(isset($action) && $action == "view"){ 
					echo $incident['timereported'];
				} else {?> 
    <span class="label">
    <select id="timereported" name="timereported">
      <?php 
	  echo generateSelectOptions(getAllTime(), $incident['timereported']);?>
    </select>
    <?php } ?>
    </span></td>
</tr>
  
  <tr>
    <td align="right" class="label">Checked By:</td>
    <td><?php if(isset($action) && $action == "view"){ 
					if(trim($incident['checkedby']) != ""){
					$person = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE p.id = g.personid AND g.guardid = '".$incident['checkedby']."'");
				echo $incident['checkedby']." (".$person['firstname']." ".$person['lastname']." ".$person['othernames'].")";
					}
				} else {?>
      <input type="text" name="checkedby" id="checkedby" value="<?php echo $incident['checkedby'];?>">
      <?php } ?>
      <b>Time:</b>
      <?php if(isset($action) && $action == "view"){ 
					echo $incident['timechecked'];
				} else {?>
      <select id="timechecked" name="timechecked">
        <?php 
		echo generateSelectOptions(getAllTime(),$incident['timechecked']);?>
      </select>
      <?php } ?>
     </td>
  </tr>
  <?php 
  if(isset($id)){
  	if(trim($incident['actiontaken']) != ""){
  		$array = split(",",trim($incident['actiontaken']));
		// Print the actions on the incident
		for($i=0;$i<count($array);$i++){ 
			$action = getRowAsArray("SELECT * FROM incidentactions WHERE id='".$array[$i]."'");
	?>
		<tr>
		   <td align="right" class="label">Action Taken (<?php echo ($i+1);?>):</td>
		   <td><div style="width:200px"><?php echo $action['details'];?></div></td>
		   </tr>
	<?php }
		} else { ?>
		<tr>
		   <td>&nbsp;</td>
		   <td>There are no actions taken so far.</td>
		   </tr>
		<?php }
  } else {
  ?>
		  <tr>
		   <td align="right" class="label">Action Taken:</td>
		   <td><textarea name="actiontaken" rows="5" id="actiontaken"><?php echo $incident['actiontaken'];?></textarea></td>
		   </tr>
		   <?php } 
		   
		   // Do not show if just viewing
		   if(!(isset($_GET['a']) && $_GET['a'] == "view")){
		   ?>
		   <tr>
		     <td align="right" class="label">&nbsp;</td>
		     <td>	       &nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../operations/incidentactions.php?id=<?php echo encryptValue($incident['assignment']);?>">Edit Actions Taken</a></td>
		     </tr>
		   <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
			<input type="submit" name="submit" id="submit" value="Save">
			<input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $id;
			  } ?>">			</td>
          </tr>
		  <?php } ?>
        </table>
        </form></td>
      </tr>
    </table></td>
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
