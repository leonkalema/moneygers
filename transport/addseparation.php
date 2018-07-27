<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$action = $_GET['a'];
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM assignmentseparations WHERE id = '".$id."'");
}
if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	if(trim($formvalues['edit']) != ""){
		$editid = decryptValue($formvalues['edit']);
		mysql_query("UPDATE assignmentseparations SET assgnfrom = '".$formvalues['from']."', assgnto = '".$formvalues['to']."', distance = '".$formvalues['distance']."', description = '".$formvalues['description']."' WHERE id='".$editid."'");
	
	} else {
		mysql_query("INSERT INTO assignmentseparations (assgnfrom, assgnto, distance, description, date_of_entry) VALUES ('".$formvalues['from']."', '".$formvalues['to']."', '".$formvalues['distance']."', '".$formvalues['description']."', NOW())");
	}
	
	forwardToPage("assignmentseparations.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit District            <?php } else {?>            Create District          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td><?php include "../core/header.php";?></td>
  </tr> <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="assignmentseparations.php">Manage Separations</a>  &gt; Add Separation </td>
      </tr> 
      <tr>
        <td><form action="addseparation.php" method="post" name="separation" id="separation" onSubmit="return isNotNullOrEmptyString('from', 'Please enter the callsign of the [FROM] assignment.') && isNotNullOrEmptyString('to', 'Please enter the callsign of the [TO] assignment.') && isNotNullOrEmptyString('distance', 'Please enter the distance separating the assignments.') && isNotNullOrEmptyString('description', 'Please enter the description of the separation.');"><table width="100%" border="0">
          <tr>
            <td width="21%" align="right"><font class="redtext">*</font> is a required field </td>
            <td width="79%">&nbsp;</td>
          </tr>
		
          <tr>
            <td height="30" align="right"><span class="label2">From:<font class="redtext">*</font></span><br>
(Enter all or part of the client's name.)</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="28%" valign="top"><input type="text" name="from" id="from" value="<?php echo $data['assgnfrom'];?>"></td>
                <td width="23%" valign="top" nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_assignments&value=','from_search','from','Searching...'); return false; ">Search for Assignment</a>&nbsp;</td>
                <td width="49%"><div id="from_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" align="right"><span class="label2">To:<font class="redtext">*</font></span><br>
(Enter all or part of the client's name.)</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="28%" valign="top"><input type="text" name="to" id="to" value="<?php echo $data['assgnto'];?>"></td>
                <td width="23%" valign="top" nowrap>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_assignments&value=','to_search','to','Searching...'); return false; ">Search for Assignment</a>&nbsp;</td>
                <td width="49%"><div id="to_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" align="right" class="label2">Distance (Kms):<font class="redtext">*</font></td>
            <td><input type="text" name="distance" id="distance" value="<?php echo $data['distance']; ?>"> 
              Kms 
             </td>
          </tr>
          <tr>
            <td height="30" align="right" valign="top" class="label2">Description:<font class="redtext">*</font></td>
            <td><textarea name="description" rows="3" id="description"><?php echo $data['description']; ?></textarea>
              </td>
          </tr>
          <tr>
            <td align="right" class="label2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
	if($action == "edit"){
		echo $_GET['id']; 
	}
	?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
  </tr>
  <tr> 
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>


