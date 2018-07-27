<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_GET['a']) && $_GET['a'] == "viewpic"){
	echo "<a href=\"#\" onClick=\"javascript:history.go(-1);\">&lt;&lt; Back</a><br><br><img src=\"".$_GET['v']."\">";
} else {
// Initialise array so that the page doesnt fail in case the user is creatig new guards
$guarddetails = array();

// Set edit mode for the guard
if(isset($_GET['id']) || isset($_GET['action'])){
	$id = decryptValue($_GET['id']);
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	} else {
		$action = $_GET['a'];
	}
	
if( isset($_GET['action']) && ($_GET['action']=="edit") && !userHasRight($_SESSION['userid'], "75")){
	//$url="../core/login.php";
	//$_SESSION['errors'] = "You donot have permission to edit Guard details";
	//forwardToPage($url);
	echo "<script> alert('You donot have permission to edit Guard details') </script>";
	//exit;
}
	
	// Guard details from guard table
	$guarddetails = getRowAsArray("SELECT * FROM guards WHERE id = '".$id."'");	
	// Details of the guard person
	$guarddetails['persondetails'] = getRowAsArray("SELECT * FROM persons WHERE id = '".$guarddetails['personid']."'");	
	$guarddetails['persondetails']['placeofbirth'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['persondetails']['birthplaceid']."'");	
	$guarddetails['presentaddress'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['persondetails']['addressid']."'");
	$guarddetails['homeaddress'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['persondetails']['homeid']."'");
	$guarddetails['father'] = getRowAsArray("SELECT * FROM persons WHERE id = '".$guarddetails['fatherid']."'");
	$guarddetails['father']['address'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['father']['addressid']."'");
	$guarddetails['mother'] = getRowAsArray("SELECT * FROM persons WHERE id = '".$guarddetails['motherid']."'");
	$guarddetails['mother']['address'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['mother']['addressid']."'");
	
	//The spouse
	$guarddetails['spouse'] = getRowAsArray("SELECT * FROM persons WHERE id = '".$guarddetails['spouseid']."'");
	$guarddetails['spouse']['address'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['spouse']['addressid']."'");
	$guarddetails['spouse']['birthaddress'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['spouse']['birthplaceid']."'");
	
	// The next of kin
	$guarddetails['nextofkin'] = getRowAsArray("SELECT * FROM persons WHERE id = '".$guarddetails['nextofkinid']."'");
	$guarddetails['nextofkin']['address'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['nextofkin']['addressid']."'");
	
	// The history of the guard
	$guarddetails['nextofkin'] = getRowAsArray("SELECT * FROM persons WHERE id = '".$guarddetails['nextofkinid']."'");
	$guarddetails['nextofkin']['address'] = getRowAsArray("SELECT * FROM places WHERE id = '".$guarddetails['nextofkin']['addressid']."'");
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - <?php if($action == 'edit') {?>          Edit Guard Details            <?php } else {?>            Add Guard          <?php } ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../javascript/smartguard.js" type="text/javascript"></script>
<script type="text/javascript" src="../javascript/tabber.js"></script>
<script type="text/javascript" src="../javascript/tabs.js"></script>
<script type="text/javascript">

/* Optional: Temporarily hide the "tabber" class so it does not "flash"
   on the page as plain HTML. After tabber runs, the class is changed
   to "tabberlive" and it will appear. */

document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>
<script type="text/javascript">
filePath = '../images/';
</script>
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
        <td class="headings"><a href="manageguards.php<?php if(isset($_GET['t'])){ echo "?a=search&t=".$_GET['t'];}?>">Manage Staff</a> . <?php 
		if($action == 'edit') { 
			echo "Edit Staff Details";
		} else if($action == 'view') {
			echo "View Staff Details";
		} else {
			echo "Add Staff";
        } ?> </td>
      </tr>
      <tr>
        <td><form action="processguard.php" method="post" name="guard" id="guard" enctype="multipart/form-data" onSubmit="return isNotNullOrEmptyString('guardid', 'Please enter the guard ID.') && isNotNullOrEmptyString('firstname', 'Please enter the guard\'s first name.') && isNotNullOrEmptyString('lastname', 'Please enter the guard\'s last name.') <?php if(!isset($_GET['id'])){ ?>&& isNotNullOrEmptyString('photofilename', 'Please upload the guard\'s photograph.') <?php } ?> && isNotNullOrEmptyString('startemployment_day', 'Please select the start day of employment.') && isNotNullOrEmptyString('startemployment_month', 'Please select the start month of employment.') && isNotNullOrEmptyString('startemployment_year', 'Please select the start year of employment.') && isNotNullOrEmptyString('nationality', 'Please select the nationality of the guard.') && isNotNullOrEmptyString('guardpreaddress_tel', 'Please enter the guard\'s telephone number [In the Address section of the form].');">
		<table width="100%" border="0">
          <tr>
            <td align="left"><font class="redtext">*</font> is a required field 			</td>
            </tr>
		<?php
		if($_SESSION['error'] != '') {
		 ?>
          <tr>
            <td align="left" class="redtext"><?php echo $_SESSION['error']; ?></td>
          </tr>
		  <?php $_SESSION['error'] = "";
		  } ?>
		  
          <tr>
            <td><div class="tabber">

     <div class="tabbertab">
	   <h2 class="style1">General</h2>
	   <p><table width="100%" border="0" cellpadding="2" cellspacing="2">
		
          <tr>
            <td width="26%" align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['id'] != "" && $guarddetails['id'] != "0"){ echo "<input type=\"hidden\" name=\"guardupdateid\" id=\"guardupdateid\" value=\"".$guarddetails['id']."\">";}?>Identification No:<font class="redtext">*</font> </td>
            <?php $noofguards_result = mysql_query("SELECT * FROM guards");
			$noofguards = mysql_num_rows($noofguards_result);
			?>
			<td colspan="3" nowrap><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				  echo $guarddetails['guardid'];
				  } else { ?>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="1%" height="13" nowrap><input name="guardid" type="text" id="guardid" value="<?php echo $guarddetails['guardid'];?>" size="6">
&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/searchforpage.php?area=guards&value=','guardid_search','guardid','Searching...'); return false; ">Check Availability </a></td>
                  <td width="99%"><div id="guardid_search" style="width:150; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
                </tr>
              </table>
			  <?php } ?></td>
          </tr>
          <tr>
            <td colspan="4"><hr color="#CCCCCC"></td>
            </tr>
          <tr>
            <td align="right" valign="top" class="label">
              <?php if(isset($_GET['id']) && $guarddetails['personid'] != "" && $guarddetails['personid'] != "0"){ echo "<input type=\"hidden\" name=\"personupdateid\" id=\"personupdateid\" value=\"".$guarddetails['personid']."\">";}?>            Names:</td>
            <td width="74%" colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td nowrap class="label">First Name:<font class="redtext">*</font></td>
                <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				  echo "<b>".$guarddetails['persondetails']['firstname']."</b>";
				  } else { ?><input type="text" name="firstname" id="firstname" value="<?php echo $guarddetails['persondetails']['firstname'];?>"><?php } ?></td>
                <td align="right" class="label">Other  Names:</td>
                <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				  echo "<b>".$guarddetails['persondetails']['othernames']."</b>";
				  } else { ?><input type="text" name="othernames" id="othernames" value="<?php echo $guarddetails['persondetails']['othernames'];?>"><?php } ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="label">Last Name:<font class="redtext">*</font></td>
                <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				  echo "<b>".$guarddetails['persondetails']['lastname']."</b>";
				  } else { ?><input type="text" name="lastname" id="lastname" value="<?php echo $guarddetails['persondetails']['lastname'];?>"><?php } ?></td>
                <td align="right" class="label">Last Name at Birth <br>
                  (if different):</td>
                <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				  echo "<b>".$guarddetails['persondetails']['birthlastname']."</b>";
				  } else { ?><input type="text" name="birthlastname" id="birthlastname" value="<?php echo $guarddetails['persondetails']['birthlastname'];?>"><?php } ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="4"><hr color="#CCCCCC"></td>
            </tr>
          
          
          <tr>
            <td align="right" class="label" valign="top">Photograph:<font class="redtext">*</font><br><span class="tinytxt">(.jpg, .jpeg and .gif files under 2mb in size please)</span></td>
            <td colspan="3" class="label"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				  if($guarddetails['photoname'] != ""){
				  	echo "<a href=\"index.php?a=viewpic&v=".$guarddetails['photoname']."\"><img src=\"".$guarddetails['photoname']."\" width=\"100\" height=\"120\" border=\"1\"></a>";
				  }
				 
				  } else { 
				  	if(isset($_GET['id']) && $guarddetails['photoname'] != ""){
			echo "<a href=\"index.php?a=viewpic\"><img src=\"".$guarddetails['photoname']."\" width=\"100\" height=\"120\" border=\"1\"></a> Change Photo: ";
			}?>
              <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <input  type="file" name="photofilename" id="photofilename" size="40"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Finger Print:<br><span class="tinytxt">(.jpg, .jpeg and .gif files under 2mb in size please)</span></td>
            <td colspan="3" class="label"><?php 
			if(isset($_GET['a']) && $_GET['a'] == "view"){
				  if($guarddetails['fingerprintname'] != ""){
				  	echo "<img src=\"".$guarddetails['fingerprintname']."\" width=\"100\" height=\"120\" border=\"1\">";
				  }
				 
				  } else { 
			if(isset($_GET['id']) && $guarddetails['fingerprintname'] != ""){
			echo "<img src=\"".$guarddetails['fingerprintname']."\" width=\"100\" height=\"120\" border=\"1\"> Change Finger Print: ";
			}?>
              <input size="40" id="fingerprintfilename" name="fingerprintfilename" value="" type="file"><?php } ?></td>
          </tr>

          <tr>
            <td align="right" class="label">Date of Employment:<font class="redtext">*</font></td>
            <td colspan="3" valign="top" class="label">Day: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo date("d", strtotime($guarddetails['dateofemployment']));
			} else {?>
              <select id="startemployment_day" name="startemployment_day">
                <?php 
				if(isset($guarddetails['dateofemployment']) && $guarddetails['dateofemployment'] != "0000-00-00"){ 
							$date =  date("d", strtotime($guarddetails['dateofemployment']));
						} else { 
							$date =  "";
						}
						
				echo generateSelectOptions(getTime('day',''), $date);?>
              </select><?php } ?>
&nbsp;Month: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo date("F", strtotime($guarddetails['dateofemployment']));
			} else {?>
<select id="startemployment_month" name="startemployment_month">
  <?php 
  if(isset($guarddetails['dateofemployment']) && $guarddetails['dateofemployment'] != "0000-00-00"){ 
							$date =  date("F", strtotime($guarddetails['dateofemployment']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('month',''), $date);?>
</select><?php } ?>
&nbsp;Year: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo date("Y", strtotime($guarddetails['dateofemployment']));
			} else {?>
<select id="startemployment_year" name="startemployment_year">
  <?php 
  if(isset($guarddetails['dateofemployment']) && $guarddetails['dateofemployment'] != "0000-00-00"){ 
							$date =  date("Y", strtotime($guarddetails['dateofemployment']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','nbc'), $date);?>
</select><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Country of Nationality:<font class="redtext">*</font></td>
            <td colspan="3"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['persondetails']['nationality'];
			} else {?><select id="nationality" name="nationality">
              <?php echo generateSelectOptions(getAllCountries(), $guarddetails['persondetails']['nationality']);?>
            </select><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Tribe:</td>
            <td colspan="3"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$tribearray = getAllTribes();
			echo $tribearray[$guarddetails['persondetails']['tribe']];
			} else {?><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%"><div id="guardtribe_show"><select id="tribe" name="tribe">
                  <?php echo generateSelectOptions(getAllTribes(), $guarddetails['persondetails']['tribe']);?>
                </select></div></td>
                <td colspan="2">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=tribe','guardtribe_add','','Loading...'); return false;">Add Tribe</a> | <a href="#" onClick="setDiv('../include/showlist.php?area=tribe','guardtribe_show','','Loading...'); return false;">Refresh List </a> </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="2%">&nbsp;</td>
                <td width="85%"><div id="guardtribe_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
              </tr>
            </table><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Job Title: </td>
            <td colspan="3" valign="top">
			<?php 
				$jobtitle=getJobTitleById($guarddetails['jobtitle']);
			if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $jobtitle;
			} else {?>
			<select id="jobtitle" name="jobtitle">
              <?php echo generateSelectOptions(getAllJobTitles(), $guarddetails['jobtitle']);?>
            </select>
			<?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">ID Expiry Date: </td>
            <td colspan="3" class="label">Day:
              <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($guarddetails['dateofexpiry']) != "0000-00-00"){
					echo "<b>".date("d", strtotime($guarddetails['dateofexpiry']))."</b>";
				}
			} else {?>
              <select id="idexpiry_day" name="idexpiry_day">
                <?php 
				if(isset($guarddetails['dateofexpiry']) && $guarddetails['dateofexpiry'] != "0000-00-00"){ 
							$date =  date("d", strtotime($guarddetails['dateofexpiry']));
						} else { 
							$date =  "";
						}
						
				echo generateSelectOptions(getTime('day',''), $date);?>
              </select>
              <?php } ?>
&nbsp;Month:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($guarddetails['dateofexpiry']) != "0000-00-00"){
					echo "<b>".date("F", strtotime($guarddetails['dateofexpiry']))."</b>";
				}
			} else {?>
<select id="idexpiry_month" name="idexpiry_month">
  <?php 
  if(isset($guarddetails['dateofexpiry']) && $guarddetails['dateofexpiry'] != "0000-00-00"){ 
							$date =  date("F", strtotime($guarddetails['dateofexpiry']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
<?php } ?>
&nbsp;Year:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($guarddetails['dateofexpiry']) != "0000-00-00"){
					echo "<b>".date("Y", strtotime($guarddetails['dateofexpiry']))."</b>";
				}
			} else {?>
<select id="idexpiry_year" name="idexpiry_year">
  <?php 
  if(isset($guarddetails['dateofexpiry']) && $guarddetails['dateofexpiry'] != "0000-00-00"){ 
							$date =  date("Y", strtotime($guarddetails['dateofexpiry']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Contract Start Date: </td>
            <td colspan="3" class="label">Day:
              <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			
				if(trim($guarddetails['contractstartdate']) != "0000-00-00"){
					echo "<b>".date("d", strtotime($guarddetails['contractstartdate']))."</b>";
				}
			
			} else {?>
              <select id="contractstart_day" name="contractstart_day">
                <?php 
				if(isset($guarddetails['contractstartdate']) && $guarddetails['contractstartdate'] != "0000-00-00"){ 
							$date =  date("d", strtotime($guarddetails['contractstartdate']));
						} else { 
							$date =  "";
						}
						
				echo generateSelectOptions(getTime('day',''), $date);?>
              </select>
              <?php } ?>
&nbsp;Month:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			
				if(trim($guarddetails['contractstartdate']) != "0000-00-00"){
					echo "<b>".date("F", strtotime($guarddetails['contractstartdate']))."</b>";
				}
			} else {?>
<select id="contractstart_month" name="contractstart_month">
  <?php 
  if(isset($guarddetails['contractstartdate']) && $guarddetails['contractstartdate'] != "0000-00-00"){ 
							$date =  date("F", strtotime($guarddetails['contractstartdate']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
<?php } ?>
&nbsp;Year:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			
				if(trim($guarddetails['contractstartdate']) != "0000-00-00"){
					echo "<b>".date("Y", strtotime($guarddetails['contractstartdate']))."</b>";
				}
			} else {?>
<select id="contractstart_year" name="contractstart_year">
  <?php 
  if(isset($guarddetails['contractstartdate']) && $guarddetails['contractstartdate'] != "0000-00-00"){ 
							$date =  date("Y", strtotime($guarddetails['contractstartdate']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Contract End Date:</td>
            <td colspan="3" class="label">Day:
              <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($guarddetails['contractenddate']) != "0000-00-00"){
					echo "<b>".date("d", strtotime($guarddetails['contractenddate']))."</b>";
				}
			} else {?>
              <select id="contractend_day" name="contractend_day">
                <?php 
				if(isset($guarddetails['contractenddate']) && $guarddetails['contractenddate'] != "0000-00-00"){ 
							$date =  date("d", strtotime($guarddetails['contractenddate']));
						} else { 
							$date =  "";
						}
						
				echo generateSelectOptions(getTime('day',''), $date);?>
              </select>
              <?php } ?>
&nbsp;Month:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			
				if(trim($guarddetails['contractenddate']) != "0000-00-00"){
					echo "<b>".date("F", strtotime($guarddetails['contractenddate']))."</b>";
				}
			} else {?>
<select id="contractend_month" name="contractend_month">
  <?php 
  if(isset($guarddetails['contractenddate']) && $guarddetails['contractenddate'] != "0000-00-00"){ 
							$date =  date("F", strtotime($guarddetails['contractenddate']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('month',''), $date);?>
</select>
<?php } ?>
&nbsp;Year:
<?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($guarddetails['contractenddate']) != "0000-00-00"){
					echo "<b>".date("Y", strtotime($guarddetails['contractenddate']))."</b>";
				}
			} else {?>
<select id="contractend_year" name="contractend_year">
  <?php 
  if(isset($guarddetails['contractenddate']) && $guarddetails['contractenddate'] != "0000-00-00"){ 
							$date =  date("Y", strtotime($guarddetails['contractenddate']));
						} else { 
							$date =  "";
						}
  
  echo generateSelectOptions(getTime('year','na'), $date);?>
</select>
<?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="subheadingtxt">Birth Details: </td>
            </tr>
          <tr>
            <td align="right" class="label">Date of Birth: </td>
            <td colspan="3" class="label">Day: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(trim($guarddetails['persondetails']['dateofbirth']) != "0000-00-00"){
					echo "<b>".date("d", strtotime($guarddetails['persondetails']['dateofbirth']))."</b>";
				}
			
			} else {?>
              <select id="bday" name="bday">
                    <?php 
					if(isset($guarddetails['persondetails']['dateofbirth']) && $guarddetails['persondetails']['dateofbirth'] != "0000-00-00"){ 
							$date =  date("d", strtotime($guarddetails['persondetails']['dateofbirth']));
						} else { 
							$date =  "";
						}
					echo generateSelectOptions(getTime('day',''),  $date);?>
              </select><?php } ?>
&nbsp;Month: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			if(trim($guarddetails['persondetails']['dateofbirth']) != "0000-00-00"){
					echo "<b>".date("F", strtotime($guarddetails['persondetails']['dateofbirth']))."</b>";
				}
			} else {?>
<select id="bmonth" name="bmonth">
  <?php 
  if(isset($guarddetails['persondetails']['dateofbirth']) && $guarddetails['persondetails']['dateofbirth'] != "0000-00-00"){ 
							$date =  date("F", strtotime($guarddetails['persondetails']['dateofbirth']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('month',''), $date);?>
</select><?php } ?>
&nbsp;Year: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			if(trim($guarddetails['persondetails']['dateofbirth']) != "0000-00-00"){
					echo "<b>".date("Y", strtotime($guarddetails['persondetails']['dateofbirth']))."</b>";
				}
			} else {?>
<select id="byear" name="byear">
  <?php 
  if(isset($guarddetails['persondetails']['dateofbirth']) && $guarddetails['persondetails']['dateofbirth'] != "0000-00-00"){ 
							$date =  date("Y", strtotime($guarddetails['persondetails']['dateofbirth']));
						} else { 
							$date =  "";
						}
						
  echo generateSelectOptions(getTime('year','bd'), $date);?>
</select><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['persondetails']['birthplaceid'] != "" && $guarddetails['persondetails']['birthplaceid'] != "0"){ echo "<input type=\"hidden\" name=\"addressupdateid\" id=\"addressupdateid\" value=\"".$guarddetails['persondetails']['birthplaceid']."\">";}?>
              Place of Birth: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['persondetails']['placeofbirth']['name'];
			} else {?><input type="text" name="name" id="name" value="<?php echo $guarddetails['persondetails']['placeofbirth']['name'];?>"><?php } ?></td>
            <td align="right"><span class="label">Sub-county:</span></td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['persondetails']['placeofbirth']['subcounty'];
			} else {?><input type="text" name="subcounty" id="subcounty" value="<?php echo $guarddetails['persondetails']['placeofbirth']['subcounty'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['persondetails']['placeofbirth']['village'];
			} else {?><input type="text" name="village" id="village" value="<?php echo $guarddetails['persondetails']['placeofbirth']['village'];?>"><?php } ?>
              <br>
              <br></td><td align="right"><span class="label">County:</span></td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['persondetails']['placeofbirth']['county'];
			} else {?><input type="text" name="county" id="county" value="<?php echo $guarddetails['persondetails']['placeofbirth']['county'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">              District:</td>
            <td colspan="3" class="label"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			
			$countryarray = getAllDistricts();
			echo $countryarray[$guarddetails['persondetails']['placeofbirth']['district']];
			} else {?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%"><div id="guarddistrict_show">
                  <select id="district" name="district">
                    <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['persondetails']['placeofbirth']['district']); ?>
                  </select>
                </div></td>
                <td colspan="2">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/addforpage.php?area=district','guarddistrict_add','','Loading...'); return false;">Add District </a>  | <a href="#" onClick="setDiv('../include/showlist.php?area=district','guarddistrict_show','','Loading...'); return false;">Refresh List </a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="2%">&nbsp;</td>
                <td width="90%"><div id="guarddistrict_add" style="width:350; height:25; font-style:normal; color:#000066; font-weight:bolder; font-size:14px">&nbsp;</div></td>
              </tr>
            </table><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
	  </p>
     </div>


     <div class="tabbertab">
	  <h2 class="style1">Address</h2>
	  <p><table width="100%" border="0" cellpadding="2" cellspacing="2">
 
          <tr>
            <td colspan="4" class="subheadingtxt">Present Address </td>
            </tr>
          
          <tr>
            <td align="right" class="label">&nbsp;<?php if(isset($_GET['id']) && $guarddetails['persondetails']['addressid'] != "" && $guarddetails['persondetails']['addressid'] != "0"){ echo "<input type=\"hidden\" name=\"guardpreaddress_addressupdateid\" id=\"guardpreaddress_addressupdateid\" value=\"".$guarddetails['persondetails']['addressid']."\">";}?></td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Telephone: <font class="redtext">*</font></td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['telephone'];
			} else {?><input type="text" name="guardpreaddress_tel" id="guardpreaddress_tel" value="<?php echo $guarddetails['presentaddress']['telephone']; ?>"><?php } ?></td>
            <td align="right" class="label">District:</td>
            <td valign="top"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$districtarray = getAllDistricts();
			echo $districtarray[$guarddetails['presentaddress']['district']];
			} else {?><span class="label">
              <select id="guardpreaddress_district" name="guardpreaddress_district">
                <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['presentaddress']['district']);?>
              </select>
            </span><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Plot No.: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['plotnumber'];
			} else {?><input type="text" name="guardpreaddress_plotno" id="guardpreaddress_plotno" value="<?php echo $guarddetails['presentaddress']['plotnumber']; ?>"><?php } ?></td>
            <td align="right" class="label">LC 1 Chairman:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['lc1chairman'];
			} else {?><input type="text" name="guardpreaddress_lc1cm" id="guardpreaddress_lc1cm" value="<?php echo $guarddetails['presentaddress']['lc1chairman']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label" width="25%">Village:</td>
            <td width="25%"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['village'];
			} else {?><input type="text" name="guardpreaddress_village" id="guardpreaddress_village" value="<?php echo $guarddetails['presentaddress']['village']; ?>"><?php } ?></td>
            <td align="right" class="label">LC 1 Chairman Telephone:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['lc1telephone'];
			} else {?><input type="text" name="guardpreaddress_lc1tel" id="guardpreaddress_lc1tel" value="<?php echo $guarddetails['presentaddress']['lc1telephone']; ?>"><?php } ?></td>
          </tr>
          <tr>
<td align="right" class="label">Parish:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['parish']; 
			} else {?><input type="text" name="guardpreaddress_parish" id="guardpreaddress_parish" value="<?php echo $guarddetails['presentaddress']['parish']; ?>"><?php } ?></td>            
            <td align="right" class="label">LC 2 Chairman: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['lc2chairman'];
			} else {?><input type="text" name="guardpreaddress_lc2cm" id="guardpreaddress_lc2cm" value="<?php echo $guarddetails['presentaddress']['lc2chairman']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['subcounty'];
			} else {?><input type="text" name="guardpreaddress_subcounty" id="guardpreaddress_subcounty" value="<?php echo $guarddetails['presentaddress']['subcounty']; ?>"><?php } ?></td>
            <td align="right" class="label">LC 2 Chairman Telephone: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['lc2telephone'];
			} else {?><input type="text" name="guardpreaddress_lc2tel" id="guardpreaddress_lc2tel" value="<?php echo $guarddetails['presentaddress']['lc2telephone']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">County:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['county'];
			} else {?><input type="text" name="guardpreaddress_county" id="guardpreaddress_county" value="<?php echo $guarddetails['presentaddress']['county']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Town:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['presentaddress']['town'];
			} else {?><input type="text" name="guardpreaddress_town" id="guardpreaddress_town" value="<?php echo $guarddetails['presentaddress']['town']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="subheadingtxt">Family Home/Upcountry Address </td>
            </tr>
          <tr>
            <td align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['persondetails']['homeid'] != "" && $guarddetails['persondetails']['homeid'] != "0"){ echo "<input type=\"hidden\" name=\"guardfamilyaddress_addressupdateid\" id=\"guardfamilyaddress_addressupdateid\" value=\"".$guarddetails['persondetails']['homeid']."\">";}?></td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Telephone:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['telephone'];
			} else {?><input type="text" name="guardfamilyaddress_tel" id="guardfamilyaddress_tel" value="<?php echo $guarddetails['homeaddress']['telephone']; ?>"><?php } ?></td>
            <td align="right" class="label">District:</td>
            <td valign="top"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$districtarray = getAllDistricts();
			echo $districtarray[$guarddetails['homeaddress']['district']];
			} else {?><span class="label">
              <select id="guardfamilyaddress_district" name="guardfamilyaddress_district">
                <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['homeaddress']['district']);?>
              </select>
            </span><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Plot No.: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['plotnumber'];
			} else {?><input type="text" name="guardfamilyaddress_plotno" id="guardfamilyaddress_plotno" value="<?php echo $guarddetails['homeaddress']['plotnumber']; ?>"><?php } ?></td>
            <td align="right" class="label">LC 1 Chairman:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['lc1chairman'];
			} else {?><input type="text" name="guardfamilyaddress_lc1cm" id="guardfamilyaddress_lc1cm" value="<?php echo $guarddetails['homeaddress']['lc1chairman']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['village'];
			} else {?><input type="text" name="guardfamilyaddress_village" id="guardfamilyaddress_village" value="<?php echo $guarddetails['homeaddress']['village']; ?>"><?php } ?></td>
            <td align="right" class="label">LC 1 Chairman Telephone:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['lc1telephone'];
			} else {?><input type="text" name="guardfamilyaddress_lc1tel" id="guardfamilyaddress_lc1tel" value="<?php echo $guarddetails['homeaddress']['lc1telephone']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Parish:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['parish'];
			} else {?><input type="text" name="guardfamilyaddress_parish" id="guardfamilyaddress_parish" value="<?php echo $guarddetails['homeaddress']['parish']; ?>"><?php } ?></td>
            <td align="right" class="label">LC 2 Chairman: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['lc2chairman'];
			} else {?><input type="text" name="guardfamilyaddress_lc2cm" id="guardfamilyaddress_lc2cm" value="<?php echo $guarddetails['homeaddress']['lc2chairman']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['subcounty'];
			} else {?><input type="text" name="guardfamilyaddress_subcounty" id="guardfamilyaddress_subcounty" value="<?php echo $guarddetails['homeaddress']['subcounty']; ?>"><?php } ?></td>
            <td align="right" class="label">LC 2 Chairman Telephone: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['lc2telephone'];
			} else {?><input type="text" name="guardfamilyaddress_lc2tel" id="guardfamilyaddress_lc2tel" value="<?php echo $guarddetails['homeaddress']['lc2telephone']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">County:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['county'];
			} else {?><input type="text" name="guardfamilyaddress_county" id="guardfamilyaddress_county" value="<?php echo $guarddetails['homeaddress']['county']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Town:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['homeaddress']['town'];
			} else {?><input type="text" name="guardfamilyaddress_town" id="guardfamilyaddress_town" value="<?php echo $guarddetails['homeaddress']['town']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
		  

        </table>
	  </p>
     </div>


     <div class="tabbertab">
	  <h2 class="style1">Parents</h2>
	  <p>
	  <table width="100%" border="0" cellpadding="2" cellspacing="2">
 
             <tr>
               <td colspan="4" class="subheadingtxt">Father/Guardian</td>
               </tr>
             
             <tr>
               <td align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['father']['addressid'] != "" && $guarddetails['father']['addressid'] != "0"){ echo "<input type=\"hidden\" name=\"father_addressupdateid\" id=\"father_addressupdateid\" value=\"".$guarddetails['father']['addressid']."\">"; }?></td>
               <td><?php if(isset($_GET['id']) && $guarddetails['fatherid'] != "" && $guarddetails['fatherid'] != "0"){ echo "<input type=\"hidden\" name=\"father_personupdateid\" id=\"father_personupdateid\" value=\"".$guarddetails['fatherid']."\">";}?>&nbsp;</td>
               <td align="right" class="label">&nbsp;</td>
               <td valign="top">&nbsp;</td>
             </tr>
             <tr>
            <td align="right" class="label">First Name: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['firstname'];
			} else {?><input type="text" name="father_firstname" id="father_firstname" value="<?php echo $guarddetails['father']['firstname']; ?>"><?php } ?></td>
            <td align="right" class="label">District:</td>
            <td valign="top" class="label"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$districtarray = getAllDistricts();
			echo $districtarray[$guarddetails['father']['address']['district']];
			} else {?><span class="label">
              <select id="father_district" name="father_district">
                <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['father']['address']['district']);?>
              </select>
            </span><?php } ?></td>
           </tr>
          <tr>
            <td align="right" class="label" width="25%">Last Name:</td>
            <td width="25%"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['lastname'];
			} else {?><input type="text" name="father_lastname" id="father_lastname" value="<?php echo $guarddetails['father']['lastname']; ?>"><?php } ?></td>
            <td align="right" class="label">Telephone:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['address']['telephone'];
			} else {?><input type="text" name="father_tel" id="father_tel" value="<?php echo $guarddetails['father']['address']['telephone']; ?>"><?php } ?></td>
          </tr>
          <tr>
<td align="right" class="label">Other Names: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['othernames'];
			} else {?><input type="text" name="father_othernames" id="father_othernames" value="<?php echo $guarddetails['father']['othernames']; ?>"><?php } ?></td>            
            <td align="right" class="label">Present Occupation: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['occupation'];
			} else {?><input type="text" name="father_occupation" id="father_occupation" value="<?php echo $guarddetails['father']['occupation']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Status: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			if($guarddetails['father']['isalive'] == "Y"){
				echo "Alive";
			} else if($guarddetails['father']['isalive'] == "N"){
				echo "Dead";
			}
			
			} else {?><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="12%"><input type="checkbox" name="father_isalive" id="father_isalive" value="Y" <?php if($guarddetails['father']['isalive'] == "Y"){
					echo "checked";
				} ?>></td>
                <td width="37%">Alive</td>
                <td width="11%"><input type="checkbox" name="father_isdead" id="father_isdead" value="Y" <?php if($guarddetails['father']['isalive'] == "N"){
					echo "checked";
				} ?>></td>
                <td width="40%">Dead</td>
              </tr>
            </table><?php } ?></td>
            <td align="right" class="label">Employer:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['employer'];
			} else {?><input type="text" name="father_employer" id="father_employer" value="<?php echo $guarddetails['father']['employer']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['address']['village'];
			} else {?><input type="text" name="father_village" id="father_village" value="<?php echo $guarddetails['father']['address']['village']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['address']['subcounty'];
			} else {?><input type="text" name="father_subcounty" id="father_subcounty" value="<?php echo $guarddetails['father']['address']['subcounty']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">County:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['father']['address']['county'];
			} else {?><input type="text" name="father_county" id="father_county" value="<?php echo $guarddetails['father']['address']['county']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="subheadingtxt">Mother</td>
            </tr>
          <tr>
            <td align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['mother']['addressid'] != "" && $guarddetails['mother']['addressid'] != "0"){ echo "<input type=\"hidden\" name=\"mother_addressupdateid\" id=\"mother_addressupdateid\" value=\"".$guarddetails['mother']['addressid']."\">";}?></td>
            <td><?php if(isset($_GET['id']) && $guarddetails['motherid'] != "" && $guarddetails['motherid'] != "0"){ echo "<input type=\"hidden\" name=\"mother_personupdateid\" id=\"mother_personupdateid\" value=\"".$guarddetails['motherid']."\">";}?>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">First Name: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['firstname'];
			} else {?><input type="text" name="mother_firstname" id="mother_firstname" value="<?php echo $guarddetails['mother']['firstname']; ?>"><?php } ?></td>
            <td align="right" class="label">District:</td>
            <td valign="top"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$districtarray = getAllDistricts();
			echo $districtarray[ $guarddetails['mother']['address']['district']];
			} else {?><span class="label">
              <select id="mother_district" name="mother_district">
                <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['mother']['address']['district']);?>
              </select>
            </span><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Last Name:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['lastname'];
			} else {?><input type="text" name="mother_lastname" id="mother_lastname" value="<?php echo $guarddetails['mother']['lastname']; ?>"><?php } ?></td>
            <td align="right" class="label">Telephone:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['address']['telephone'];
			} else {?><input type="text" name="mother_tel" id="mother_tel" value="<?php echo $guarddetails['mother']['address']['telephone']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Other Names: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['othernames'];
			} else {?><input type="text" name="mother_othernames" id="mother_othernames" value="<?php echo $guarddetails['mother']['othernames']; ?>"><?php } ?></td>
            <td align="right" class="label">Present Occupation: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['occupation'];
			} else {?><input type="text" name="mother_occupation" id="mother_occupation" value="<?php echo $guarddetails['mother']['occupation']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Status: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			if($guarddetails['mother']['isalive'] == "Y"){
				echo "Alive";
			} else if($guarddetails['mother']['isalive'] == "N"){
				echo "Dead";
			}
			
			} else {?><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="12%"><input type="checkbox" name="mother_isalive" id="mother_isalive" value="Y" <?php if($guarddetails['mother']['isalive'] == "Y"){
					echo "checked";
				} ?>></td>
                  <td width="37%">Alive</td>
                  <td width="11%"><input type="checkbox" name="mother_isdead" id="mother_isdead" value="Y" <?php if($guarddetails['mother']['isalive'] == "N"){
					echo "checked";
				} ?>></td>
                  <td width="40%">Dead</td>
                </tr>
            </table><?php } ?></td>
            <td align="right" class="label">Employer:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['employer'];
			} else {?><input type="text" name="mother_employer" id="mother_employer" value="<?php echo $guarddetails['mother']['employer']; ?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['address']['village'];
			} else {?><input type="text" name="mother_village" id="mother_village" value="<?php echo $guarddetails['mother']['address']['village']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['address']['subcounty'];
			} else {?><input type="text" name="mother_subcounty" id="mother_subcounty" value="<?php echo $guarddetails['mother']['address']['subcounty']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">County:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['mother']['address']['county'];
			} else {?><input type="text" name="mother_county" id="mother_county" value="<?php echo $guarddetails['mother']['address']['county']; ?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
		  </table>
	  </p>
     </div>
	 
     <div class="tabbertab">
	  <h2 class="style1">Family</h2>
	  <p><table width="100%" border="0" cellpadding="2" cellspacing="2">
 
           <tr>
            <td colspan="4" class="subheadingtxt">Spouse Details </td>
            </tr>
           <tr>
             <td align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['spouseid'] != "" && $guarddetails['spouseid'] != "0"){ echo "<input type=\"hidden\" name=\"spouse_personupdateid\" id=\"spouse_personupdateid\" value=\"".$guarddetails['spouseid']."\">";}?>General Details: </td>
             <td>&nbsp;</td>
             <td align="right" class="label">&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr>
            <td align="right" class="label">First Name: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['firstname'];
			} else {?><input type="text" name="spouse_firstname" id="spouse_firstname" value="<?php echo $guarddetails['spouse']['firstname'];?>"><?php } ?></td>
            <td align="right" class="label">Present Occupation: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['occupation'];
			} else {?><input type="text" name="spouse_occupation" id="spouse_occupation" value="<?php echo $guarddetails['spouse']['occupation'];?>"><?php } ?></td>
           </tr>
          <tr>
            <td align="right" class="label" width="25%">Last Name:</td>
            <td width="25%"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['lastname'];
			} else {?><input type="text" name="spouse_lastname" id="spouse_lastname" value="<?php echo $guarddetails['spouse']['lastname'];?>"><?php } ?></td>
            <td align="right" class="label">Employer:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['employer'];
			} else {?><input type="text" name="spouse_employer" id="spouse_employer" value="<?php echo $guarddetails['spouse']['employer'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Other Names:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['othernames'];
			} else {?><input type="text" name="spouse_othernames" id="spouse_othernames" value="<?php echo $guarddetails['spouse']['othernames'];?>"><?php } ?></td>
<td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Last Name at Birth: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['birthlastname'];
			} else {?><input type="text" name="spouse_birthlastname" id="spouse_birthlastname" value="<?php echo $guarddetails['spouse']['birthlastname'];?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td colspan="4"><hr color="#CCCCCC"></td>
            </tr>
          
          <tr>
            <td align="right" class="sectiontxt"><span class="label">
              <?php if(isset($_GET['id']) && $guarddetails['spouse']['birthplaceid'] != "" && $guarddetails['spouse']['birthplaceid'] != "0"){ echo "<input type=\"hidden\" name=\"spousebirthplace_addressupdateid\" id=\"spousebirthplace_addressupdateid\" value=\"".$guarddetails['spouse']['birthplaceid']."\">";}?>
            </span>Birth Details: </td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
 <td align="right" class="label">Date of Birth: </td>
            <td colspan="3" class="label">Day: <?php 
			if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(isset($guarddetails['spouse']['dateofbirth']) && $guarddetails['spouse']['dateofbirth'] != "0000-00-00 00:00:00"){ 
					$date =  date("d", strtotime($guarddetails['spouse']['dateofbirth']));
				} else { 
					$date =  "";
				}
				echo $date;	
			} else {
			?>
              <select id="spouse_bday" name="spouse_bday">
                <?php 
				if(isset($guarddetails['spouse']['dateofbirth']) && $guarddetails['spouse']['dateofbirth'] != "0000-00-00 00:00:00"){ 
							$date =  date("d", strtotime($guarddetails['spouse']['dateofbirth']));
						} else { 
							$date =  "";
						}
						
				echo generateSelectOptions(getTime('day',''),$date);?>
              </select> <?php } ?>
&nbsp;Month: <?php 
			if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(isset($guarddetails['spouse']['dateofbirth']) && $guarddetails['spouse']['dateofbirth'] != "0000-00-00 00:00:00"){ 
					$date =  date("F", strtotime($guarddetails['spouse']['dateofbirth']));
				} else { 
					$date =  "";
				}
				echo $date;	
			} else {
			?>
<select id="spouse_bmonth" name="spouse_bmonth">
  <?php 
  if(isset($guarddetails['spouse']['dateofbirth']) && $guarddetails['spouse']['dateofbirth'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($guarddetails['spouse']['dateofbirth']));
						} else { 
							$date =  "";
						}
						
  echo generateSelectOptions(getTime('month',''), $date);?>
</select><?php } ?>
&nbsp;Year: <?php 
			if(isset($_GET['a']) && $_GET['a'] == "view"){
				if(isset($guarddetails['spouse']['dateofbirth']) && $guarddetails['spouse']['dateofbirth'] != "0000-00-00 00:00:00"){ 
					$date =  date("Y", strtotime($guarddetails['spouse']['dateofbirth']));
				} else { 
					$date =  "";
				}
				echo $date;	
			} else {
			?>
<select id="spouse_byear" name="spouse_byear">
  <?php 
   if(isset($guarddetails['spouse']['dateofbirth']) && $guarddetails['spouse']['dateofbirth'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($guarddetails['spouse']['dateofbirth']));
						} else { 
							$date =  "";
						}
  echo generateSelectOptions(getTime('year','bd'), $date);?>
</select><?php } ?></td>
            </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['birthaddress']['village'];
			} else {?><input type="text" name="spousebirthplace_village" id="spousebirthplace_village" value="<?php echo $guarddetails['spouse']['birthaddress']['village'];?>"><?php } ?></td>
            <td align="right" class="label">County:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['birthaddress']['county'];
			} else {?><input type="text" name="spousebirthplace_county" id="spousebirthplace_county" value="<?php echo $guarddetails['spouse']['birthaddress']['county'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['birthaddress']['subcounty'];
			} else {?><input type="text" name="spousebirthplace_subcounty" id="spousebirthplace_subcounty" value="<?php echo $guarddetails['spouse']['birthaddress']['subcounty'];?>"><?php } ?></td>
            <td align="right" class="label">District:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$districtarray = getAllDistricts();
			echo $districtarray[$guarddetails['spouse']['birthaddress']['district']];
			} else {?><span class="label">
              <select id="spousebirthplace_district" name="spousebirthplace_district">
                <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['spouse']['birthaddress']['district']);?>
              </select>
            </span><?php } ?></td>
          </tr>
          
          <tr>
            <td colspan="4"><hr color="#CCCCCC"></td>
            </tr>
          <tr>
            <td align="right" class="sectiontxt"><?php if(isset($_GET['id']) && $guarddetails['spouse']['addressid'] != "" && $guarddetails['spouse']['addressid'] != "0"){ echo "<input type=\"hidden\" name=\"spouse_addressupdateid\" id=\"spouse_addressupdateid\" value=\"".$guarddetails['spouse']['addressid']."\">";}?>Present Address:</td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">Telephone: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['address']['telephone'];
			} else {?><span class="label">
              <input type="text" name="spouse_tel" id="spouse_tel" value="<?php echo $guarddetails['spouse']['address']['telephone'];?>">
            </span><?php } ?></td>
            <td align="right" class="label">County:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['address']['county'];
			} else {?><input type="text" name="spouse_county" id="spouse_county" value="<?php echo $guarddetails['spouse']['address']['county'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Village:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['address']['village'];
			} else {?><input type="text" name="spouse_village" id="spouse_village" value="<?php echo $guarddetails['spouse']['address']['village'];?>"><?php } ?></td>
            <td align="right" class="label">District:</td>
            <td class="label"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$districtarray = getAllDistricts();
			echo $districtarray[$guarddetails['spouse']['address']['district']];
			} else {?><span class="label">
              <select id="spouse_district" name="spouse_district">
                <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['spouse']['address']['district']); ?>
              </select>
            </span><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['spouse']['address']['subcounty'];
			} else {?><input type="text" name="spouse_subcounty" id="spouse_subcounty" value="<?php echo $guarddetails['spouse']['address']['subcounty'];?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
		  <tr>
		    <td colspan="4"><a name="anchorchild"></a></td>
		    </tr>
		  <tr>
		    <td colspan="4" class="subheadingtxt">Children</td>
		    </tr>
		  <tr>
		    <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="2" id="childtable">
              <tr class="tabheadings">
                <th>&nbsp;</th>
                <th align="left">Firstname </th>
                <th align="left">Lastname</th>
                <th align="left">Other Names </th>
                <th align="left">Gender</th>
                <th align="left">Age</th>
              </tr>
			  <?php 
			  if(isset($_GET['id'])){
			  	
				if(trim($guarddetails['childrenids']) != ""){
				if(isset($_GET['a']) && $_GET['a'] == "view"){
					$viewonly = "Y";
				}
				
				//Split the string to extract the children ids
			  	$childrenarray = split(",",$guarddetails['childrenids']);
				for($i=0;$i<count($childrenarray);$i++){
			  		$child = getRowAsArray("SELECT * FROM children WHERE id = '".$childrenarray[$i]."'");
					if($i%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
					
					$row = "<tr class=\"".$shade."\"><td>".($i+1).".</td><td>";
					if(isset($_GET['id'])){ 
						$row .=  "<input type=\"hidden\" name=\"childupdateid[]\" id=\"childupdateid[]".($i+1)."\" value=\"".$child['id']."\">";
					}
					if(isset($viewonly)){
						$row .= $child['firstname'];
					} else {
						$row .= "<input name=\"childfname[]\" id=\"childfname[]".($i+1)."\" type=\"text\" value=\"".$child['firstname']."\">";
					}
					$row.= "</td><td>";
					if(isset($viewonly)){
						$row .= $child['lastname'];
					} else {
						$row .= "<input name=\"childlname[]\" id=\"childlname[]".($i+1)."\" type=\"text\" value=\"".$child['lastname']."\">";
					}
					$row .= "</td><td>";
					if(isset($viewonly)){
						$row .= $child['othernames'];
					} else {
						$row .= "<input name=\"childoname[]\" id=\"childoname[]".($i+1)."\" type=\"text\" value=\"".$child['othernames']."\">";
					}
					$row .= "</td><td>";
					
					if(isset($viewonly)){
						if($child['gender'] == "F"){ $row .= "Female";}
						if($child['gender'] == "M"){ $row .= "Male";}
						
					} else {
						$row .= "<select name=\"childgender[]\" id=\"childgender[]".($i+1)."\"><option selected>&lt;Select&gt;</option><option value=\"M\"";
						if($child['gender'] == "M"){ $row .= "selected";}
						$row .= ">Male</option><option value=\"F\"";
						if($child['gender'] == "F"){ $row .= "selected";}
						$row .= ">Female</option></select>";
					}
					$row .= "</td><td>";
					if(isset($viewonly)){
						$row .= $child['age'];
					} else {	
						$row .= "<input name=\"childage[]\" id=\"childage[]".($i+1)."\" size=\"4\" type=\"text\" value=\"".$child['age']."\">";
			  		}
			  		$row .= "</td></tr>";
					echo $row;
			  	}
				} else {
					echo "<tr><td>There are no children registered so far.</td></tr>";
				}
			  } else {
			  ?>
			  <tr><td>1.</td><td><input name="childfname[]" id="childfname[]1" type="text" value=""></td><td><input name="childlname[]" id="childlname[]1" type="text" value=""></td><td><input name="childoname[]" id="childoname[]1" type="text" value=""></td><td><select name="childgender[]" id="childgender[]1">
                    <option selected>&lt;Select&gt;</option>
                    <option value="M">Male</option><option value="F">Female</option>
              </select></td><td><input name="childage[]" id="childage[]1" size="4" type="text" value=""></td></tr>
			  <?php } ?>
            </table></td>
		    </tr>
			<?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){?>
		  <tr>
		    <td colspan="4">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorchild" onClick="addRowToChildTable()">Add Child</a>   | <a href="#anchorchild" onClick="removeRow('childtable')">Remove Child</a></td>
		    </tr>
			<?php } ?>
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
           <tr>
            <td colspan="4" class="subheadingtxt">Next of Kin Details </td>
            </tr>
          <tr>
            <td align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['nextofkinid'] != "" && $guarddetails['nextofkinid'] != "0"){ echo "<input type=\"hidden\" name=\"nextofkin_personupdateid\" id=\"nextofkin_personupdateid\" value=\"".$guarddetails['nextofkinid']."\">";}?>Firstname: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['firstname'];
			} else {?><input type="text" name="nextofkin_firstname" id="nextofkin_firstname" value="<?php echo $guarddetails['nextofkin']['firstname'];?>"><?php } ?></td>
            <td align="right" class="label">District:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			$districtarray = getAllDistricts();
			echo $districtarray[$guarddetails['nextofkin']['address']['district']];
			} else {?><span class="label">
              <select id="nextofkin_district" name="nextofkin_district">
                <?php echo generateSelectOptions(getAllDistricts(), $guarddetails['nextofkin']['address']['district']);?>
              </select>
            </span><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label" width="25%">Lastname:</td>
            <td width="25%"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['lastname'];
			} else {?><input type="text" name="nextofkin_lastname" id="nextofkin_lastname" value="<?php echo $guarddetails['nextofkin']['lastname'];?>"><?php } ?></td>
            <td align="right" class="label">Telephone:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['address']['telephone'];
			} else {?><input type="text" name="nextofkin_tel" id="nextofkin_tel" value="<?php echo $guarddetails['nextofkin']['address']['telephone'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label"><span class="sectiontxt">
              <?php if(isset($_GET['id']) && $guarddetails['nextofkin']['addressid'] != "" && $guarddetails['nextofkin']['addressid'] != "0"){ echo "<input type=\"hidden\" name=\"nextofkin_addressupdateid\" id=\"nextofkin_addressupdateid\" value=\"".$guarddetails['nextofkin']['addressid']."\">";}?>
            </span>Village:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['address']['village'];
			} else {?><input type="text" name="nextofkin_village" id="nextofkin_village" value="<?php echo $guarddetails['nextofkin']['address']['village'];?>"><?php } ?></td>
            <td align="right" class="label">Present Occupation: </td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['occupation'];
			} else {?><input type="text" name="nextofkin_occupation" id="nextofkin_occupation" value="<?php echo $guarddetails['nextofkin']['occupation'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">Sub-county:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['address']['subcounty'];
			} else {?><input type="text" name="nextofkin_subcounty" id="nextofkin_subcounty" value="<?php echo $guarddetails['nextofkin']['address']['subcounty'];?>"><?php } ?></td>
            <td align="right" class="label">Employer:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['employer'];
			} else {?><input type="text" name="nextofkin_employer" id="nextofkin_employer" value="<?php echo $guarddetails['nextofkin']['employer'];?>"><?php } ?></td>
          </tr>
          <tr>
            <td align="right" class="label">County:</td>
            <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $guarddetails['nextofkin']['address']['county'];
			} else {?><input type="text" name="nextofkin_county" id="nextofkin_county" value="<?php echo $guarddetails['nextofkin']['address']['county'];?>"><?php } ?></td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  </table>
	  </p>
     </div>
	 
     <div class="tabbertab">
	  <h2 class="style1">History</h2>
	  <p>
	  <table width="100%" border="0" cellpadding="2" cellspacing="2">
 
           <tr>
            <td colspan="4" class="subheadingtxt"><a name="anchorprimaryschool"></a>Schools Attended </td>
            </tr>
           <tr>
             <td width="21%" align="right" class="sectiontxt">Primary Education : </td>
             <td width="29%">&nbsp;</td>
             <td width="25%" align="right" class="label">&nbsp;</td>
             <td width="25%">&nbsp;</td>
           </tr>
           <tr>
            <td colspan="4" align="right" class="label">
			<table width="100%" border="0" cellpadding="0" id="primaryschooltable">
              <tr>
                <td>&nbsp;</td>
                <td><span class="label">Name of School : </span></td>
                  <td class="label">From: </td>
                  <td class="label"><span class="label">To:</span></td>
                  </tr>
              <?php 
			  if(isset($_GET['id'])){
			  	if($guarddetails['primaryschids'] != ""){
				if(isset($_GET['a']) && $_GET['a'] == "view"){
					$viewonly = "Y";
				}
				
				//Split the string to extract the school ids
			  	$prischarray = split(",",$guarddetails['primaryschids']);
			  	for($i=0;$i<count($prischarray);$i++){
			  		$school = getRowAsArray("SELECT * FROM schools WHERE id = '".$prischarray[$i]."'");
					if($i%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
					
					$row = "<tr class=\"".$shade."\"><td>".($i+1).".</td><td>";
                	if(isset($_GET['id'])){ 
						$row .=  "<input type=\"hidden\" name=\"primaryschupdateid[]\" id=\"primaryschupdateid[]".($i+1)."\" value=\"".$school['id']."\">";
					}
					
					if(isset($viewonly)){
						$row .=	$school['schoolname'];
					} else {
						$row .=	"<input type=\"text\" name=\"primaryschname[]\" id=\"primaryschname[]".($i+1)."\" value=\"".$school['schoolname']."\" />";
					}
                  	$row .=	"</td><td>";
					if(isset($viewonly)){
						$row .=	$school['yearjoined'];
					} else {
						$row .=	"<select id=\"primaryschstart[]".($i+1)."\" name=\"primaryschstart[]\">".generateSelectOptions(getTime('year','nbc'), $school['yearjoined'])."</select>";
					}
					$row .= "</td><td>";
					if(isset($viewonly)){
						$row .=	$school['yearleft'];
					} else {
						$row .= "<select id=\"primaryschend[]".($i+1)."\" name=\"primaryschend[]\">".generateSelectOptions(getTime('year','nbc'), $school['yearleft'])."</select>";
					}
					
					$row .= "</td></tr>";
			  
			  		echo $row;
			  	}
				} else {
					echo "<tr><td>There are no primary schools registered.</td></tr>";
				}
			  } else {
			  ?>
			  <tr>
                <td>1.</td>
                <td><input type="text" name="primaryschname[]" id="primaryschname[]1" value="" /></td>
                  <td class="label"><select id="primaryschstart[]1" name="primaryschstart[]">
                      <?php echo generateSelectOptions(getTime('year','nbc'), '');?>
                                  </select></td>
                  <td class="label"><select id="primaryschend[]1" name="primaryschend[]">
                      <?php echo generateSelectOptions(getTime('year','nbc'), '');?>
                                  </select></td>
                  </tr>
				  <?php } ?>
            </table></td>
            </tr>
          <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?>
		  <tr>
            <td colspan="4">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorprimaryschool" onClick="addRowToSchoolTable('primaryschooltable')">Add School</a>   | <a href="#anchorprimaryschool" onClick="removeRow('primaryschooltable')">Remove School</a></td>
            </tr>
			<?php } ?>
          <tr>
            <td colspan="4"><hr color="#CCCCCC"></td>
            </tr>
          <tr>
            <td align="right" class="label"><span class="sectiontxt"><a name="anchorsecondaryschool"></a>Secondary Education : </span></td>
            <td>&nbsp;</td>
<td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="right" class="label"><table width="100%" border="0" cellpadding="0" id="secondaryschooltable">
              <tr>
                <td>&nbsp;</td>
                <td><span class="label">Name of School : </span></td>
                  <td class="label">From: </td>
                  <td class="label">To:</td>
                  </tr>
              <?php 
			  if(isset($_GET['id'])){
			  	
				if($guarddetails['secondaryschids'] != ""){
					if(isset($_GET['a']) && $_GET['a'] == "view"){
						$viewonly = "Y";
					}
					
				//Split the string to extract the school ids
			  	$secscharray = split(",",$guarddetails['secondaryschids']);
			  	for($i=0;$i<count($secscharray);$i++){
			  		$school = getRowAsArray("SELECT * FROM schools WHERE id = '".$secscharray[$i]."'");
					if($i%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
					
					$row = "<tr class=\"".$shade."\"><td>".($i+1).".</td><td>";
                	if(isset($_GET['id'])){ 
						$row .=  "<input type=\"hidden\" name=\"secondaryschupdateid[]\" id=\"secondaryschupdateid[]".($i+1)."\" value=\"".$school['id']."\">";
					}
					if(isset($viewonly)){		
						$row .=	$school['schoolname'];
					} else {
						$row .=	"<input type=\"text\" name=\"secondaryschname[]\" id=\"secondaryschname[]".($i+1)."\" value=\"".$school['schoolname']."\" />";
					}
					$row .= "</td><td>";
					if(isset($viewonly)){		
						$row .=	$school['yearjoined'];
					} else {
						$row .=	"<select id=\"secondaryschstart[]".($i+1)."\" name=\"secondaryschstart[]\">".generateSelectOptions(getTime('year','nbc'), $school['yearjoined'])."</select>";
					}
					$row .=	"</td><td>";
					if(isset($viewonly)){		
						$row .=	$school['yearleft'];
					} else {
						$row .=	"<select id=\"secondaryschend[]".($i+1)."\" name=\"secondaryschend[]\">".generateSelectOptions(getTime('year','nbc'), $school['yearleft'])."</select>";
					}
					$row .=	"</td></tr>";
			  
			  		echo $row;
			  	} 
				} else {
					echo "<tr><td>There are no secondary schools registered.</td></tr>";
				}
			  } else {
			  ?>
			  <tr>
                <td>1.</td>
                <td><input type="text" name="secondaryschname[]" id="secondaryschname[]1" value="" /></td>
                <td class="label"><select id="secondaryschstart[]1" name="secondaryschstart[]">
                    <?php echo generateSelectOptions(getTime('year','nbc'), '');?>
                </select></td>
                <td class="label"><select id="secondaryschend[]1" name="secondaryschend[]">
                    <?php echo generateSelectOptions(getTime('year','nbc'), '');?>
                </select></td>
              </tr>
			  <?php } ?>
            </table></td>
            </tr>
          <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?><tr>
            <td colspan="4">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorsecondaryschool" onClick="addRowToSchoolTable('secondaryschooltable')">Add School</a>   | <a href="#anchorsecondaryschool" onClick="removeRow('secondaryschooltable')">Remove School</a></td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="4"><hr color="#CCCCCC"></td>
            </tr>
          <tr>
            <td align="right" class="sectiontxt"><a name="anchorotherquals" id="anchorotherquals"></a>Other Qualifications: </td>
            <td>&nbsp;</td>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
 <td colspan="4"><table width="100%" border="0" cellpadding="2" cellspacing="2" id="qualschooltable">
   <tr>
     <td>&nbsp;</td>
     <td><span class="label">Qualification: </span></td>
     <td class="label">Year Attained:</td>
   </tr>
   <?php 
			  if(isset($_GET['id'])){
			  
			  if($guarddetails['qualschids'] != ""){
			  	//Split the string to extract the school ids
			  	$qualscharray = split(",",$guarddetails['qualschids']);
			  	for($i=0;$i<count($qualscharray);$i++){
			  		$school = getRowAsArray("SELECT * FROM schools WHERE id = '".$qualscharray[$i]."'");
					if($i%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
					
					if(isset($_GET['a']) && $_GET['a'] == "view"){
						$viewonly = "Y";
					}
					
					$row = "<tr class=\"".$shade."\"><td>".($i+1).".</td><td>";
                	if(isset($_GET['id'])){ 
						$row .=  "<input type=\"hidden\" name=\"qualschupdateid[]\" id=\"qualschupdateid[]".($i+1)."\" value=\"".$school['id']."\">";
					}
					
					if(isset($viewonly)){
						$row .=	$school['schoolname'];
					} else {
						$row .=	"<input type=\"text\" name=\"qualschname[]\" id=\"qualschname[]".($i+1)."\" value=\"".$school['schoolname']."\" />";
					}	
					$row .=	"</td><td>";
					if(isset($viewonly)){
						$row .=	$school['yearleft'];
					} else {
						$row .=	"<select id=\"qualschend[]".($i+1)."\" name=\"qualschend[]\">".generateSelectOptions(getTime('year','nbc'), $school['yearleft'])."</select>";
					}
					$row .=	"</td></tr>";
			  
			  		echo $row;
			  	}
				} else {
					echo "<tr><td>There are no registered qualifications.</td></tr>";
				}
			  } else {
			  ?>
   <tr>
     <td>1.</td>
     <td><input type="text" name="qualschname[]" id="qualschname[]1" value="" /></td>
     <td class="label"><select id="qualschend[]1" name="qualschend[]">
       <?php echo generateSelectOptions(getTime('year','nbc'), '');?>
     </select></td>
   </tr>
   <?php } ?>
 </table></td>
            </tr>
          <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?><tr>
            <td colspan="4">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorotherquals" onClick="addRowToSchoolTable('qualschooltable')">Add Qualification</a>  | <a href="#anchorotherquals" onClick="removeRow('qualschooltable')">Remove Qualification</a></td>
            </tr><?php } ?>
          
          
          
          
          
          
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
		  <tr>
		    <td colspan="4" class="subheadingtxt">Experience</td>
		    </tr>
		  <tr>
		    <td colspan="4" class="label">Have you been in any of the services below: </td>
		    </tr>
		  <tr>
		    <td colspan="4"><?php 
			  	$armyexperience = array();
				$policeexperience = array();
				$prisonsexperience = array();
				
				if(isset($_GET['id']) && $guarddetails['experienceids'] != ""){
			  		//Split the string to extract the experience ids
			  		$experiencearray = split(",",$guarddetails['experienceids']);
					for($i=0;$i<count($experiencearray);$i++){
			  			$experience = getRowAsArray("SELECT * FROM experiences WHERE id = '".$experiencearray[$i]."'");
						if($experience['type'] == "armyexperience_"){
							$armyexperience = $experience;
						}
						if($experience['type'] == "policeexperience_"){
							$policeexperience = $experience;
						}
						if($experience['type'] == "prisonsexperience_"){
							$prisonsexperience = $experience;
						}
			  		}
				}
			  ?>
			  <?php //}
				if(count($prisonsexperience) > 0){
					echo "<input type=\"hidden\" name=\"prisonsexperience_updateid\" id=\"prisonsexperience_updateid\" value=\"".$prisonsexperience['id']."\">";
				} ?>
			  <table width="100%" border="0" cellspacing="2" cellpadding="2">
              
              <tr>
                <td class=\"label\">1.</td>
                <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
						if(count($armyexperience) > 0){
							echo "[Y]";
						} else {
							echo "[N]";
						}
					} else {?><input type="checkbox" name="armyexperience" value="armyexperience" onClick="showRelatedInfo(this,'armydiv')" <?php if(count($armyexperience) > 0){
				echo "checked";
				}?>> <?php }
				if(count($armyexperience) > 0){
					echo "<input type=\"hidden\" name=\"armyexperience_updateid\" id=\"armyexperience_updateid\" value=\"".$armyexperience['id']."\">";
				} ?></td>
                <td valign="middle" class="label">Army</td>
                <td><div id="armydiv" style="visibility:<?php 
				if(count($armyexperience) > 0){
				echo "shown";
				} else {
				echo "hidden";
				}?>">
                  <table width="100%" border="0" cellpadding="2" cellspacing="2">
                    <tr>
                      <td class="label">From:</td>
                      <td class="label">Month: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($armyexperience) > 0 && $armyexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($armyexperience['startdate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?>
                        <select id="armyexperience_startmonth" name="armyexperience_startmonth">
                          <?php 
						  if(count($armyexperience) > 0 && $armyexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($armyexperience['startdate']));
						} else { 
							$date =  "";
						}
						
						  echo generateSelectOptions(getTime('month',''), $date);?>
                        </select><?php } ?>
                        &nbsp;Year:
                        <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($armyexperience) > 0 && $armyexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($armyexperience['startdate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><span class="label">
                        <select id="armyexperience_startyr" name="armyexperience_startyr">
                          <?php 
						  if(count($armyexperience) > 0 && $armyexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($armyexperience['startdate']));
						} else { 
							$date =  "";
						}
						
						  echo generateSelectOptions(getTime('year','nbc'), $date);?>
                        </select>
                        </span><?php } ?></td>
                      <td class="label">To:</td>
                      <td>Month:
                        <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($armyexperience) > 0 && $armyexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($armyexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><select id="armyexperience_endmonth" name="armyexperience_endmonth">
                          <?php 
						  if(count($armyexperience) > 0 && $armyexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($armyexperience['enddate']));
						} else { 
							$date =  "";
						}
						  echo generateSelectOptions(getTime('month',''), $date);?>
                        </select><?php } ?>
                        &nbsp;Year:
                        <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($armyexperience) > 0 && $armyexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($armyexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><span class="label">
                        <select id="armyexperience_endyr" name="armyexperience_endyr">
                          <?php 
						  if(count($armyexperience) > 0 && $armyexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($armyexperience['enddate']));
						} else { 
							$date =  "";
						}
						  
						  echo generateSelectOptions(getTime('year','nbc'), $date);?>
                        </select>
                        </span><?php } ?></td>
                    </tr>
                  </table>
                </div></td>
                </tr>
              <tr>
                <td class=\"label\">2.</td>
                <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
						if(count($policeexperience) > 0){
							echo "[Y]";
						} else {
							echo "[N]";
						}
					} else {?><input type="checkbox" name="policeexperience" value="policeexperience" onClick="showRelatedInfo(this,'policediv')" <?php if(count($policeexperience) > 0){
				echo "checked";
				}?>><?php }
				if(count($policeexperience) > 0){
					echo "<input type=\"hidden\" name=\"policeexperience_updateid\" id=\"policeexperience_updateid\" value=\"".$policeexperience['id']."\">";
				}?></td>
                <td valign="middle" class="label">Police</td>
                <td><div id="policediv" style="visibility:<?php 
				if(count($policeexperience) > 0){
				echo "shown";
				} else {
				echo "hidden";
				}?>"><table width="100%" border="0" cellpadding="2" cellspacing="2">
                  <tr>
                    <td class="label">From:</td>
                    <td class="label">Month: <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($policeexperience) > 0 && $policeexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($policeexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?>
                      <select id="policeexperience_startmonth" name="policeexperience_startmonth">
                        <?php 
						if(count($policeexperience) > 0 && $policeexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($policeexperience['startdate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('month',''), $date);?>
                      </select><?php } ?>
                      &nbsp;Year:
                      <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($policeexperience) > 0 && $policeexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($policeexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><span class="label">
                      <select id="policeexperience_startyr" name="policeexperience_startyr">
                        <?php 
						if(count($policeexperience) > 0 && $policeexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($policeexperience['startdate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('year','nbc'), $date);?>
                      </select>
                      </span><?php } ?></td>
                    <td class="label">To:</td>
                    <td>Month:  <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($policeexperience) > 0 && $policeexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($policeexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?>
                      <select id="policeexperience_endmonth" name="policeexperience_endmonth">
                        <?php 
						if(count($policeexperience) > 0 && $policeexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($policeexperience['enddate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('month',''), $date);?>
                      </select><?php } ?>
                      &nbsp;Year:
                      <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($policeexperience) > 0 && $policeexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($policeexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><span class="label">
                      <select id="policeexperience_endyr" name="policeexperience_endyr">
                        <?php 
						if(count($policeexperience) > 0 && $policeexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($policeexperience['enddate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('year','nbc'), $date);?>
                      </select>
                      </span><?php } ?></td>
                  </tr>
                </table></div></td>
                </tr>
              <tr>
                <td class=\"label\">3.</td>
                <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
						if(count($prisonsexperience) > 0){
							echo "[Y]";
						} else {
							echo "[N]";
						}
					} else {?><input type="checkbox" name="prisonsexperience" value="prisonsexperience" onClick="showRelatedInfo(this,'prisonsdiv')" <?php if(count($prisonsexperience) > 0){
				echo "checked";
				}?>>
                  <?php }
				if(count($prisonsexperience) > 0){
					echo "<input type=\"hidden\" name=\"prisonsexperience_updateid\" id=\"prisonsexperience_updateid\" value=\"".$prisonsexperience['id']."\">";
				}?></td>
                <td valign="middle" class="label">Prisons</td>
                <td><div id="prisonsdiv" style="visibility:<?php 
				if(count($prisonsexperience) > 0){
				echo "shown";
				} else {
				echo "hidden";
				}?>"><table width="100%" border="0" cellpadding="2" cellspacing="2">
                  <tr>
                    <td class="label">From:</td>
                    <td class="label">Month:
                      <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($prisonsexperience) > 0 && $prisonsexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($prisonsexperience['startdate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?>
					  <select id="prisonsexperience_startmonth" name="prisonsexperience_startmonth">
                        <?php 
						if(count($prisonsexperience) > 0 && $prisonsexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($prisonsexperience['startdate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('month',''), $date);?>
                      </select><?php } ?>
                      &nbsp;Year:
                      <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($prisonsexperience) > 0 && $prisonsexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($prisonsexperience['startdate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><span class="label">
                      <select id="prisonsexperience_startyr" name="prisonsexperience_startyr">
                        <?php 
						if(count($prisonsexperience) > 0 && $prisonsexperience['startdate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($prisonsexperience['startdate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('year','nbc'), $date);?>
                      </select>
                      </span><?php } ?></td>
                    <td class="label">To:</td>
                    <td>Month:
                      <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($prisonsexperience) > 0 && $prisonsexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($prisonsexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><select id="prisonsexperience_endmonth" name="prisonsexperience_endmonth">
                        <?php 
						if(count($prisonsexperience) > 0 && $prisonsexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("F", strtotime($prisonsexperience['enddate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('month',''), $date);?>
                      </select><?php } ?>
                      &nbsp;Year:
                      <?php if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					  	if(count($prisonsexperience) > 0 && $prisonsexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($prisonsexperience['enddate']));
						} else { 
							$date =  "";
						}
						 echo $date;
						} else {
					  ?><span class="label">
                      <select id="prisonsexperience_endyr" name="prisonsexperience_endyr">
                        <?php 
						if(count($prisonsexperience) > 0 && $prisonsexperience['enddate'] != "0000-00-00 00:00:00"){ 
							$date =  date("Y", strtotime($prisonsexperience['enddate']));
						} else { 
							$date =  "";
						}
						
						echo generateSelectOptions(getTime('year','nbc'), $date);?>
                      </select>
                      </span><?php } ?></td>
                  </tr>
                </table></div></td>
                </tr>
            </table></td>
		    </tr>
		  
		  <tr>
		    <td colspan="4"><a name="anchorPrevEmployer"></a></td>
		   </tr>
		  <tr>
		    <td colspan="4" class="subheadingtxt">Previous Employers: </td>
		    </tr>
		  <tr>
		    <td colspan="4">
			<table width="100%" border="0" cellpadding="2" cellspacing="2" id="prevemployerstable">
              <?php 
			  if(isset($_GET['id'])){
			  	
				if($guarddetails['employerids'] != ""){
				if(isset($_GET['a']) && $_GET['a'] == "view"){
					$viewonly = "Y";
				}
				
				//Split the string to extract the school ids
			  	$employerarray = split(",",$guarddetails['employerids']);
			  	for($i=0;$i<count($employerarray);$i++){
			  		$employer = getRowAsArray("SELECT * FROM employers WHERE id = '".$employerarray[$i]."'");
					if($i%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
					$row = "<tr class=\"".$shade."\"><td align=\"right\" class=\"label\">Name:</td><td>";
                	if(isset($_GET['id'])){ 
						$row .=  "<input type=\"hidden\" name=\"employerupdateid[]\" id=\"employerupdateid[]".($i+1)."\" value=\"".$employer['id']."\">";
					}
					
					if(isset($viewonly)){
						$row .=	$employer['name'];
					} else {
						$row .=	"<input type=\"text\" name=\"employername[]\" id=\"employername[]".($i+1)."\" value=\"".$employer['name']."\" />";
					}
					$row .=	"</td><td align=\"right\" class=\"label\">Employment Date: </td>".
                			"<td valign=\"top\">From: ";
					if($employer['startdate'] != ""){
						$date =  date("Y", strtotime($employer['startdate']));
					} else {
						$date = "";
					}
					if(isset($viewonly)){
						$row .=	$date." To:";
					} else {
						$row .=	"<select id=\"startemployment[]".($i+1)."\" name=\"startemployment[]\">".generateSelectOptions(getTime('year','nbc'), $date)."</select> To:";
						
						
					}
					
					if($employer['enddate'] != ""){
						$date =  date("Y", strtotime($employer['enddate']));
					} else {
						$date = "";
					}
					if(isset($viewonly)){
						$row .=	$date;
					} else {
						$row .= "<select id=\"endemployment[]".($i+1)."\" name=\"endemployment[]\">";
						$row .= generateSelectOptions(getTime('year','nbc'), $date)."</select>";
					}
				$row .=	"</td></tr><tr class=\"".$shade."\"><td align=\"right\" class=\"label\">Telephone:</td><td>";
			  if(isset($viewonly)){
			  	 $row .= $employer['telephone'];
			  } else {
			  	$row .=	"<input type=\"text\" name=\"employertel[]\" id=\"employertel[]".($i+1)."\" value=\"".$employer['telephone']."\" />";
			  }
			  $row .=	"</td><td>&nbsp;</td><td valign=\"top\">&nbsp;</td></tr>".
              "<tr class=\"".$shade."\"><td align=\"right\" class=\"label\">Physical Address:</td><td>";
			  if(isset($viewonly)){
			  	 $row .= $employer['physicaladdress'];
			  } else {
			  	$row .=	"<textarea name=\"employerphysicaladd[]\" rows=\"3\" id=\"employerphysicaladd[]".($i+1)."\">".$employer['physicaladdress']."</textarea>";
			  }
			 $row .=	"</td></tr><tr class=\"".$shade."\"><td align=\"right\" class=\"label\">Previous Position:</td><td>";
			  if(isset($viewonly)){
			  	 $row .= $employer['position'];
			  } else {
			  	$row .=	"<input type=\"text\" name=\"position[]\" id=\"position[]".($i+1)."\" value=\"".$employer['position']."\" />";
			  }
			 $row .= "</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			  
			  		echo $row;
			  	}
				
				} else {
					echo "<tr><td>There are no registered previous employers.</td></tr>";
				}
			  } else {
			  ?>
			  
			  <tr>
                <td align="right" class="label">Name:</td>
                <td><input type="text" name="employername[]" id="employername[]1" value="" /></td>
                <td align="right" class="label">Employment Date: </td>
                <td valign="top" class="label">From:
                  <span class="label">
                  <select id="startemployment[]1" name="startemployment[]">
                    <?php 
					
					echo generateSelectOptions(getTime('year','nbc'), $persondetails['prisonsexperience_endyr']);?>
                  </select>
                  </span>
                  To:
                  <span class="label">
                  <select id="endemployment[]1" name="endemployment[]">
                    <?php echo generateSelectOptions(getTime('year','nbc'), '');?>
                  </select>
                  </span></td>
              </tr>
              <tr>
                <td align="right" class="label">Telephone:</td>
                <td><input type="text" name="employertel[]" id="employertel[]1" value="" /></td>
                <td>&nbsp;</td>
                <td valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="right" class="label">Physical Address:</td>
                <td><textarea name="employerphysicaladd[]" rows="3" id="employerphysicaladd[]1"></textarea></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right" class="label">Previous Position: </td>
                <td><input type="text" name="position[]" id="position[]1" value="" /></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
			  <?php } ?>
            </table></td>
		    </tr>
		  <tr>
		    <td align="right" class="label">&nbsp;</td>
		    <td colspan="3">&nbsp;</td>
		    </tr>
		  <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?><tr>
		    <td>&nbsp;</td>
		    <td colspan="3">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorPrevEmployer" onClick="addPrevEmployer()">Add Employer</a> | <a href="#anchorPrevEmployer" onClick="removeMultRows('prevemployerstable',4)">Remove Employer</a> </td>
		    </tr><?php } ?>
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
		  </table>
	  </p>
     </div>
	 
     <div class="tabbertab">
	  <h2 class="style1">Referees</h2>
	  <p><table width="100%" border="0" cellpadding="2" cellspacing="2">
 
           <tr>
            <td colspan="4" class="subheadingtxt"><a name="anchorReferee"></a>Referees </td>
            </tr>
           <tr>
             <td colspan="4"><table width="100%" border="0" cellpadding="2" cellspacing="2" id="guardrefereetable">
			 
			 <?php 
			  if(isset($_GET['id']) && $guarddetails['refereeids'] != ""){
			  	//Split the string to extract the school ids
			  	$refereearray = split(",",$guarddetails['refereeids']);
			  	for($i=0;$i<count($refereearray);$i++){
			  		if(isset($_GET['a']) && $_GET['a'] == "view"){
						$viewonly = "Y";
					}
					$referee = getRowAsArray("SELECT * FROM referees WHERE id = '".$refereearray[$i]."'");
					if($i%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
					
					$row = "<tr class=\"".$shade."\"><td align=\"right\" class=\"label\">Name: </td><td>";
                	if(isset($_GET['id'])){ 
						$row .=  "<input type=\"hidden\" name=\"refereeupdateid[]\" id=\"refereeupdateid[]".($i+1)."\" value=\"".$referee['id']."\">";
					}
					if(isset($viewonly)){
						$row .= $referee['name'];
					} else {
						$row .=	"<input type=\"text\" name=\"refereename[]\" id=\"refereename[]".($i+1)."\" value=\"".$referee['name']."\" />";
					}	
					$row .=	"</td><td align=\"right\" class=\"label\">Telephone: </td><td valign=\"top\">";
					
					if(isset($viewonly)){
						$row .= $referee['telephone'];
					} else {
						$row .=	"<input type=\"text\" name=\"refereetel[]\" id=\"refereetel[]".($i+1)."\" value=\"".$referee['telephone']."\" />";
					}
					$row .=	"</td></tr><tr class=\"".$shade."\"> <td align=\"right\" class=\"label\">Physical Address:</td><td>";
					if(isset($viewonly)){
						$row .= $referee['physicaladdress'];
					} else {
						$row .=	"<textarea name=\"refereephysicaladd[]\" rows=\"3\" id=\"refereephysicaladd[]".($i+1)."\">".$referee['physicaladdress']."</textarea>";
					}
					$row .=	"</td><td>&nbsp;</td><td valign=\"top\">&nbsp;</td></tr>";
			  
			  		echo $row;
			  	}
			  } else {
			  ?>
               <tr>
                 <td align="right" class="label">Name: </td>
                 <td><input type="text" name="refereename[]" id="refereename[]1" value="" /></td>
                 <td align="right" class="label">                   Telephone: </td>
                 <td valign="top"><span class="label">
                   <input type="text" name="refereetel[]" id="refereetel[]1" value="" />
                 </span></td>
               </tr>
               <tr>
                 <td align="right" class="label">Physical Address:</td>
                 <td><textarea name="refereephysicaladd[]" rows="3" id="refereephysicaladd[]1"></textarea></td>
                 <td>&nbsp;</td>
                 <td valign="top">&nbsp;</td>
               </tr>
			   <?php } ?>
             </table></td>
             </tr>
           <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?><tr>
            <td align="right" class="label" width="25%">&nbsp;</td>
            <td colspan="3">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorReferee" onClick="addGuardReferee()">Add Referee </a>   | <a href="#anchorReferee" onClick="removeMultRows('guardrefereetable',2)">Remove Referee </a></td>
            </tr>
          <?php } ?>
          
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
		  <tr>
		    <td colspan="4" class="subheadingtxt">Landlord 
		      </td>
		    </tr>
			<?php
			if(isset($_GET['id'])){
				$landlord = getRowAsArray("SELECT * FROM referees WHERE id = '".$guarddetails['landlordid']."'");
			}
			
			?>
		  <tr>
		    <td align="right" class="label"><?php if(isset($_GET['id']) && $guarddetails['landlordid'] != "" && $guarddetails['landlordid'] != "0"){ echo "<input type=\"hidden\" name=\"landlord_updateid\" id=\"landlord_updateid\" value=\"".$guarddetails['landlordid']."\">";}?>Name:</td>
		    <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $landlord['name'];
			} else {?><input type="text" name="landlord_name" id="landlord_name" value="<?php echo $landlord['name'];?>"><?php } ?></td>
		    <td align="right" class="label">Telephone:</td>
		    <td valign="top"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $landlord['telephone'];
			} else {?><input type="text" name="landlord_tel" id="landlord_tel" value="<?php echo $landlord['telephone'];?>"><?php } ?></td>
		    </tr>
		  <tr>
		    <td align="right" class="label">Physical Address:</td>
		    <td><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
			echo $landlord['physicaladdress'];
			} else {?><textarea name="landlord_physicaladd" rows="3" id="landlord_physicaladd"><?php echo $landlord['physicaladdress'];?></textarea><?php } ?></td>
		    <td>&nbsp;</td>
		    <td valign="top">&nbsp;</td>
		  </tr>
		  <tr>
            <td align="right" class="label"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if($guarddetails['lc1letterprovided'] == "Y"){
					echo "[Y]";
				} else {
					echo "[N]";
				}
				
			} else {?><input type="checkbox" name="lc1letter_provided" id="lc1letter_provided" value="Y" <?php 
			if($guarddetails['lc1letterprovided'] == "Y"){
				echo "checked";
			}
			?>><?php } ?></td>
		    <td colspan="3" class="label">A letter from the LC1 has been provided. </td>
		    </tr>
		  <tr>
		    <td align="right" class="label"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
				if($guarddetails['medicalexaminationdone'] == "Y"){
					echo "[Y]";
				} else {
					echo "[N]";
				}
				
			} else {?><input type="checkbox" name="medicalexaminationdone" id="medicalexaminationdone" value="Y" <?php 
			if($guarddetails['medicalexaminationdone'] == "Y"){
				echo "checked";
			}
			?>><?php } ?></td>
		    <td colspan="3" class="label">Medical Examination done.</td>
		    </tr>
		  <tr>
		    <td align="right" class="label">&nbsp;</td>
		    <td colspan="3">&nbsp;</td>
		    </tr>
		  

		  </table>
	  </p>
     </div>
	 
	 <div class="tabbertab">
	  <h2 class="style1">Uniform</h2>
	  <p>
	  <table width="100%" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" class="subheadingtxt">Uniform:</td>
                </tr>
                <tr>
                  <td width="16%" class="label">Uniform Provided?</td>
                  <td width="84%" colspan="3"><?php if(isset($_GET['a']) && $_GET['a'] == "view"){
						if($guarddetails['uniformprovided'] =="Y"){
							echo "[Yes]";
						} else {
							echo "[No]";
						}
					} else {?>
                      <input type="checkbox" name="uniformprovided" id="uniformprovided" value="Y" onClick="showRelatedInfo(this,'uniformsdiv')" <?php if($guarddetails['uniformprovided'] =="Y"){
				echo "checked";}?>>
                      <?php }?>                  </td>
                </tr>
                <tr>
                  <td colspan="4"><div id="uniformsdiv" style="visibility:<?php 
				if($guarddetails['uniformprovided'] =="Y"){
				echo "shown";
				} else {
				echo "hidden";
				}?>">
                      <table cellpadding="2" cellspacing="1">
                        <tr>
                          <td class="label" colspan="4">Which of these items have you recieved? </td>
                        </tr>
                        <?php
			//generate the rows of the uniform items to be received
			$uniform_result = mysql_query("SELECT * FROM equipmentdetails WHERE type='Uniform' ORDER BY name ASC");
			$counter = 1;
			
			$item_details = array();
			//Get the saved uniform data
			if(isset($_GET['id']) && $guarddetails['uniformids'] != ""){
				//Split the string to extract the uniform ids
				$uniformsarray = split(",",$guarddetails['uniformids']);
					
				for($i=0;$i<count($uniformsarray);$i++){
					$uniformsdetails = getRowAsArray("SELECT * FROM uniform WHERE id = '".$uniformsarray[$i]."'");
					$item_details[$uniformsdetails['uniformtype']] = array($uniformsdetails['id'], $uniformsdetails['number']);
				}
			}
			
			while($uni_data = mysql_fetch_array($uniform_result, MYSQL_ASSOC)){
				//Code name for use in the naming and manipulation of fields
				$codename = strtolower(str_replace(" ","",$uni_data['name']));
				
				$row = "<tr><td valign='top' class='label'>".$counter.".</td>";
				$row .= "<td valign='top'>";
					if(isset($_GET['a']) && $_GET['a'] == "view"){
						if(isset($item_details[$codename."_"])){
							$row .= "[Y]";
						} else {
							$row .= "[N]";
						}
					} else {
                  		$row .= "<input type='checkbox' name='".$codename."' value='".$codename."' onClick='showRelatedInfo(this,\"".$codename."div\")'";
				  
				  		if(isset($item_details[$codename."_"])){
							$row .= "checked";
				  		}
				  		$row .= ">";
					}
					
					if(isset($item_details[$codename."_"])){
						$row .= "<input type=\"hidden\" name=\"".$codename."_updateid\" id=\"".$codename."_updateid\" value=\"".$item_details[$codename."_"][0]."\">";
					} 
					$row .= "</td><td class='label' nowrap>".$uni_data['name']."</td>";
					
					$row .= "<td><div id='".$codename."div' style='visibility:"; 
				
				if(isset($item_details[$codename."_"])){
					$row .= "shown";
				} else {
					$row .= "hidden";
				}
				$row .= "'><table width='100%' border='0' cellpadding='2' cellspacing='2'>";
                $row .= "<tr><td width='14%' class='label'>Number:</td><td width='86%'>";
				
				if(isset($_GET['a']) && $_GET['a'] == "view"){ 
					if(isset($item_details[$codename."_"])){ 
						$number =  $item_details[$codename."_"][1];
					} else { 
						$number =  "";
					}
					$row .= $number;
				} else {
					$row .= "<select name='".$codename."_number' id='".$codename."_number'>";
					
						for($iq = 1; $iq <= 10; $iq++){ 
							$row .= "<option value='".$iq."'";
							if ($item_details[$codename."_"][1] == $iq) {
								$row .= "selected";
							}
							$row .= ">".$iq."</option>";
						}
						
						$row .= "</select>";
					}
					  
					$row .= "</td></tr></table></div></td>";
					$row .= "<td ></td></tr>";
					echo $row;
				$counter++;
			}
			?>
                      </table>
                  </div></td>
                </tr>
                <tr>
                  <td align="right" class="label">&nbsp;</td>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </table>
	  </p>
     </div>
	 <div class="tabbertab">
	  <h2 class="style1">Others</h2>
	  <p>
	  <table width="100%" border="0" cellpadding="2" cellspacing="2">
           <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?>
          <?php } ?>
          
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    </tr>
		  <tr>
		    <td colspan="4"><table width="100%" border="0" cellpadding="0" id="guarddocumentstable">
              <tr>
                <td height="18" colspan="4" class="subheadingtxt"><a name="anchorguarddocuments"></a>Documents:</td>
                </tr>
              <tr>
                <td width="3%">&nbsp;</td>
                <td width="50%"><span class="label">Document name: </span></td>
                  <td width="42%" class="label">Reference Number: </td>
                  <td width="5%" class="label">&nbsp;</td>
                  </tr>
              <?php 
			  if(isset($_GET['id'])){
			  	if($guarddetails['documentsids'] != ""){
				if(isset($_GET['a']) && $_GET['a'] == "view"){
					$viewonly = "Y";
				}
				
				//Split the string to extract the document ids
			  	$docsarray = split(",",$guarddetails['documentsids']);
			  	for($i=0;$i<count($docsarray);$i++){
			  		$doc = getRowAsArray("SELECT * FROM guarddocuments WHERE id = '".$docsarray[$i]."'");
					if($i%2 == 0){ $shade = "oddrow"; } else { $shade = "evenrow";}
					
					$row = "<tr class=\"".$shade."\"><td>".($i+1).".</td><td>";
                	if(isset($_GET['id'])){ 
						$row .=  "<input type=\"hidden\" name=\"documentupdateid[]\" id=\"documentupdateid[]".($i+1)."\" value=\"".$doc['id']."\">";
					}
					
					if(isset($viewonly)){
						$row .=	$doc['documentname'];
					} else {
						$row .=	"<input type=\"text\" name=\"documentname[]\" id=\"documentname[]".($i+1)."\" value=\"".$doc['documentname']."\" />";
					}
                  	$row .=	"</td><td>";
					if(isset($viewonly)){
						$row .=	$doc['referencenumber'];
					} else {
						$row .=	"<input type=\"text\" name=\"referencenumber[]\" id=\"referencenumber[]".($i+1)."\" value=\"".$doc['referencenumber']."\" />";
					}
					$row .= "</td></tr>";
			  
			  		echo $row;
			  	}
				} else {
					echo "<tr><td colspan='4'>There are no documents registered.</td></tr>";
				}
			  } else {
			  ?>
			  <tr>
                <td>1.</td>
                <td><input type="text" name="documentname[]" id="documentname[]1" value="" /></td>
                <td class="label"><input type="text" name="referencenumber[]" id="referencenumber[]1" value="" /></td>
                  <td class="label">&nbsp;</td>
			  </tr>
			 <?php } ?>
            </table></td>
		    </tr>
			 <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?>
			  <tr>
			    <td colspan="4">&nbsp;&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#anchorguarddocuments" onClick="addRowToGuarddocumentsTable('guarddocumentstable')">Add Document</a> | <a href="#anchorguarddocuments" onClick="removeRow('guarddocumentstable')">Remove Document</a></td>
			    </tr>
			<?php } ?>
		  <tr>
		    <td colspan="4">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="4" class="subheadingtxt">Financial Records:</td>
		   </tr>
			<?php 
				$guardid=$guarddetails['guardid'];
				$sql=getRowAsArray("SELECT * FROM guards WHERE guardid='".$guardid."' ");
			?>
		  <tr>
		    <td colspan="4" headers="5" align="right" class="label"></td>
		    </tr>
		  <tr>
		    <td align="right" class="label">Guard rate: </td>
		    <td colspan="3"><?php if($sql['rate'] ==""){ echo "Not Set"; }else{ echo commify($sql['rate']);} ?></td>
		  </tr>
		   <tr>
		    <td width="15%" align="right" class="label">Overtime rate: </td>
		    <td width="85%" colspan="3"><?php if($sql['overtimerate'] ==""){ echo "Not Set"; }else{  echo commify($sql['overtimerate']); }?></td>
		  </tr>
		  </table>
	 <br>
	  <table width="100%" border="0" cellpadding="2" cellspacing="2">
           <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){ ?>
          <?php } ?>
          
		  <tr>
		    <td colspan="5">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="5" class="subheadingtxt">Discplinary Record: <?php if(isset($_GET['id'])){?> [ <a href="managepersonnel.php?id=<?php echo $_GET['id'];?>"><img src="../images/folder.gif" alt="Discipline Folder" width="16" height="14" border="0"></a> <a href="managepersonnel.php?id=<?php echo encryptValue($guarddetails['guardid']); if(isset($_GET['t'])){ echo "&t=drivers";}?>">Full Disciplinary Folder</a>]<?php } ?> </td>
		    </tr>
		
		  <tr>
		    <td height="5" colspan="5" align="right"></td>
		    </tr>
		  <?php 
		  	$guardid=$guarddetails['guardid'];
		  	$query = mysql_query("SELECT concat(p.firstname,' ',p.lastname,' ',p.othernames,' ',p.birthlastname) as name, ps.type, ps.disciplineletter,ps.actiontaken,ps.takenby FROM persons p INNER JOIN guards g ON(p.id = g.personid) INNER JOIN personnel ps ON(g.guardid = ps.guard) WHERE ps.guard='".$guardid."' ") or die(mysql_error());
		   
		  $personnels=mysql_num_rows($query);
		  
			if(count($personnels) == 0){          			
				echo "<tr><td>There are no Personnnel Files to display</td></tr>";exit;
		   	} else { 
			?>
			<tr class="tabheadings" >
				<td width="5%">&nbsp;</td>
				<td width="16%">Type</td>
                <td width="17%">Action Taken </td>
				<td width="17%" >Taken By </td>
				<td width="62%">Attached Document </td>
			</tr>
			<?php
				$i=1;
				while($thepersonnel=mysql_fetch_array($query,MYSQL_ASSOC)){
			      if(($i%2)==0) {
				     $rowclass = "oddrow";
				  } else {
				     $rowclass = "evenrow";
				  }
				
			?>
		  <tr class="<?php echo $rowclass; ?>">
		    <td><?php echo $i; ?></td>
		    <td><?php if($thepersonnel['type']=='Discipline'){  
					echo "Commendation";
				} else if($thepersonnel['type']=='Indiscipline'){
					echo "Sanction";
				} ?>&nbsp;</td>
			<td><?php echo $thepersonnel['actiontaken']; ?></td>
			<td><?php echo $thepersonnel['takenby']; ?></td>
			<td><?php 
			if(trim($thepersonnel['disciplineletter']) != ""){
			?> <img src="../images/file.gif" alt="Discipline File" border="0"> <?php
				echo "<a href=\"../files/".$thepersonnel['disciplineletter']."\">".$thepersonnel['disciplineletter']."</a>";
			} ?></td>
		  </tr>
		   <?php 
			  $i++;
			  } 
			 } 
			  ?>
		  </table>
	  </p>
     </div>
	 </div>

</td>
            </tr>
          <tr>
            <td align="center" class="label">&nbsp;</td>
          </tr>
          <?php if(!(isset($_GET['a']) && $_GET['a'] == "view")){?><tr>
            <td align="center" class="label"><input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">&nbsp;&nbsp;
              <input type="submit" name="submit" id="submit" value="Save All Guard Data">
              <input type="hidden" name="action" id="action" value="<?php if(isset($_GET['id'])){ echo "EDIT";}?>">
              <input type="hidden" name="id" id="id" value="<?php if(isset($_GET['id'])){ echo $_GET['id'];}?>"></td>
            </tr><?php } ?>
        </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php } ?>