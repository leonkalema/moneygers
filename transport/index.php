<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['logdate']) ){
	$logdate = $_GET['logdate'];
	$query = "SELECT * FROM logbook WHERE logdate LIKE '%$logdate%' GROUP BY mobile ORDER BY id";
}
else{
	$today=date("Y-m-d");
	$query = "SELECT * FROM logbook WHERE logdate LIKE '%$today%' GROUP BY mobile";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Send Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
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
        <td class="headings"><a href="../transport/managevehiclelog.php">  Previous Logbooks</a>
		 &gt; Vehicle log for <?php if(isset($_GET['logdate']) ){ echo date("d-M-Y",strtotime($_GET['logdate'])); } else {?> today (<?php echo date("d-M-Y",strtotime("now")); }?>)</td>
      </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
	  
       <tr>
			<td>
			<form action="../transport/vehiclelog.php" method="post" >
			<table width="100%" border="0">
			<tr>
			  <td colspan="4" class="label">Select the Mobile for which you want to Add the log.</td>
			  </tr>
			<tr>
			  <td align="right" class="label">&nbsp;</td>
			  <td colspan="3" nowrap>&nbsp;</td>
			  </tr>
			<tr>
			<td width="20%" align="right">Vehicle(Mobile) No:</td>
			<td width="80%" colspan="3" nowrap>
			<select id="serialno" name="serialno">
				<?php echo generateSelectOptions(getSerialNumbers());?>
			  </select>
			  &nbsp;
			<input type="submit" name="select" value="Select">			</td>
			</tr>
			</table>
			</form>
			</td>
		</tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <?php if (howManyRows($query)==0)
		  	echo "There are no Vehicle log books for today (".date("d-M-Y",strtotime("now")).")" ;
			else {
		  ?>
		  <tr>
		  <td colspan="2" class="label">&nbsp;</td> 
          </tr>
		  <tr>
            <td colspan="2"></td>
          </tr>
		 <tr>
        <td colspan="2" width="100%"><div style="padding:4px;width:730px;height:350px;overflow: auto">
		<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="1">
           <tr class="tabheadings">
            <td width="15%">Edit</td>
			<td width="15%">Vehicle</td>
            <td width="24%">Driver</td>
			<td width="61%">Car Commander</td>
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
            
			 <td>
			<?php if(isset($_GET['logdate']) ){?>
			<a href="../transport/vehiclelog.php?action=edit&mobile=<?php echo $line['mobile']; ?>&logdate=<?php echo $logdate; ?>" class="normaltxtlink" title="Edit Vehicle log book.">Edit</a><?php } else {?>
			<a href="../transport/vehiclelog.php?action=edit&mobile=<?php echo $line['mobile']; ?>" class="normaltxtlink" title="Edit Vehicle log book.">Edit</a><?php } ?>
			</td>
			<td>
			<?php if(isset($_GET['logdate']) ){?>
			<a href="../transport/vehiclelog.php?action=view&mobile=<?php echo $line['mobile']; ?>&logdate=<?php echo $logdate; ?>" class="normaltxtlink" title="Edit Vehicle log book."><?php echo $line['mobile']; ?></a><?php } else {?>
			<a href="../transport/vehiclelog.php?action=view&mobile=<?php echo $line['mobile']; ?>" class="normaltxtlink" title="Edit Vehicle log book."><?php echo $line['mobile']; ?></a><?php } ?>
			
			</td>
			<?php
			$driver = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$line['driver']."'"); ?>
            <td nowrap="nowrap"><?php echo $line['driver']; ?>&nbsp;(<?php echo $driver['firstname']." ".$driver['lastname']." ".$driver['othernames']; ?>)</td>
			<?php
			$driver = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$line['carcommander']."'"); ?>
			<td><?php echo $line['carcommander']; ?>&nbsp;(<?php echo $driver['firstname']." ".$driver['lastname']." ".$driver['othernames']; ?>)</td>
          </tr>
		   <?php 
			  	$i++;
			  } ?>
        </table></div>
		  <?php }  ?>       </td>
      </tr>
	  <tr>
	  	<td>&nbsp;</td>
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
