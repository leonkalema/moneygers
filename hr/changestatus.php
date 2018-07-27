<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$id = decryptValue($_GET['id']);
//Set edit mode for the leave
if(isset($_GET['id']) || isset($_GET['t'])){
	if(isset($_GET['id']) && $_GET['id'] != ""){ $_SESSION['statusid'] = $_GET['id'];
		$formvalues = getRowAsArray("SELECT * FROM guardstatustrack WHERE id='$id'");
	}
	if(isset($_GET['t']) && $_GET['t'] != ""){ $_SESSION['type'] = $_GET['t'];}
	if(isset($_GET['gid']) && $_GET['gid'] != ""){ 
		$gid=decryptValue($_GET['gid']);
		$_SESSION['guardid'] = $gid;
	}
	if(isset($_GET['a']) && $_GET['a'] != ""){ $action = $_GET['a'];}
}

$data = getRowAsArray("SELECT g.id, g.guardid, p.firstname, p.lastname, p.othernames FROM guards g, persons p WHERE g.personid = p.id AND g.guardid='".$_SESSION['guardid']."'");
$_SESSION['guardid'] = $data['guardid'];

$guardname = $data['firstname']." ".$data['lastname']." ".$data['othernames'];

if(isset($_SESSION['formvalues']) && isset($_SESSION['errors']) && $_SESSION['errors'] != ""){
	$formvalues = $_SESSION['formvalues'];
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Change Status of <?php echo $guardname;?> From <?php echo $_SESSION['type'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
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
      <tr> <?php if(userHasRight($_SESSION['userid'], "32")){?>
        <td class="headings"><a href="../hr/manageguards.php">Manage Guards</a> &gt; Change Status For <?php echo $guardname;?> [<?php echo $_SESSION['type'];?> ] </td> <?php } ?>
      </tr>
      <tr>
        <td><form action="processstatus.php" method="post" name="status" id="status" onSubmit="return <?php if($_SESSION['type'] == "Sick"){ ?>isNotNullOrEmptyString('illness', 'Please select the illness.') && <?php } else if($_SESSION['type'] == "Sick"){ ?>isNotNullOrEmptyString('illness', 'Please select the illness.') && <?php } ?>isNotNullOrEmptyString('start_day', 'Please select the start day.') && isNotNullOrEmptyString('start_month', 'Please select the start month.') && isNotNullOrEmptyString('start_year', 'Please select the start year.') && isNotNullOrEmptyString('reported_by', 'Please enter the ID of the guard who reported this.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
		<?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){ ?>
		<tr>
            <td height="30" align="right">&nbsp;</td>
            <td colspan="3" class="redtext"><b><?php echo $_SESSION['errors'];
			$_SESSION['errors'] = "";
			?></b></td>
          </tr>
		<?php } ?>
          <tr>
            <td height="30" colspan="4" class="label"><font class="redtext">*</font> is a required field </td>
            </tr>
			<?php if($action != "view"){?>
            <tr>
              <td colspan="4" valign="top" nowrap class="label"><hr></td>
              </tr>
            <tr>
              <td valign="top" nowrap class="label" width="1%">Change Status: </td>
              <td colspan="3"><select name="changestatus" id="changestatus" onChange="pickFormItemAndDirect('changestatus', 'changestatus.php?gid=<?php echo $_SESSION['guardid'];?>&t=', 'Please select a guard status')">
		<option value="">&lt; Select One &gt;</option>
		<?php
		$q=mysql_query("SELECT status FROM guardstatus ");
		while($row=mysql_fetch_array($q)){
		echo "<option value=\"".$row['status']."\"";
		if($_SESSION['type'] == $row['status']){
			echo " selected";
		}
		echo ">". $row['status']."</option>";
		}
		?>
            </select></td>
            </tr>
            <tr>
              <td colspan="4" valign="top" nowrap class="label"><hr></td>
              </tr>
			  <?php }?>
            <tr>
              <td colspan="4" valign="top" nowrap class="label"><?php echo $guardname;?> is &quot;<?php echo strtoupper($_SESSION['type']);?>&quot;:</td>
              </tr>
			
            <tr>
              <td height="24" align="right" class="label2">Guard:</td>
            <td colspan="3"><?php echo $data['guardid']."(".$guardname.")";?>
              <input type="hidden" name="guardid" id="guardid" value="<?php echo $data['guardid'];?>"></td>
            </tr>
          <?php if($_SESSION['type'] == "Sick"){ ?>
		  <tr>
            <td align="right" valign="top" class="label">Illness:<font class="redtext">*</font></td>
            <td width="7%" valign="top"><?php if($action == "view"){
				echo $formvalues['illness'];
			} else {?>
			<div id="illness_show">
			  <select name="illness" id="illness">
                <option value="">&lt; Select One &gt;</option>
                <?php
		$q=mysql_query("select name from illness ");
		while($row=mysql_fetch_array($q)){
		echo "<option value=\"".$row['name']."\"";
		if($formvalues['illness'] == $row['name']){
			echo " selected";
		}
		echo ">". $row['name']."</option>";
		}
		?>
              </select>
			</div><?php } ?></td>
            <td width="32%"><?php if($action == "view"){
				echo "&nbsp;";
			} else {?>&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=illness','illness_add','','Loading...'); return false;">Add Illness</a>  | <a href="#" onClick="setDiv('../include/showlist.php?area=illness','illness_show','','Loading...'); return false;">Refresh List</a> <br>
              <br>
            
              <div id="illness_add" style="width:350; height:0; font-style:normal; color:#000066; font-weight:bolder; font-size:14px"></div><?php } ?></td>
            <td width="30%">&nbsp;</td>
          </tr>
          
          <tr>
            <td height="36" align="right" valign="top" class="label">Notes: </td>
            <td colspan="3"><?php if($action == "view"){  
				echo "<div style=\"width:150px\">".$formvalues['notes']."</div>";
			} else {?><textarea name="notes" id="notes"><?php echo $formvalues['notes']; ?></textarea><?php } ?></td>
          </tr>
          
          <tr>
            <td height="31" align="right" valign="top" class="label" nowrap>Date When <br>Sickness Started:<font class="redtext">*</font></td>
            <td colspan="3" class="label"> <?php if($action == "view"){  
				if($formvalues['date_started'] != "0000-00-00 00:00:00"){
					echo date("d-M-Y",strtotime($formvalues['date_started']));
				}
			} else {?>
              Day:
              <select id="start_day" name="start_day">
                    <?php 
					if(isset($formvalues['date_started']) && $formvalues['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($formvalues['date_started']));
						} else { 
							$date =  "";
						}
					echo generateSelectOptions(getTime('day',''), $date);?>
              </select> 
              Month:
<select id="start_month" name="start_month">
  <?php 
  if(isset($formvalues['date_started']) && $formvalues['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($formvalues['date_started']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>

              
			  
			  
			   &nbsp;Year:
<select id="start_year" name="start_year">
  <?php 
  if(isset($formvalues['date_started']) && $formvalues['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($formvalues['date_started']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } ?></td>
          </tr>
          <tr>
            <td height="38" align="right" valign="top" class="label" nowrap>Expected Date of<br> Recovery:</td>
            <td colspan="3" class="label"><?php if($action == "view"){  
				if($formvalues['date_started'] != "0000-00-00 00:00:00"){
					echo date("d-M-Y",strtotime($formvalues['date_ended']));
				}
			} else {?>
              Day:
              <select id="end_day" name="end_day">
                  <?php 
				  if(isset($formvalues['date_ended']) && $formvalues['date_ended'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($formvalues['date_ended']));
						} else { 
							$date =  "";
						}
				  echo generateSelectOptions(getTime('day',''),  $date);?>
                </select>
                Month:
                <select id="end_month" name="end_month">
                  <?php 
				  if(isset($formvalues['date_ended']) && $formvalues['date_ended'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($formvalues['date_ended']));
						} else { 
							$date =  "";
						}
				  echo generateSelectOptions(getTime('month',''), $date);?>
                </select>
                 &nbsp;Year:
              <select id="end_year" name="end_year">
                  <?php 
				  if(isset($formvalues['date_ended']) && $formvalues['date_ended'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($formvalues['date_ended']));
						} else { 
							$date =  "";
						}
				  echo generateSelectOptions(getTime('year','na'), $date);?>
              </select>
              <?php } ?></td>
          </tr>
		  <?php } else { ?>
		  <tr>
            <td height="31" align="right" valign="top" class="label" nowrap>Start Date:<font class="redtext">*</font></td>
            <td colspan="3" class="label"><?php if($action == "view"){  
				if($formvalues['date_started'] != "0000-00-00 00:00:00"){
					echo date("d-M-Y",strtotime($formvalues['date_started']));
				}
			} else {?>
              Day:
              <select id="start_day" name="start_day">
                    <?php 
					if(isset($formvalues['date_started']) && $formvalues['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($formvalues['date_started']));
						} else { 
							$date =  "";
						}
					echo generateSelectOptions(getTime('day',''), $date);?>
              </select> 
              Month:
<select id="start_month" name="start_month">
  <?php 
  if(isset($formvalues['date_started']) && $formvalues['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($formvalues['date_started']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>

              
			  
			  
			   &nbsp;Year:
<select id="start_year" name="start_year">
  <?php 
  if(isset($formvalues['date_started']) && $formvalues['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($formvalues['date_started']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select>
<?php } ?></td>
          </tr>
		  <tr>
            <td width="1%" height="36" align="right" valign="top" nowrap class="label">Reason / Notes:<font class="redtext">*</font> </td>
            <td colspan="3"><?php if($action == "view"){  
				echo "<div style=\"width:150px\">".$formvalues['notes']."</div>";
			} else {?>
              <textarea name="notes" id="notes"><?php echo $formvalues['notes']; ?></textarea>
              <?php } ?></td>
		  </tr>
		  <?php } 
		  
		  if($_SESSION['type'] != "Not Set"){ ?>
          <tr>
            <td height="31" align="right" valign="top" class="label" nowrap>Reported By:<font class="redtext">*</font></td>
            <td colspan="3"><?php if($action == "view"){  
				echo $formvalues['reported_by'];
			} else {?>
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="28%" valign="top"><input type="text" name="reported_by" id="reported_by" value="<?php echo $formvalues['reported_by'];?>"></td>
                    <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','reported_by','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                    <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                  </tr>
              </table>
              <?php } ?></td>
          </tr>
		  
		  <?php } ?>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <?php if($action != "view"){ ?>
			<input type="submit" name="submit" id="submit" value="Save">
			<?php } ?></td>
          </tr>
        </table>
        </form></td>
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
