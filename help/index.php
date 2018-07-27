<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Help Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0" onLoad="setDiv('helpindex.php','helpindex','','loading...')">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="contenttableborder">
      <tr>
        <td class="headings">GuardSECURE Help</td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td width="30%" nowrap style="border-bottom: 1px solid #adaefe;"><form name="form1" method="post" action="">
              <table border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td><b>Search:</b></td>
                  <td><input name="search" type="text" id="search" size="24" onKeyDown="setDiv('helpindex.php?value=','helpindex','search','loading...')"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3">(Enter your key and it will automatically be searched among the topics.) </td>
                  </tr>
              </table>
            </form></td>
            <td style="border-left: 1px solid #adaefe; border-bottom: 1px solid #adaefe;" width="1%">&nbsp;</td>
            <td width="69%" valign="top" style="border-bottom: 1px solid #adaefe;"><a href="../help/index.php" title="Go to help home page.">&lt;&lt; Help Home</a><?php if($_SESSION['groups'] == "1"){?> | <a href="../help/addsection.php" title="Create a new help section.">New Section</a> | <a href="../help/managesection.php" title="Manage help section.">Manage Sections</a> <?php } else { 
			
			if(isset($_SESSION['groups'])){ 
				echo " | <a href='../core/logout.php' title='Click here to login.'>Logout</a>";
			} else {
			?> | <a href="../core/login.php" title="Click here to login.">Login</a><?php 
			} 
			
			} if(isset($_SESSION['groups'])){
				?> | <a href="../core/dashboard.php" title="Go to Dashboard.">Dashboard >></a><?php 
			} ?></td>
          </tr>
          
          <tr>
            <td valign="top"><div id="helpindex" style="width:230; height:430; overflow: auto;">
                
              </div></td>
            <td style="border-left: 1px solid #adaefe;" width="1%">&nbsp;</td>
            <td valign="top"><div id="helpdetails" style="width:500; height:430; font-family: verdana; color:#000066; font-weight:bolder; font-size:14px; overflow: auto;">
              <p class="label2">Welcome to the GuardSECURE help home.<br>
                  <br>
                Please use the menu on the left or enter what you are looking for in the search and click Go.</p>
              <p><a href="../settings/index.php">Click here</a> <span class="label2">to contact the system administrator if you cant find the help you need</span></p>
              </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
