<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

//Set edit mode for the iappraisal
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	// details from the appraisal table
	$appraisaldetails = getRowAsArray("SELECT * FROM appraisals WHERE id = '".$id."'");	
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit <?php } else if($action == "view") {?>View <?php } else { ?> Register <?php } ?>Appraisal</title>
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
        <td class="headings"><a href="../operations/appraisals.php">Manage Appraisals</a> &gt; <?php if($action == 'edit') { echo "Edit";} else { echo "Register";} ?> Appraisal</td>
      </tr>
      <tr>
        <td><form action="processappraisal.php" method="post" name="form1" id="form1" onSubmit=" return isNotNullOrEmptyString('guard', 'Please enter the guard ID.') && isNotNullOrEmptyString('assignment', 'Please enter the assignment call sign.') && isNotNullOrEmptyString('appraisal_day', 'Please select the appraisal day.') && isNotNullOrEmptyString('appraisal_month', 'Please select the appraisal month.') && isNotNullOrEmptyString('appraisal_year', 'Please select the appraisal year.') && isNotNullOrEmptyString('details', 'Please enter the details of the appraisal.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
            <tr>
              <td align="right" class="label">Guard ID:<font class="redtext">*</font></td>
              <td><?php if(isset($_GET['id']) || (isset($action) && $action == "view")){ 
					echo $appraisaldetails['guard'];
				} else {?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="28%" valign="top"><input type="text" name="guard" id="guard" value="<?php echo $appraisaldetails['guard']; ?>"></td>
                      <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guard','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                      <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                    </tr>
                  </table>
                <?php } ?></td>
            </tr>
            
		       <tr>
              <td align="right" class="label" valign="top">Assignment:<font class="redtext">*</font></td>
              <td><?php if(isset($_GET['id']) || (isset($action) && $action == "view")){
			 
			  $assignarr = getRowAsArray("SELECT client FROM assignments WHERE callsign= '".$appraisaldetails['assignment']."'"); 
				echo $appraisaldetails['assignment']." (".$assignarr['client'].")";
			  } else {?><table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="28%" valign="top"><input type="text" name="assignment" id="assignment" value="<?php echo $appraisaldetails['assignment'];?>"></td>
                    <td width="23%" valign="top" nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_assignments&value=','assignments_search','assignment','Searching...'); return false; ">Search for Assignment</a>&nbsp;</td>
                    <td width="49%"><div id="assignments_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                  </tr>
                </table><?php } ?></td>
             </tr>
             <tr>
             <td align="right" class="label">Date:<font class="redtext">*</font></td>
             <td colspan="3">Day: <?php if(isset($action) && $action == "view"){ 
					echo date("d", strtotime($appraisaldetails['registrationdate']));
				} else {?>
           <select id="appraisal_day" name="appraisal_day">
<?php 
if(isset($appraisaldetails['registrationdate']) && $appraisaldetails['registrationdate'] != "0000-00-00 00:00:00"){
 	$date = date("d", strtotime($appraisaldetails['registrationdate']));
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
					echo date("F", strtotime($appraisaldetails['registrationdate']));
				} else {?>
<select id="appraisal_month" name="appraisal_month">
 <?php 
 if(isset($appraisaldetails['registrationdate']) && $appraisaldetails['registrationdate'] != "0000-00-00 00:00:00"){
 	$date = date("F", strtotime($appraisaldetails['registrationdate']));
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
					echo date("Y", strtotime($appraisaldetails['registrationdate']));
				} else {?>
<select id="appraisal_year" name="appraisal_year">
 <?php 
 if(isset($appraisaldetails['registrationdate']) && $appraisaldetails['registrationdate'] != "0000-00-00 00:00:00"){
 	$date = date("Y", strtotime($appraisaldetails['registrationdate']));
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
					echo "<div style=\"width:200px\">".$appraisaldetails['details']."</div>";
				} else {?>
  <textarea name="details" rows="5" id="details"><?php echo $appraisaldetails['details'];?></textarea>
  <?php } ?></td>
		</tr>
<tr>
  <td class="label" align="right">Made By: </td>
  
  <td valign="top"><?php if(isset($action) && $action == "view"){ 
					echo $appraisaldetails['madeby'];
				} else {?>
    <input type="text" name="madeby" id="madeby" value="<?php echo $appraisaldetails['madeby'];?>" />
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
			  } ?>">			</td>
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
