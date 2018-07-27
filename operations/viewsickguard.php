<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['id'])){
	
	$guard=getRowAsArray("SELECT * from sickguard where id='".$_GET['id']."'");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Sick Guard Details
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
            <a href="managesickguards.php">Manage Sick Guards</a> &gt; View Sick Guard Details          </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          
          
          <tr>
            <td width="47%" align="right" class="label">Guard:</td>
            <td colspan="2">
              <?php 
			  $namearray = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$guard['guard']."'");
			  echo $guard['guard'] ." (".$namearray['firstname']." ".$namearray['lastname']." ".$namearray['othernames'].")"; ?>            </td>
          </tr>
          <tr>
            <td height="17" align="right" valign="top" class="label">Illness:</td>
            <td colspan="2"><?php echo $guard['illness']; ?></td>
            </tr>
          
          <tr>
            <td align="right" class="label">Notes: </td>
            <td colspan="2"><div style="width:200px"><?php echo $guard['notes']; ?></div></td>
          </tr>
          <tr>
            <td height="18" align="right" class="label">Date Started: </td>
            <td colspan="2"><?php echo date("d-M-Y",strtotime($guard['date_started'])); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Expected Recovery Date:</td>
            <td colspan="2"><?php 
			
				if($guard['date_recovery'] == "0000-00-00 00:00:00"){
				echo "Date Unknown";
				} else {
				echo date("d-M-Y",strtotime($guard['date_recovery']));
				}
			
			 ?></td>
          </tr>
          
          
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
          </tr>
          
          <tr>
            <td align="center">&nbsp;</td>
            <td colspan="2"><input type="button" name="editsickguard" value="Edit Sick Guard Details" onClick="javascript:document.location.href='../operations/sickguard.php?action=edit&id=<?php echo $_GET['id']; ?>'">
              <input type="button" name="newsickguard" value="Register Sick Guard" onClick="javascript:document.location.href='../operations/sickguard.php'"></td>
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


