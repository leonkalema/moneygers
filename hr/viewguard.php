<?php
include_once "../class/class.guard.php";
include_once "../class/class.person.php";
include_once "../class/class.place.php";
session_start();
$guard = new Guard;
$persondetails = new Person;
$fatherdetails = new Person;
$motherdetails = new Person;
$personaladdress = new Place;
$homeaddress = new Place;
$fatheraddress = new Place;
$motheraddress = new Place;
$id = $_GET['id'];
$guard->get($id);
$persondetails->get($guard->getPersonId());
$personaladdress->get($persondetails->getAddressId());
$fatherdetails->get($guard->getFatherId());
$fatheraddress->get($fatherdetails->getAddressId());
$motherdetails->get($guard->getMotherId());
$motheraddress->get($motherdetails->getAddressId());
$homeaddress->get($persondetails->getHomeId());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - View Guard
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<script type="text/javascript" src="../javascript/tabber.js"></script>
<style type="text/css">
<!--
.style1 {color: #FFFF00}
-->
</style>
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
    <td colspan="2" align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellpadding="0" cellspacing="0">
      <tr>
        <td class="headings">
            View Guard
          </td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td align="right">&nbsp;</td>
            <td>&nbsp;			</td>
          </tr>
          <tr>
            <td align="senter" class="redtext" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><div class="tabber">

     <div class="tabbertab">
	  <h2 class="style1">General</h2>
	  <p><table width="100%" border="0">
          <tr>
            <td align="right" class="label">Identification Number: </td>
            <td><?php echo $guard->getGuardId(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label" width="50%">Firstname:</td>
            <td><?php echo $persondetails->getFirstName(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Lastname:</td>
            <td><?php echo $persondetails->getLastName(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Other Names :</td>
            <td><?php echo $persondetails->getOtherNames(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Last Name at Birth (if different) :</td>
            <td><?php echo $persondetails->getBirthLastName(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label" valign="top">Photograph:</td>
            <td></td>
          </tr>
          <tr>
            <td align="right" class="label">Finger Print:</td>
            <td></td>
          </tr>
          <tr>
            <td align="right" class="label">Date of Employment:</td>
            <td><?php echo changeMySQLDateToPageFormat($guard->getDateOfEmployment()); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Country of Nationality:</td>
            <td>
              <?php echo $persondetails->getNationality();?>           </td>
          </tr>
          <tr>
            <td align="right" class="label">Tribe:</td>
            <td><?php echo $persondetails->getTribe(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Date of Birth: </td>
            <td><?php echo changeMySQLDateToPageFormat($persondetails->getDateOfBirth()); ?></td>
          </tr>
        </table>
	  </p>
     </div>


     <div class="tabbertab">
	  <h2 class="style1">Address</h2>
	  <p><table width="100%" border="0" cellpadding="2" cellspacing="2">
 
           <tr>
            <td colspan="4" class="subheadingtxt">Present Address - When Working </td>
            </tr>
          <tr>
            <td align="right" class="label">Plot No.: </td>
            <td><?php echo $personaladdress->getPlotNumber(); ?></td>
            <td align="right" class="label">District:</td>
            <td><?php echo $personaladdress->getDistrict(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label" width="25%">Village:</td>
            <td width="25%"><?php echo $personaladdress->getVillage(); ?></td>
            <td align="right" class="label">LC 1 Chairman:</td>
            <td><?php echo $personaladdress->getLc1Chairman(); ?></td>
          </tr>
          <tr>
<td align="right" class="label">Parish:</td>
            <td><?php echo $personaladdress->getParish(); ?></td>            
            <td align="right" class="label">LC 1 Chairman Telephone:</td>
            <td><?php echo $personaladdress->getLc1Telephone(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php echo $personaladdress->getSubcounty(); ?></td>
            <td align="right" class="label">LC 2 Chairman: </td>
            <td><?php echo $personaladdress->getLc2Chairman(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">County:</td>
            <td><?php echo $personaladdress->getCounty(); ?></td>
            <td align="right" class="label">LC 2 Chairman Telephone: </td>
            <td><?php echo $personaladdress->getLc2Telephone(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Town:</td>
            <td><?php echo $personaladdress->getTown(); ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
		  <tr>
            <td colspan="4" class="subheadingtxt">Family Home/Up Country Address </td>
            </tr>
          <tr>
            <td align="right" class="label">Plot No.: </td>
            <td><?php echo $homeaddress->getPlotNumber(); ?></td>
            <td align="right" class="label">District:</td>
            <td><?php echo $homeaddress->getDistrict(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label" width="25%">Village:</td>
            <td width="25%"><?php echo $homeaddress->getVillage(); ?></td>
            <td align="right" class="label">LC 1 Chairman:</td>
            <td><?php echo $homeaddress->getLc1Chairman(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php echo $homeaddress->getSubcounty(); ?></td>
            <td align="right" class="label">LC 1 Chairman Telephone:</td>
            <td><?php echo $homeaddress->getLc1Telephone(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">County:</td>
            <td><?php echo $homeaddress->getCounty(); ?></td>
            <td align="right" class="label">LC 2 Chairman: </td>
            <td><?php echo $homeaddress->getLc2Chairman(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Town:</td>
            <td><?php echo $homeaddress->getTown(); ?></td>
            <td align="right" class="label">LC 2 Chairman Telephone: </td>
            <td><?php echo $homeaddress->getLc2Telephone(); ?></td>
          </tr>

        </table></p>
     </div>


     <div class="tabbertab">
	  <h2>Parents</h2>
	  <p><table width="100%" border="0" cellpadding="2" cellspacing="2">
 
           <tr>
            <td colspan="4" class="subheadingtxt">Father Details </td>
            </tr>
          <tr>
            <td align="right" class="label">Firstname: </td>
            <td><?php echo $fatherdetails->getFirstName(); ?></td>
            <td align="right" class="label">County:</td>
            <td><?php echo $fatheraddress->getCounty(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label" width="25%">Lastname:</td>
            <td width="25%"><?php echo $fatherdetails->getFirstName(); ?></td>
            <td align="right" class="label">District:</td>
            <td><?php echo $fatheraddress->getDistrict(); ?></td>
          </tr>
          <tr>
<td align="right" class="label">Other names: </td>
            <td><?php echo $fatherdetails->getOtherNames(); ?></td>            
            <td align="right" class="label">Telephone:</td>
            <td><?php echo $fatheraddress->getTelephone(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Is Alive: </td>
            <td> 
			<?php echo changeBinaryToPageValues($fatherdetails->isAlive); ?></td>
            <td align="right" class="label">Present Occupation: </td>
            <td><?php echo $fatherdetails->getOccupation(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php echo $fatheraddress->getVillage(); ?></td>
            <td align="right" class="label">Employer:</td>
            <td><?php echo $fatherdetails->getEmployer(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php echo $fatheraddress->getSubcounty(); ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
           <tr>
            <td colspan="4" class="subheadingtxt">Mother Details </td>
            </tr>
          <tr>
            <td align="right" class="label">Firstname: </td>
            <td><?php echo $motherdetails->getFirstName(); ?></td>
            <td align="right" class="label">County:</td>
            <td><?php echo $motheraddress->getCounty(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label" width="25%">Lastname:</td>
            <td width="25%"><?php echo $motherdetails->getFirstName(); ?></td>
            <td align="right" class="label">District:</td>
            <td><?php echo $motheraddress->getDistrict(); ?></td>
          </tr>
          <tr>
<td align="right" class="label">Other names: </td>
            <td><?php echo $motherdetails->getOtherNames(); ?></td>            
            <td align="right" class="label">Telephone:</td>
            <td><?php echo $motheraddress->getTelephone(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Is Alive: </td>
            <td> 
			<?php echo changeBinaryToPageValues($fatherdetails->isAlive());?></td>
            <td align="right" class="label">Present Occupation: </td>
            <td><?php echo $motherdetails->getOccupation(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php echo $motheraddress->getVillage(); ?></td>
            <td align="right" class="label">Employer:</td>
            <td><?php echo $motherdetails->getEmployer(); ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php echo $motheraddress->getSubcounty(); ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  </table></p>
     </div>
	 
     <div class="tabbertab">
	  <h2 class="style1">Family</h2>
	  <p>Family content.</p>
     </div>
	 
     <div class="tabbertab">
	  <h2 class="style1">Beneficiaries</h2>
	  <p>Beneficiaries content.</p>
     </div>
	 
     <div class="tabbertab">
	  <h2 class="style1">History</h2>
	  <p>History content.</p>
     </div>
	 
     <div class="tabbertab">
	  <h2>Referees</h2>
	  <p>Referees content.</p>
     </div>
	 
     <div class="tabbertab">
	  <h2>Verifications</h2>
	  <p>Verifications content.</p>
     </div>
	 
     <div class="tabbertab">
	  <h2>Documents</h2>
	  <p>Documents content.</p>
     </div>

</div></td>
            </tr>
          <tr>
            <td colspan="2" align="center" class="label">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="button" name="returntolist" value="Manage Guards" onClick="javascript:document.location.href='../hr/manageguards.php'">
              <input type="button" name="newguard" value="Add New Guard" onClick="javascript:document.location.href='../hr/guard.php'">
              <input type="button" name="editguard" value="Edit Guard" onClick="javascript:document.location.href='../hr/guard.php?id=<?php echo $_GET['id']; ?>&action=edit'">
              </td>
            </tr>
        </table>
        </td>
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
