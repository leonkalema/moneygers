<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

$searchcondition = "";
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$guardid = $_GET['guardid'];
	$searchcondition = " WHERE guard = '".$guardid."'";
	$q=mysql_query("SELECT * from personnel ".$searchcondition." ORDER BY id DESC");
}

// If you are searching
if(isset($_GET['v']) && trim($_GET['v']) != ""){
	$_SESSION['searchpersonnel'] = trim($_GET['v']);
	$searchvalues = $_SESSION['searchpersonnel'];
	
	// Scan through the search values separated by a space
	$searchvalue = explode(" ",$searchvalues);
	
	$where= " WHERE (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%') AND (p.firstname LIKE '%".$searchvalue[1]."%' OR p.lastname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%')";

$q = mysql_query("SELECT * FROM persons p INNER JOIN guards g ON(p.id = g.personid) INNER JOIN personnel ps ON(g.guardid = ps.guard) ".$where." ") or die (mysql_error());
	
} else if(isset($_GET['id'])){
	$q = mysql_query("SELECT * FROM personnel WHERE guard = '".decryptValue($_GET['id'])."' ORDER BY id DESC");
}else {
	
	$q = mysql_query("SELECT * FROM personnel ORDER BY id DESC");
}


$personnels = mysql_num_rows($q);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Personnel Files</title>
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
        <td class="headings"><a href="manageguards.php<?php if(isset($_GET['t'])){ echo "?a=search&t=".$_GET['t'];}?>">Manage Guards</a> &gt; Manage Personnel Files </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          
<?php
if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){
?>
<tr>
            <td class="redtext"><b><?php echo $_SESSION['errors'];?></b></td>
          </tr>
<?php 
$_SESSION['errors'] = "";
}?>
          <tr>
            <td>&nbsp;</td>
          </tr>
		
          <tr>
            <td><?php if(!isset($_GET['t'])){?>
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">&nbsp;<?php if(isset($_GET['a']) && $_GET['a'] == "search" && userHasRight($_SESSION['userid'], "141")){?><input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')"><?php } else {  if(userHasRight($_SESSION['userid'], "74")){?>   <input type="button" name="newpersonnel" value="Create New Personnel File" onClick="javascript:document.location.href='../hr/personnel.php'"><?php } } }?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  
		  <?php 
		  //First time you hit this page, you should see a summary of the disciplinary records
		  // based on the guards
		  if(!isset($_GET['a']) && !isset($_GET['v']) && !isset($_GET['id'])){ 
		  	$guardresult = mysql_query("SELECT p.firstname, p.lastname, p.othernames, g.dateofemployment, g.guardid, g.id FROM guards g, persons p WHERE g.personid = p.id ORDER BY p.firstname ASC");
			  	$guarddetailsarr = array();
				$k = 0;
				while($theguard=mysql_fetch_array($guardresult,MYSQL_ASSOC)){
					$guardfileno = howManyRows("SELECT * FROM personnel WHERE guard = '".$theguard['guardid']."'"); 
					if($guardfileno > 0){
						$guarddetailsarr[$k]['id'] = $theguard['guardid'];
						$guarddetailsarr[$k]['name'] = $theguard['firstname']." ".$theguard['lastname']." ".$theguard['othernames']." (".$theguard['guardid'].")";
						$guarddetailsarr[$k]['fileno'] = $guardfileno;
						$guarddetailsarr[$k]['employmentdate'] = $theguard['dateofemployment'];
						
						$k++;
					}
				}
			  
		  ?>
		     <tr>
            <td><table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
                <td width="18%">Guard Folder</td>
                <td width="16%">No of Files in Folder </td>
                <td width="18%">Date of Employment </td>
                </tr>
              <?php
			  	for($i=0; $i<count($guarddetailsarr); $i++){
			      if(($i%2)==0) {
				     $rowclass = "oddrow";
				  } else {
				     $rowclass = "evenrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
                
                <td><img src="../images/folder.gif" alt="Disciplinary folder for <?php echo $guarddetailsarr[$i]['name'];?>" width="16" height="14"> <a href="managepersonnel.php?id=<?php echo encryptValue($guarddetailsarr[$i]['id']);?>"><?php echo $guarddetailsarr[$i]['name'];?></a></td>
                <td><?php echo $guarddetailsarr[$i]['fileno'];?></td>
                <td><?php echo date("d-M-Y", strtotime($guarddetailsarr[$i]['employmentdate']));?></td>
                </tr>
              <?php } ?>
            </table></td>
          </tr>
		  <?php } else {?>
          <tr>
            <td>&nbsp;</td>
          </tr>
			<?php
			if(count($personnels) == 0){          			
				echo "<tr><td>There are no Personnnel Files to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div id="printresults_div" style="padding:4px;width:98%;height:400px;overflow: auto"><table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr style="font-family: tahoma;
	font-size: 11px;
	font-weight:bold;
	color:#FFFFFF;
	text-decoration: none;
	background-color: #010066;
	font-weight:bold">
	
				<?php if(userHasRight($_SESSION['userid'], "75") && !isset($_GET['t'])){?>
                <td width="5%">Edit</td>
                <?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "76") && !isset($_GET['t'])){?>
                <td width="5%">Delete</td>
                <?php } ?>
                <td width="18%">Guard</td>
                <td width="16%">Type</td>
                <td width="18%">Action Taken </td>
				<td width="18%">Taken By</td>
                <td width="19%">Date</td>
				<?php if(userHasRight($_SESSION['userid'], "77")){?><td width="19%">Details</td><?php } ?>
              </tr>
			  <?php
			  $i=0;
			   	while($thepersonnel=mysql_fetch_array($q,MYSQL_ASSOC)){
			      if(($i%2)==0) {
				     $rowclass = "oddrow";
				  } else {
				     $rowclass = "evenrow";
				  }
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			  <?php if(userHasRight($_SESSION['userid'], "75") && !isset($_GET['t'])){?>
                <td><a href="personnel.php?action=edit&id=<?php echo encryptValue($thepersonnel['id']); ?>" class="normaltxtlink" title="Modify guard's personnel file information.">Edit</a></td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "76") && !isset($_GET['t'])){?>
                <td><a href="#" onClick="javascript:deleteEntity('../hr/deletepersonnel.php?id=<?php echo $thepersonnel['id']; ?>', 'personnel', '<?php echo $thepersonnel['guard']; ?>')" class="normaltxtlink" title="Delete guard's personnel file information.">Delete</a></td><?php } ?>
                <td>
				 
				<?php				
				$guard = getRowAsArray("SELECT p.firstname, p.lastname, p.othernames, g.id FROM guards g, persons p WHERE g.personid = p.id AND g.guardid = '".$thepersonnel['guard']."'");
				$guardname=$guard['firstname']." ".$guard['lastname']." ".$guard['othernames'];
				?>
				<?php if(userHasRight($_SESSION['userid'], "43") && !isset($_GET['t'])){?><a href="../hr/index.php?id=<?php echo encryptValue($guard['id']); ?>&a=view" class="normaltxtlink"  title="View guard's details.">
				<?php 
				echo $guardname;
				 ?></a><?php } else { echo $guardname; } ?></td>
                <td><?php 
				if($thepersonnel['type']=='Discipline'){  
					echo "Commendation";
				} else if($thepersonnel['type']=='Indiscipline'){
					echo "Sanction";
				}
				 ?></td>
                <td><?php echo $thepersonnel['actiontaken']; ?>&nbsp;</td>
				<td><?php echo $thepersonnel['takenby']; ?>&nbsp;</td>
                <td><?php 
				if($thepersonnel['date'] != "0000-00-00 00:00:00"){
					$date = date("d-M-Y",strtotime($thepersonnel['date']));
				} else { $date = "&nbsp;";}
				echo $date; ?></td>
				<?php if(userHasRight($_SESSION['userid'], "77")){?><td nowrap><img src="../images/file.gif" alt="Discipline File" border="0"> <?php if(userHasRight($_SESSION['userid'], "77")){?><a href="../hr/viewpersonnelfile.php?id=<?php echo encryptValue($thepersonnel['id']);  if($_GET['t'] == "drivers"){ echo "&t=drivers";}?>" class="normaltxtlink"  title="View guard's personnel file information.">View Details</a><?php }?></td>
				<?php } ?>
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table></div></td>
          </tr>			
			<?php } 
			
			}?>
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
