<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

// Searching for a Fuel distribution	
if(isset($_GET['a']) && $_GET['a'] == "search"){
	$_SESSION['searchfueldistribution'] = trim($_GET['v']);
	
//Search through all the Fuel distribution and get the relevant results
	
//search by Date
if($_GET['type'] == "Date"){
		$searchvalue = $_SESSION['searchfueldistribution'];
		$searchresultsarray = array();$searchstr=ucfirst(substr($searchvalue,0,3));
		
		if(is_numeric($searchvalue)){
			//echo "Is numeric = ".$searchvalue;
			$whereclause = "WHERE YEAR(date) LIKE '%".$searchvalue."%' OR DAY(date) = '".$searchvalue."' ";
			
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
			$whereclause = "WHERE MONTH(date) = '".$searchvalue."' ";
		} else {
			$whereclause = "WHERE date = '".date("Y-m-d",strtotime($searchvalue))."' ";
		}
		
	}
}
	
	//search by Vehicle No
	if($_GET['type'] == "Vehicle No"){
		$searchvalue = $_SESSION['searchfueldistribution'];
		$searchresultsarray = array();
		
		$whereclause = "WHERE vehicleregno LIKE '%".$searchvalue."%'";
	}
	
	//search by Petro Station
	if($_GET['type'] == "Petro Station"){
		$searchvalue = $_SESSION['searchfueldistribution'];
		$searchresultsarray = array();
		
		$whereclause = "WHERE petrostation LIKE '%".$searchvalue."%'";
	}	
}
else {
	$whereclause="";
}

//Generate custom made query
$query = "SELECT * FROM fueldistribution ".$whereclause." ORDER BY date DESC ";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Fuel Distribution</title>
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
        <td class="headings">Manage Fuel Distribution</td>
      </tr>
      <tr>
        <td>
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <?php if(userHasRight($_SESSION['userid'], "192")){?>
          <tr>
            <td><span class="label">
              <input name="newfueldistribution" type="button" id="newfueldistribution" onClick="javascript:document.location.href='../transport/fueldistribution.php'" value="Add Fuel Distribution">
            </span></td>
            </tr>
			<?php } ?>
			<tr>
            <td></td>
          </tr>
       <tr>
	  <td><form metho="post" action="">
	  <div id="searchtable">
	  <table border="0" cellspacing="0" cellpadding="2" class="contenttableborder">
                <tr>
                  <td>Search Fuel distribution reports: </td>
                  <td><input name="searchfueldistribution" id="searchfueldistribution" type="text" size="20" value="<?php if(isset($_SESSION['searchfueldistribution'])){ echo $_SESSION['searchfueldistribution'];}?>"></td>
                  <td nowrap>Search By: 
                    <select name="type" id="type">
                      <option value="Date">Date</option>
					  <option value="Vehicle No">Vehicle No</option>
					  <option value="Petro Station" <?php if(isset($_GET['type']) && $_GET['type'] == "Petro Station"){ echo "selected";}?>>Petro Station</option>	
                    </select> 
					</td>
                  <td><input type="button" name="Button" value="Search Distribution Reports" onClick="pickFormItemTypeAndDirect('searchfueldistribution', '../transport/managefueldistribution.php?a=search&v=', 'Please enter date or vehicle number or petro station!')"></td>
                </tr>
              </table>
              </div></form></td>
            </tr>
			  <tr>
            <td></td>
          </tr>	  
			<?php
			if(howManyRows($query) == 0){          			
				echo "<tr><td>There are no fuel distribution reports to display.</td></tr>";
				echo "<tr><td><input type=\"button\" name=\"cancel\" id=\"cancel\" value=\"<< Back\" onClick=\"javascript:history.go(-1);\"></td></tr>";
		   	} else { 
			?>
          <tr>
            <td><div style="padding:4px;width:730px;height:350px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	<?php if(userHasRight($_SESSION['userid'], "191")){?>
                <td width="4%">Edit</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "191")){?>
				<td width="9%">Delete</td><?php } ?>
				<td width="11%" nowrap>Date</td>
                <td width="14%" nowrap>Vehicle No.</td>
                <td width="12%">No. of Litres</td>				
                <td width="50%">Petro Station</td>
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
                <?php if(userHasRight($_SESSION['userid'], "191")){?>
				<td><a href="../transport/fueldistribution.php?action=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify fuel distribution information.">Edit</a></td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "191")){?>
				<td><a href="#" onClick="javascript:deleteEntity('../transport/fueldistribution.php?id=<?php echo encryptValue($line['id']); ?>&action=delete', 'fueldistribution', '<?php echo $line['vehicleregno']; ?>')" class="normaltxtlink" title="Delete this entry.">Delete</a></td><?php } ?>
                
                <td><?php echo date("d-M-Y",strtotime($line['date'])) ; ?></td>
				<td><a href="../transport/viewvehicle.php?veh=<?php echo encryptValue($line['vehicleregno']); ?>" class="normaltxtlink" title="View Vehicle information."><?php echo $line['vehicleregno']; ?></a></td>
				<td align="center"><a href="../transport/viewdistribution.php?veh=<?php echo encryptValue($line['vehicleregno']); ?>&d=<?php echo encryptValue($line['date']) ; ?>" class="normaltxtlink" title="View details on the fuel purchased."><?php echo $line['litresreceived']; ?> (Details)</a></td>
				<td><?php echo $line['petrostation']; ?></td>
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
