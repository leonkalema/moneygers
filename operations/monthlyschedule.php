<?php
include_once "../include/commonfunctions.php"; 
session_start();
openDatabaseConnection();

//Merge all passed values
if(isset($_POST)){
	$formvalues = array_merge($_POST);
}

//Add the selected assignments to the list shown in the schedules
if(isset($_POST['selectValues']) && $_POST['selectValues'] != ""){
	//Add selected callsigns to the list of callsigns
	if(count($formvalues['callsign']) > 0){
		for($i=0;$i<count($formvalues['callsign']);$i++){
			//Ensure that the callsign was not already added and the max number of six
			// is not exceeded.
			if(isset($_SESSION['selectedCallSigns']) && (!in_array($formvalues['callsign'][$i],$_SESSION['selectedCallSigns'])) && (count($_SESSION['selectedCallSigns']) < 6)){
				array_push($_SESSION['selectedCallSigns'],$formvalues['callsign'][$i]);
				echo "THe ".$i."th Call Sign: ".$formvalues['callsign'][$i];
			} else if(!isset($_SESSION['selectedCallSigns'])){
				$_SESSION['selectedCallSigns'] = array();
				array_push($_SESSION['selectedCallSigns'],$formvalues['callsign'][$i]);
			}
		}
	}
}

//The person decides to generate a new schedule
if(isset($_GET['a']) && $_GET['a'] == "new"){
	$_SESSION['selectedCallSigns'] = array();
	$_SESSION['weekending'] = "";
	
	if(isset($_GET['d']) && $_GET['d'] == "back"){
		$_SESSION['returnURL'] = "";
		forwardToPage("../core/dashboard.php");
	}
}

//The last sunday of the week
if(isset($formvalues['weekending']) && $formvalues['weekending'] != ""){
	$_SESSION['weekending'] = $formvalues['weekending'];
}
$datestring = $_SESSION['weekending'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Generate Guard Schedule</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
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
        <td class="headings">Generate Guard Monthly Schedule</td>
      </tr>
      <tr>
        <td><form action="index.php" method="post" name="guardschedule" id="guardschedule" onSubmit="return isNotNullOrEmptyString('clientname', 'Please enter the number of the guard who reported this incident / search and select the guard among the search results.');"><table width="100%" border="0">
          
          <tr>
            <td colspan="2" valign="top"><b>Instructions:</b><br>
              1. Search for the guard using the guard's name (enter all/part of the name).<br>
2. Select the guard whose schedule you want to view.<br>
3. Select the month you want to view.<br>
4. Generate the schedule. </td>
            </tr>
          <tr>
            <td width="57%" valign="top" class="contenttableborder"><table width="90%" border="0" cellpadding="2" cellspacing="0">
              <tr>
                <td colspan="2" class="label">1. Search for Assignment (Call Sign): </td>
                </tr>
              <tr>
                <td width="49%">Enter Guard Name: </td>
                <td width="51%" nowrap><input name="clientname" id="clientname" type="text" onClick="this.select()">
                  &nbsp;<img src="../images/bullet.gif">&nbsp;<a href="#" onClick="setDiv('../include/resultsforpage.php?area=return_guards&value=','guard_search','clientname','Searching...'); return false; ">Search</a>&nbsp;</td>
              </tr>
              
            </table></td>
            <td width="43%" valign="top" class="contenttableborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><span class="label">2. Select Guard:</span></td>
              </tr>
              <tr>
                <td><div id="guard_search" style="width:250px; height:0px; font-style:normal;font-family: verdana;font-size: 10px; color:#000066; font-weight:bolder; font-size:14px;overflow: auto"></div>
                  </td>
              </tr>
            </table></td>
          </tr>
		
          <tr>
            <td height="24" class="contenttableborder"><table border="0" cellspacing="0" cellpadding="2">
              
              <tr>
                <td nowrap class="label">3. Generate for Week Ending:<br></td>
                <td><select name="weekending" id="weekending">
                    <option value="">&lt;Select One&gt;</option>
                    <?php
					for($j=0;$j<7;$j++){
						$str = "+ ".$j;
						$datestr = "next sunday ".$str." week";
						echo "<option value=\"".date("d-M-Y",strtotime($datestr))."\"";
						if($datestring == date("d-M-Y",strtotime($datestr))){ echo "selected";}
						echo ">".date("d-M-Y",strtotime($datestr))."</option>";
					}?>
                </select></td>
              </tr>
            </table></td>
            <td height="24" class="contenttableborder" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="label">4. Generate Schedule: </td>
              </tr>
              <tr>
                <td height="45" valign="bottom"><input type="submit" name="ViewSchedule" id="ViewSchedule" value="Generate Schedule &gt;&gt;"></td>
              </tr>
            </table></td>
          </tr>
			<tr>
			  <td colspan="2">&nbsp;<img src="../images/bullet.gif">&nbsp;<a href="../operations/?a=new">Generate New Schedule</a>&nbsp;| <a href="../operations/?a=new&d=back">Back to Dashboard</a> </td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2"><div id="printresults_div" style="<?php
			 if(count($_SESSION['selectedCallSigns'])>0 && $datestring != ""){
			 echo "visibility:visible";
			 } else {
			  echo "height:0px; visibility:hidden";
			 }
			 ?>"></div>
			</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td>&nbsp;</td>
			  <td><input type="button" name="cancel" id="cancel" value="Cancel" onClick="javascript:window.location.href='../core/dashboard.php';">
                <input type="button" name="Button" id="submit" value="Print"  onClick="openPopWindow(600,350,'Guard Print Report','print')"></td>
			</tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
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