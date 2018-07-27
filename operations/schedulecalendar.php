<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Schedule Calendar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link rel='stylesheet' type='text/css' href='../calendar/calendar_style.css' />
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script language="JavaScript" type="text/javascript" src="../calendar/calendar.js"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0" onLoad="navigate('','','../','schedule')">
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
        <td class="headings"> Schedule Calendar  &gt; <a href="../operations/">Weekly Schedule</a> | <a href="schedule.php"> Today's Schedule</a> </td>
      </tr>
      <tr>
        <td><form action="index.php" method="post" name="guardschedule" id="guardschedule"><table width="100%" border="0">
          
          <tr>
            <td align="center" class="redtext"><?php if(isset($_GET['msg']) && $_GET['msg'] != ""){ echo $_GET['msg'];}?></td>
            </tr>
			
          <tr>
            <td valign="top"><b>Instructions:</b><br>
              1. Click on the date under monthly view to view the schedule for that date.<br>
              2. Select weekly view to view the 6X1 schedules for the current month. </td>
            </tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr><td><div id="calback">
		<div id="calendar"></div>
	</div></td></tr>
			<tr><td>&nbsp;
			</td>
			</tr>
        </table>
        </form></td>
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