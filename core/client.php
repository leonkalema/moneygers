<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

$action = $_GET['action'];
$id = decryptValue($_GET['id']);

if( isset($_GET['id']) && !userHasRight($_SESSION['userid'], "53")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You donot have permission to edit Client details";
	forwardToPage($url);
}

if($action == 'edit') {
	$data = getRowAsArray("SELECT * FROM clients WHERE id = '".$id."'");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Client<?php } else {?>Create Client<?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
filePath = '../images/';
</script>
<script  language="javascript" src="../javascript/swazzcalendar.js" type="text/javascript"> </script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
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
        <td class="headings"><a href="manageclients.php">Manage Clients</a> &gt; <?php if($action == 'edit') {?>Edit Client<?php } else {?>Create Client<?php } ?></td>
      </tr>
      <tr>
        <td><form action="processclient.php?id=<?php echo $_GET['id'];?>" method="post" name="client" id="client" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the client.') && isNotNullOrEmptyString('plotno', 'Please enter the plot number for the client.') && isNotNullOrEmptyString('boxno', 'Please enter post office box number for the client.') && isNotNullOrEmptyString('contname', 'Please enter the client contact name.') && isNotNullOrEmptyString('contposition', 'Please enter the client contact position.') && isNotNullOrEmptyString('contphone', 'Please enter the client contact phone.');"><table width="100%" border="0" cellpadding="4">
          <tr>
            <td align="right"><font class="redtext">*</font> is a required field </td>
            <td colspan="2"><input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
              <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
              <input type="hidden" name="createdby" id="createdby" value="<?php echo $_SESSION['userid']; ?>">
              <input type="hidden" name="lastupdatedby" id="lastupdatedby" value="<?php echo $_SESSION['userid']; ?>"></td>
          </tr>
		
          <tr>
            <td height="24" align="right" class="label" width="1%" nowrap>Name:<font class="redtext">*<br>
            </font><span class="label">(Organisation/Individual)</span>              </td>
            <td colspan="2">
              <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>">            </td>
          </tr>
          <tr>
            <td rowspan="3" align="right" valign="top" class="label">Address:</td>
            <td width="1%" class="list" nowrap>Plot No:<span class="redtext">*</span> <br>
              (Street/Adress)</td>
            <td width="98%"><input type="text" name="plotno" id="plotno" value="<?php echo $data['plotno']; ?>"></td>
          </tr>
          <tr>
            <td class="list">P. O. Box: <span class="redtext">*</span> </td>
            <td><input type="text" name="boxno" id="boxno" value="<?php echo $data['boxno']; ?>"></td>
          </tr>
          <tr>
            <td class="list" nowrap>FLoor &amp; Room No: <br>(If Applicable)</td>
            <td><input type="text" name="floorno" id="floorno" value="<?php echo $data['floorno']; ?>"></td>
          </tr>
          <tr>
            <td align="right" class="label">Building Name: <span class="redtext">*</span></td>
            <td colspan="2"><input type="text" id="buildname" name="buildname" value="<?php echo $data['buildname']; ?>"></td>
          </tr>
          <tr>
            <td align="right" class="label">Telephone(s):</td>
            <td colspan="2"><input type="text" id="genphone" name="genphone" value="<?php echo $data['genphone']; ?>"> <br>if entereing more than 1, separate telephone numbers using a comma (,)</td>
            </tr>
          <tr>
            <td align="right" class="label">Contact Name: <span class="redtext">*</span></td>
            <td colspan="2"><input type="text" id="contname" name="contname" value="<?php echo $data['contname']; ?>"></td>
          </tr>
          
          <tr>
            <td align="right" class="label">Contact's Position: <span class="redtext">*</span></td>
            <td colspan="2"><input type="text" id="contposition" name="contposition" value="<?php echo $data['contposition']; ?>"></td>
          </tr>
          <tr>
            <td align="right" class="label">Mobile:<span class="redtext"> *</span> </td>
            <td colspan="2"><input type="text" id="contphone" name="contphone" value="<?php echo $data['contphone']; ?>"></td>
          </tr>
          <tr>
            <td align="right" class="label">Fax:</td>
            <td colspan="2"><input type="text" id="fax" name="fax" value="<?php echo $data['fax']; ?>"></td>
          </tr>
          <tr>
            <td align="right" class="label">Email:</td>
            <td colspan="2"><input type="text" id="email" name="email" value="<?php echo $data['email']; ?>"></td>
          </tr>
          <tr>
            <td align="right" class="label">The Client is:</td>
            <td colspan="2">
              <input name="activity" type="radio" value="Y" <?php if($data['isactive'] == 'Y' || !isset($data['isactive'])){ echo "checked";}?>> 
                Is Active            
               &nbsp;&nbsp;
               
			   <input type="radio" name="activity" value="N" <?php if($data['isactive'] == 'N'){ echo "checked";}?>>
Not Active </td>
          </tr>
          
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="2"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo "YES";
			  } ?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
