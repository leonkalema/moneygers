<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['action']) && $_GET['action'] == "delete"){
	mysql_query("DELETE FROM rights WHERE id = '".$_GET['id']."'");
	
	//Remove the deleted right from any of the groups
	$groupresult = mysql_query("SELECT * FROM groups");
	while($row = mysql_fetch_array($groupresult,MYSQL_ASSOC)){
		$oldrights = explode(',',$row['rights']);
		$newrights = array();
		if(in_array($_GET['id'],$oldrights)){
			//Remove the id
			for($i=0;$i<count($oldrights);$i++){
				if($oldrights[$i] != $_GET['id']){
					array_push($newrights,$oldrights[$i]);
				}
			}
			//Update the table row of the group
			mysql_query("UPDATE groups SET rights = '".implode(",",$newrights)."' WHERE id = '".$row['id']."'");
		}
	}
}
// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$serachvalue=trim($_GET['v']);
	$where = "WHERE rightname LIKE '%".$serachvalue."%' ";
	$_SESSION['searchright'] = $_GET['v'];
} else { $where = "";}

$query = "SELECT id, rightname FROM rights ".$where." ORDER BY rightname";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage User Rights</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage User Rights </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
		   <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For User Rights:</td>
                  <td><input name="searchright" id="searchright" type="text" size="30" value="<?php if(isset($_SESSION['searchright'])){ echo $_SESSION['searchright'];}?>"></td>
                  <td><input type="button" name="Button" value="Search User Rights" onClick="pickFormItemAndDirect('searchright', '../core/managerights.php?v=', 'Please enter some text about the user right')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no user rights to display.</td></tr>";
		   	} else { 
			?>
          <tr>
            <td>
			<div style="padding:4px;width:720px;height:350px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
                <td width="1%">Edit</td>
                <td width="1%">Delete</td>
                <td width="98%">User Right</td>
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
                <td><a href="../core/addright.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify rights information.">Edit</a></td>
                <td><a href="#" onClick="javascript:deleteEntity('../core/managerights.php?id=<?php echo $line['id']; ?>&action=delete', 'user right', '<?php echo $line['rightname']; ?>')" class="normaltxtlink" title="Delete this right.">Delete</a></td>
                
                <td><?php echo $line['rightname']; ?></td>
              </tr>
			  <?php 
			  	$i++;
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
