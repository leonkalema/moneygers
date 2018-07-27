<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['save'])){
	$formvalues = array_merge($_POST);
	//Save the message
	mysql_query("INSERT INTO messages (reason,details,sentby,sentto,date) VALUES ('".$formvalues['reason']."','".$formvalues['details']."','".$_SESSION['userid']."','".implode(",",$formvalues['sentto'])."',now())");
	
	$_SESSION['msg'] = "Your message has been sent.";
}

if(isset($_GET['a']) && $_GET['a'] == "view"){
	$reminder = getRowAsArray("SELECT * FROM messages WHERE id = '".$_GET['id']."'");
	$name = getRowAsArray("SELECT firstname, lastname FROM users WHERE id='".$_GET['sby']."'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Send Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
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
        <td class="headings"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){ echo "View Request Sent By ";
		if(trim($_GET['sby']) != ""){
			echo $name['firstname']." ".$name['lastname'];
		} else {
			echo "System";
		}
		
		} else { ?>
          Send Request          <?php } ?></td>
      </tr>
      <tr>
        <td><form action="../settings/index.php" method="post" name="request" id="request" onSubmit=" return isNotNullOrEmptyString('reason', 'Please summarise your reason in the reason field.') && isNotNullOrEmptyString('details', 'Please enter the request details.');"><table width="100%" border="0">
         <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ ?>
		 <tr>
            <td colspan="2"><b><font class="redtext"><?php echo $_SESSION['msg'];
			$_SESSION['msg'] = "";
			?></font></b><br>
<br>
<a href="../core/dashboard.php"><< Back to the dashboard</a>.</td>
            </tr>
		 <?php } else {?>
		  <tr>
            <td colspan="2" class="label"><font class="redtext">*</font> is a required field </td>
            </tr>
		
          <tr>
           <td width="1%" align="right" nowrap class="label">Requested By:</td>
            <td colspan="3" nowrap width="99%"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
			echo $name['firstname']." ".$name['lastname'];
			} else { 
				echo $_SESSION['names']; 
			}?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sent To:<font class="redtext">*</font> </td>
            <td colspan="3" nowrap><?php 
			$sento_array = split(",", $reminder['sentto']);
						
			if(isset($_GET['a']) && $_GET['a'] == "view"){ 
				$userstr = "";
				for($k=0;$k<count($sento_array);$k++){
					$username = getRowAsArray("SELECT name FROM groups WHERE id='".$sento_array[$k]."'");
					if($userstr != ""){
						$userstr .= ", ".$username['name'];
					} else {
						$userstr = $username['name'];
					}
				}
				
				echo $userstr;
			} else { ?><div id="div" style="width:250; height:90; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;"><table width="100%" border="0" cellspacing="0" cellpadding="2">
			    <?php
						$result = mysql_query("SELECT * FROM groups");
						while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		$row = "<tr><td width=\"1%\"><input type=\"checkbox\" name=\"sentto[]\" value=\"".$line['id']."\"";
							//Administrators receive all communication by default.
					  		if($line['id'] == "1"){
								$row .= " checked";
							}
					  		$row .= "></td><td width=\"99%\">".$line['name'];
								
							$row .= "</td></tr>";
					  		echo $row;
				   		}
				   ?>
			    
			    </table>
               </div><?php } ?></td>
          </tr>
          <tr>
           <td align="right" class="label">Reason:<font class="redtext">*</font></td>
            <td colspan="3" nowrap><?php if(isset($_GET['a']) && $_GET['a'] == "view"){ echo $reminder['reason'];} else {?><input type="text" name="reason" id="reason" value="<?php echo $_GET['t'];?>"><?php } ?></td>
          </tr>
    
          <tr>
           <td align="right" class="label" valign="top">Details:<font class="redtext">*</font></td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
			echo "<div style=\"width:150px\">".$reminder['details']."</div>";
			} else {?><textarea name="details" cols="30" rows="5" id="details"></textarea><?php } ?></td>
          </tr>
		  
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);"><?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?>
              <input type="submit" name="save" id="save" value="Send &gt;&gt;">
              <?php } ?></td>
          </tr>
		  <?php } ?>
        </table>
        </form></td>
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
