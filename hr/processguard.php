<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$formvalues = array_merge($_POST);

/****************************************************************************
 *																			*
 *  WARNING: Procedural code. Do not change the order unless you know what  *
 *			 you are doing!													*
 *																			*
 ***************************************************************************/

// Save the addresses:
// Guard present address
$formvalues['addressid'] = saveAddress($formvalues, "guardpreaddress_");
// Guard home address
$formvalues['homeaddressid'] = saveAddress($formvalues, "guardfamilyaddress_");
// Father address
$formvalues['father_addressid'] = saveAddress($formvalues, "father_");
// Mother address
$formvalues['mother_addressid'] = saveAddress($formvalues, "mother_");
// Guard birth place address
$formvalues['bplaceid'] = saveAddress($formvalues, "");
// Spouse birth place address
$formvalues['spouse_bplaceid'] = saveAddress($formvalues, "spousebirthplace_");
// Spouse present address
$formvalues['spouse_addressid'] = saveAddress($formvalues, "spouse_");
// Next of kin present address
$formvalues['nextofkin_addressid'] = saveAddress($formvalues, "nextofkin_");

// Return the right value whether is alive or dead depending on what is clicked
$formvalues['father_alive'] = isAlive($formvalues, "father_");
$formvalues['mother_alive'] = isAlive($formvalues, "mother_");

//Save the persons
// The guard person
$formvalues['personid'] = savePerson($formvalues, "");
// The parents:
$formvalues['fatherid'] = savePerson($formvalues, "father_");
$formvalues['motherid'] = savePerson($formvalues, "mother_");
// The spouse:
$formvalues['spouseid'] = savePerson($formvalues, "spouse_");
// The next of kin
$formvalues['nextofkinid'] = savePerson($formvalues, "nextofkin_");
// The children
// Returns a comma delimited list of ids of the children
$formvalues['childrenids'] = implode("," , saveAllChildren($formvalues, "childfname"));
// The schools and qualifications
// Returns a comma delimited list of ids of the schools
$formvalues['primaryschids'] = implode("," , saveAllSchools($formvalues, "primary"));
$formvalues['secondaryschids'] = implode("," , saveAllSchools($formvalues, "secondary"));
$formvalues['qualschids'] = implode("," , saveAllSchools($formvalues, "qual"));

// Save the guard experience
$experiencearray = array("armyexperience_", "policeexperience_", "prisonsexperience_");
$formvalues['experienceids'] = saveAllExperiences($formvalues, $experiencearray);

// Save the Uniform status
//First generate the uniform codes
$uniform_result = mysql_query("SELECT * FROM equipmentdetails WHERE type='Uniform' ORDER BY name ASC");
$uniformsarray = array();
while($uni_data = mysql_fetch_array($uniform_result, MYSQL_ASSOC)){
	$codename = strtolower(str_replace(" ","",$uni_data['name']));
	if(trim($codename) != ""){
		array_push($uniformsarray,$codename."_");
	}
}
if(count($uniformsarray) > 0){
	$formvalues['uniformids'] = saveAllUniforms($formvalues, $uniformsarray);
} else {
	$formvalues['uniformids'] = "";
}
// The guard's previous employers
$formvalues['employerids'] = saveAllEmployers($formvalues, "employer");
// The referees
$formvalues['refereeids'] = saveAllEmployers($formvalues, "referee");

// The land lord
$formvalues['landlordid'] = saveLandLord($formvalues);
// save the photo and fingerprint
$formvalues['photoname'] = uploadPhoto($_FILES['photofilename']['tmp_name'], $_FILES['photofilename']['name'], $_FILES['photofilename']['size'], $formvalues['MAX_FILE_SIZE'], $_FILES['photofilename']['error'], "photos/");

$formvalues['fingerprintname'] = uploadPhoto($_FILES['fingerprintfilename']['tmp_name'], $_FILES['fingerprintfilename']['name'],$_FILES['fingerprintfilename']['size'], $formvalues['MAX_FILE_SIZE'], $_FILES['fingerprintfilename']['error'], "fingerprints/");


if(isset($formvalues['guardupdateid'])){
	// Update guard info and then forward to appropriate page
	$query = "UPDATE guards SET guardid = '".$formvalues['guardid']."', personid = '".$formvalues['personid']."'";
	if(trim($formvalues['photoname']) != ""){
	$query .= ", photoname = '".$formvalues['photoname']."'";
	}
	if(trim($formvalues['fingerprintname']) != ""){
	$query .= ", fingerprintname = '".$formvalues['fingerprintname']."'";
	}
	if ($formvalues['uniformprovided'] == "Y"){
		$uniformprovided="Y";
	}else{
		$uniformprovided="N";
		$message="Add Uniform to guard";
	}
	
	$query .= ", dateofemployment = ".changeDateFromPageCombosToMySQLFormat($formvalues['startemployment_day'], $formvalues['startemployment_month'], $formvalues['startemployment_year']).", dateofexpiry =".changeDateFromPageCombosToMySQLFormat($formvalues['idexpiry_day'], $formvalues['idexpiry_month'], $formvalues['idexpiry_year']).", jobtitle = '".$formvalues['jobtitle']."', contractstartdate =".changeDateFromPageCombosToMySQLFormat($formvalues['contractstart_day'], $formvalues['contractstart_month'], $formvalues['contractstart_year']).", contractenddate =".changeDateFromPageCombosToMySQLFormat($formvalues['contractend_day'], $formvalues['contractend_month'], $formvalues['contractend_year']).", fatherid = '".$formvalues['fatherid']."', motherid = '".$formvalues['motherid']."', spouseid = '".$formvalues['spouseid']."', childrenids = '".$formvalues['childrenids']."', nextofkinid = '".$formvalues['nextofkinid']."', primaryschids = '".$formvalues['primaryschids']."', secondaryschids = '".$formvalues['secondaryschids']."', qualschids = '".$formvalues['qualschids']."', experienceids = '".$formvalues['experienceids']."', employerids = '".$formvalues['employerids']."', refereeids = '".$formvalues['refereeids']."', uniformids = '".$formvalues['uniformids']."', landlordid = '".$formvalues['landlordid']."', lc1letterprovided = '".$formvalues['lc1letter_provided']."', medicalexaminationdone = '".$formvalues['medicalexaminationdone']."', documentsids = '".$formvalues['documentsids']."', uniformprovided = '".$uniformprovided."', lastupdatedby = ".$_SESSION['userid'].", lastupdatedate = now() WHERE id = '".$formvalues['guardupdateid']."'";
	
} else {
	// Save unique guard info and then forward to appropriate page
	$query = "INSERT INTO guards(guardid, personid, photoname, fingerprintname, dateofemployment,jobtitle, dateofexpiry, contractstartdate, contractenddate, fatherid, motherid, spouseid, childrenids, nextofkinid, primaryschids, secondaryschids, qualschids, experienceids, employerids, refereeids, uniformids, landlordid, lc1letterprovided, medicalexaminationdone, documentsids, uniformprovided, createdby, datecreated) VALUES ('".$formvalues['guardid']."', '".$formvalues['personid']."', '".$formvalues['photoname']."', '".$formvalues['fingerprintname']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['startemployment_day'], $formvalues['startemployment_month'], $formvalues['startemployment_year']).",'".$formvalues['jobtitle']."', ".changeDateFromPageCombosToMySQLFormat($formvalues['idexpiry_day'], $formvalues['idexpiry_month'], $formvalues['idexpiry_year']).", ".changeDateFromPageCombosToMySQLFormat($formvalues['contractstart_day'], $formvalues['contractstart_month'], $formvalues['contractstart_year']).", ".changeDateFromPageCombosToMySQLFormat($formvalues['contractend_day'], $formvalues['contractend_month'], $formvalues['contractend_year']).", '".$formvalues['fatherid']."', '".$formvalues['motherid']."', '".$formvalues['spouseid']."', '".$formvalues['childrenids']."', '".$formvalues['nextofkinid']."', '".$formvalues['primaryschids']."', '".$formvalues['secondaryschids']."', '".$formvalues['qualschids']."', '".$formvalues['experienceids']."', '".$formvalues['employerids']."', '".$formvalues['refereeids']."', '".$formvalues['uniformids']."','".$formvalues['landlordid']."', '".$formvalues['lc1letter_provided']."', '".$formvalues['medicalexaminationdone']."',  '".$formvalues['documentsids']."', '".$uniformprovided."', '".$_SESSION['userid']."', NOW())";
}
//echo $query; exit;
$result = mysql_query($query);

# check if any errors have occured during the saving the activities to the database
if (mysql_error() == "") {
	# no errors occured, so return the last inserted id
	$formvalues['guard_ref'] = mysql_insert_id();
	
	if(isset($formvalues['guardupdateid'])){
		$formvalues['guard_ref'] = $formvalues['guardupdateid'];
	}
	
	//Put a reminder to add uniform for guard, to be seen by all concerned parties on their dashboards
	if ($uniformprovided=="N"){
		mysql_query("INSERT INTO messages (reason,details,sentby,sentto,date) VALUES ('".$message."','<a href=\"../hr/index.php?id=".encryptValue($formvalues['guard_ref'])."&a=edit\">Provide Uniform</a>','".$_SESSION['userid']."','1,79,82',now())");
	}
	
} else {
	# add the error message to the string
	$_SESSION['error'] .= "ERROR: Could not save the guard information. Please try again. DETAILS: ".mysql_error();
	
}

forwardToPage("../hr/index.php?id=".encryptValue($formvalues['guard_ref']));
?>
