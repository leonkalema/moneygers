<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['veh'])){
	$veh=decryptValue($_GET['veh']);
	$vehicledetails=getRowAsArray("SELECT * FROM equipment WHERE serialno='".$veh."' ");

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Vehicle details</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings">Vehicle details for <?php echo $veh; ?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="28%" align="right" class="label">Vehicle Number : </td>
            <td width="72%">
			  <strong><?php echo $veh;?></strong> </td>
          </tr>
		  <tr>
            <td width="28%" align="right" class="label">Vehicle Type : </td>
            <td width="72%">
			<?php echo $vehicledetails['type'];?>             </td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Name:</td>
            <td><?php echo $vehicledetails['name']; ?>  </td>
          </tr>
          <tr>
            <td align="right" class="label">Status: </td>
            <td>
			<?php echo $vehicledetails['status']; ?>			</td>
          </tr>
		  <tr>
            <td align="right" class="label">In Store? </td>
            <td>
			<?php if($vehicledetails['instore'] == "Y") echo "YES"; else echo "NO"; ?>			</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"></td>
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
