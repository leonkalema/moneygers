<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
//today's date
$today=date("Y-m-d");
$wherestr = "";

if(isset($_POST['ArchiveLogs'])){
	$formvalues = array_merge($_POST);
	//Archive all selected logs
	for($i=0;$i<count($formvalues['log']);$i++){
		mysql_query("UPDATE logbook SET isactive = 'N' WHERE id='".$formvalues['log'][$i]."'");
	}
	forwardToPage("managevehiclelog.php?a=archive");
}

if(isset($_POST['ActivateLogs'])){
	$formvalues = array_merge($_POST);
	//Archive all selected complaints
	for($i=0;$i<count($formvalues['log']);$i++){
		mysql_query("UPDATE logbook SET isactive = 'Y' WHERE id='".$formvalues['log'][$i]."'");
	}
	forwardToPage("managevehiclelog.php");
}

if(isset($_GET['a']) && $_GET['a'] == "archive"){
	 $wherestr = "AND isactive = 'N'";
} else {
	 $wherestr = "AND isactive = 'Y'";
}

//Get the unik log dates
$logdatequery = ("SELECT id, logdate FROM logbook WHERE logdate <> '$today' ".$wherestr." GROUP BY logdate ORDER BY logdate DESC");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Previous Guard Schedules</title>
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
        <td class="headings">Previous Vehicle Logbooks (Before <?php echo date("d-M-Y",strtotime("now"));?>) </td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="managevehiclelog.php">
          <table width="100%" border="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                <input name="newschedule" type="button" id="newschedule" onClick="javascript:document.location.href='../transport/index.php'" value="View Today's Logbooks">
              [ <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ ?><a href="../transport/managevehiclelog.php" title="Displays active vehicle logs.">View Active Logs</a><?php } else {?><a href="../transport/managevehiclelog.php?a=archive" title="Displays vehicle logs which have been archived.">View Archive</a><?php } ?> ]   </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <?php
			 if (howManyRows($logdatequery)==0) {       			
				echo "<tr><td>There are no previous logbooks to display</td></tr>";
		   	} else { 
			?>
            <tr>
              <td><div style="padding:4px;width:720px;height:350px;overflow: auto">
                  <table width="100%" border="0" class="contenttableborder" cellpadding="2" cellspacing="0">
                    <tr class="tabheadings">
                      <td width="1%">&nbsp;</td>
                      <td width="19%">Date</td>
                      <td width="80%">Mobile (total per day) </td>
                    </tr>
                    <?php 
			  $result = mysql_query($logdatequery);
			  $i = 0;
			  while($line = mysql_fetch_array($result, MYSQL_ASSOC)) { 
			  	$log_date=$line['logdate'];
				$mob=$line['mobile'];
			      if(($i%2)==0) {
				     $rowclass = "evenrow";
				  } else {
				     $rowclass = "oddrow";
				  }
			   ?>
                    <tr class="<?php echo $rowclass; ?>">
                      <td valign="top"><input type="checkbox" name="log[]" id="log[]<?php echo $line['id']; ?>" value="<?php echo $line['id']; ?>"></td>
                      <td valign="top"><?php echo date("d-M-Y", strtotime($log_date)); ?></td>
                      <td><?php 
				$mobilequery = ("SELECT mobile, count(mobile) as mobiles FROM logbook WHERE logdate = '".$line['logdate']."' GROUP BY mobile ORDER BY logdate DESC") ; 
				$res = mysql_query($mobilequery);
			 	$j = 0;
				$total=0;
			  	while($rows = mysql_fetch_array($res, MYSQL_ASSOC)) { 
					$total=$rows['mobiles'];
					$mob=$rows['mobile'];
				?>
                          <a href="../transport/vehiclelog.php?action=view&mobile=<?php echo $mob; ?>&logdate=<?php echo $line['logdate']; ?>" title="View Vehicle log book."><?php echo $mob; ?></a>
                          <?php 
				$j++; 
				} ?>
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
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><span class="label">
                <input type="submit"  <?php if(isset($_GET['a']) && $_GET['a'] == "archive"){ echo "name=\"ActivateLogs\" value=\"Re-Activate\""; } else { echo "name=\"ArchiveLogs\" value=\"Archive\"";} ?>>
              </span></td>
            </tr>
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
