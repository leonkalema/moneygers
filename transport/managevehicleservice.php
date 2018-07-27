<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();


// Searching for a Vehicle service	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchvehicleservice'] = trim($_GET['v']);
	
//Search through all the Fuel distribution and get the relevant results
	
//search by service Date
if($_GET['type'] == "Date"){
		$searchvalue = $_SESSION['searchvehicleservice'];
		$searchresultsarray = array();
		
		if(is_numeric($searchvalue)){
			//echo "Is numeric = ".$searchvalue;
			$whereclause = "WHERE YEAR(servicedate) LIKE '%".$searchvalue."%' OR DAY(servicedate) = '".$searchvalue."' ";
			
		}else{
		$searchstr=ucfirst(substr($searchvalue,0,3));
		//echo "substring = ".$searchstr;
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
		
		$whereclause = "WHERE MONTH(servicedate) = '".$searchvalue."' ";
	}
}
	
//search by Vehicle No
	if($_GET['type'] == "Vehicle No"){
		$searchvalue = $_SESSION['searchvehicleservice'];
		$searchresultsarray = array();
		
		$whereclause = "WHERE vehicleregno LIKE '%".$searchvalue."%'";
	}
	
}
else {
	$whereclause="";
}

//Generate custom made query
$query = "SELECT * FROM vehicleservice ".$whereclause." ORDER BY servicedate DESC ";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Vehicle Service</title>
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
    <td colspan="2" align="center" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">Manage Vehicle Service</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="2">

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr><?php if(userHasRight($_SESSION['userid'], "155")){?>
            <td><span class="label">
              <input name="newvehicleservice" type="button" id="newvehicleservice" onClick="javascript:document.location.href='../transport/vehicleservice.php'" value="Add Service Report">
            </span></td>
			<?php } ?>
            </tr>
			<tr>
            <td></td>
          </tr>
          <tr>
	  <td><form metho="post" action="">
	  <div id="searchtable"><table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search Vehicle service reports: </td>
                  <td><input name="searchvehicleservice" id="searchvehicleservice" type="text" size="20" value="<?php if(isset($_SESSION['searchvehicleservice'])){ echo $_SESSION['searchvehicleservice'];}?>"></td>
                  <td nowrap>Search By: 
                    <select name="type" id="type">
                      <option value="Date">Service Date</option>
					  <option value="Vehicle No" <?php if(isset($_GET['type']) && $_GET['type'] == "Vehicle No"){ echo "selected";}?>>Vehicle No</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search Service Reports" onClick="pickFormItemTypeAndDirect('searchvehicleservice', '../transport/managevehicleservice.php?a=search&v=', 'Please enter service date or vehicle number!')"></td>
                </tr>
              </table>
              </div></form></td>
            </tr>
			  <tr>
            <td></td>
          </tr>	 
		  	  
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no vehicle service reports to display.</td></tr>";
				echo "<tr><td><input type=\"button\" name=\"cancel\" id=\"cancel\" value=\"<< Back\" onClick=\"javascript:history.go(-1);\"></td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:730px;height:400px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  <?php if(userHasRight($_SESSION['userid'], "130")){?>
                <td width="4%">Edit</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "130")){?>
				<td width="9%">Delete</td><?php } ?>
				<td width="13%">Service Date</td>
                <td width="16%">Vehicle Reg No.</td>
                <td width="15%">Part serviced</td>				
                <td width="43%">Service done</td>
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
                <?php if(userHasRight($_SESSION['userid'], "155")){?>
				<td valign="top"><a href="../transport/vehicleservice.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify vehicle service information.">Edit</a></td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "155")){?>
				<td valign="top"><a href="#" onClick="javascript:deleteEntity('../transport/vehicleservice.php?id=<?php echo $line['id']; ?>&action=delete', 'service information for', '<?php echo $line['vehicleregno']; ?>')" class="normaltxtlink" title="Delete this entry.">Delete</a></td><?php } ?>
                
                <td valign="top"><?php echo date("d-M-Y",strtotime($line['servicedate'])) ; ?></td>
				<td valign="top"><?php echo $line['vehicleregno']; ?></td>
				<td valign="top"><?php echo $line['partserviced']; ?></td>
				<td valign="top"><?php echo $line['servicedone']; ?></td>
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
    <td colspan="2" align="left" valign="top" class="copyright"><?php include('../include/footer.php');?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
