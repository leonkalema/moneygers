<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();


// Archiving a guard or viewing archived guards
if(isset($_POST['archive']) || (isset($_GET['a']) && $_GET['a'] == "archive")){
	
	if(isset($_POST)){
		for($i=0;$i<count($_POST['guardid']);$i++){
			$archivequery = "UPDATE guards SET isarchived = 'Y' WHERE id = '".$_POST['guardid'][$i]."'";
			mysql_query($archivequery);
		}
	}
	$query = "SELECT g.id, g.guardid, g.photoname, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived = 'Y'";// ORDER BY  g.datecreated DESC, g.lastupdatedate

// Searching for a guard	
} else if((isset($_GET['a']) && $_GET['a'] == "search") || (isset($_GET['act']) && $_GET['act'] == "search")){
	$_SESSION['searchguard'] = trim($_GET['v']);
	
	//If you are searching for drivers and commanders
	if($_GET['t'] == "drivers") {
		//$_GET['act'] = $_GET['a'];
		if(isset($_GET['type'])){
			$subquery = " AND g.jobtitle=j.id AND (j.jobtitle='DRIVER' OR j.jobtitle='Car Commander') AND g.isarchived='N' ";
		} else {
			$query = "SELECT g.id, g.guardid, g.photoname, g.jobtitle, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g, jobtitles j WHERE p.id = g.personid AND g.jobtitle=j.id AND (j.jobtitle LIKE '%DRIVER%' OR j.jobtitle LIKE '%Car Commander%' OR j.jobtitle LIKE '%QRF%') AND g.isarchived='N'";// ORDER BY g.lastupdatedate, g.datecreated
			$subquery = "";
		}
	}
	
	if($_GET['type'] == "Name"){
		//Search through all the guards and get the relevant results
		$searchvalues = $_SESSION['searchguard'];
		
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		$searchresultsarray = array();
		
		$basequery = "SELECT g.id, g.guardid, g.photoname, g.jobtitle, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g, jobtitles j WHERE p.id = g.personid";
		
		$result = mysql_query($basequery);
		//First search through for a full name
		while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
			$rowname = $row['firstname']." ".$row['lastname']." ".$row['othernames']." ".$row['birthlastname'];
			if(trim($searchvalue) == trim($rowname)){
				array_push($searchresultsarray, $row['id']);
			}
		}
		
				
		$condition = " AND (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%')";// ORDER BY g.lastupdatedate, g.datecreated
		
		$query = $basequery.$subquery.$condition;
		
		$result1 = mysql_query($query);
		//First search through for a full name
		while($row1=mysql_fetch_array($result1, MYSQL_ASSOC)){
			array_push($searchresultsarray, $row1['id']);
		}
		
	} else if($_GET['type'] == "ID") {
		$query = "SELECT g.id, g.guardid, g.photoname, g.jobtitle, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g, jobtitles j WHERE p.id = g.personid AND g.guardid LIKE '%".$_SESSION['searchguard']."%'".$subquery;//." ORDER BY g.lastupdatedate, g.datecreated"
	}

// Viewing guards due for long service awards
} else if(isset($_GET['a']) && $_GET['a'] == "lsearch"){
	$long_guards = array();
	
	$result = mysql_query("SELECT guardid, dateofemployment FROM guards WHERE isarchived = 'N'");
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
		//Look for the long serving guards for the passed year
		if((date("Y",strtotime(decryptValue($_GET['y']))) - date("Y",strtotime($row['dateofemployment']))) >= 10){
			array_push($long_guards,$row['guardid']);
		}
	}
	
	//Generate where clause to be added to the query
	$whereclause = "AND (";
	for($i=0;$i<count($long_guards);$i++){
		$whereclause .= "g.guardid = '".$long_guards[$i]."'";
		if($i < (count($long_guards) - 1)){
			$whereclause .= " OR ";
		}
	}
	$whereclause .= ")";
	
	$query = "SELECT g.id, g.guardid, g.photoname, g.jobtitle, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid ".$whereclause;//." ORDER BY g.lastupdatedate, g.datecreated"
	

// Viewing active guards
} else {
	if(isset($_POST)){
		for($i=0;$i<count($_POST['guardid']);$i++){
			$activatequery = "UPDATE guards SET isarchived = 'N' WHERE id = '".$_POST['guardid'][$i]."'";
			mysql_query($activatequery);
		}
	}
	
	$query = "SELECT g.id, g.guardid, g.photoname,g.jobtitle, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived = 'N' AND UserID = 1;";// ORDER BY g.datecreated DESC
}

if($_GET['a'] == "order"){
	if($_GET['ty'] == "desc"){
		$order = "DESC";
	} else { $order = "ASC";}
	
	if($_GET['va'] == "id"){
		$by = "g.guardid";
	} else if($_GET['va'] == "name") { 
		$by = "p.firstname";
	} else if($_GET['va'] == "doe") { 
		$by = "g.dateofemployment";
	}
	
	$query .= " ORDER BY ".$by." ".$order;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Guards</title>
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
        <td class="headings">Manage Staff<?php if(isset($_POST['archive']) || (isset($_GET['a']) && $_GET['a'] == "archive")){ echo "Archive"; }?></td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="manageguards.php">
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td>&nbsp;</td>
            </tr>
			<?php if($_GET['t'] != "drivers"){?>
            <tr><?php if(userHasRight($_SESSION['userid'], "46")){?>
              <td><span class="label">
                <input type="button" name="newguard" value="Create New Staff" onClick="javascript:document.location.href='../hr/index.php'"> 
                <?php } ?>
               <?php
			   if(isset($_POST['archive']) || (isset($_GET['a']) && $_GET['a'] == "archive")){
			   	echo "<a href=\"../hr/manageguards.php\">View Active Guards</a>";
			   } else {
			   ?>
			    <a href="../hr/manageguards.php?a=archive" title="Displays guards who are archived.">View Staff Archive</a> 
				<?php } ?>
				</span></td>
            </tr>
			<?php } ?>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td class="label">Search For Staff: </td>
                  <td><input name="searchguard" id="searchguard" type="text" size="30" value="<?php if(isset($_SESSION['searchguard'])){ echo $_SESSION['searchguard'];}?>"></td>
                  <td class="label">Search By: 
                    <select name="type" id="type">
                      <option value="Name">Name</option>
					  <option value="ID" <?php if(isset($_GET['type']) && $_GET['type'] == "ID"){ echo "selected";}?>>ID</option>			  
                    </select> </td>
                  <td><input type="button" name="Button" value="Search Staff" onClick="pickFormItemTypeAndDirect('searchguard', 'manageguards.php?a=search<?php if(isset($_GET['t']) && $_GET['t'] == "drivers"){ echo "&t=drivers";}?>&v=', 'Please enter a guard name or ID')"></td>
                </tr>
              </table></div></td>
            </tr>
            
            <tr>
              <td>&nbsp;</td>
            </tr>
            <?php
			if((isset($_GET['type']) && $_GET['type'] == "ID" &&  howManyRows($query) == 0) || (isset($_GET['type']) && $_GET['type'] == "Name" &&  count($searchresultsarray) == 0) || (!isset($_GET['type']) && howManyRows($query) == 0)){          			
				echo "<tr><td>There are no guards to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:98%;height:420px;overflow: auto"><table width="89%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
                    <?php if(!isset($_GET['t'])){ ?><td>&nbsp;</td><?php }?>
                    <td><a href="manageguards.php?a=order&va=id&ty=<?php if($_GET['ty'] == "desc"){ echo "asc";} else { echo "desc";}
					
					if(isset($_GET['t'])){
						echo "&t=".$_GET['t']."&act=".$_GET['act'];
					}?>" style="color:#000">ID<?php if(isset($_GET['ty']) && $_GET['va'] == "id"){
					if($_GET['ty'] == "desc"){ echo " &nbsp;&nbsp; <img src='../images/ascarrow.gif' border='0'>";} else { echo " &nbsp;&nbsp; <img src='../images/descarrow.gif' border='0'>";}
					}?></a></td>
                    <td><a href="manageguards.php?a=order&va=name&ty=<?php if($_GET['ty'] == "desc"){ echo "asc";} else { echo "desc";}
					if(isset($_GET['t'])){
						echo "&t=".$_GET['t']."&act=".$_GET['act'];
					}
					?>" style="color:#000">Name<?php if(isset($_GET['ty']) && $_GET['va'] == "name"){
					if($_GET['ty'] == "desc"){ echo " &nbsp;&nbsp; <img src='../images/ascarrow.gif' border='0'>";} else { echo " &nbsp;&nbsp; <img src='../images/descarrow.gif' border='0'>";}
					}?></a></td>
					<td><a href="manageguards.php?a=order&va=doe&ty=<?php if($_GET['ty'] == "desc"){ echo "asc";} else { echo "desc";}
					if(isset($_GET['t'])){
						echo "&t=".$_GET['t']."&act=".$_GET['act'];
					}
					?>" style="color:#000">Date of Employment<?php if(isset($_GET['ty']) && $_GET['va'] == "doe"){
					if($_GET['ty'] == "desc"){ echo " &nbsp;&nbsp; <img src='../images/ascarrow.gif' border='0'>";} else { echo " &nbsp;&nbsp; <img src='../images/descarrow.gif' border='0'>";}
					}?></a></td>
					<td>Position</td>
					<td>LC Letter Provided</td>
                    <td>Photo</td>
					<?php if(userHasRight($_SESSION['userid'], "77")){?>
					<td>Personnel File</td>
					<?php } ?>
					<?php if(userHasRight($_SESSION['userid'], "76") && !isset($_GET['t'])){?>
                    <td>Delete</td>
					<?php } ?>
                  </tr>
                  <?php
			  $i = 0;
			  $result = mysql_query($query);
			   while($line = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
                    <?php if(!isset($_GET['t'])){ ?><td>
                      <input type="checkbox" name="guardid[]" value="<?php echo $line['id']; ?>"></td><?php } ?>
                    <td>
					<?php if(userHasRight($_SESSION['userid'], "75") && !isset($_GET['t'])){?> 
				  	<a href="../hr/index.php?id=<?php echo encryptValue($line['id']);?>&a=edit" class="normaltxtlink" title="Edit guard details."><?php echo $line['guardid']; ?></a> <?php } else { echo $line['guardid']; ?>
					 <?php } ?>
					</td>
					
					 
                    <td><?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames']; ?></td>
					<td><?php echo date("d-M-Y",strtotime($line['dateofemployment'])); ?></td>
					<td><?php 
					$row = getRowAsArray("SELECT jobtitle FROM jobtitles WHERE id='".$line['jobtitle']."'");
					echo $row['jobtitle']; ?></td>
					<td align="center"><?php 
					if($line['lc1letterprovided'] == "Y"){
						echo "Yes";
					} else {
						echo "No";
					} ?></td>
                    <td><a href="../hr/index.php?id=<?php echo encryptValue($line['id']);  if($_GET['t'] == "drivers"){ echo "&t=drivers";}?>&a=view" class="normaltxtlink"><?php
				if($line['photoname'] != ""){
			echo "<img src=\"".$line['photoname']."\" width=\"50\" height=\"60\" border=\"1\">";
			} ?></a></td>
			<?php if(userHasRight($_SESSION['userid'], "77")){
			
			$personnelid=mysql_result(mysql_query("SELECT id FROM personnel WHERE guard='".$line['guardid']."'"),"id");
			?>
			<td><img src="../images/folder.gif" alt="Disciplinary folder for <?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];?>" width="16" height="14"> <a href="managepersonnel.php?id=<?php echo encryptValue($line['guardid']); if($_GET['t'] == "drivers"){ echo "&t=drivers";}?>" title="View <?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];?>'s personnel file." class="normaltxtlink">View File</a></td>
			<?php } ?>
			<?php if(userHasRight($_SESSION['userid'], "76") && !isset($_GET['t'])){?>
                    <td><a href="#" onClick="javascript:deleteEntity('../hr/deleteguard.php?id=<?php echo $line['id']; ?>', 'guard', '<?php echo $line['firstname']." ".$line['lastname']; ?>')" class="normaltxtlink" title="Delete <?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];?>">Delete</a></td>
			<?php } ?>
                  </tr><?php 
			  $i++;
			  
			  } ?>
              </table></div></td>
            </tr>
            <?php } ?>
			<tr>
			  <td>&nbsp;</td>
			  </tr>
			<?php if(!isset($_GET['t'])){ ?><tr><td>
			  <?php
			   if(isset($_POST['archive']) || (isset($_GET['a']) && $_GET['a'] == "archive")){
			   ?><input name="activate" type="submit" id="activate" value="Activate Staff"><?php } else {?><input name="archive" type="submit" id="archive" value="Archive Staff"><?php } ?></td>
			</tr><?php } ?>
          </table>
                </form>
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
