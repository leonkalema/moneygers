<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if($_GET['t']){
	$type_view = decryptValue($_GET['t']);
}

//Set edit mode for the complaint
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	// details from the complaint table
	$formvalues = getRowAsArray("SELECT * FROM complaints WHERE id = '".$id."'");	
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit <?php } else if($action == "view") {?>View <?php } else { ?> Register <?php } ?>Complaint</title>
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
        <td class="headings"><a href="../operations/complaints.php<?php if(isset($_GET['t'])){ echo "?t=".$_GET['t'];}?>">Manage Complaints</a> &gt; <?php if($action == 'edit') { echo "Edit";} else { echo "Register";} ?> Complaint</td>
      </tr>
      <tr>
        <td><form action="processcomplaint.php" method="post" name="form1" id="form1" onSubmit=" return isNotNullOrEmptyString('madeby', 'Please enter the name of the complainant.') &&  isNotNullOrEmptyString('callsign', 'Please enter the assignment call sign.') <?php if($type_view == "Client"){?>&&  isNotNullOrEmptyString('contactphone', 'Please enter the complaint\'s contact phone.') <?php }?>&&  isNotNullOrEmptyString('complaint_day', 'Please select the day the complaint was made.') && isNotNullOrEmptyString('complaint_month', 'Please select the month the complaint was made.') && isNotNullOrEmptyString('complaint_year', 'Please select the year the complaint was made.') && isNotNullOrEmptyString('details', 'Please enter the complaint details.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
            <tr>
              <td align="right" class="label"><?php 
			  if($type_view == "Client"){
			  	echo "Client Name";
			  } else {
			  	echo "Guard ID";
			  }?> <font class="redtext">*</font></td>
              <td><?php if(isset($action) && $action == "view"){ 
					echo $formvalues['madeby'];
				} else {?>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="28%" valign="top"><input type="text" name="madeby" id="madeby" value="<?php echo $formvalues['madeby']; ?>"></td>
                      <td width="23%" valign="top">&nbsp;<?php 
			  if($type_view == "Guard"){
			  	?><img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','madeby','Searching...'); return false; ">Search for Guard</a><?php } ?>&nbsp;</td>
                      <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                    </tr>
                  </table>
                <?php } ?></td>
            </tr>
            <tr>
              <td align="right"><span class="label">Assignment Call Sign:<font class="redtext">*</font></span><br>
(Enter client name and search)</td>
              <td><?php if(isset($action) && $action == "view"){ 
					echo $formvalues['callsign'];
				} else {?>
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="28%" valign="top"><input type="text" name="callsign" id="callsign" value="<?php echo $formvalues['callsign'];?>"></td>
                    <td width="23%" valign="top" nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_assignments&value=','assignments_search','callsign','Searching...'); return false; ">Search for Assignment</a>&nbsp;</td>
                    <td width="49%"><div id="assignments_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                  </tr>
                </table>
                <?php } ?></td>
            </tr>
			<?php if($type_view == "Client"){?>
            <tr>
              <td align="right" class="label">Contact Phone:<font class="redtext">*</font></td>
              <td><?php if(isset($action) && $action == "view"){ 
					echo $formvalues['contactphone'];
				} else {?>
                <input type="text" name="contactphone" id="contactphone" value="<?php echo $formvalues['contactphone']; ?>">
                <?php } ?></td>
            </tr>
			<?php } ?>
             <tr>
             <td align="right" class="label">Date:<font class="redtext">*</font></td>
             <td colspan="3">Day: <?php if(isset($action) && $action == "view"){ 
					echo date("d", strtotime($formvalues['madeon']));
				} else {?>
           <select id="complaint_day" name="complaint_day">
<?php 
if(isset($formvalues['madeon']) && $formvalues['madeon'] != "0000-00-00 00:00:00"){
 	$date = date("d", strtotime($formvalues['madeon']));
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
					echo date("F", strtotime($formvalues['madeon']));
				} else {?>
<select id="complaint_month" name="complaint_month">
 <?php 
 if(isset($formvalues['madeon']) && $formvalues['madeon'] != "0000-00-00 00:00:00"){
 	$date = date("F", strtotime($formvalues['madeon']));
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
					echo date("Y", strtotime($formvalues['madeon']));
				} else {?>
<select id="complaint_year" name="complaint_year">
 <?php 
 if(isset($formvalues['madeon']) && $formvalues['madeon'] != "0000-00-00 00:00:00"){
 	$date = date("Y", strtotime($formvalues['madeon']));
 } else {
 	if(isset($id)){
		$date = "";
	} else {
		$date = date("Y", strtotime("now"));
	}
 }
 echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } ?></td>
          </tr>
			
		<tr>
		<td align="right" class="label">Details: <font class="redtext">*</font></td>
<td><?php if(isset($action) && $action == "view"){ 
					echo "<div style=\"width:200px\">".$formvalues['details']."</div>";
				} else {?>
  <textarea name="details" rows="5" id="details"><?php echo $formvalues['details'];?></textarea>
  <?php } ?></td>
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
			  } ?>">	<input type="hidden" name="whotype" id="whotype" value="<?php 
			 echo $type_view; ?>">		</td>
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
