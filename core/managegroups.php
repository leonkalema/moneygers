<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchgroup'] = $_GET['v'];
	$searchvalue = $_SESSION['searchgroup'];
	$where = "WHERE name LIKE '%".$searchvalue ."%'";
	
} else { $where = "";}


$query = "SELECT * FROM groups ".$where." ORDER BY name ";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Groups</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>

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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage Groups </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
          

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		  <?php if(userHasRight($_SESSION['userid'], "59")){?>
            <td><span class="label">
              <input type="button" name="newgroup" value="Create New Group" onClick="javascript:document.location.href='../core/group.php'">
            </span></td>
			<?php } ?>	
            </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td><div id="searchtable">
              <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For a Group:</td>
                  <td><input name="searchgroup" id="searchgroup" type="text" size="30" value="<?php if(isset($_SESSION['searchgroup'])){ echo $_SESSION['searchgroup'];}?>"></td>
                  <td><input type="button" name="Button" value="Search Groups" onClick="pickFormItemAndDirect('searchgroup', '../core/managegroups.php?v=', 'Please enter all or part of the group name')"></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no groups to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:740px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			   <?php if(userHasRight($_SESSION['userid'], "61")){?>
                <td width="5%">Edit</td>
                <?php } ?>	
				<?php if(userHasRight($_SESSION['userid'], "62")){?>
                <td width="7%">Delete</td>
                <?php } ?>	
                <td width="20%">Group Name</td>
                <td width="39%">User Rights </td>
                <td width="17%">Description</td>
                <td width="12%">No of Users </td>
              </tr>
			  <?php
			  $i = 0;
			  $result = mysql_query($query);
			  while($thegroup = mysql_fetch_array($result, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php if(userHasRight($_SESSION['userid'], "61")){?>
                <td valign="top"><a href="../core/group.php?action=edit&id=<?php echo encryptValue($thegroup['id']); ?>" class="normaltxtlink" title="Modify group details and rights.">Edit</a></td><?php } ?>	
				<?php if(userHasRight($_SESSION['userid'], "61")){?>
                <td valign="top"><a href="#" onClick="javascript:deleteEntity('../core/deletegroup.php?id=<?php echo $thegroup['id']; ?>', 'group', '<?php echo $thegroup['name']; ?>')" class="normaltxtlink" title="Delete this group.">Delete</a></td><?php } ?>	
                <td valign="top"><?php if(userHasRight($_SESSION['userid'], "63")){?> <a href="../core/viewgroup.php?id=<?php echo encryptValue($thegroup['id']); ?>" class="normaltxtlink" title="View group details and rights."><?php echo $thegroup['name']; ?></a> <?php } else echo $thegroup['name']; ?>		</td>
                <td valign="top"><div style="padding:3px;width:220px;height:80px;overflow: auto;">
				<?php 
				if(trim($thegroup['rights']) != ""){
				$rights=$thegroup['rights'];
				$right=explode(',',$rights);
				for($x=0;$x<count($right);$x++){
					$rows=getRowAsArray("select * from rights where id='".$right[$x]."'") ;
					echo "<img src='../images/bullet1.gif' width='5' height='11'>"."&nbsp;&nbsp;".$rows['rightname']."<br />";
			
				} 
				}?></div></td>
                <td valign="top"><?php echo $thegroup['description']; ?></td>
                <td valign="top">
				<?php $number = howManyRows("SELECT id FROM users WHERE usergroup ='".$thegroup['id']."'");
				if($number > 0){
					echo $number;
					if(userHasRight($_SESSION['userid'], "51")){?> <a href="../core/manageusers.php?a=search&groupid=<?php echo encryptValue($thegroup['id']);?>" class='normaltxtlink'>View All</a> <?php } 	
				} else {
					echo $number;
				}
					
				?>
				
				&nbsp;</td>
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