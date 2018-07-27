<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$wherestr = "";

if(isset($_GET['veh'])){
	$veh=decryptValue($_GET['veh']);
	$wherestr = "WHERE vehicleregno LIKE '%".$veh."%'";
	if(isset($_GET['d'])){
		$wherestr .= " AND date = '".date("Y-m-d",strtotime(decryptValue($_GET['d'])))."'";
	}
}

$query="SELECT * FROM fueldistribution ".$wherestr." ORDER BY date DESC";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Vehicle fuel distribution details</title>
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
        <td class="headings">Vehicle fuel distribution details for <?php echo $veh; ?></td>
      </tr>
	  <tr>
          <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"></td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div style="padding:4px;width:730px;height:350px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	
				<td width="15%" nowrap>Date</td>
                <td width="16%" align="center">No. of Litres</td>
				<td width="16%">Cost Per Litre</td>				
                <td width="16%">Petro Station</td>
				<td width="69%">Mileage Reading</td>
              </tr>
			  <?php
			  $result = mysql_query($query);
			  $i = 0;
			  while($line = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                               
                <td><?php echo date("d-M-Y",strtotime($line['date'])) ; ?></td>
				<td align="center"><?php echo $line['litresreceived']; ?></td>
				<td><?php echo "Shs. ".commify($line['costperlitre']); ?></td>
				<td><?php echo $line['petrostation']; ?></td>
				<td><?php echo $line['mileage']; ?></td>
              </tr>
			  <?php 
			  	$i++;
			  } ?>
            </table></div></td>
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
