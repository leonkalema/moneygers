<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();

if(isset($_GET['a']) && $_GET['a'] == "delete"){
	mysql_query("DELETE FROM assignmentseparations WHERE id = '".decryptValue($_GET['id'])."'");
} 

//Generate custom made query
if($_GET['a'] == "search"){
	$_SESSION['searchseparation'] = $_GET['v'];
	
	if($_GET['type'] == "from"){
		$wherestr = "s.assgnfrom = c.callsign";
	} else {
		$wherestr = "s.assgnto = c.callsign";
	}
	$query = "SELECT s.id, s.assgnfrom, s.assgnto, s.distance, s.description, c.client FROM assignmentseparations s, assignments c WHERE ".$wherestr." AND c.client LIKE '%".$_GET['v']."%' ORDER BY s.date_of_entry DESC";
	
} else {
	$query = "SELECT * FROM assignmentseparations ORDER BY date_of_entry DESC";
}




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Assignment Separations</title>
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
        <td class="headings">Manage Assignment Separations </td>
      </tr>
      <tr>
        <td>
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <?php if(userHasRight($_SESSION['userid'], "188")){?>
          <tr>
            <td><span class="label">
              <input name="newassignmentseparation" type="button" id="newassignmentseparation" onClick="javascript:document.location.href='../transport/addseparation.php'" value="Add Assignment Separation">
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
                  <td><b>Search Assignment Separations:</b><br>
                    (Enter all or part of the Client Name) </td>
                  <td><input name="searchseparation" id="searchseparation" type="text" size="20" value="<?php if(isset($_SESSION['searchseparation'])){ echo $_SESSION['searchseparation'];}?>"></td>
                  <td nowrap>&nbsp;&nbsp;Select Section: </td>
                  <td><select name="type" id="type">
				  <option value="to" <?php if($_GET['type'] != "from"){ echo "selected";}?>>TO</option>
				  <option value="from" <?php if(isset($_GET['type']) && $_GET['type'] == "from"){ echo "selected";}?>>FROM</option>
                  </select>
                  </td>
                  <td><input type="button" name="Button" value="Search Separations" onClick="pickFormItemTypeAndDirect('searchseparation', '../transport/assignmentseparations.php?a=search&v=', 'Please enter all or part of the client name.')"></td>
                </tr>
              </table>
              </div></form></td>
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
            <td><div style="padding:4px;width:730px;height:350px;overflow: auto">
			<table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
              <tr class="tabheadings">
			  	<?php if(userHasRight($_SESSION['userid'], "187")){?>
                <td width="4%">Edit</td><?php } ?>
				<?php if(userHasRight($_SESSION['userid'], "187")){?>
				<td width="9%">Delete</td><?php } ?>
				<td width="11%" nowrap>From</td>
                <td width="14%">To</td>
                <td width="12%" nowrap>Distance (Kms)</td>				
                <td width="50%">Description</td>
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
                <?php if(userHasRight($_SESSION['userid'], "187")){?>
				<td><a href="../transport/addseparation.php?a=edit&id=<?php echo encryptValue($line['id']); ?>" class="normaltxtlink" title="Modify the distance information.">Edit</a></td><?php } ?>
                <?php if(userHasRight($_SESSION['userid'], "187")){?>
				<td><a href="#" onClick="javascript:deleteEntity('../transport/assignmentseparations.php?id=<?php echo encryptValue($line['id']); ?>&a=delete', 'assignment separation', '<?php echo "From ".$line['assgnfrom']." To ".$line['assgnto']; ?>')" class="normaltxtlink" title="Delete this entry.">Delete</a></td><?php } ?>
                
                <td nowrap><?php 
				$clientfromarr = getRowAsArray("SELECT client FROM assignments WHERE callsign='".$line['assgnfrom']."' ");
				echo $line['assgnfrom']." <br>(".$clientfromarr['client'].")"; ?></td>
				<td nowrap><?php 
				$clienttoarr = getRowAsArray("SELECT client FROM assignments WHERE callsign='".$line['assgnto']."' ");
				echo $line['assgnto']." <br>(".$clienttoarr['client'].")";?></td>
				<td align="center"><?php echo $line['distance']?></td>
				<td><?php echo "<div style='width:150px'>".$line['description']."</div>"; ?></td>
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
