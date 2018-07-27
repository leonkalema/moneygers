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
//$id = $_GET['id'];
if($action == 'edit') {
	$personnel->get($id);
}

	//$id=$_GET['id'];

	if(isset($_GET['id'])){
	$q=mysql_query("SELECT * from personnel where id='$id'");
	
	while($row=mysql_fetch_array($q)){
	$name=$row[guard];
	$type=$row[type];
	$notes=$row[notes];
	$action=$row[actiontaken];
	$date=$row['date'];
	}
}




?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Personnel File Status            <?php } else {?>           Create Personnel File Status          <?php } ?></title>
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
        <td class="headings"><a href="managepersonnel.php">Manage Personnel </a>&gt; <?php if($action == 'edit') {?>
          Edit Personnel File Status
            <?php } else {?>
            Create Personnel File Status
          <?php } ?> </td>
      </tr>
      <tr>
        <td><form action="processpersonnel.php" method="post" name="personnel" id="personnel" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the guard.');"><table width="100%" border="0">
          <tr>
            <td width="31%" align="right"><font class="redtext">*</font> is a required field </td>
            <td colspan="3"><?php if(isset($_GET['msg']) && $_GET['msg'] != ""){ echo $_GET['msg'];}?></td>
          </tr>
		
          <tr>
            <td height="24" align="right" class="label2">Guard:<font class="redtext">*</font></td>
            <td colspan="2"><input type="text" name="name" id="name" value="<?php echo $name; ?>">              &nbsp;&nbsp;<img src="../images/bullet.gif" width="5" height="11"> <a href="#" onClick="setDiv('../include/searchforpage.php?area=personnel&value=','personnel_search','name','Searching...'); return false; ">Check Availability</a><a href="#" onClick="setDiv('../include/searchforpage.php?area=personnel&value=','personnel_search','name','Searching...'); return false; "></a></td>
            <td width="30%"><div id="personnel_search" style="width:150; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
          </tr>
          <tr>
            <td height="19" align="right" valign="top" class="label">Type:</td>
            <td colspan="3"><select name="type">
			
			<?php  
			if($type==""){
			echo "<option>Discipline</option>
            <option>Indiscipline</option>";
			}
			else if($type=='Discipline') 
			{
			
			echo "<option>Discipline</option>
            <option>Indiscipline</option>";
			} else {
			 
			 echo "<option>Indiscipline</option>
            <option>Discipline</option>";
			 } ?>
            </select></td>
          </tr>
          <tr>
            <td height="38" align="right" valign="top" class="label">Notes</td>
            <td colspan="3">
			<textarea name="notes" id="notes"><?php echo $notes; ?></textarea></td>
          </tr>
          <tr>
            <td height="3" rowspan="2" align="right" valign="top" class="label">Action Taken: </td>
            <td width="7%">
			<div id="action_show">
			
			<select name="action">
		
		<?php
		$q=mysql_query("select name from actions ");
		while($row=mysql_fetch_array($q)){
		echo "<option>". $row['name']."</option>";
		}
		?>
            </select> </div></td>
            <td width="32%">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=actions','action_add','','Loading...'); return false;">Add Action</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=actions','action_show','','Loading...'); return false;">Refresh List </a></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><div id="action_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px"></div></td>
            </tr>
          <tr>
            <td height="43" align="right" valign="top" class="label">Date:<font class="redtext">*</font></td>
            <td colspan="3"><span class="label">Day:
              <select id="day" name="day">
                    <?php echo generateSelectOptions(getTime('day',''),  date("d", strtotime($guarddetails['persondetails']['dateofbirth'])));?>
              </select> 
              <span class="label">Month:
<select id="month" name="month">
  <?php echo generateSelectOptions(getTime('month',''), date("F", strtotime($guarddetails['persondetails']['dateofbirth'])));?>
</select>

              
			  
			  
			  <span class="label">              &nbsp;Year:
<select id="year" name="year">
  <?php echo generateSelectOptions(getTime('year','bd'), date("Y", strtotime($guarddetails['persondetails']['dateofbirth'])));?>
</select></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
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