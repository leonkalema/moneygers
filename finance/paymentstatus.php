<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Client Payment Status</title>
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
        <td class="headings">Manage Client Payment Status </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">

          <tr>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			$query = "SELECT id,callsign,client,lastpaymentdate,amountdue FROM assignments WHERE isactive = 'Y' ORDER BY lastupdatedate DESC";
			
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no active assignments to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  <?php if(userHasRight($_SESSION['userid'], "78")){?>
                <td width="13%">Edit</td><?php } ?>
                <td width="12%">Assignment</td>
                 <td width="13%">Client</td>
				 <td width="21%">Last Payment Date</td>
                 <td width="18%">Set Amount Due (Shs) </td>
				 <?php if(userHasRight($_SESSION['userid'], "79")){?>
				 <td width="18%">Profoma Invoice</td><?php } ?>				 
              </tr>
			  <?php
			  // Display the incidents 
			  $result = mysql_query($query);
			  $i = 0;
			   while($line=mysql_fetch_array($result, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php if(userHasRight($_SESSION['userid'], "78")){?>
				<td><a href="../finance/paymentstatusupdate.php?id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink">Edit</a></td><?php } ?>
                <td><?php if(userHasRight($_SESSION['userid'], "92")){?>
				<a href="../core/assignment.php?id=<?php echo encryptValue($line['id']); ?>&a=view" class="normaltxtlink"><?php echo $line['callsign'];?></a><?php } else echo $line['callsign']; ?></td>
                <td><?php echo $line['client'];?></td>
                <td><?php 
				if($line['lastpaymentdate'] != "0000-00-00 00:00:00"){
					echo date("d-M-Y",strtotime($line['lastpaymentdate'])); 
				} else {
					echo "&nbsp;";
				}
					?></td>
                <td><b><?php
				echo number_format($line['amountdue']);
				
				 ?></b></td>
				 <?php if(userHasRight($_SESSION['userid'], "79")){?>
                <td>
				<a href="../finance/report.php?f=Client Invoice&pid=<?php echo encryptValue($line['id']);?>">Generate</a>				</td><?php } ?>
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table></div></td>
          </tr>			
			<?php } ?>


        </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
