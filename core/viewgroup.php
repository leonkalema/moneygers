<?php
include_once "../class/class.group.php";
session_start();
$group = new Group;
//pick up the  value of the id from the form
$id=decryptValue($_GET['id']);
$group->get($id);
if(isset($_GET[id])){
	$result=mysql_query("select * from groups where id='$id'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Group</title>
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
        <td class="headings"><a href="managegroups.php">Manage Groups</a> &gt; View Group</td>
      </tr>
      <tr>
        <td>
		<table width="100%" border="0">
          <tr>
            <td align="right" class="label">Name: </td>
            <td>
              <?php echo $group->getName(); ?>            </td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Description:</td>
            <td><?php echo "<div style=\"width:150px\">".$group->getDescription()."</div>"; ?></td>
          </tr>
          
		  <tr>
            <td align="right" class="label" width="1%">User Rights: </td>
            <td><div style="padding:4px;width:600px;height:400px;overflow: auto">
              <?php 
			 $result=mysql_query("select * from groups where id='$id'");
			 $row=mysql_fetch_array($result);
			 $rights=$row['rights'];
			 $right=explode(',',$rights);
			 
			 
			 for($x=0;$x<count($right);$x++)
					{
			$res=mysql_query("select * from rights where id='".$right[$x]."'") ;
			
			while($rows=mysql_fetch_array($res))
			{
			echo "<img src='../images/bullet.gif' width='5' height='11'>"."&nbsp;&nbsp;".$rows['rightname']."<br />";
			}
			
		}   
		?> 
		 </div></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
