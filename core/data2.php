<?php
	include_once "../include/lib.php";
	$conn = new connection();
	$OptionList = new utilities();
	$OptionList->link = $conn->link;
	$OptionList->table = "buildings";
	$OptionList->filter = "buildingName";
	$OptionList->id = $_GET['q'];
	echo "<select  name = \"room\" onchange=\"show(this.value)\">";
	print "<option>Select building</option>";
	$OptionList->write_option_list_3();
	echo "</select>";
	unset($OptionList);
?>