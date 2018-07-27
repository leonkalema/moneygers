<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();

session_start();
$id=$_GET['id'];

	if(isset($_GET['id'])){
	$q=mysql_query("SELECT * from guardresponseforms where id='$id'");
	
	while($row=mysql_fetch_array($q)){
	$id=$row[id];
	$assignment=$row[assignment];
	$guard=$row[guard];
	$commander=$row[commander];
	$mobile=$row[mobile];
	$datecreated=$row[datecreated];
	$location=$row[location];
	}
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Guard Response Forms
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<script type="text/javascript" src="../javascript/tabber.js"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7" colspan="2"></td><tr> 

  </tr>
    <td colspan="2"><?php include "../core/header.php";?></td>
  </tr>
  <tr> 
    <td height="7" colspan="2"></td>
  </tr>
  <tr> 
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellpadding="0" cellspacing="0">
      <tr>
        <td class="headings">
            View Guard Responses
          </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          
          
          <tr>
            <td width="47%" align="right" class="label">Id:</td>
            <td colspan="2">
              <?php echo $id; ?>            </td>
          </tr>
          <tr>
            <td height="17" align="right" valign="top" class="label">Assignment:</td>
            <td colspan="2"><?php echo $assignment; ?></td>
            </tr>
          
          <tr>
            <td align="right" class="label">Guard: </td>
            <td colspan="2"><?php echo $guard; ?></td>
          </tr>
          <tr>
            <td height="18" align="right" class="label">Commander: </td>
            <td colspan="2"><?php echo $commander; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Mobile:</td>
            <td colspan="2"><?php 
			
				$date_recovery=$date2;
				
				echo $mobile;
			
			 ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Date of Response:</td>
            <td colspan="2"><?php 
			list($y,$m,$d)=explode("-",$datecreated);
			
			echo $d."-".$m."-".$y; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Location:</td>
            <td colspan="2"><?php echo $location; ?></td>
          </tr>
          
          
          <tr>
            <td colspan="3" align="right" class="label">&nbsp;</td>
            </tr>
          
          <tr>
            <td colspan="2" align="center"><input type="button" name="returntolist" value="Manage Guard Responses" onClick="javascript:document.location.href='../operations/manageguardresponses.php'">
              <input type="button" name="newguardresponses" value="Register Guard Responses" onClick="javascript:document.location.href='../operations/guardresponses.php'">
              <input type="button" name="editguardresponses" value="Edit Guard Responses" onClick="javascript:document.location.href='../operations/guardresponses.php?action=edit&id=<?php echo $_GET['id']; ?>'"> </td>
            </tr>
        </table>
        </td>
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



