<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['id']) && !userHasRight($_SESSION['userid'], "67")){
	$url="../core/login.php";
	$_SESSION['errors'] = "You donot have permission to edit staff debt details";
	forwardToPage($url);
}

$loan=array();
//Set edit mode for the loan
if(isset($_GET['id']) || isset($_GET['a'])){
	$id = decryptValue($_GET['id']);
	$action = $_GET['a'];
	
	if(isset($_SESSION['formvalues']) && count($_SESSION['formvalues'])){
		$formvalues = $_SESSION['formvalues'];
	}
	
	//loan details from guard table
	$formvalues = getRowAsArray("SELECT * FROM loanapplications WHERE id = '".$id."'");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>Edit Staff Debt Application<?php } else if($action == "view"){?>View Staff Debt Application <?php } else { ?>Create Staff Debt Application<?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
<script type="text/javascript">
filePath = '../images/';
</script>
<script  language="javascript" src="../javascript/swazzcalendar.js" type="text/javascript"> </script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="750" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
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
        <td class="headings"><?php if(userHasRight($_SESSION['userid'], "65")){?><a href="../finance/manageguardloans.php">Manage Staff Debt</a> &gt; <?php }  if($action == 'edit') {?>
          Edit Staff Debt Application
          <?php } else if (isset($_GET['a']) && $_GET['a']=='view'){ echo "View Staff Debt Application"; } else {?>Create Staff Debt Application <?php } ?></td>
      </tr>
      <tr>
        <td><form action="processloan.php" method="post" name="loan" id="loan" onSubmit=" return isNotNullOrEmptyString('guardid', 'Please enter the guard ID or search and pick from list.') && isNotNullOrEmptyString('loanamount', 'Please enter the staff debt amount.')<?php if($action != 'edit') {?> && isNotNullOrEmptyString('appnletter', 'Please browse to add the scanned copy of the Guard\'s application letter.')<?php } ?>;"  enctype="multipart/form-data"><table width="100%" border="0" cellpadding="2" cellspacing="2">
		<?php if(isset($_SESSION['errors']) && $_SESSION['errors'] != ""){ ?>
		<tr>
            <td height="30" align="right">&nbsp;</td>
            <td class="redtext"><b><?php echo $_SESSION['errors'];
			$_SESSION['errors'] = "";
			?></b></td>
          </tr>
		<?php } ?>
          <tr>
            <td height="30" colspan="2" class="label"><font class="redtext">*</font> is a required field </td>
            </tr>
            <tr>
              <td align="right" class="label" valign="top" width="20%">Guard:<font class="redtext">*</font></td>
              <td width="80%"><?php if($action == "view"){
			  echo $formvalues['guardid'];
			  
			  $line = getRowasArray("SELECT p.firstname, p.lastname, p.othernames FROM persons p, guards g WHERE g.personid=p.id AND g.guardid = '".$formvalues['guardid']."'");
				echo " (". $line['firstname']." ".$line['lastname']." ".$line['othernames'].")"; 
			  } else {?>
			  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="28%" valign="top"><input type="text" name="guardid" id="guardid" value="<?php echo $formvalues['guardid'];?>"></td>
                  <td width="23%" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guardname_search','guardid','Searching...'); return false; ">Search for Guard</a>&nbsp;</td>
                  <td width="49%"><div id="guardname_search" style="width:200; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div></td>
                </tr>
              </table><?php } ?></td>
             </tr><tr>
              <td align="right" class="label">Staff Debt Amount:<font class="redtext">*</font> </td>
              <td><?php if($action == "view"){ echo "<div style=\"width:150px\">".number_format($formvalues['loanamount'])."</div>"; } else {?>
                <input name="loanamount" type="text" id="loanamount" value="<?php echo $formvalues['loanamount'];?>">
                <?php } ?></td>
             </tr>
                   
             <tr>
               <td align="right" class="label"><?php if(!isset($action)){?>Add Scanned <?php } ?>Application Letter:<font class="redtext">*</font></td>
               <td nowrap class="label"><?php if($action == "view"){?><img src="../images/file.gif" alt="Discipline File" border="0"> <?php  if(trim($formvalues['appnletter']) == ""){ echo "No Letter";} else {?><a href="../finance/<?php echo $formvalues['appnletter']; ?>" class="normaltxtlink"  title="View guard's application letter.">View Details</a><?php } } else {?>
                 <input type="file" name="appnletter" id="appnletter" />
                 <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                 <br>
                 (Max Upload Size: 10MB)<?php } ?></td>
             </tr>
             <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <?php if($action != "view"){ ?>
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="edit" id="edit" value="<?php 
			  if(isset($_GET['id']) && $_GET['id'] != ""){
			  	echo $_GET['id'];
			  } ?>">
			<?php } ?></td>
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
