<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues']) > 0 && !isset($_GET['id'])){
	$formvalues = $_SESSION['formvalues'];
}

if( isset($_GET['id']) && !userHasRight($_SESSION['userid'], "110")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You donot have permission to edit this item";
	forwardToPage($url);
}

if(isset($_GET['id']) && $_GET['id'] != ""){
	$id = decryptValue($_GET['id']);
	$formvalues = getRowAsArray("SELECT * FROM itempurchases WHERE id = '$id'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Item Purchases</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">View Item Purchase </td>
      </tr>
      <tr>
        <td>
          <table width="100%" border="0" cellpadding="5">
            <tr>
              <td align="right" nowrap><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"></td>
              <td>&nbsp;</td>
            </tr>            
            <tr>
              <td align="right" nowrap class="label">Item Type: </td>
              <td valign="top"><?php echo $formvalues['itemtype'];?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label" width="21%">Item Name: </td>
              <td width="79%" valign="top"><?php echo $formvalues['itemname'];?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Description: </td>
              <td><?php echo $formvalues['description'];?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Condition: </td>
              <td><?php echo $formvalues['condition'];?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Cost: </td>
              <td><?php echo number_format($formvalues['cost']);?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">Supplier: </td>
              <td><?php echo $formvalues['supplier'];?></td>
			</tr>
            <tr>
              <td align="right" nowrap class="label">Status: </td>
              <td><?php echo $formvalues['status'];?></td>
            </tr>
            <tr>
              <td align="right" nowrap class="label">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
                
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
