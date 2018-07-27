<?php
require_once '../include/commonfunctions.php';
session_start();
openDatabaseConnection();


if($_GET['v']=="a"){
$query = "SELECT * FROM audittrail ORDER BY time_Visited DESC";
}else if ($_POST){
$startDate = $_POST['startDate']." ".$_POST['startTime'].":00";
$endDate = $_POST['endDate']." ".$_POST['endTime'].":00";

if($_POST['user']=="Any User"){
	$user = "";
	}else{
	$user = $_POST['user'];
	}
if($user==""){
$query = "SELECT * FROM audittrail WHERE time_Visited BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY time_Visited DESC";
}else{
$query = "SELECT * FROM audittrail WHERE time_Visited BETWEEN '".$startDate."' AND '".$endDate."' and userEmail = '".$user."' ORDER BY time_Visited DESC";
}
}

if(isset($query)&&$query!=""){
$result = mysql_query($query) or die("Invalid Query ".mysql_error()."<br>Error No: ".mysql_errno());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SmartGuard for Ultimate SEcurity: Audit Trail</title>
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../Styles/datePicker.css" />
<script language="javascript" type="text/javascript" src="../javascript/datePicker.js"></script>
<script language="javascript" type="text/javascript" src="../javascript/smartguard.js"></script>
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="contenttableborder">
 <tr>
 	<td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" background="../images/headerbg.gif">
        <tr> 
          <td width="216" align="left" valign="top"><img src="../images/logo.gif" width="211" height="56"></td>
          <td width="532" align="right" valign="middle"><a href="../core/dashboard.php" class="headertxt" title="Go to Dashboard.">Dashboard</a><span class="headertxt"> 
            | </span><a href="../settings/settings.php" class="headertxt" title="Click here to go to settings.">Settings</a><a href="#" class="headertxt"></a><span class="headertxt"> 
            | </span><a href="../core/logout.php" class="headertxt" title="Click here to logout.">Logout</a><span class="headertxt"> 
            | </span><a href="../help/index.php" class="headertxt" title="Click here to view the help section.">Help</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
</table></td>
 </tr>
  <tr>
    <td>
	<form action="index.php" method="post" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td colspan="11">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="11" align="center" class="headings">SmartGuard Audit Trail </td>
  </tr>
  <tr>
    <td colspan="11" align="center" class="headings">View Who Did What and When on SmartGuard </td>
  </tr>
  <tr>
    <td width="66">BETWEEN</td>
    <td width="172"><input name="startDate" type="text" class="label" id="startDate" title="Click here  to chose Start date" onClick="displayDatePicker('startDate', this);" value="Click to Choose Date" readonly="true" /></td>
    <td width="3">&nbsp;</td>
    <td width="67">TIME</td>
    <td width="50"><select name="startTime" title="Chose the Audit Start Time">
	<?php for($i=0;$i<=23;$i++){
	echo "<option>";
	if($i>9){
	echo $i;
	}else{
	echo "0".$i;
	}
	echo ":00</option>";
	
	} ?>
    </select>    </td>
    <td width="65">AND</td>
    <td width="172"><input type="text" name="endDate" id="endDate" value="Click to Choose Date" onClick="displayDatePicker('endDate', this);" readonly="true" class="label" title="Click to chose End Date" /></td>
    <td width="3">&nbsp;</td>
    <td width="34">TIME</td>
    <td width="50"><select name="endTime" title="Chose the Audit End time">
	<?php for($i=0;$i<=23;$i++){
	echo "<option>";
	if($i>9){
	echo $i;
	}else{
	echo "0".$i;
	}
	echo ":00</option>";
	
	} ?>
    </select></td>
    <td width="10">&nbsp;</td>
  </tr>
  <tr>
    <td>USER</td>
    <td><input name="username" type="text" class="label" id="username" title="Enter User's username" onclick="this.value=''" value="Any User" /></td>
    <td>&nbsp;</td>
    <td><input name="image" type="submit" class="disabledfield" title="Search the Trail" onclick="checkEmptyTime('startDate','Click to Choose Date','Please Chose Audit Start Time'); checkEmptyTime('endDate','Click to Choose Date','Please Chose Audit End Time')" value="Submit" /></td>
    <td>&nbsp;</td>
    <td><input name="Reset" type="reset" class="disabledfield" value="Cancel" title="Reset the Form" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="10" headers="1"></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="6" align="center"><a href="?v=a" class="links">View All</a> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
</form>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
			<tr class="tabheadings">
				<td width="7%" align="center" valign="middle">User</td>
				<td width="16%" align="left" valign="middle" nowrap="nowrap">Station (IP)</td>
				<td width="53%" align="left" valign="middle">Page Visited </td>
				<td width="24%" align="center" valign="middle">Time of Visit </td>
		    </tr>
	  </table>
	</td>
  </tr>
	  
  <tr>
    <td>
	<div style="padding:4px; width:auto;height:400px;overflow: auto">
	<table width="90%" border="0" align="left" cellpadding="2" cellspacing="1">
  
  <?php 
  if(isset($result)&&$result!=""){
  $x=1;
  while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
  if($x%2==0){
  	$rowclass = "evenrow";
  }else{
  	$rowclass = "oddrow";
  }
   ?>
  
  <tr class="<?php echo $rowclass; ?>">
    <td width="11%" nowrap="nowrap"><?php echo $row['username']; ?></td>
    <td width="22%" align="left" nowrap="nowrap"><?php echo $row['workStation']; ?></td>
    <td width="35%"><a href="<?php echo $row['page_Visited']; ?>" class="bodylink" target="_blank"><?php echo $row['page_Visited']; ?></a></td>
    <td width="24%" nowrap="nowrap"><?php echo $row['time_Visited']; ?></td>
  </tr>
  <tr>
  <?php $x++;
  	 } 
 }?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
	</div>	</td>
  </tr>
</table>
<div style="visibility: hidden; position: absolute; left: 265px; top: 269px; display: none; z-index: 10000;" class="dpDiv" id="datepicker"><table class="dpTable" cols="7">
<tbody><tr class="dpTitleTR"><td class="dpButtonTD"><button class="dpButton" onclick='refreshDatePicker("AnotherDate", 2007, 11);'>&lt;</button></td>
<td colspan="5" class="dpTitleTD"><div class="dpTitleText">January 2008</div></td>
<td class="dpButtonTD"><button class="dpButton" onclick='refreshDatePicker("AnotherDate", 2008, 1);'>&gt;</button></td>
</tr>
<tr class="dpDayTR"><td class="dpDayTD">Su</td>
<td class="dpDayTD">Mo</td>
<td class="dpDayTD">Tu</td>
<td class="dpDayTD">We</td>
<td class="dpDayTD">Th</td>
<td class="dpDayTD">Fr</td>
<td class="dpDayTD">Sa</td>
</tr>
<tr class="dpTR"><td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' &nbsp;=""></td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' &nbsp;=""></td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/01/2008');">1</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/02/2008');">2</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/03/2008');">3</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/04/2008');">4</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/05/2008');">5</td>
</tr>
<tr class="dpTR"><td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/06/2008');">6</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/07/2008');">7</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/08/2008');">8</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/09/2008');">9</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/10/2008');">10</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/11/2008');">11</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/12/2008');">12</td>
</tr>
<tr class="dpTR"><td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/13/2008');">13</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/14/2008');">14</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/15/2008');">15</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/16/2008');">16</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/17/2008');">17</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/18/2008');">18</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/19/2008');">19</td>
</tr>
<tr class="dpTR"><td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/20/2008');">20</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/21/2008');">21</td>
<td class="dpDayHighlightTD" onmouseout='this.className="dpDayHighlightTD";' onmouseover='this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/22/2008');"><div class="dpDayHighlight">22</div></td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/23/2008');">23</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/24/2008');">24</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/25/2008');">25</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/26/2008');">26</td>
</tr>
<tr class="dpTR"><td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/27/2008');">27</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/28/2008');">28</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/29/2008');">29</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/30/2008');">30</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' onClick="updateDateField('AnotherDate', '01/31/2008');">31</td>
<td class="dpTD" onmouseout='this.className="dpTD";' onmouseover=' this.className="dpTDHover";' &nbsp;=""></td>
</tr>
<tr class="dpTodayButtonTR"><td colspan="7" class="dpTodayButtonTD"><button class="dpTodayButton" onclick='refreshDatePicker("AnotherDate");'>this month</button> <button class="dpTodayButton" onclick='updateDateField("AnotherDate");'>close</button></td>
</tr>
</tbody></table>
</div><iframe style="position: absolute; width: 0pt; height: 0pt; top: 269px; left: 265px; z-index: 9999; visibility: hidden; display: none;" src="javascript:false;" id="datepickeriframe" frameborder="0" scrolling="no"></iframe>
</body>
</html>
