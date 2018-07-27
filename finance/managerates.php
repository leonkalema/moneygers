<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Manage Rates</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
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
        <td class="headings">Manage Rates </td>
      </tr>
      <tr>
        <td><form action="../finance/rates.php" method="post" name="rateform" id="rateform"><table width="100%" border="0" cellpadding="5" cellspacing="2">
          
            <tr>
              <td nowrap class="label2">Client Rates:</td>
              <td valign="top" class="label2">Guard Rates:</td>
            </tr>
            <tr>
              <td width="50%" valign="top"><div id="div" style="width:350; height:200; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr class="tabheadings"><td>&nbsp;</td><td>Client</td><td>Call Sign</td>
				<td>Rate (Shs) </td>
				</tr>
                  <?php
				   		$result = mysql_query("SELECT id, callsign, client, rate FROM assignments WHERE isactive = 'Y' ORDER BY client");
				   		$i = 0;
						while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		if(($i%2)==0) {
				    			$rowclass = "evenrow";
				  			} else {
				     			$rowclass = "oddrow";
				  			}
							
							$row = "<tr class = \"".$rowclass."\"><td><input type=\"checkbox\" name=\"assignment[]\" id=\"assignment[]".$line['id']."\" value=\"".$line['id']."\"></td><td>".$line['client']."</td><td>".$line['callsign']."</td><td align=\"right\"><b>".number_format($line['rate'])."</b></td></tr>";
					  
					  		echo $row;
				   			$i++;
						}
				   ?>
                </table>
              </div></td>
              <td width="50%" valign="top"><div id="guardid_search" style="width:350; height:200; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;"><table width="100%" border="0" cellspacing="0" cellpadding="2">
			  <tr><td width="1%" nowrap><b class="label">Guard Name: </b></td>
			  <td width="99%"><input type="text" name="guardname" id="guardname"></td>
			  </tr>
			  <tr><td colspan="2"><input type="button" name="Button" value="Search &gt;&gt;" onClick="setDiv('../include/resultsforpage.php?area=return_guardrates&value=','guardrates_search','guardname','Searching...'); return false;"></td>
			  </tr>
			  <tr><td colspan="2"><div id="guardrates_search">&nbsp;</div></td></tr>
                </table>
               </div></td>
            </tr>
            
            <tr>
              <td><input type="submit" name="EditAssignmentRates" value="Edit Assignment Rates"onClick="showSelectedValue('isAssignments','YES')">
                <input type="hidden" name="isAssignments" id="isAssignments" value=""></td>
              <td><input type="submit" name="EditGuardRates" value="Edit Guard Rates"></td>
            </tr>
			 
        </table>		  
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
