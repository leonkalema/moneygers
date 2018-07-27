<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$assignment=array();
//Set edit mode for the incident
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = $_GET['id'];
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
        <td class="headings"><a href="../operations/manageassignments.php">Manage Incidents</a> &gt; <?php if($_GET['a'] == 'overtime'){ ?>Add Overtime for <?php echo $assignment_array['callsign']." (".$assignment_array['client'].")"; }?></td>
      </tr>
      <tr>
        <td><form action="processincident.php" method="post" name="form1" id="form1" onSubmit=" return isNotNullOrEmptyString('guardid', 'Please enter the ID of the guard who worked overtime.') && isNotNullOrEmptyString('duration', 'Please specify the duration of the overtime.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
           <?php 
		  //TODO: Add code for viewing the overtime and editing the overtime 
		  
		  ?>
		   <tr>
            <td align="right" class="label">Guard:<font class="redtext">*</font></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="28%" valign="top"><input type="text" name="guardid" id="guardid" value=""></td>
                <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guardid','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
              </tr>
            </table></td>
            </tr>
			 <tr>
            <td align="right" class="label">Date:<font class="redtext">*</font></td>
            <td>Day:
              <select id="day" name="day">
                <?php 
					   if(isset($assignment_array['date']) && trim($assignment_array['date']) != ""){
	$date = date("d", strtotime($assignment_array['date']));
} else {
	$date = date("d", strtotime("now"));
}
					 
					 echo generateSelectOptions(getTime('day',''), $date);?>
              </select>
&nbsp;Month:
<select id="month" name="month">
  <?php 
				   if(isset($assignment_array['date']) && trim($assignment_array['date']) != ""){
	$date = date("F", strtotime($assignment_array['date']));
} else {
	$date = date("F", strtotime("now"));
}
				   echo generateSelectOptions(getTime('month',''), $date);?>
</select>
&nbsp;Year:
<select id="year" name="year">
  <?php 
				    if(isset($assignment_array['date']) && trim($assignment_array['date']) != ""){
	$date = date("Y", strtotime($assignment_array['date']));
} else {
	$date = date("Y", strtotime("now"));
}
				   echo generateSelectOptions(getTime('year','na'), $date);?>
</select></td>
            </tr>
			<tr>
            <td align="right" class="label">Duration (Hrs):<font class="redtext">*</font></td>
            <td><select id="duration" name="duration">
              <option selected>&lt;Select One&gt;</option>
              <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			  <option value="5">5</option>
			  <option value="6">6</option>
			  <option value="7">7</option>
			  <option value="8">8</option>
			  <option value="9">9</option>
			  <option value="10">10</option>
			  <option value="11">11</option>
			  <option value="12">12</option>
                                    </select></td>
            </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:history.go(-1);">
			    &nbsp;&nbsp;
                <?php 
			if(!(isset($_GET['d']) && $_GET['d'] == "view")){ ?>
                <input type="submit" name="SaveActions" id="SaveActions" value="Save">
                <?php } ?></td>
			  </tr>
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
