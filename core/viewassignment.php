<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$query="SELECT * FROM assignments where id='".$_GET['id']."'";
$result=mysql_query($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Assignment</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
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
        <td class="headings"><a href="manageassignments.php">Manage Assignments</a> &gt; View Assignment</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="right" class="label"><font class="redtext">*</font> is a required field </td>
            <td></td>
          </tr>
		
          <tr>
            <td align="right" class="label">Call Sign:</td>
            <td><?php $row=mysql_fetch_array($result);
             echo $row['callsign']; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Service Type:</td>
            <td>
              <?php 
             echo $row['servicetype']; ?>           </td>
          </tr>
          <tr>
            <td align="right" class="label">Client:</td>
            <td><?php
             $client_array = getRowAsArray("SELECT name FROM clients WHERE id='".$row['client']."'");
			 echo $client_array['name'];
			
			 ?></td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Start Date :</td>
            <td>
              <?php
             echo changeMySQLDateToPageFormat($row['startdate']);?>            </td>
          </tr>
          <tr>
            <td align="right" class="label">End Date: </td>
            <td><?php
             echo changeMySQLDateToPageFormat($row['enddate']);?></td>
          </tr>
          
          <tr>
            <td align="right" class="label">Assigned Guards :</td>
            <td>
			<?php
             echo $row['assignedguard'];?></td>
          </tr>
          <tr>
            <td align="right" class="label">Start Time: </td>
            <td>
              <?php
             echo $row['starttime'];?>  </td>
          </tr>
          <tr>
            <td align="right" class="label">End Time: </td>
            <td>
              <?php
             echo $row['endtime'];?></td>
          </tr>
          
          <tr>
            <td align="right" class="label">Exception:</td>
            <td>
              <?php
             echo $row['exception'];?> </td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><span class="label">
              <input type="button" name="newuser" value="Create New Assignment" onClick="javascript:document.location.href='../core/assignment.php'">
              <input type="button" name="edituser" value="Edit Assignment" onClick="javascript:document.location.href='../core/assignment.php?id=<?php echo $_GET['id']; ?>&action=edit'">
            </span></td>
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
