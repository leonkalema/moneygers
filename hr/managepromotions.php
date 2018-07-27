<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_POST['promote']) ){
	
	for($i=0;$i<count($_POST['promotionid']);$i++){
		//First get the old job titles before you determine whether the guard is promoted
		$oldposts_result = mysql_query("SELECT jobtitle FROM guards WHERE isarchived = 'N'");
		$guard_post_array = getRowAsArray("SELECT guardid, jobtitle FROM guards WHERE id = '".$_POST['promotionid'][$i]."'");
		//Save the promotion in the promotions table and post a reminder in the responsible
		//users' dashboards.
		if($guard_post_array['jobtitle'] != $_POST['jobtitle'][$i]){
			mysql_query("INSERT INTO promotions (guard, oldtitle, newtitle, dateofpromotion) VALUES ('".$guard_post_array['guardid']."', '".$guard_post_array['jobtitle']."', '".$_POST['jobtitle'][$i]."', NOW())");
			
			$promotion_title = getRowAsArray("SELECT jobtitle FROM jobtitles WHERE id='".$_POST['jobtitle'][$i]."'");
			
			mysql_query("INSERT INTO messages (reason, details, sentby, sentto, date) VALUES ('GUARD PROMOTION', '".getGuardNameById($guard_post_array['guardid'])." has been promoted to ".strtoupper($promotion_title['jobtitle']).". Please change the payment rate if affected', '', '1,80,84', NOW())");
		}
		
		$promotequery = "UPDATE guards SET jobtitle='".$_POST['jobtitle'][$i]."', promotiondate = now() WHERE id = '".$_POST['promotionid'][$i]."'";
		mysql_query($promotequery) or die(mysql_error());
		
	}
	
	$query = "SELECT g.id, g.guardid, g.jobtitle, g.photoname, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived = 'N' ORDER BY g.datecreated DESC";
}

// Searching for a guard	
 else if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchguard'] = trim($_GET['v']);
	
	if($_GET['type'] == "Name"){
		//Search through all the guards and get the relevant results
		$searchvalues = $_SESSION['searchguard'];
		
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		$searchresultsarray = array();
		
		$basequery = "SELECT g.id, g.guardid,g.jobtitle, g.photoname, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid";
		$result = mysql_query($basequery);
		//First search through for a full name
		while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
			$rowname = $row['firstname']." ".$row['lastname']." ".$row['othernames']." ".$row['birthlastname'];
			if(trim($searchvalue) == trim($rowname)){
				array_push($searchresultsarray, $row['id']);
			}
		}
		
				
		$condition = " AND (p.firstname LIKE '%".$searchvalue[0]."%' OR p.lastname LIKE '%".$searchvalue[0]."%' OR p.othernames LIKE '%".$searchvalue[0]."%'  OR p.birthlastname LIKE '%".$searchvalue[0]."%') AND (p.lastname LIKE '%".$searchvalue[1]."%' OR p.firstname LIKE '%".$searchvalue[1]."%' OR p.othernames LIKE '%".$searchvalue[1]."%' OR p.birthlastname LIKE '%".$searchvalue[1]."%') ORDER BY g.lastupdatedate, g.datecreated";
		
		$query = $basequery.$condition;
		
		$result1 = mysql_query($query);
		//First search through for a full name
		while($row1=mysql_fetch_array($result1, MYSQL_ASSOC)){
			array_push($searchresultsarray, $row1['id']);
		}
		
	} else if($_GET['type'] == "ID") {
		$query = "SELECT g.id, g.guardid,g.jobtitle, g.photoname, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid AND g.guardid LIKE '%".$_SESSION['searchguard']."%' ORDER BY g.lastupdatedate, g.datecreated";
	}
}
// Viewing active guards
 else {
	
	$query = "SELECT g.id, g.guardid, g.jobtitle, g.photoname, g.dateofemployment, g.status, g.lc1letterprovided, p.firstname, p.lastname FROM guards g, persons p WHERE g.personid = p.id AND g.isarchived = 'N' ORDER BY g.datecreated DESC";
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
        <td class="headings">Manage Guard Promotions . <a href="managepromotions.php?t=archive">Previous Promotions </a></td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="managepromotions.php">
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            
            <tr>
              <td>&nbsp;</td>
            </tr>
           <?php if(!isset($_GET['t'])){?>
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
                  <td><input type="button" name="Button" value="Search Staff" onClick="pickFormItemTypeAndDirect('searchguard', 'managepromotions.php?a=search&v=', 'Please enter a guard name or ID')"></td>
                </tr>
              </table></div></td>
            </tr>
			
            <tr>
              <td>&nbsp;</td>
            </tr>
			<?php } //Removes the previous search box ?>
			<tr>
              <td><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td><b class="label">Specify promotion month:</b> </td>
                  <td nowrap class="label">Month:
                    <select name="promo_month" id="promo_month">
  <?php 
  echo generateSelectOptions(getTime('month',''), date("F",strtotime("now")));?>
</select>&nbsp;Year:&nbsp;<select name="promo_year" id="promo_year">
  <?php 
  echo generateSelectOptions(getTime('year','nbc'), date("Y",strtotime("now")));?>
</select></td>
                  <td><input type="button" name="Button" value="Search" onClick="combineFieldValues('promo_month', 'promo_year', '-','datevalue');pickFormItemAndDirect('datevalue', 'managepromotions.php?t=archive&v=', 'Please select the promotion year and month')">
                    <input type="hidden" name="datevalue" id="datevalue" value=""></td>
                </tr>
              </table></td>
            </tr>
			
			<?php
			if(isset($_GET['t']) && $_GET['t'] == "archive"){
				if(isset($_GET['v']) && trim($_GET['v']) != ""){
					$promotionmonth = date("M-Y",strtotime(trim($_GET['v'])));
				} else {
					$promotionmonth = date("M-Y",strtotime("now"));
				}
			
			$promotions = array();
			$promotion_result = mysql_query("SELECT * FROM promotions ORDER BY dateofpromotion DESC");
			while($line = mysql_fetch_array($promotion_result, MYSQL_ASSOC)){
				if($promotionmonth == date("M-Y",strtotime($line['dateofpromotion']))){
					array_push($promotions, $line['id']);
				}
			}
			
			if(count($promotions) == 0){
				echo "<tr><td>No guards were promoted in ".$promotionmonth."</td></tr>";
			} else {?>
			
			<tr>
				<td>&nbsp;</td>
			</tr>
			
			<tr>
              <td><div style="padding:4px;width:700px;height:420px;overflow: auto"><table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
                    <td width="12%">Staff ID</td>
                    <td width="17%">Staff Name</td>
                    <td width="23%">Date of Promotion</td>
					<td width="22%">Current Job Title </td>
                    <td width="26%">Previous Job Title</td>
                  </tr>
                  <?php
			  $result = mysql_query($query);
			   for($i=0;$i<count($promotions);$i++) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
				  
				  $line = getRowAsArray("SELECT * FROM promotions WHERE id='".$promotions[$i]."'");
			   ?>
                  <tr class="<?php echo $rowclass; ?>">
                    <td><?php echo $line['guard']; ?></td>
                    <td><?php echo getGuardNameById($line['guard']); ?></td>
                    <td><?php echo date("d-M-Y",strtotime($line['dateofpromotion'])); ?></td>
					
					<td align="left"><?php echo getJobTitleById($line['newtitle']);	?></td>
                    <td><?php echo getJobTitleById($line['oldtitle']);	?></td>
                  </tr>
                  
                  <?php 
			  } 
			  
			 }
			 
			 
			 //******************************************************************
			 // Normal promotion page (for active promotions
			 //******************************************************************
			} else {
			
			if((isset($_GET['type']) && $_GET['type'] == "ID" &&  howManyRows($query) == 0) || (isset($_GET['type']) && $_GET['type'] == "Name" &&  count($searchresultsarray) == 0) || (!isset($_GET['type']) && howManyRows($query) == 0)){          			
				echo "<tr><td>There are no guards to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:97%;height:420px;overflow: auto"><table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                  <tr class="tabheadings">
                    <td width="12%">Staff ID</td>
                    <td width="17%">Staff Name</td>
                    <td width="23%">Date of Employment </td>
					<td width="22%">Current Job Title </td>
                    <td width="26%">New Job Title</td>
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
                    <td><?php echo $line['guardid']; ?></td>
                    <td><img src="../images/folder.gif" alt="Disciplinary folder for <?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];?>" width="16" height="14"> <?php if(userHasRight($_SESSION['userid'], "77") && howManyRows("SELECT  * FROM personnel WHERE guard = '".$line['guardid']."'") != 0){?><a href="../hr/managepersonnel.php?id=<?php echo encryptValue($line['guardid']);?>" title="View the guard file for <?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];?>"><?php echo $line['firstname']." ".$line['lastname']." ".$line['othernames'];?></a><?php } else { echo $line['firstname']." ".$line['lastname']." ".$line['othernames']; }?>
					</td>
                    <td><?php echo date("d-M-Y",strtotime($line['dateofemployment'])); ?></td>
					
					<td align="left"><?php echo getJobTitleById($line['jobtitle']);	?></td>
                    <?php if(userHasRight($_SESSION['userid'], "76")){?>
					<td>
						<select id="jobtitle[]" name="jobtitle[]">
						  <?php echo generateSelectOptions(getAllJobTitles(), $line['jobtitle']);?>
						</select>
					<input type="hidden" name="promotionid[]" id="promotionid[]" value="<?php echo $line['id']; ?>" />
					</td>
                    <?php } ?>
                  </tr>
                  
                  <?php 
			  $i++;
			  } ?>
			  <tr>
                   <td colspan="5">&nbsp;</td>
              </tr>
              <tr>
			 	<td colspan="8" align="center"><input name="promote" type="submit" id="promote" value="Save"></td>
			 </tr>
              </table>
              </div></td>
            </tr>
            <?php } 
			
			}?>
			<tr>
			  <td>&nbsp;</td>
			  </tr>
			
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
