<?php
//Page returns shows a form for adding items to a list depending on what is passed
include_once "../include/commonfunctions.php";
openDatabaseConnection();
$showlayer = "";

// Update the item according to the selected item
if(isset($_GET['sect']) && $_GET['sect'] == "guardstatus"){
	
	if($_GET['item'] != ""){
		$id_array = split("_",$_GET['item']);
		
		$query = "UPDATE guards SET status = '".$id_array[0]."', lastupdatedate=now()  WHERE id='".$id_array[1]."'";
		mysql_query($query);
		$message = "Guard status has been successfully updated.<br><a href=\"manageguards.php\">Refresh</a>";
		
	} else {
		$message = "Please select a status.";
	}
	
	
}


// Specify where the messages and form are to be dislayed
if(isset($_GET['area']) && $_GET['area'] == "guardstatus"){
	$id_value = $_GET['id'];
	$valuecolumn = "status";
	$dropresult = mysql_query("SELECT status FROM guardstatus");
	$showlayer = "guardstatus_".$id_value;
} 
?>

  <table border="0" cellspacing="0" cellpadding="0">
  <?php if(isset($message) && $message != ""){?>
  <tr>
      <td colspan="2" style="color:#000066; font-weight:bold"><?php echo $message;?></td>
    </tr>
 <?php } else {?>
    <tr>
      <td><select name="item" id="item">
        <option>&lt;Select one&gt;</option>
	  	<?php
		while($selectrow = mysql_fetch_array($dropresult,MYSQL_ASSOC)){
			echo "<option value=\"".$selectrow[$valuecolumn]."_".$id_value."\">".$selectrow[$valuecolumn]."</option>";
		}
		?>
      </select>
      </td>
      <td nowrap="nowrap">&nbsp;
	  <input type="button" name="Button" value="Update" onclick="pickFormItem('item', 'forwardURL','addLayer')" />
	 <input name="forwardURL" id="forwardURL" type="hidden" value="../include/dropdownupdate.php?sect=<?php echo $_GET['area'];?>&item=" /><input name="addLayer" id="addLayer" type="hidden" value="<?php echo $showlayer;?>" />
	 	 
	 
	 </td>
    </tr>
	<?php } ?>
  </table>


