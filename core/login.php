<?php
	include_once '../include/commonfunctions.php';
	// initialize a session
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge -
<?php 		  if(isset($_GET['a']) && $_GET['a'] == "forgotpw"){ echo "Forgot Password";} else {?>
Login
<?php } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
</head>
<body class="mainbackground" topmargin="0" bottommargin="0" style="padding-top:20px;">
<center>
<table width="900" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="44%" align="right" valign="top"><img src="../images/logo.png"></td>
    <td width="56%" align="left" valign="middle">
	<a href="../core/login.php?a=forgotpw" class="headertxt" title="Click here to recover lost password">Forgot my Password</a>
       <span class="headertxt" title="Click here to login.">|</span> <a href="http://newwavetech.co.ug/" class="headertxt">About MONEYGE</a><span class="headertxt" title="Click here to login."> 
            | </span><a href="../help/index.php" class="headertxt" title="Click here to view the help section">Help</a></td>
  </tr>
  <tr><td colspan="2" height="350" align="center" valign="middle">
  <font color="#ffff00;"><?php echo $_SESSION['errors'];?></font>
    <table width="39%" border="0">
      
<tr>
        <td><form action="processlogin.php" method="post" name="login" id="login" onSubmit="return isNotNullOrEmptyString('username', 'Please enter the username of the user.')<?php 
		  if(!(isset($_GET['a']) && $_GET['a'] == "forgotpw")){ ?> &&  isNotNullOrEmptyString('password', 'Please enter the password of the user.')<?php } ?>;"><table width="100%" border="0">
          <tr>
            <td colspan="2" align="center"></td>
          </tr>
		  <?php 
		  if(isset($_GET['a']) && $_GET['a'] == "forgotpw"){ ?>
		  <tr>
		    <td colspan="2" class="label">Enter your username below and the admin will send your password to your registered email.</td>
		    </tr>
		  <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ ?>
		  <tr>
		    <td colspan="2"></td>
		    </tr>
		 <?php 
		 	$_SESSION['msg'] = "";
		 } else { ?>
		  <tr>
            <td align="right" class="label"> Username:<font class="redtext">*</font></td>
            <td align="left"><input type="text" name="username" id="username" value="" onClick="this.value=''"></td>
          </tr>
		  <tr>
            <td align="right" class="label">&nbsp;</td>
            <td align="left"><input type="submit" name="forgotpw" id="forgotpw" value="SEND US YOUR REGISTERED USERNAME"></td>
          </tr>
		  <?php } 
		  } else { ?>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td align="left"><input type="text" name="username" id="username" value="Username" onFocus="if(this.value=='Username')this.value=''" onBlur="if(this.value=='')this.value='Username'"></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td align="left"><input type="password" name="password" id="password" value="password" onFocus="if(this.value=='password')this.value=''" onBlur="if(this.value=='')this.value='password'"></td>
          </tr>
		 
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="submit" name="button" id="button" value="LOGIN"></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr> <?php } ?>
        </table>
        </form></td>
      </tr>	  
	  </table>
   
      </td>
  </tr>
</table>
</center>
</body>
</html>
