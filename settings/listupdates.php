<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$assignment=array();
//Set edit mode for the assignment
if(isset($_GET['a'])){
	$area = $_GET['a'];
	$_SESSION['area'] = $area ;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - List Updates</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
<script type="text/javascript">
filePath = '../images/';
</script>
<script  language="javascript" src="../javascript/swazzcalendar.js" type="text/javascript"> </script>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings">List Updates</td>
      </tr>
      <tr>
        <td><form action="../core/processassignment.php" method="post" name="assignment" id="assignment" onSubmit=" return isNotNullOrEmptyString('clientname', 'Please enter the name of the client.') && isNotNullOrEmptyString('callsign', 'Please enter the assignment call sign.') && isNotNullOrEmptyString('servicetype', 'Please enter the name of the client.') && isNotNullOrEmptyString('start_day', 'Please select the day of the start date.') && isNotNullOrEmptyString('start_month', 'Please select the month of the start date.') && isNotNullOrEmptyString('starttime', 'Please select the start time of the assignment.') && isNotNullOrEmptyString('endtime', 'Please select the end time of the assignment.');"><table width="100%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td colspan="3">&nbsp;</td>
            </tr>
			<?php if($_SESSION['area'] == "leavetype"){?>
            <tr>
              <td width="16%" align="right" valign="top" class="label">Leave Type: <font class="redtext">&nbsp;</font><br></td>
              <td width="84%" colspan="2" valign="top" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="8%"><div id="leavetype_show">
                      <select id="leavetype" name="leavetype">
                        <?php echo generateSelectOptions(getAllLeaveTypes(), "");?>
                      </select>
                  </div></td>
                  <td colspan="2">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=leavetype','leavetype_add','','Loading...'); return false;">Add Leave Type </a> | <a href="#" onClick="setDiv('../include/showlist.php?area=leavetype','leavetype_show','','Loading...'); return false;">Refresh List </a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="2%">&nbsp;</td>
                  <td width="90%"><div id="leavetype_add" style="width:350; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
                </tr>
              </table></td>
              </tr>
		      <?php } 
			  
			  if($_SESSION['area'] == "district"){
			  ?>
			  <tr>
		        <td align="right" class="label">District:</td>
		        <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%"><div id="guarddistrict_show">
                  <select id="district" name="district">
                    <?php echo generateSelectOptions(getAllDistricts(), ""); ?>
                  </select>
                </div></td>
                <td colspan="2">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=district','guarddistrict_add','','Loading...'); return false;">Add District</a>  | <a href="#" onClick="setDiv('../include/showlist.php?area=district','guarddistrict_show','','Loading...'); return false;">Refresh List </a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="2%">&nbsp;</td>
                <td width="90%"><div id="guarddistrict_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
              </tr>
            </table></td>
		        </tr>
		      <?php 
			  }
			  
			  if($_SESSION['area'] == "tribe"){
			  ?>
			  <tr>
		        <td align="right" class="label">Tribe:</td>
		        <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%"><div id="guardtribe_show"><select id="tribe" name="tribe">
                  <?php echo generateSelectOptions(getAllTribes(), "");?>
                </select></div></td>
                <td colspan="2">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=tribe','guardtribe_add','','Loading...'); return false;">Add Tribe</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=tribe','guardtribe_show','','Loading...'); return false;">Refresh List </a> </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="2%">&nbsp;</td>
                <td width="85%"><div id="guardtribe_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
              </tr>
            </table></td>
		        </tr>
		      <?php } ?>
			  <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            </tr>
          
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include('../include/footer.php');?> </a></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
