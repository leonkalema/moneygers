<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_POST['ArchiveInspections'])){
	$formvalues = array_merge($_POST);
	//Archive all selected inspections
	for($i=0;$i<count($formvalues['inspection']);$i++){
		mysql_query("UPDATE vehicleinspections SET isactive = 'N' WHERE id='".$formvalues['inspection'][$i]."'");
	}
}

if(isset($_POST['ActivateInspections'])){
	$formvalues = array_merge($_POST);
	//Archive all selected inspections
	for($i=0;$i<count($formvalues['inspection']);$i++){
		mysql_query("UPDATE vehicleinspections SET isactive = 'Y' WHERE id='".$formvalues['inspection'][$i]."'");
	}
}

if(isset($_GET['a']) && $_GET['a'] == "delete"){
	mysql_query("DELETE FROM vehicleinspections WHERE id = '".decryptValue($_GET['id'])."'");
} 

//Generate custom made query
if($_GET['a'] == "search"){
	$_SESSION['searchinspections'] = $_GET['v'];
	$_SESSION['searchtype'] = $_GET['type'];
	
	if($_SESSION['searchtype'] == "vehicleid"){
		$wherestr = "WHERE vehicleno LIKE '%".trim($_SESSION['searchinspections'])."%'";
	
	} else if($_SESSION['searchtype'] == "inspectiondate"){
		$searchvalue = $_SESSION['searchinspections'];
		$searchresultsarray = array();$searchstr=ucfirst(substr($searchvalue,0,3));
		
		if(is_numeric($searchvalue)){
			$whereclause = "WHERE YEAR(inspectiondate) LIKE '%".$searchvalue."%' OR DAY(inspectiondate) = '".$searchvalue."' ";
			
		}else{
		if(strpos($searchvalue, "-") === FALSE){
		$searchstr=ucfirst(substr($searchvalue,0,3));
		switch ($searchstr){
			case "Jan":
				$searchvalue="01";
			break;
			case "Feb":
				$searchvalue="02";
			break;
			case "Mar":
				$searchvalue="03";
			break;
			case "Apr":
				$searchvalue="04";
			break;
			case "May":
				$searchvalue="05";
			break;
			case "Jun":
				$searchvalue="06";
			break;
			case "Jul":
				$searchvalue="07";
			break;
			case "Aug":
				$searchvalue="08";
			break;
			case "Sep":
				$searchvalue="09";
			break;
			case "Oct":
				$searchvalue="10";
			break;
			case "Nov":
				$searchvalue="11";
			break;
			case "Dec":
				$searchvalue="12";
			break;
			
			default:
				$searchvalue="13";
			}
			$wherestr = "WHERE MONTH(inspectiondate) = '".$searchvalue."' ";
		} else {
			$wherestr = "WHERE inspectiondate = '".date("Y-m-d",strtotime($searchvalue))."' ";
		}
	}
}
	
	if($_GET['t'] == "archive"){
		$wherestr .= " AND isactive = 'N'";
		$_GET['a']= "archive";
	} else {
		$wherestr .= " AND isactive = 'Y'";
		
	}
	
	$query = "SELECT id, vehicleno, inspectiondate, commentids, madeby FROM vehicleinspections ".$wherestr." ORDER BY inspectiondate DESC";
	
} else if($_GET['a'] == "archive") {
	$query = "SELECT * FROM vehicleinspections WHERE isactive = 'N' ORDER BY inspectiondate DESC";
} else {
	$query = "SELECT * FROM vehicleinspections WHERE isactive = 'Y' ORDER BY inspectiondate DESC";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Vehicle Inspections</title>
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
        <td class="headings">Manage Vehicle Inspections </td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="vehicleinspections.php">
          <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <?php if(userHasRight($_SESSION['userid'], "189")){?>
            <tr>
              <td><input name="newvehicleinspection" type="button" id="newvehicleinspection" onClick="javascript:document.location.href='../transport/addvehicleinspection.php'" value="Add Vehicle Inspection">
                [
                <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?>
                <a href="vehicleinspections.php" title="Displays active inspections.">View Active Inspections</a>
                <?php } else {?>
                <a href="vehicleinspections.php?a=archive" title="Displays inspections which have been archived.">View Archive</a>
                <?php } ?>
                ] </td>
            </tr>
            <?php } ?>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td><div id="searchtable">
                  <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                    <tr>
                      <td>Search vehicle Inspections:<br>
                        (Enter date in format "02-May-06")</td>
                      <td><input name="searchinspections" id="searchinspections" type="text" size="20" value="<?php if(isset($_SESSION['searchinspections'])){ echo $_SESSION['searchinspections'];}?>"></td>
                      <td nowrap>&nbsp;&nbsp;Search By: </td>
                      <td><select name="type" id="type">
                          <option value="vehicleid" <?php if($_SESSION['searchtype'] != "inspectiondate"){ echo "selected";}?>>Vehicle Reg No.</option>
                          <option value="inspectiondate" <?php if($_SESSION['searchtype'] == "inspectiondate"){ echo "selected";}?>>Inspection Date</option>
                      </select></td>
                      <td><input type="button" name="Button" value="Search Inspections" onClick="pickFormItemTypeAndDirect('searchinspections', '../transport/vehicleinspections.php?a=search&t=<?php if($_GET['a'] == "archive"){ echo "archive";}else{ echo "active";}?>&v=', 'Please enter all or part of the vehicle registration number or date of inspection.')"></td>
                    </tr>
                  </table>
              </div></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no assignment separations records to display.</td></tr>";
				echo "<tr><td><input type=\"button\" name=\"cancel\" id=\"cancel\" value=\"<< Back\" onClick=\"javascript:history.go(-1);\"></td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:730px;height:250px;overflow: auto">
                  <table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                    <tr class="tabheadings">
                      <?php if(userHasRight($_SESSION['userid'], "193")){?>
                      <td width="4%">&nbsp;</td>
                      <?php } ?>
                      <?php if(userHasRight($_SESSION['userid'], "190")){?>
                      <td width="4%">Edit</td>
                      <?php } ?>
                      <?php if(userHasRight($_SESSION['userid'], "190")){?>
                      <td width="9%">Delete</td>
                      <?php } ?>
                      <td width="11%" nowrap>Vehicle No.</td>
                      <td width="14%">Inspection Date </td>
                      <td width="12%" nowrap>Reports</td>
                      <td width="50%">Inspected By </td>
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
                      <?php if(userHasRight($_SESSION['userid'], "193")){?>
                      <td width="4%"><input type="checkbox" name="inspection[]" id="inspection[]<?php echo $line['id']; ?>" value="<?php echo $line['id']; ?>"></td>
                      <?php } ?>
                      <?php if(userHasRight($_SESSION['userid'], "190")){?>
                      <td><a href="../transport/addvehicleinspection.php?a=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify the vehicle inspection details.">Edit</a></td>
                      <?php } ?>
                      <?php if(userHasRight($_SESSION['userid'], "190")){?>
                      <td><a href="#" onClick="javascript:deleteEntity('../transport/vehicleinspections.php?id=<?php echo encryptValue($line['id']); ?>&a=delete', 'vehicle inspection', '<?php echo $line['vehicleno']; ?>')" class="normaltxtlink" title="Delete this entry.">Delete</a></td>
                      <?php } ?>
                      <td nowrap><?php echo $line['vehicleno']; ?></td>
                      <td nowrap><?php echo date("d-M-Y",strtotime($line['inspectiondate']));?></td>
                      <td><a href="addvehicleinspection.php?a=view&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="View all inspection reports for <?php echo $line['vehicleno']; ?> on <?php echo date("d-M-Y",strtotime($line['inspectiondate']));?>.">View All (
                            <?php 
				
				$commentarray = split(",",$line['commentids']);
				echo count($commentarray);?>
                        )</a></td>
                      <td><?php echo $line['madeby']; ?></td>
                    </tr>
                    <?php 
			  	$i++;
			  } ?>
                  </table>
              </div></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><?php if(userHasRight($_SESSION['userid'], "193")){?>
                  <input <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateInspections\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveInspections\" value=\"Archive\"";} ?>type="submit" >
                  <?php } ?>
                  <?php if(isset($_GET['a']) && $_GET['a'] == "search"){ ?>
                <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
                <?php } ?></td>
            </tr>
            <?php } ?>
          </table>
                </form>
        </td>
      </tr>
    </table></td>
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
