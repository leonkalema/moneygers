<?php
include_once "../include/searchforpage.php";
include_once "../include/commonfunctions.php"; 
session_start();

openDatabaseConnection();

if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['action'];
}



	$id=$_GET['id'];

	if(isset($_GET['id'])){
	$q=mysql_query("SELECT * from guardresponseforms where id='$id'");
	
	while($row=mysql_fetch_array($q)){
	$assignment=$row[assignment];
	$guard=$row[guard];
	$commander=$row[commander];
	$mobile=$row[mobile];
	$location=$row[location];
	}
}




?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Guard Response <?php } else {?> Register Guard responses<?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
<script language="javascript">
var d= new Date();

</script>
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
        <td class="headings"><?php if($action == 'edit') {?>
          Edit Guard Responses
            <?php } else {?>
            Register Guard Responses
          <?php } ?></td>
      </tr>
      <tr>
        <td><form action="processguardresponses.php" method="post" name="guardresponses" id="guardresponses" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the guard.');"><table width="98%" height="410" border="0">
          <tr>
            <td width="20%" height="49" align="right"><font class="redtext">*</font> is a required field </td>
            <td width="52%"><?php if(isset($_GET['msg']) && $_GET['msg'] != ""){ echo $_GET['msg'];}?></td>
          </tr>
          <tr>
            <td width="20%" height="36" align="right" class="label"><br>
            Date
            :           </td>
            <td><input type="text" name="responseid" id="responseid" width="60" value="<?php echo date('d - M - Y',time()); ?>" readonly="true" ></td>
          </tr>
		
          <tr>
            <td height="30" align="right" class="label2">Assignment:<font class="redtext">*</font></td>
            <td><input type="text" name="assignment1" id="assignment1" value="<?php echo $assignment; ?>">
              <img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_assignments&value=','assignment_search','assignment1','Searching...'); return false; ">Search Assignments </a></td>
             <td width="28%"><div id="assignment_search" style="width:200; height:40; font-style:normal;font-family: verdana;font-size: 10px; color:#000066;  font-weight:bolder; font-size:14px;overflow: auto "></div></td>
            </tr>
			 <tr><td colspan="3"><table width="107%" border="0" align="center" cellpadding="2" cellspacing="0" id="responsetable">
          <tr>
            <td width="20%" height="30" align="right" valign="top" class="label"><br>
              Guard: </td>
            <td width="46%">
			  <input type="text" name="guardres[]"  id="guardres[]1" width="200" value="<?php echo $guard; ?>">
		<img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guardres[]1','Searching...'); return false; ">Search Guards </a>	</td><td width="34%"><div id="guardname_search" style="width:200; height:40; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td></tr></table></td></tr>
          <tr>
            <td height="20" align="right" valign="top" class="label">&nbsp;</td>
            <td>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick= "addRowToResponseTable('responsetable', 'guardres')" >Add Guard</a>   | <a href="#" onClick="removeMultRows('responsetable',1)">Remove Guard</a> </td>
            </tr>
			 <tr><td colspan="3"><table width="99%" border="0" align="center" cellpadding="2" cellspacing="2" id="commandertable">
          <tr>
            <td width="19%" height="28" align="right" valign="top" class="label"><br>
              Commander: </td>
            <td width="52%"><input type="text" name="commander" id="commander[]1" width="200" value="<?php echo $commander; ?>">
              <img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_commanders&value=','commander_search','commander[]1','Searching...'); return false; ">Search Commanders</a></td><td width="29%"><div id="commander_search" style="width:200; height:40; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
          </tr></table></td>
            </tr>
          <tr>
            <td height="24" align="right" valign="top" class="label">&nbsp;</td>
            <td>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="addRowToCommanderTable()">Add Commander</a>   | <a href="#" onClick="removeMultRows('commandertable',1)">Remove commander</a></td>
            </tr>
			 <tr><td colspan="3"><table width="99%" border="0" align="center" cellpadding="2" cellspacing="2" id="mobiletable">
          <tr>
            <td width="19%" height="39" align="right" valign="top" class="label"><br>
              Mobile: </td>
            <td width="52%"><input type="text" name="mobile[]" id="mobile[]1"width="200" value="<?php echo $mobile; ?>">
              <img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_mobiles&value=','mobile_search','mobile[]1','Searching...'); return false; ">Search Mobile </a> </td><td width="29%"><div id="mobile_search" style="width:200; height:40; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td></tr></table></td>
            </tr>
          <tr>
            <td height="23" align="right" valign="top" class="label">&nbsp;</td>
            <td>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="addRowToMobileTable()">Add Mobile </a>   | <a href="#" onClick="removeMultRows('mobiletable',1)">Remove Mobile</a> </td>
            </tr>
			 <tr><td colspan="3"><table width="99%" border="0" align="center" cellpadding="2" cellspacing="2" id="locationtable">
          <tr>
            <td width="19%" height="31" align="right" valign="top" class="label"><br>
              Location: <font class="redtext">&nbsp;</font></td>
            <td width="52%">
              <input type="text" name="location[]" id="location[]1"width="200" value="<?php echo $location; ?>">
            <img src="../images/bullet.gif" width="5" height="11"> <a href="#"  onClick="setDiv('../include/resultsforpage.php?area=return_locations&value=','location_search','location[]1','Searching...'); return false; " >Search Location </a></td><td width="29%"><div id="location_search" style="width:200; height:40; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td></tr></table></td>
            </tr>
          <tr>
            <td height="23" align="right" valign="top" class="label">&nbsp;</td>
            <td>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#"  onClick= "addRowToLocationTable()" >Add Location </a>   | <a href="#" onClick="removeMultRows('locationtable',1)">Remove Location </a></td>
            </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
                <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
                <input type="submit" name="submit" id="submit" value="Register">
                <input type="hidden" name="id" id="id" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>">
                <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo "YES";
			  } ?>">
                <br>
                <div>
                  <p><font color ="blue">Today's Responses</font> </p>
                  <p>&nbsp;   </p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp; </p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                </div>
                <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp; </p></td>
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