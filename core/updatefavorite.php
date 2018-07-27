<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
session_start();
$data = getRowAsArray("SELECT * FROM favorites WHERE id = '".$_GET['id']."'");

//Updated data being saved
if(isset($_POST['submit'])){
	$formvalues = array_merge($_POST);
	
	mysql_query("UPDATE favorites SET name='".$formvalues['name']."', link='".$formvalues['link']."', viewedby='".implode(",",$formvalues['usergroup'])."' WHERE id = '".$formvalues['favoriteid']."'");
	if(mysql_error()== ""){
		$_SESSION['msg'] = "Your favorite details for ".$formvalues['name']." have been updated.";
	} else {
		$_SESSION['msg'] = "There was a problem saving your data. Please contact your administrator.";
	}
	forwardToPage("favorites.php?t=".$formvalues['sectionid']);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Moneyge My Company - Update Favorite</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../Styles/ultimatesecurity.css" rel="stylesheet" type="text/css">
<script src="../javascript/smartguard.js" type="text/javascript" language="javascript"></script>
</head>

<body class="mainbackground" topmargin="0" bottommargin="0">
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="outtertablebg">
  <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td><?php include "../core/header.php";?></td>
  </tr> <tr> 
    <td height="7"></td>
  </tr>
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" class="contenttableborder" cellspacing="0">
      <tr>
        <td class="headings"><a href="../core/favorites.php?t=<?php echo $_GET['t'];?>">Update Favorites</a>  &gt; Who Views <?php echo $data['name'];?></td>
      </tr> 
      <tr>
        <td><form action="updatefavorite.php" method="post" name="group" id="group" onSubmit=" return isNotNullOrEmptyString('name', 'Please enter a name for the favorite.') && isNotNullOrEmptyString('link', 'Please enter a relative link for the favorite.');"><table width="100%" border="0">
          <tr>
            <td align="right" class="label"><font class="redtext">*</font> is a required field </td>
            <td>&nbsp;</td>
          </tr>
		
          <tr>
            <td height="30" align="right" class="label2">Favorite:<font class="redtext">*</font></td>
            <td>
              &nbsp;
              <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>">
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td height="30" align="right" class="label2">Favorite Link:<font class="redtext">*</font></td>
            <td class="label">&nbsp;
                <input type="text" name="link" id="link" value="<?php echo $data['link']; ?>">
              (Use a relative link. If not sure, please contact the supplier.) </td>
          </tr>
          <tr>
            <td height="30" align="right" valign="top" class="label2">Viewed By: <font class="redtext">*</font></td>
            <td><div id="div" style="width:350; height:150; font-style:normal; color:#000066; font-weight:bolder; font-size:14px;overflow: auto; border-color:#CCCCCC; border-style:solid;">
                <table width="100%" border="0" cellspacing="0" cellpadding="2">
				<?php
				   		$result = mysql_query("SELECT id, name FROM groups ORDER BY name");
				   		$i = 0;
						while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
				      		
							if(($i%2)==0) {
				    			$rowclass = "evenrow";
				  			} else {
				     			$rowclass = "oddrow";
				  			}
							
							$row = "<tr class = \"".$rowclass."\"><td><input type=\"checkbox\" name=\"usergroup[]\" id=\"usergroup[]".$line['id']."\" value=\"".$line['id']."\"";
							
							//Check whether the group is previously allowed to view the group
							if(in_array($line['id'],split(",",$data['viewedby']))){
								$row .= "checked";
							}
							$row .= "></td><td>".$line['name']."</td></tr>";
					  
					  		echo $row;
				   			$i++;
						}
				   ?>
                </table>
              </div></td>
          </tr>
          <tr>
            <td align="right" class="label2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="label">&nbsp;</td>
            <td>&nbsp;
              <input type="button" name="cancel" id="cancel" value="<< Back" onClick="javascript:history.go(-1);">
              <input type="submit" name="submit" id="submit" value="Save">
              <input type="hidden" name="favoriteid" value="<?php echo $_GET['id'];?>">
              <input type="hidden" name="sectionid" value="<?php echo $_GET['t'];?>"></td>
          </tr>
        </table>
        </form></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="copyright"><?php include("../include/footer.php");?></td>
  </tr>
  <tr> 
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>


