<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchguard'] = trim($_GET['v']);
	
	if($_GET['type'] == "Name"){
		//Search through all the guards and get the relevant results
		$searchvalues = $_SESSION['searchguard'];
		
		// Scan through the search values separated by a space
		$searchvalue = explode(" ",$searchvalues);
		$searchresultsarray = array();
		
		$basequery = "SELECT g.id, g.guardid, g.dateofemployment, g.jobtitle, g.contractenddate, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid";
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
		$query = "SELECT g.id, g.guardid, g.dateofemployment, g.jobtitle, g.contractenddate, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid AND g.guardid LIKE '%".$_SESSION['searchguard']."%' ORDER BY g.lastupdatedate, g.datecreated";
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
	
	$query = "SELECT g.id, g.guardid, g.dateofemployment, g.jobtitle, g.contractenddate, p.firstname, p.lastname, p.othernames, p.birthlastname FROM persons p, guards g WHERE p.id = g.personid ".$whereclause." ORDER BY g.dateofemployment DESC";
	

// Viewing active guards
} else {
	$query = "SELECT id, guardid, dateofemployment, jobtitle, contractenddate  FROM guards WHERE isarchived = 'N' ORDER BY dateofemployment DESC";
}			
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Period of Service</title>
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
        <td class="headings"><a href="manageguards.php">Manage Guards</a> &gt; View Period of Service </td>
      </tr>
      <tr>
        <td>
		
		<tr><td>&nbsp;</td>
        </tr>
		  <tr>
         <td><form id="searchtable" action="periodofservice.php" method="post" >
           <table border="0" cellspacing="0" cellpadding="2">
             <tr>
               <td class="label">Search For Guard: </td>
               <td><input name="searchguard" id="searchguard" type="text" size="30" value="<?php if(isset($_SESSION['searchguard'])){ echo $_SESSION['searchguard'];}?>"></td>
               <td class="label">Search By:
                 <select name="type" id="type">
                     <option value="Name">Name</option>
                     <option value="ID" <?php if(isset($_GET['type']) && $_GET['type'] == "ID"){ echo "selected";}?>>ID</option>
                   </select>
               </td>
               <td><input type="button" name="Button" value="Search Guard" onClick="pickFormItemTypeAndDirect('searchguard', 'periodofservice.php?a=search&v=', 'Please enter a guard name or ID')"></td>
             </tr>
           </table>
         </form></td>
       </tr>
	  <td>
	    </td>
      </tr>
            <tr>
              <td height="16">&nbsp;</td>
            </tr>
			<?php 
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no guards to display</td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:720px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
				<td width="7%">Guard ID</td>
                <td width="13%">Name</td>
                <td width="12%">Period of Service</td>
				<td width="12%">Job Title</td>
                 <td width="13%">Contract Expiry Date</td>
				 <td width="21%">Guard File</td>
              </tr>
			  <?php
			  // Display the leave applications
			  $result = mysql_query($query);
			  $i = 0;
			   while($row=mysql_fetch_array($result, MYSQL_ASSOC)) { 
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
				  
			   ?>
              <tr class="<?php echo $rowclass; ?>">
			 	<td><?php echo $row['guardid']; ?></td>
                <td><?php echo getGuardNameById($row['guardid']);?></td>
                <td><?php 
				$yrdiff = date("Y",strtotime("now")) - date("Y",strtotime($row['dateofemployment']));
				$monthdiff = date("m",strtotime("now")) - date("m",strtotime($row['dateofemployment']));
				
				if($yrdiff > 0){
					$diff = $yrdiff." Yrs";
				} else {
					$diff = $monthdiff." Months";
				}
				echo $diff;
				?></td>
                <td><?php echo getJobTitleById($row['jobtitle']);?></td>
                <td><?php echo date("d-M-Y",strtotime($row['contractenddate']));?></td>
                <td><img src="../images/folder.gif" alt="Disciplinary folder for <?php echo getGuardNameById($row['guardid']);?>" width="16" height="14"> <?php if(userHasRight($_SESSION['userid'], "77") && howManyRows("SELECT  * FROM personnel WHERE guard = '".$row['guardid']."'") != 0){?><a href="../hr/managepersonnel.php?id=<?php echo encryptValue($row['guardid']);?>" title="View the guard file for <?php echo getGuardNameById($row['guardid']);?>"><?php echo getGuardNameById($row['guardid']);?></a><?php } else { echo getGuardNameById($row['guardid']); }?>
				</td>
              </tr>
			  <?php 
			  $i++;
			  } ?>
            </table>
            </div></td>
          </tr>			
			<?php } ?>
			<tr>
              <td class="copyright"><?php include("../include/footer.php");?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table>
		 
    </td>
  </tr>
</table></td>
  </tr>
<tr>
    <td colspan="2" align="left" valign="top">&nbsp;</td>
</tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
