<?php
include_once "../include/commonfunctions.php";
session_start();
openDatabaseConnection();

if(isset($_POST['save'])){
	$formvalues = array_merge($_POST);
	$_SESSION['formvalues'] = $formvalues;
	$sectiontype = $formvalues['favoritesection'];
	//Save the new selected favorites
	$user_details = getRowAsArray("SELECT favorites FROM users WHERE id = '".$_SESSION['userid']."'");
	$favorites = split(",",$user_details['favorites']);
	$selected_values = array();
	for($i=0;$i<count($formvalues['favorite']);$i++){
		//Add missing favorites
		if(!in_array($formvalues['favorite'][$i],$favorites)){
			//The new ids to be put into the user's record
			array_push($favorites,$formvalues['favorite'][$i]);
		}
		//The selected ids
		array_push($selected_values,$formvalues['favorite'][$i]);
	}
	$passedvalues = split(",",$formvalues['passedvalues']);
	//Remove all those ids that were de-selected
	for($j=0;$j<count($passedvalues);$j++){
		if(!in_array($passedvalues[$j],$selected_values)){
			if(in_array($passedvalues[$j],$favorites)){
				$key = array_search($passedvalues[$j], $favorites);
				$favorites[$key] = "";
			}
		}
	}
	//Make a clean array for saving into the db
	$clean_array = array();
	for($k=0;$k<count($favorites);$k++){
		if($favorites[$k] != ""){
			array_push($clean_array,$favorites[$k]);
		}
	}
	mysql_query("UPDATE users SET favorites = '".implode(",",$clean_array)."' WHERE id = '".$_SESSION['userid']."'");
}

if(isset($_GET['t'])){
	$_SESSION['section'] = $_GET['t'];
	$sectiontype = $_SESSION['section'];
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Update Favorites</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0" onLoad="setDiv('../core/favorites.php?t=<?php echo $_SESSION['section'];
?>&value=','sectiondetails','','Loading...'); return false; ">
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
        <td class="headings">Update Favorites for <?php echo $_SESSION['names'];?></td>
      </tr>
      <tr>
        <td><form action="../core/favorites.php" method="post" name="favorites" id="favorites"><table width="100%" border="0" cellpadding="5" cellspacing="2">
          <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){ ?>
		   <tr>
		   <td colspan="2"><b class="redtext"><?php echo $_SESSION['msg'];?></b></td>
		   </tr>
		   <?php 
		   	$_SESSION['msg'] = "";
		   } ?>
            <tr>
            <td width="1%" align="right" class="label">Section:</td>
            <td width="99%" valign="top"><select name="favoritesection" id="favoritesection" onChange="pickFavoriteAndDirect('favoritesection', '../core/favorites.php?t=', 'Please select a section of favorites')">
              <option value="">&lt;Select One&gt;</option>
              <?php 
			  $fav_result = mysql_query("SELECT id, name FROM favoritesection");
			  while($line1 = mysql_fetch_array($fav_result, MYSQL_ASSOC)){
			  	echo "<option value=\"".$line1['id']."\"";
				if($line1['id'] == $sectiontype){
					echo " selected";
				}
				echo ">".$line1['name']."</option>";
			  }
			  
			  ?>
            </select></td>
            </tr>
            <tr>
            <td align="right" nowrap class="label">&nbsp;</td>
            
			<td colspan="2" valign="top"><div id="sectiondetails1" style="width:400; height:170; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;"><table width="100%" border="0" cellspacing="0" cellpadding="2">
			    <?php
				   		$user_array = getRowAsArray("SELECT favorites FROM users WHERE id = '".$_SESSION['userid']."'");
						$result = mysql_query("SELECT * FROM favorites WHERE section = '".$sectiontype."' ORDER BY name");
						$passed_values = array();
				   		while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		if(in_array($_SESSION['groups'],split(",",$line['viewedby']))){
								$row = "<tr><td width=\"1%\"><input type=\"checkbox\" name=\"favorite[]\" value=\"".$line['id']."\"";
					  			if(in_array($line['id'],split(",",$user_array['favorites']))){
									$row .= "checked";
								}
					  			$row .= "></td><td width=\"99%\">".$line['name']." ";
								//Check if admin and then allow to edit
								if($_SESSION['groups'] == "1"){
									$row .= "[ <a href=\"updatefavorite.php?id=".$line['id']."&t=".$sectiontype."\">Edit</a> ]";
								}
								$row .= "</td></tr>";
					  			echo $row;
								array_push($passed_values,$line['id']);
							}
				   		}
				   ?>
			    
			    </table>
               </div>
			  <input name="passedvalues" type="hidden" id="passedvalues" value="<?php echo implode(",",$passed_values);?>"></td>
			</tr>
            <tr>
              <td align="right" nowrap class="label">&nbsp;</td>
              <td colspan="2" valign="top">&nbsp;</td>
              </tr>
            <tr>
              <td align="right" nowrap class="label">&nbsp;</td>
              <td colspan="2" valign="top"><input type="submit" name="save" id="save" value="Save Settings"></td>
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
