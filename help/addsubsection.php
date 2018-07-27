<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$action = $_GET['action'];
$id = $_GET['id'];

if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	$imagename = uploadPhoto($_FILES['photofilename']['tmp_name'], $_FILES['photofilename']['name'], $_FILES['photofilename']['size'], $formvalues['MAX_FILE_SIZE'], $_FILES['photofilename']['error'], "helpimages/");
	
	//If editing the section
	if($formvalues['edit'] != ""){
		$query = "UPDATE helpsubsection SET step='".$formvalues['step']."', details='".$formvalues['details']."'";
		if($imagename != ""){
			$query .= ", imageURL = '".$imagename."'";
		}
		$query .= " WHERE id = '".$formvalues['edit']."'";
		
		mysql_query($query);
	
	//Insert new section
	} else {
		$query = "INSERT INTO helpsubsection (step, details";
		if($imagename != ""){
			$query .= ", imageURL";
		}
		$query .= ") VALUES ('".$formvalues['step']."','".$formvalues['details']."'";
		if($imagename != ""){
			$query .= ", '".$imagename."'";
		}
		$query .= ")";
		mysql_query($query);
		
		//Update the section subsection ids
		$sectiondata = getRowAsArray("SELECT substeps FROM helpsection WHERE id = '".$formvalues['sectionid']."'");
		if($sectiondata['substeps'] == ""){
			$sectiondata['substeps'] = mysql_insert_id();
		} else {
			$sectiondata['substeps'] .= ",".mysql_insert_id();
		}
		//Update the database
		mysql_query("UPDATE helpsection SET substeps = '".$sectiondata['substeps']."' WHERE id = '".$formvalues['sectionid']."'");
	}
	
	//Set appropriate help and forward to the page list.
	if(mysql_error() != ""){
		$_SESSION['msg'] = "There were problems saving your help section data. Please contact the admin.";
	} else {
		$_SESSION['msg'] = "The section help was successfully saved.";
	}
	forwardToPage("managesubsection.php?sid=".$formvalues['sectionid']);
}

if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM helpsubsection WHERE id = '".$id."'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Help Section            <?php } else {?>            Create Help Section          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><a href="../help/managesubsection.php?sid=<?php echo $_GET['sid'];?>">Manage Help Sub Section </a> &gt; <?php if($action == 'edit') {?>
          Edit Help Sub Section
            <?php } else {?>
            Create Help Sub Section
          <?php } ?> </td>
      </tr> 
      <tr>
        <td><form action="addsubsection.php" method="post" name="group" id="group" enctype="multipart/form-data" onSubmit="return isNotNullOrEmptyString('step', 'Please enter the sub section step.');"><table width="100%" border="0">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
		
          <tr>
            <td height="30" align="right" class="label2"> Step:<font class="redtext">*</font></td>
            <td><input name="step" type="text" id="step" value="<?php echo $data['step']; ?>" size="3"></td>
          </tr>
          <tr>
            <td height="30" align="right" class="label2">Details:</td>
            <td><input name="details" type="text" id="details" value="<?php echo $data['details']; ?>" size="50">             </td>
          </tr>
          <tr>
            <td align="right" class="label">OR</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Image: </td>
            <td><input  type="file" name="photofilename" id="photofilename" size="40">
              <input type="hidden" name="MAX_FILE_SIZE" value="3000000" /></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
	if($action == "edit"){
		echo $id; 
	}
	?>">
              <input type="hidden" name="sectionid" id="sectionid" value="<?php echo $_GET['sid']; ?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>


