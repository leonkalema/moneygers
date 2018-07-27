<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();
$page ="../core/dashboard.php";
if($_POST['archieve']){
if($_POST['reminder']){
foreach($_POST['reminder'] as $rem => $value){
mysql_query("UPDATE messages SET isactive ='N' WHERE id='$value'");

	}


}

}else{
die("error");
}
forwardToPage($page);
?>