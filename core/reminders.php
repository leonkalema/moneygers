<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$groupid= $_SESSION['groups'];
if(isset($_GET['a']) && $_GET['a'] == "delete"){
	$id=decryptValue($_GET['id']);
	mysql_query("DELETE FROM messages WHERE id = '".$id."'");
}

$query = "SELECT * FROM messages WHERE isactive='N' AND (sentto='' OR sentto LIKE '%$groupid%') ORDER BY date DESC";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Reminders Archive</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
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
        <td class="headings">View Reminders Archive </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no archived reminders.</td></tr>";
		   	} else {
			?>
          <tr>
            <td align="center">
		
			  <div style="padding:4px;width:95%;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
               <td height="21">Delete</td>
			   <td align="left">Reason</td>
                <td align="left">Details</td>
				<td align="left">Sent By </td>
                <td align="left">Sent To </td>
				<td align="left">Date</td>
              </tr>
			
			  <?php
			  //Get the reminders that have been archived
			  $result = mysql_query($query);
			  $i = 0;
			  while($line = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
				  
				  if(in_array($_SESSION['groups'],split(",",$line['sentto'])) || ($_SESSION['groups'] == "1" && trim($line['sentto']) == "")){
			   ?>
              <tr valign="top" class="<?php echo $rowclass; ?>">
			  <td><a href="#" onClick="javascript:deleteEntity('../core/reminders.php?id=<?php echo encryptValue($line['id']); ?>&a=delete', 'reminder', '<?php echo $line['reason']; ?>')">Delete</a></td>
                <td><?php echo $line['reason']; ?></td>
                <td><?php echo "<div style=\"width:150px\">".$line['details']."</div>"; ?></td>
				<td><?php $name = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$line['sentby']."'");
				echo $name['firstname']." ".$name['lastname'];?></td>
                <td><?php 
				$name = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$line['sentto']."'");
				echo $name['firstname']." ".$name['lastname']; ?></td>
				<td><?php echo date("d-M-Y",strtotime($line['date'])); ?></td>
              </tr>
			  <?php 
			 		$i++;
			  	}
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
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
