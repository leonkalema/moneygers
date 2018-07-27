<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
$query="SELECT * FROM incidents where id='".$_GET['id']."'";
$result=mysql_query($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Incident</title>
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
        <td class="headings">View Incident </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td></td>
          </tr>
		
          <tr>
            <td align="right" class="label">Reference Number :</td>
            <td><?php $row=mysql_fetch_array($result);
             echo $row['refno']; ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Assignment:</td>
            <td>
              <?php
             echo $row['assignment']; ?>            </td>
          </tr>
          <tr>
            <td align="right" class="label">Date:</td>
            <td><?php
             echo changeMySQLDateToPageFormat($row['date']);?></td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Guard(s) Responsible:</td>
            <td>
              <?php
             echo $row['guardresponsible'];?>            </td>
          </tr>
          <tr>
            <td align="right" class="label">Details: </td>
            <td><?php
             echo $row['details'];?></td>
          </tr>
          
          <tr>
            <td align="right" class="label">Reported By :</td>
            <td>
			<?php
             echo $row['reportedby'];?> &nbsp;&nbsp;&nbsp;&nbsp; <font class="label">Time:</font> <?php echo $row['timereported'];?> </td> 
          </tr>
          <tr>
            <td align="right" class="label">Checked By : </td> 
            <td>
              <?php
             echo $row['checkedby'];?> &nbsp;&nbsp;&nbsp;&nbsp; <font class="label">Time:</font> <?php echo $row['timechecked'];?> </td>
          </tr>
          <tr>
            <td align="right" class="label">Action Taken : </td>
            <td>
              <?php
             echo $row['actiontaken'];?>&nbsp;&nbsp;&nbsp;&nbsp; <font class="label"> Time:</font> <?php echo $row['timeactiontaken'];?></td>
          </tr>
          <tr>
            <td align="right" class="label"><input type="button" name="returntolist" value="Manage Incidents" onClick="javascript:document.location.href='../core/manageincidents.php'"></td>
            <td><span class="label">
              <input type="button" name="newincident" value="Create New Incident" onClick="javascript:document.location.href='../core/incident.php'">
              <input type="button" name="editincident" value="Edit Incident" onClick="javascript:document.location.href='../core/incident.php?id=<?php echo $_GET['id']; ?>&action=edit'">
            </span></td>
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
