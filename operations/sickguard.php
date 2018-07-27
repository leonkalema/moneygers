<?php
include_once "../class/class.personnelfile.php";
include_once "../include/searchforpage.php";
include_once "../include/commonfunctions.php"; 
session_start();

openDatabaseConnection();

if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['action'];
}

$personnel = new Personnel;
$action = $_GET['action'];
$id = decryptValue($_GET['id']);
if($action == 'edit') {
	$personnel->get($id);
}

	//$id=$_GET['id'];

	if(isset($_GET['id'])){
		$guard = getRowAsArray("SELECT * FROM sickguard WHERE id = '".$_GET['id']."'");
	}




?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Sick Guard Details            <?php } else {?>           Register Sick Guard          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
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
        <td class="headings"><a href="managesickguards.php">Manage Sick Guards</a> &gt; <?php if($action == 'edit') {?>
          Edit Sick Guard Details 
            <?php } else {?>
            Register Sick Guard
          <?php } ?> </td>
      </tr>
      <tr>
        <td><form action="process_sickguard.php" method="post" name="sickguard" id="sickguard" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the guard.');"><table width="100%" border="0">
          <tr>
            <td width="31%" align="right"><font class="redtext">*</font> is a required field </td>
            <td colspan="3" class="redtext"><?php if(isset($_GET['msg']) && $_GET['msg'] != ""){ echo $_GET['msg'];}?></td>
          </tr>
		
          <tr>
            <td height="24" align="right" class="label2">Guard:<font class="redtext">*</font></td>
            <td colspan="2"><input type="text" name="name" id="name" value="<?php echo $guard['guard']; ?>">              
            &nbsp;&nbsp;<img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','sickguard_search','name','Searching...'); return false; ">Search Guards </a><a href="#" onClick="setDiv('../include/searchforpage.php?area=sickguard&value=','sickguard_search','name','Searching...'); return false; "></a></td>
            <td width="30%"><div id="sickguard_search" style="width:200; height:40; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
          </tr>
          <tr>
            <td height="29" align="right" valign="top" class="label">Illness: </td>
            <td width="7%">
			<div id="illness_show">
			
			<select name="illness" id="illness">
		
		<?php
		$q=mysql_query("select name from illness ");
		while($row=mysql_fetch_array($q)){
		echo "<option";
		if($guard['illness'] == $row['name']){
			echo " selected";
		}
		echo ">". $row['name']."</option>";
		}
		?>
            </select> </div></td>
            <td width="32%">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=illness','illness_add','','Loading...'); return false;">Add Illness</a>  | <a href="#" onClick="setDiv('../include/showlist.php?area=illness','illness_show','','Loading...'); return false;">Refresh List </a></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="-1" align="right" valign="top" class="label">&nbsp;</td>
            <td colspan="3"><div id="illness_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px"></div></td>
            </tr>
          <tr>
            <td height="36" align="right" valign="top" class="label">Notes: </td>
            <td colspan="3"><textarea name="notes" id="notes"><?php echo $guard['notes']; ?></textarea></td>
          </tr>
          
          <tr>
            <td height="31" align="right" valign="top" class="label">Date When Sickness Started:<font class="redtext">*</font></td>
            <td colspan="3">Day:
              <select id="day" name="day">
                    <?php 
					if(isset($guard['date_started']) && $guard['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($guard['date_started']));
						} else { 
							$date =  "";
						}
					echo generateSelectOptions(getTime('day',''), $date);?>
              </select> 
              Month:
<select id="month" name="month">
  <?php 
  if(isset($guard['date_started']) && $guard['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($guard['date_started']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>

              
			  
			  
			   &nbsp;Year:
<select id="year" name="year">
  <?php 
  if(isset($guard['date_started']) && $guard['date_started'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($guard['date_started']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select></td>
          </tr>
          <tr>
            <td height="38" align="right" valign="top" class="label">Expected Date of Recovery:<font class="redtext">*</font></td>
            <td colspan="3">Day:
              <select id="day1" name="day1">
                  <?php 
				  if(isset($guard['date_recovery']) && $guard['date_recovery'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($guard['date_recovery']));
						} else { 
							$date =  "";
						}
				  echo generateSelectOptions(getTime('day',''),  $date);?>
                </select>
                Month:
              <select id="month1" name="month1">
                  <?php 
				  if(isset($guard['date_recovery']) && $guard['date_recovery'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($guard['date_recovery']));
						} else { 
							$date =  "";
						}
				  echo generateSelectOptions(getTime('month',''), $date);?>
                </select>
                 &nbsp;Year:
              <select id="year1" name="year1">
                  <?php 
				  if(isset($guard['date_recovery']) && $guard['date_recovery'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($guard['date_recovery']));
						} else { 
							$date =  "";
						}
				  echo generateSelectOptions(getTime('year','na'), $date);?>
              </select></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Register">
              <input type="hidden" name="id" id="id" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>">
              <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo "YES";
			  } ?>"></td>
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