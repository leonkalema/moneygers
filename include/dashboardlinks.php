<?php
//Page returns a list of links for the dashboard
include_once "../include/commonfunctions.php";
openDatabaseConnection();

if($_GET['area'] == "HR"){ ?>
<table  width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr align="center" valign="top">
    <td colspan="2" align="left" class="innertableheaderbg"><span class="bigheaders"><b>Administration and HR: </b></span></td>
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "45")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../core/managegroups.php"  title="Create new user groups, edit groups and add users to groups">Manage user groups </a></td>
    <?php } ?>	
  </tr>
  
  <tr valign="top">
    <?php if(userHasRight($_SESSION['userid'], "132")){?>
	<td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../hr/managepersonnel.php"  title="Create, view, edit and/or delete staff's personnel file">Track staff discipline</a></td>
	<?php } ?>	
  </tr>
  
  <tr valign="top">
    <?php if(userHasRight($_SESSION['userid'], "163")){?>
	<td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../hr/periodofservice.php"  title="View period in years or months that staff has been working.">View staff period of service</a></td>
	<?php } ?>	
  </tr>
</table>
<?php }else if($_GET['area'] == "operations"){ ?>
<table width="100%"  border="0" cellpadding="5" cellspacing="0">
  <tr align="center" valign="top">
    <td colspan="2" align="left" class="innertableheaderbg"><span class="bigheaders"><b>Operations Management: </b></span></td>
  </tr>
  
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "98") || userHasRight($_SESSION['userid'], "99") ){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../operations/manageincidents.php"  title="Create new incidents, view, edit/delete incidents and add actions to incidents.">Manage incidents on assignments</a></td><?php } ?>
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "48") || userHasRight($_SESSION['userid'], "49") ){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../core/manageclients.php"  title="Create new clients, modify client details, delete clients and view client assignments.">Manage clients</a></td><?php } ?>	
  </tr>
  
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "103") || userHasRight($_SESSION['userid'], "106") ){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="manageregions.php"  title="Add new regions, view region details, modify/remove regions.">Manage regions</a></td><?php } ?>	
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "123") ){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../operations/manageactiveguards.php"  title="Search for active staff">Search staff by status </a></td>
    <?php } ?>	
  </tr>
  
	<?php if(userHasRight($_SESSION['userid'], "174") ){?>
  <tr valign="top">
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../operations/complaints.php?t=<?php echo encryptValue("Client");?>"  title="Record, edit or delete complaints made by the customers.">Manage client complaints</a></td></tr>
    <?php } ?>
	<?php if(userHasRight($_SESSION['userid'], "175") ){?>
  <tr valign="top">
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../operations/complaints.php?t=<?php echo encryptValue("Guard");?>"  title="Record, edit or delete complaints made by the staff.">Manage staff complaints</a></td></tr>
	<?php } ?>
	<?php if(userHasRight($_SESSION['userid'], "181") ){?>
  <tr valign="top">
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../operations/inspections.php"  title="Add, Edit and Delete assignment inspections.">Manage assignment inspections </a></td>
  </tr>
  <?php } ?>
  <?php if(userHasRight($_SESSION['userid'], "145") ){?>
  <tr valign="top">
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../technical/managealarminstallations.php"  title="Record and edit alarm activations and de-commisions.">Manage alarms </a></td>
  </tr>
  <?php } ?>
  <?php //if(userHasRight($_SESSION['userid'], "181") ){?>
  <tr valign="top">
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../transport/managevehiclelog.php"  title="Add, Edit and Delete vehicle logs.">Manage vehicle logs</a></td>
  </tr>
    <?php //} ?>
	<?php //if(userHasRight($_SESSION['userid'], "181") ){?>
  <tr valign="top">
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../operations/sitreps.php"  title="Add, Edit and Delete guard sitrep checks.">Manage sitrep checks</a></td>
  </tr>
    <?php //} ?>
</table>
<?php } else if($_GET['area'] == "morereports"){ ?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr align="center" valign="top">
    <td colspan="2" align="left" class="innertableheaderbg"><span class="bigheaders"><b>Financial  Reports: </b></span></td>
  </tr>
  
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "84") || userHasRight($_SESSION['userid'], "85") ){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../finance/paye.php"  title="Includes PAYE returns for each guard for a specified period.">PAYE schedule   </a></td><?php } ?>	
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "86") || userHasRight($_SESSION['userid'], "87") ){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../finance/nssf.php"  title="Includes NSSF contributions for each guard for a specified period.">NSSF schedule  </a></td><?php } ?>
  </tr>
  <tr valign="top">
  
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../finance/paymentstatus.php"  title="View, edit client payment status and generate client profoma invoice.">Track 
                        payment of invoices</a></td>
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "81") || userHasRight($_SESSION['userid'], "82")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../finance/managerates.php"  title="Edit assignment rates and guard rates.">Manage rates </a></td><?php } ?>
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "69")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../hr/manageleave.php" title="Manage, view, approve/reject leave applications">Leave report  </a></td><?php } ?>
  </tr>
 
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "198")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../finance/report.php?f=Ledger Report" title="Generate ledger report">Ledger Report</a></td><?php } ?>
  </tr>
 
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "128")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg">[ <a href="../settings/index.php?t=New Finance Report" title="Send a request to ask for a new report.">Request for new report</a> ] </td><?php } ?>
  </tr>
</table>
<?php } else if($_GET['area'] == "transport"){ ?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr align="center" valign="top">
    <td colspan="2" align="left" class="bigheaders">Transport  Reports:</td>
  </tr>
  
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "191")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../transport/fuelreport.php"  title="Shows average fuel comsuption for a selected month.">Average fuel consumption</a></td><?php } ?>	
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "187")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../transport/assignmentseparations.php" title="Manage separations between assignments and alarms.">Assignment Separations</a></td><?php } ?>
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "190")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../transport/vehicleinspections.php" title="Manage vehicle inspection results.">Vehicle inspections</a></td>
	<?php } ?>
  </tr>
  <tr valign="top">
  <?php if(userHasRight($_SESSION['userid'], "170")){?>
    <td class="innertablebg"><img src="../images/bulletstar.gif"  /></td>
    <td class="innertablebg"><a href="../operations/appraisals.php?t=drivers" title="Manage appraisals for drivers and commanders.">Drivers and commanders' appraisal</a></td><?php } ?>
  </tr>
</table>
<?php } else { ?>	
<table border="0" cellpadding="4" cellspacing="0" width="100%" >

  <?php 
  $userdata = getRowAsArray("SELECT favorites FROM users WHERE id = '".$_SESSION['userid']."'");
  $favorite_array  = split(",",$userdata['favorites']);
  $section_array = array();
  //generate an array of the sections in the favorites for this user
  for($i=0;$i<count($favorite_array);$i++){
  	$fav = getRowAsArray("SELECT section FROM favorites WHERE id='".$favorite_array[$i]."'");
	if(!in_array($fav['section'],$section_array)){
		array_push($section_array,$fav['section']);
	}
  }
  if(count($section_array) == 0 || (count($section_array) == 1 && $section_array[0] == "")){
  	echo "<tr valign=\"top\"><td>You have set no favorites. Modify your settings to set favorites. <a href='favorites.php'>Click here to add favourites</a></td></tr>";
  } else {
  for($j=0;$j<count($section_array);$j++){
  $section_data = getRowAsArray("SELECT * FROM favoritesection WHERE id='".$section_array[$j]."'");
  ?>
  <tr valign="top">
    <td width="239" class="innertablebg"><table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
      <tr>
        <td width="90" rowspan="2" align="left" valign="top"><img src="<?php echo $section_data['image'];?>" /></td>
        <td align="left" valign="top" class="bigheaders"><?php echo $section_data['name'];?>:</td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="170" border="0" align="left" cellpadding="4" cellspacing="0">
		<?php 
		for($k=0;$k<count($favorite_array);$k++){
  			$favorite_detail = getRowAsArray("SELECT name,description,link,section FROM favorites WHERE id='".$favorite_array[$k]."'");
			if($favorite_detail['section'] == $section_array[$j]){
		?>
          <tr>
            <td width="12" align="right" valign="top"><img src="../images/bulletstar.gif"  /></td>
            <td width="192" align="left" valign="top"><a href="<?php echo $favorite_detail['link'];?>"  title="<?php echo $favorite_detail['description'];?>"><?php echo $favorite_detail['name'];?></a></td>
          </tr>
		  <?php 
		  	}
		  }?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <?php }
  
  }?>
</table>
<?php } ?>