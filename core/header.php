<?php 
authenticateUser($_SESSION['userid'],$_SESSION['groups']); 

$currentActivePage = selfURL();
	
	$auditQuery = "INSERT INTO audittrail(username,workStation,page_Visited,time_Visited) VALUES ('".$_SESSION['username']."','".$_SERVER['REMOTE_ADDR']."','".$currentActivePage."',now())";
	mysql_query($auditQuery) or die ("Invalid query: ".mysql_error()."<br/>".mysql_errno());
	

	

?>
<link href="../styles/ultimatesecurity.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="3" align="left" valign="top" class="smallerheadings"><strong>Welcome,
            <a href="../core/viewuser.php?id=<?php echo encryptValue($_SESSION['userid']);?>" title="Displays your profile" class="smallerheadings" ><?php echo $_SESSION['names'];?></a></strong></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="middle">&nbsp;</td>
          <td align="right" valign="middle">&nbsp;</td>
        </tr>
        <tr> 
          <td width="211" align="left" valign="top"><img src="../images/logo.png"></td>
          <td width="320" align="left" valign="middle"><span style="font:Arial, Helvetica, sans-serif; font-size:14px; color:#FFFFFF"></a></span></td>
          <td width="199" align="right" valign="middle"><a href="../core/dashboard.php" class="headertxt" title="Go to Dashboard.">Dashboard</a><span class="headertxt"> | </span><a href="../settings/settings.php" class="headertxt" title="Click here to go to settings.">Settings</a><a href="#" class="headertxt"></a><span class="headertxt"> | </span><a href="../core/logout.php" class="headertxt" title="Click here to logout.">Logout</a><span class="headertxt"> | </span><a href="../help/index.php" class="headertxt" title="Click here to view the help section.">Help</a>&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="middle">&nbsp;</td>
          <td align="right" valign="middle">&nbsp;</td>
        </tr>
</table>
