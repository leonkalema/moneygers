<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();

if(isset($_SESSION['formvalues'])){
	$formvalues = $_SESSION['formvalues'];
}
//Page shows the appropriate fields for each report
?>
<link href="../styles/ultimatesecurity.css" rel="stylesheet" type="text/css" />
<table border="0" cellspacing="0" cellpadding="2" width="100%">
  <?php 
  //****************************************************************************************
  // Client Invoice fields
  //****************************************************************************************
  
  if($_GET['area'] == "Client Invoice" || $_GET['area'] == "Ledger Report" || $_GET['area'] == "Guard Payroll"){
    
	// Do not show client field if generating guard payroll
	if($_GET['area'] == "Client Invoice"){?>
  <tr>
    <td align="right" class="label">Client: </td>
    <td><input type="text" name="clientname" id="clientname" value="<?php echo $formvalues['clientname'];?>"/>
    <br />
&nbsp;<img src="../images/bullet.gif" />&nbsp;<a href="#" onclick="setDiv('../include/resultsforpage.php?area=return_clientname&value=','show_clients','clientname','Searching...'); return false; ">Search Client</a><br />
<div id="show_clients" style="height:0px; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;"></div></td>
  </tr>
 <?php }?>
  <tr>
    <td align="right" class="label" nowrap>Start Date:</td>
    <td>
       Day:<br />
      <select id="start_day" name="start_day">
        <?php 
if(isset($formvalues['startdate']) && $formvalues['startdate'] != ""){
 	$date = date("d", strtotime($formvalues['startdate']));
 } else {
 	$date = date("d", strtotime("now"));
 }
echo generateSelectOptions(getTime('day',''), $date);?>
      </select>
      <br />
      <br />
      Month:<br />
      <select id="start_month" name="start_month">
        <?php 
 if(isset($formvalues['startdate']) && $formvalues['startdate'] != ""){
 	$date = date("F", strtotime($formvalues['startdate']));
 } else {
 	$date = date("F", strtotime("now"));
 }
 echo generateSelectOptions(getTime('month',''), $date);?>
      </select>
      <br />
      <br />
      Year:<br />
      <select id="start_year" name="start_year">
  <?php 
 if(isset($formvalues['startdate']) && $formvalues['startdate'] != ""){
 	$date = date("Y", strtotime($formvalues['startdate']));
 } else {
 	$date = date("Y", strtotime("now"));
 }
 echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
  </tr>
  <tr>
    <td width="24%" align="right" class="label" nowrap>End Date: </td>
    <td width="76%">Day:<br />
      <select id="end_day" name="end_day">
        <?php 
if(isset($formvalues['enddate']) && $formvalues['enddate'] != ""){
 	$date = date("d", strtotime($formvalues['enddate']));
 } else {
 	$date = date("d", strtotime("now"));
 }
echo generateSelectOptions(getTime('day',''), $date);?>
      </select>
      <br />
      <br />
Month:<br />
<select id="end_month" name="end_month">
  <?php 
 if(isset($formvalues['enddate']) && $formvalues['enddate'] != ""){
 	$date = date("F", strtotime($formvalues['enddate']));
 } else {
 	$date = date("F", strtotime("now"));
 }
 echo generateSelectOptions(getTime('month',''), $date);?>
</select>
<br />
<br />
Year:<br />
<select id="end_year" name="end_year">
  <?php 
 if(isset($formvalues['enddate']) && $formvalues['enddate'] != ""){
 	$date = date("Y", strtotime($formvalues['enddate']));
 } else {
 	$date = date("Y", strtotime("now"));
 }
 echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
  </tr>
  
  <?php }  
  //****************************************************************************************
  // Control shift fields
  //****************************************************************************************
  if($_GET['area'] == "Control Shift"){ ?>
  
  <tr>
    <td align="right" class="label">Date:</td>
    <td>
       Day:<br />
      <select id="day" name="day">
        <?php 
if(isset($shiftdate) && $shiftdate != "0000-00-00 00:00:00"){
 	$date = date("d", strtotime($shiftdate));
 } else {
 	$date = date("d", strtotime("now"));
 }
echo generateSelectOptions(getTime('day',''), $date);?>
      </select>
      <br />
      <br />
      Month:<br />
      <select id="month" name="month">
        <?php 
 if(isset($shiftdate) && $shiftdate != "0000-00-00 00:00:00"){
 	$date = date("F", strtotime($shiftdate));
 } else {
 	$date = date("F", strtotime("now"));
 }
 echo generateSelectOptions(getTime('month',''), $date);?>
      </select>
      <br />
      <br />
      Year:<br />
      <select id="year" name="year">
  <?php 
 if(isset($shiftdate) && $shiftdate != "0000-00-00 00:00:00"){
 	$date = date("Y", strtotime($shiftdate));
 } else {
 	$date = date("Y", strtotime("now"));
 }
 echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
  </tr>
  <tr>
    <td width="24%" align="right" class="label">From: </td>
    <td width="76%">
      <select id="timefrom" name="timefrom">
        <?php 
	  echo generateSelectOptions(getAllTime(), $formvalues['timefrom']);?>
      </select>   </td>
  </tr>
  <tr>
    <td align="right" class="label">To:</td>
    <td>
      <select id="timeto" name="timeto">
        <?php 
	  echo generateSelectOptions(getAllTime(), $formvalues['timeto']);?>
      </select>    </td>
  </tr>
  <?php } ?>
  
  <?php
  // Do not show client field if generating guard payroll
	if($_GET['area'] == "Item Location"){?>
  <tr>
    <td align="right" class="label" nowrap>Item Type: </td>
    <td><select name="itemtype" id="itemtype">
                        <?php 
						if(isset($_GET['type'])){
							$type = $_GET['type'];
						} else {
							$type = "";
						}
						echo generateSelectOptions(getAllEquipmentTypes(), $type);?>
                      </select></td>
  </tr>
 <?php }?>
</table>

