<?php
include_once "../class/class.group.php";
session_start();

$name=$_POST['name'];

openDatabaseConnection();

if(isset($_GET[check]))
{
$query1=mysql_query("select name from groups where name='$name'");
}


?>