<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['savesettings'])){
	$formvalues = array_merge($_POST);
	// save the logo and upload
	$formvalues['logoname'] = uploadPhoto($_FILES['logofilename']['tmp_name'], $_FILES['logofilename']['name'], $_FILES['logofilename']['size'], $formvalues['MAX_FILE_SIZE'], $_FILES['logofilename']['error'], "../images/");
	
	mysql_query("UPDATE settings SET employeenssfrate = '".$formvalues['employeenssfrate']."', employernssfrate = '".$formvalues['employernssfrate']."', companyname='".$formvalues['companyname']."', employerno='".$formvalues['employerno']."', companytinno='".$formvalues['companytinno']."', customerserviceemail='".$formvalues['customerserviceemail']."', expirydate='".changeDateFromPageToMySQLFormat($formvalues['systemexpirydate'])."', serveripaddress='".$formvalues['serveripaddress']."', companylogo='".$formvalues['logoname']."', pobox='".$formvalues['pobox']."',headqtrscity = '".$formvalues['headqtrscity']."', headqtrscountry ='".$formvalues['headqtrscountry']."', contacttelphone = '".$formvalues['contacttelphone']."', abbreviation='".$formvalues['abbreviation']."', VATrate='".$formvalues['VATrate']."'");
	if(mysql_error() != ""){
		$msg = "There were problems saving your changes on the system settings.";
	} else {
		$msg = "Your changes on the system settings have been successfully saved.";
	}
}
$setings = getRowAsArray("SELECT * FROM settings");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Settings for <?php echo $_SESSION['names'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="900" border="0" align="center" cellpadding="2" cellspacing="2">
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
    <td colspan="2" align="center" valign="top"><table width="98%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings">Settings for <?php echo $_SESSION['names'];?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="5">
		  <tr>
            <td class="label" width="235">Your User Profile </td>
			<?php if (isset($_GET['cs']) && $_GET['cs'] == $setings['employerno'] ) {?>
            <td rowspan="23" width="589" valign="top"style="width:350; height:350; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;">
              <form name="form1" method="post" action="settings.php" enctype="multipart/form-data">
                <?php if(userHasRight($_SESSION['userid'], "138")){?>
				<table width="100%" border="0" cellpadding="5">
                  <?php if(isset($msg) && $msg != ""){?>
				  <tr>
                    <td colspan="2" class="redtext"><b><?php echo $msg;?></b></td>
                  </tr>
				   <?php 
				   	$msg = "";
				   }?>
				  <tr>
                    <td colspan="2" class="label">Global Settings </td>
                  </tr>
                  <tr>
                    <td width="39%" nowrap="nowrap">Employee NSSF Rate: </td>
                    <td width="61%" nowrap="nowrap"><input type="text" name="employeenssfrate" value="<?php echo $setings['employeenssfrate'];?>">
                      %</td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap">Employer NSSF Rate: </td>
                    <td nowrap="nowrap"><input type="text" name="employernssfrate" value="<?php echo $setings['employernssfrate'];?>">
                    %</td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap">Company Name: </td>
                    <td nowrap="nowrap"><input type="text" name="companyname" value="<?php echo $setings['companyname'];?>"></td>
                  </tr>
                  <tr>
                    <td>Company Logo : </td>
                    <td><?php if($setings['companylogo'] != ""){
			echo "<img src=\"".$setings['companylogo']."\" width=\"130\" height=\"120\" border=\"1\"> <br><br>Change Logo: ";
			}?><input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <input  type="file" name="logofilename" id="logofilename" size="40"></td>
                  </tr>
                  <tr>
                    <td>Employer No: </td>
                    <td><input type="text" name="employerno" value="<?php echo $setings['employerno'];?>"></td>
                  </tr>
                  <tr>
                    <td>Company Tin No: </td>
                    <td><input type="text" name="companytinno" value="<?php echo $setings['companytinno'];?>"></td>
                  </tr>
                  <tr>
                    <td>Customer Service Email: </td>
                    <td><input type="text" name="customerserviceemail" value="<?php echo $setings['customerserviceemail'];?>"></td>
                  </tr>
                  <tr>
                    <td>System Expiry Date: </td>
                    <td><input type="text" name="systemexpirydate" value="<?php echo date("d-M-Y",strtotime($setings['expirydate']));?>"></td>
                  </tr>
                  <tr>
                    <td>Server IP Address:</td>
                    <td><input type="text" name="serveripaddress" value="<?php echo $setings['serveripaddress'];?>"></td>
                  </tr>
                  
                  <tr>
                    <td>P.O.Box:</td>
                    <td><input type="text" name="pobox" value="<?php echo $setings['pobox'];?>"></td>
                  </tr>
                  <tr>
                    <td>Headquarters City:</td>
                    <td><input type="text" name="headqtrscity" value="<?php echo $setings['headqtrscity'];?>"></td>
                  </tr>
                  <tr>
                    <td>Headquarters Country:</td>
                    <td><input type="text" name="headqtrscountry" value="<?php echo $setings['headqtrscountry'];?>"></td>
                  </tr>
                  <tr>
                    <td>Contact Telephone: </td>
                    <td><input type="text" name="contacttelphone" value="<?php echo $setings['contacttelphone'];?>"></td>
                  </tr>
                  <tr>
                    <td>Abbreviation:</td>
                    <td><input type="text" name="abbreviation" value="<?php echo $setings['abbreviation'];?>"></td>
                  </tr>
                  <tr>
                    <td>V.A.T Rate: </td>
                    <td><input type="text" name="VATrate" value="<?php echo $setings['VATrate'];?>"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="savesettings" value="Update"></td>
                  </tr>
                </table>
				<?php } ?>
                </form>				  </td>
				  <?php } ?>
		  </tr>
		
          <tr>
           <td align="left" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/viewuser.php?id=<?php echo encryptValue($_SESSION['userid']);?>" title="Displays your profile">View Profile </a></td>
            </tr>
          <tr>
            <td align="left" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/user.php?id=<?php echo encryptValue($_SESSION['userid']);?>&action=edit" title="Edit your profile">Edit Profile  </a></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/favorites.php" title="Enables you to set favorites that will appear on your dashbord.">Update Favorites </a></td>
          </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "128")){?> <td align="left" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;[ <a href="../settings/index.php" title="Send message to other user groups">Contact Others</a> ] </td><?php } ?>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
		  
          <tr>
            <td align="left" class="label">Module Settings </td>
            </tr>
          <tr>
            <?php if(userHasRight($_SESSION['userid'], "125")){?> <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="payeformula.php" title="Update the PAYE formulae.">PAYE Formulae </a></td><?php } ?>
            </tr>
          <tr>
            <?php if(userHasRight($_SESSION['userid'], "126")){?> <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/manageleavetypes.php" title="Create, edit or delete leave types.">Leave Types</a></td><?php } ?>
            </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "127")){?>  <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managedistricts.php" title="Add new districts, edit or delete district details.">Districts</a></td><?php } ?>
            </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "129")){?>  <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managetribes.php" title="Add new tribes, edit or delete tribe details.">Tribes</a></td><?php } ?>
            </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "130")){?>  <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managerights.php" title="Create new user right, modify or delete user rights.">User Rights</a></td><?php } ?>
            </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "131")){?>  <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managegroups.php" title="Create new user groups, manage user groups, members and user rights.">Manage User Groups</a></td><?php } ?>
          </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "132")){?>  <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managedisciplineactions.php" title="Add, edit or delete disciplinary actions.">Disciplinary Actions </a></td><?php } ?>
          </tr> 
		  <tr>
           <?php if(userHasRight($_SESSION['userid'], "132")){?> 
            <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managejobtitles.php" title="Add, modify Job titles.">Job Titles </a> </td>
			<?php } ?>
          </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "133")){?> <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/manageservicetypes.php" title="Add new service types, edit or delete service types.">Service Types  </a></td><?php } ?>
          </tr>
          <tr>
            <?php if(userHasRight($_SESSION['userid'], "134")){?><td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/manageitemtypes.php" title="Create, edit or delete guard equipment.">Guard Equipment</a></td><?php } ?>
          </tr>
		   <tr>
            <?php if(userHasRight($_SESSION['userid'], "194")){?><td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managealarmsystems.php" title="Create, edit or delete alarm systems.">Alarm Systems</a></td><?php } ?>
          </tr>
		   <tr>
            <?php if(userHasRight($_SESSION['userid'], "195")){?><td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/manageguarduniform.php" title="Create, edit or delete guard uniform.">Guard Uniform</a></td><?php } ?>
          </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "135")){?> <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/manageitemstatus.php" title="Create, edit or delete item status.">Item Status </a></td><?php } ?>
          </tr>
          <tr>
            <?php if(userHasRight($_SESSION['userid'], "136")){?><td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/manageguardstatus.php" title="Create, edit or delete guard status.">Guard Status </a></td><?php } ?>
          </tr>
		   <tr>
            <?php if(userHasRight($_SESSION['userid'], "185")){?><td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managepaymentforms.php" title="Create, edit or delete payment forms.">Payment Forms</a></td><?php } ?>
          </tr>
		  <tr>
            <?php if(userHasRight($_SESSION['userid'], "164")){?><td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managesuppliers.php" title="Create, edit or delete suppliers.">Company Suppliers</a></td><?php } ?>
          </tr>
          <tr>
            <?php if(userHasRight($_SESSION['userid'], "165")){?><td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managedepartments.php" title="Create, edit or delete departments.">Company Departments</a></td><?php } ?>
          </tr>
		  <tr>
            <?php if(userHasRight($_SESSION['userid'], "197")){?>
            <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/manageaccounts.php" title="Create, edit or delete accounts.">Finance Accounts</a></td>
            <?php } ?>
          </tr>
		  <tr>
            <?php if(userHasRight($_SESSION['userid'], "201")){?>
            <td align="left">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../core/managefinancecategories.php" title="Create, edit or delete finance categories.">Finance Categories</a></td>
            <?php } ?>
          </tr>
          <tr>
           <?php if(userHasRight($_SESSION['userid'], "137")){?> <td align="left" valign="top">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../trail/index.php" title="View audit trail.">View Audit Trail  </a></td>
           <?php } ?>
          </tr>
        </table>
       </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include('../include/footer.php');?></a></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
