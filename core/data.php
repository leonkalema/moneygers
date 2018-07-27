<?php
	include_once "../include/lib.php";
	$conn = new connection();
	$OptionList = new utilities();
	$OptionList->link = $conn->link;
	$OptionList->table = "rooms";
	$OptionList->filter = "roomName";
	$OptionList->id = $_GET['q'];
	echo "<select  name = \"room\" onchange=\"show(this.value)\">";
	$OptionList->write_option_list_2();
	echo "</select>";
	unset($OptionList);
?>